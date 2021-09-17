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


 
/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate me</a>';
	}
	return $actions;
}
 
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );