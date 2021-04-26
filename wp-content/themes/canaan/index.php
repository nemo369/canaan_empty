<?php
if ( !defined('ABSPATH') ){
    die();
}

 
get_header();
global $posts;
echo '<h1 class="text-center text-5xl py-16 px-6 bg-green-100">This is the New Bright and Shine CANAAN Theme</h1>';
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
