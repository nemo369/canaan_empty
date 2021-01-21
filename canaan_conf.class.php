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

    public static $wpDBPrefix='';

    /*
     * current static versioning ID, used for filename changing for cache bypass and more
     */
    public static $staticVersionID=1;
    public static $isProduction=false;
    public static $carbonDir='/';
    public static $wpackDir='/';
    public static $allowStaticVersioning=true;
    public static $WP_UPLOADS_URL=false;
    public static $WP_UPLOADS_PATH=false;
    public static $url='https://';
    public static $BaseSiteURL='/';
    public static $isProd=false;    

    public static $static=false;    
    public static $isSafeLocalHost=false;
    public static $IN_MAINTENANCE=false;
	
	
}
if (defined('ABSPATH')) {
    canaan_conf::$carbonDir = ABSPATH . 'wp-content/carbon';
    canaan_conf::$wpackDir = ABSPATH . 'wp-content/wpack';
}




if (file_exists(dirname(__FILE__).'/canaan_conf_local_overrides.php'))
    include dirname(__FILE__).'/canaan_conf_local_overrides.php';
