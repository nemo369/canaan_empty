<?php
defined('ABSPATH') || die();

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{

    $prefix = 'misc_';
    $metaBox = Container::make('theme_options', 'Miscellaneous');
    $metaBox->add_tab('כללי', array(
        Field::make('complex', "{$prefix}email_accounts", 'E-mails for site notfications')
            ->add_fields(array(
                Field::make('text', 'email', 'E-mail')->set_attribute( 'type', 'email' )->set_attribute( 'placeholder', 'test@test.com' ),
            ))
    ));
}
