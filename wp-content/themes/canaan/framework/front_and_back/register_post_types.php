<?php

if ( !defined('ABSPATH') ){
    die();
}



add_action( 'init', 'canaan_register_post_types_cb' );
function canaan_register_post_types_cb() {
	// $args = get_register_taxonomy_args('כותבים','writer','category',['menu_icon' => 'dashicons-carrot',],'ים');
	// register_taxonomy( $args['rewrite']['slug'],$args['rewrite']['slug'], $args );
	// register_taxonomy_for_object_type('writer','post');

	// $args = get_register_post_type_args('כותבים','writer',['menu_icon' => 'dashicons-carrot',],'ים');
	// register_post_type( $args['rewrite']['slug'], $args );
       
}
/**
 * canaan: get defuelt vals for register a post type.
 *
 * @param string $name The name in the menu.
 * @param string $slug The slug name must be uniqe dont use 'type','date' and so...
 * @param array $args The defaults oveerride
 * @param string $plurel can be in hebrew or english ('s')
 */
function get_register_post_type_args($name, $slug, $args =[], $plurel= 'ים'){
	$labels = get_register_post_type_labels($name, $plurel);
	$defaults = array(
		'labels'             => $labels,
		'description'        => '',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => ['slug' => $slug],
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'exclude_from_search'       => false,
		'menu_position'      => null,
		'taxonomies'      => [],
		'show_in_rest'=>true,
		'supports' => ['title','page-attributes'],
		'menu_icon' => 'dashicons-edit',

	);

  $return = wp_parse_args( $args, $defaults );
	return $return;
}

function get_register_post_type_labels($name, $plurel= 's'){
	$labels = array(
		'name'               => $name,
		'singular_name'      => $name,
		'menu_name'          => $name.$plurel,
		'name_admin_bar'     => $name,
		// 'add_new'            => 'הוסף '.$name.' חדש',
		// 'add_new_item'       => 'הוסף '.$name.' חדש',
		// 'new_item'           => ''.$name.' חדש',
		// 'edit_item'          => 'עריכה',
		// 'view_item'          => 'הצגה',
		// 'all_items'          => 'כל ה'.$name.$plurel,
		// 'search_items'       => 'חיפוש',
		// 'parent_item_colon'  => ''.$name.' אב',
		// 'not_found'          => 'לא נמצאו תוצאות',
		// 'not_found_in_trash' => 'לא נמצאו תוצאות',
	);
	return $labels;
}



function get_register_taxonomy_labels($name, $plurel= 'ים'){
	$labels = array(
		'name'              => $name.$plurel,
		'singular_name'     =>  $name,
		'search_items'      => 'חיפוש '. $name.$plurel,
		'all_items'         => 'כל '. $name.$plurel,
		'parent_item'       =>'הורה '. $name.$plurel,
		'parent_item_colon' => 'הורה סוג '. $name,
		'edit_item'         => 'ערוך '. $name,
		'update_item'       =>  'עדכן '. $name,
		'add_new_item'      => 'הוסף '. $name,
		'new_item_name'     =>  'הוסף חדש '. $name,
		'menu_name'         => $name
	);
	return $labels;
}


function get_register_taxonomy_args($name, $slug,$tax_type='category', $args =[], $plurel= 'ים'){
	$labels = get_register_taxonomy_labels($name, $plurel);
	$defaults = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'=>true,
		'query_var'         => true,
		'rewrite'           => ['slug' => $slug],

	);

  $return = wp_parse_args( $args, $defaults );
return $return;
}



