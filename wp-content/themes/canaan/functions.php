<?php
defined('ABSPATH') || die();
if(!class_exists('canaan_conf')){
    die('wrong instaliton');
}
 
 
include_once(dirname(__FILE__).'/wpack.php');
include_once(dirname(__FILE__).'/theme-functions.php');
include_once(dirname(__FILE__).'/framework/framework.php');
include_once(dirname(__FILE__).'/post_types/register_post_types.php');
include_once(dirname(__FILE__).'/carbon/carbon.php');


//     wp_set_current_user(1);
//      wp_set_auth_cookie( 1, true ) ;