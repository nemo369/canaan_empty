<?php
defined('ABSPATH') || die();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_term_options');
function crb_attach_term_options()
{
    $taxonomy = 'category';
    $prefix = 'taxonomy_';
    $metaBox = Container::make('term_meta', 'הגדרות כלליות')->where('term_taxonomy', '=', $taxonomy);
    $metaBox->add_fields(array(
        Field::make( 'color', $prefix.'color', 'צבע' ),
    ));

    // tags
    $taxonomy = 'post_tag';
    $prefix = 'tag_';
    $metaBox = Container::make('term_meta', 'הגדרות כלליות')->where('term_taxonomy', '=', $taxonomy);
    $metaBox->add_fields(array(
        // Field::make( 'textarea', $prefix.'desc', 'תיאור' ),
    ));
}
