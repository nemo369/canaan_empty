<?php
// THIS file is only to include and require other files -> use canaan-functiion for genreal 
defined('ABSPATH') || die();
if(!class_exists('canaan_conf')){
    die('wrong instaliton');
}
 
 
include_once(dirname(__FILE__).'/wpack.php');
include_once(dirname(__FILE__).'/canaan-functions.php');
include_once(dirname(__FILE__).'/framework/framework.php');
include_once(dirname(__FILE__).'/post_types/register_post_types.php');
include_once(dirname(__FILE__).'/carbon/carbon.php');



add_action( 'carbon_fields_register_fields', 'canaan_load_my_functions_cb',50 );
function canaan_load_my_functions_cb() {
    // include_once(dirname(__FILE__).'/myfunctions.php');
}
 



//     wp_set_current_user(1);
//      wp_set_auth_cookie( 1, true ) ;