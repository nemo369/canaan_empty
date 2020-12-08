<?php
defined('ABSPATH') || die();


include_once(dirname(__FILE__).'/canaan_image.class.php');
include_once(dirname(__FILE__).'/canaan_post.class.php');
include_once(dirname(__FILE__).'/pll.php');
include_once(dirname(__FILE__).'/ajax.php');


function canaan_static($root = ''){
	return get_template_directory_uri().'/static' .($root ? '/'.$root : ''); 
}
