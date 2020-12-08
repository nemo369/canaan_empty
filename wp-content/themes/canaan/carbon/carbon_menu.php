<?php
defined('ABSPATH') || die();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_nav_options');
function crb_attach_nav_options()
{

    $prefix = 'nav_';
    $metaBox = Container::make('nav_menu_item', 'תריט');
    $metaBox->add_fields( array(
        Field::make( 'image', "{$prefix}_image",'הוסף תמונה 211X125' )->set_value_type('url'),
    ));

    
}
