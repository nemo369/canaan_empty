<?php
defined('ABSPATH') || die();


include_once(dirname(__FILE__).'/canaan_image.class.php');
include_once(dirname(__FILE__).'/canaan_post.class.php');
include_once(dirname(__FILE__).'/pll.php');
include_once(dirname(__FILE__).'/ajax.php');


function canaan_static($root = ''){
	return get_template_directory_uri().'/static' .($root ? '/'.$root : ''); 
}
function get_site_static($root = '')
{
	return get_template_directory_uri() . '/static' . ($root ? '/' . $root : '');
}

function get_posts_transiet($args, $transient, $time = MONTH_IN_SECONDS)
{
	// Do we have this information in our transients already?
	$transient = get_transient($transient);
	// Yep!  Just return it and we're done.
	if (!empty($transient)) {
		// The function will return here every time after the first time it is run, until the transient expires.
		return $transient;
		// Nope!  We gotta make a call.
	} else {
		$_posts = get_posts($args);
		set_transient($transient, $_posts, $time);
		return $_posts;
	}
}
