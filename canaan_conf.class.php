<?php
// if (ABSPATH.'canaan_conf.class.php')) include ABSPATH.'canaan_conf.class.php';

class canaan_conf{
    /**
    * allways use 3 characters, non-capitals, a-z chars only
    * i.e. 'grc'
    * 
    * always change before WP install!
    * never change after WP install
     *
     * used in WP's wp-config.php
    * 
    * @var string
    */

    public static $wpDBPrefix='grc';

    /*
     * current static versioning ID, used for filename changing for cache bypass and more
     */
    public static $staticVersionID=1;
    public static $isProduction=false;
    public static $carbonDir='/';
    public static $allowStaticVersioning=true;
    public static $WP_UPLOADS_URL=false;
    public static $WP_UPLOADS_PATH=false;
    public static $url='https://';
    public static $BaseSiteURL='/';
    public static $isProd=false;    

    public static $static=false;    
    public static $isSafeLocalHost=false;

    public static $currentTemplateName=false;
    public static $fontSlugsToLoad=false;
    public static $spritesSlugsToLoad=false;
    public static $scriptsSlugsToLoad=false;
    public static $cssSlugsToLoad=false;


	static $loginScreenLogoType='theme';	
	static $loginScreenLogoURL='backend/wp_login_logo.png';
	
	
	/**
	 * an array of strings used to forcefully block WP "problematic" features
	 * please block all unneeded functionality 
	 */
	static $wpFeatures_to_lock=array(
			'xmlrpc.php',
			'wp-trackback.php',
			'wp-signup.php',
			'wp-mail.php',
			'wp-links-opml.php',
			'wp-activate.php',
			'wp-comments-post.php',
			);
}

if (defined('ABSPATH')) {
    canaan_conf::$carbonDir = ABSPATH . '/wp-content/carbon';
}



if (file_exists(dirname(__FILE__).'/canaan_conf_local_overrides.php'))
    include dirname(__FILE__).'/canaan_conf_local_overrides.php';