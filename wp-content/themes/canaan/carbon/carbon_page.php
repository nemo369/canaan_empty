<?php
defined('ABSPATH') || die();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_page_options');
function crb_attach_page_options()
{
    $prefix = 'page-home';
    $post_template =  $prefix.'.php';
    $metaBox = Container::make('post_meta', 'הגדרות כלליות')->where('post_template', '=', $post_template);
    $metaBox->add_fields(array(
        Field::make( 'date', $prefix.'date', 'תאריך' ),
    ));


}


// add_action('carbon_fields_{container_type}_container_saved', 'crb__post_meta_container_save');
add_action('carbon_fields_post_meta_container_saved', 'crb__post_meta_container_save');

function crb__post_meta_container_save(){
}