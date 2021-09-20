<?php
defined('ABSPATH') || die();


class canaan_backend{
    static $fields=[];
    
    static public function add($args){
        self::$fields[] = $args; 
    }
    
    static public function get(){
       return self::$fields; 
    }
}
 




add_action('admin_menu', 'mwpages_admin_menu_cb');
function mwpages_admin_menu_cb()
{
    global $plugin_page;

    add_submenu_page(
        'tools.php',
        'Static Versions',
        'Static Versions',
        'manage_options',
        'mwpage_out_page_cb'
    );
}
function mwpage_out_page_cb()
{
    global $plugin_page;
    if (!isset($plugin_page)) {
        return;
    }
    include(dirname(__FILE__).'/'.$plugin_page.'.php');
}
function mwpage_fetch_events_out_page_cb()
{
    global $plugin_page;
    if (!isset($plugin_page)) {
        return;
    }
    include(dirname(__FILE__).'/'.$plugin_page.'.php');
}


