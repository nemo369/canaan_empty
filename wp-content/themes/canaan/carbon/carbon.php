<?php
defined('ABSPATH') || die();

use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( canaan_conf::$carbonDir.'/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}


// If you delete this tag, the sky will fall on
add_filter( 'carbon_fields_map_field_api_key', 'crb_get_gmaps_api_key' );
function crb_get_gmaps_api_key( $key ) {
    return 'AIzaSyCS6dS49kCzuQUFjVCtlj3JsTXCZvv01gw';
}

// carbon fileds import
include_once(dirname(__FILE__) . '/carbon_misc.php');
include_once(dirname(__FILE__) . '/carbon_post.php');
include_once(dirname(__FILE__) . '/carbon_term.php');
include_once(dirname(__FILE__) . '/carbon_page.php');
// carbon fileds import


add_action( 'carbon_fields_post_meta_container_saved', 'crb_after_save_event' );
function crb_after_save_event( $post_id ) {
    // var_dump($post_id);
}