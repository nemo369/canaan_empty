<?php
defined('ABSPATH') || die();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// !! Field Name Patterns : most have uniqe prefix
// https://docs.carbonfields.net/#/advanced-topics/field-name-patterns?id=field-name-patterns


add_action('carbon_fields_register_fields', 'crb_attach_post_options');
function crb_attach_post_options()
{
    $post_type = 'post';
    $prefix = 'post_';
    $metaBox = Container::make('post_meta', 'הגדרות כלליות');
    $metaBox->where('post_type', '=', $post_type);
    $metaBox->add_fields(
        array(
            Field::make('image', $prefix . 'image', 'תמונת תצוגה 1:1  {width:350,height:350}')
                ->set_value_type('id'),
            Field::make('separator', 'crb_separator', __('Separator')),
            Field::make('complex', $prefix . 'services', ' זהו שדה מורכב')
                ->add_fields(array(
                    Field::make('text', 'name'),
                )),
        )
    );
}
