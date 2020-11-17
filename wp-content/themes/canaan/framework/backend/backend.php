<?php
defined('ABSPATH') || die();


class canaan_backend{
    static $fields=[];
    
    static public function add($args){
        self::$fields[] = $args; 
    }
    
    static public function get(){
       return self::$fields; 
    }
}
 




add_action('admin_menu', 'mwpages_admin_menu_cb');
function mwpages_admin_menu_cb()
{
    global $plugin_page;

    add_submenu_page(
        'tools.php',
        'Static Versions',
        'Static Versions',
        'manage_options',
        'mwpage_static_versions',
        'mwpage_out_page_cb'
    );
}
function mwpage_out_page_cb()
{
    global $plugin_page;
    if (!isset($plugin_page)) {
        return;
    }
    include(dirname(__FILE__).'/'.$plugin_page.'.php');
}
function mwpage_fetch_events_out_page_cb()
{
    global $plugin_page;
    if (!isset($plugin_page)) {
        return;
    }
    include(dirname(__FILE__).'/'.$plugin_page.'.php');
}






add_action( 'admin_enqueue_scripts', 'canaan_enqueue_my_script',9999 );

function canaan_enqueue_my_script( $page ) {
    
    wp_enqueue_script( 'my-script', canaan_static('framework/backend/js/backend.js'), null, 3, true );
}


 add_action( 'admin_footer', 'canaan_print_images_dimin_cb' );
 function canaan_print_images_dimin_cb(){
     
     $data=[];
     $args = array('post_type'=>'attachment','numberposts'=>-1,'post_status'=>null);
   $attachments = get_posts($args);
    if($attachments){
          foreach($attachments as $attachment){
             $img=new canaan_image($attachment->ID);
             if($img){
                 $data[$attachment->ID]=[$img->get_width(),$img->get_height()];
             }
            }
      }
      
?>
<script>
    
    var canaanAttachments=<?php echo json_encode($data); ?>;
    var noImgSrch='<?php echo canaan_static('framework/backend/img/noimg.jpg'); ?>';
   </script>
   
   <style>
       
       .canaan_error{
           display: block; width:100%; font-weight:bold; margin-top:10px; color:red; font-size: 20px;
       }
       .block-editor .cf-field.cf-complex{
           border:1px solid #4d555d;
               margin-bottom: 15px;
       }
       .block-editor .cf-field.cf-complex .cf-field.cf-complex{
             border:1px solid #e2e4e7;
               margin-bottom: 0;
       }
       body .cf-complex__group-head{
           background-color: #4d555d;
       }
       body .cf-field.cf-complex .cf-field.cf-complex .cf-complex__group-head{
             background-color: #fbfbfc;
       }
       .cf-container-user-meta .cf-container__fields>.cf-field>.cf-field__head, .term-php .cf-container__fields>.cf-field>.cf-field__head{
           left:auto; right:0;
       }
   </style>
 
<?php
}


/*
 * Function for post duplication. Dups appear as drafts. User is redirected to the edit screen
 */
function rd_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
 
	/*
	 * Nonce verification
	 */
	if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
		return;
 
	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );
 
	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {
 
		/*
		 * new post data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft', //publish
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		/*
		 * insert the post by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post( $args );
 
		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		/*
		 * duplicate all post meta just in two SQL queries
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				if( $meta_key == '_wp_old_slug' ) continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
        // wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
        wp_redirect( admin_url( 'edit.php' ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
 
/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">שכפל אותי</a>';
	}
	return $actions;
}
 
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );