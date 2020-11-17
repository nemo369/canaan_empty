<?php
defined('ABSPATH') || die();


include_once(dirname(__FILE__).'/canaan_image.class.php');
include_once(dirname(__FILE__).'/canaan_post.class.php');
include_once(dirname(__FILE__).'/pll.php');
include_once(dirname(__FILE__).'/ajax.php');


function canaan_static(){
	return canaan_conf::$static; 
}
