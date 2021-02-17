<?php
defined('ABSPATH') || die();

include_once(dirname(__FILE__) . '/components.php');
include_once(dirname(__FILE__) . '/svg.php');


function canaan_get_menu_array($current_menu = 'Main Menu')
{

    $menuLocations = get_nav_menu_locations();
    $menuID = isset($menuLocations[$current_menu]) ? $menuLocations[$current_menu] : null;
    $menu_array = wp_get_nav_menu_items($menuID);
    $menu = array();
    foreach ((array) $menu_array as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID'] = $m->ID;
            $menu[$m->ID]['title'] = $m->title;
            $menu[$m->ID]['url'] = $m->url;
            $menu[$m->ID]['classes'] = $m->classes;
            $menu[$m->ID]['type'] = $m->type;
            $menu[$m->ID]['children'] = populate_children($menu_array, $m);
    
        }
    }

    return $menu;
}
function populate_children($menu_array, $menu_item)
{
    $children = array();
    if (!empty($menu_array)) {
        foreach ($menu_array as $k => $m) {
            if ($m->menu_item_parent == $menu_item->ID) {
                $children[$m->ID] = array();
                $children[$m->ID]['ID'] = $m->ID;
                $children[$m->ID]['title'] = $m->title;
                $children[$m->ID]['url'] = $m->url;
                $children[$m->ID]['classes'] = $m->classes;
                $children[$m->ID]['type'] = $m->type;
                unset($menu_array[$k]);
                $children[$m->ID]['children'] = populate_children($menu_array, $m);
            }
        }
    };
    return $children;
}


function order_posts_by_menu_order($query)
{
    if (!is_admin() && $query->is_main_query()) {
            $query->set('orderby','menu_order');
    }
}
add_action('pre_get_posts', 'order_posts_by_menu_order');