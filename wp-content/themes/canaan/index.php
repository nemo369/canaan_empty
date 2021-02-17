<?php
if ( !defined('ABSPATH') ){
    die();
}

 
get_header();
global $posts;
echo '<br><br><h1 class="tac" style="font-size:50px">This is the New Bright and Shine CANAAN Theme</h1><br>';
echo '<main  class="wp-content">';
echo '<ul>';
$prefix = 'post_';
foreach ((array)$posts as $key => $post) {
    $mainObj=new canaan_post($post);
    $url=$mainObj->get_url();
    echo '<li><a href="'.$url.'">'.$mainObj->get_title().'</a><br>';
 
   echo get_img_html($prefix.'image');
    echo '</li>';
}
echo '</ul></main>';   

echo '<hr><br><br>';
// misc
$prefix = 'misc_';

$misc=carbon_get_theme_option( $prefix.'email_accounts' );
var_dump($misc);

get_footer();
