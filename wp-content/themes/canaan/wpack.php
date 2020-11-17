<?php


// Require the composer autoload for getting conflict-free access to enqueue
require_once canaan_conf::$wpackDir . '/vendor/autoload.php';

// Instantiate
$enqueue = new \WPackio\Enqueue( 'appName', 'outputPath', canaan_conf::$staticVersionID, 'plugin', __FILE__ );

// Do stuff through this plugin
class MyThemeInit {
	/**
	 * @var \WPackio\Enqueue
	 */
	public $enqueue;

	public function __construct() {
		// It is important that we init the Enqueue class right at the plugin/theme load time
		$this->enqueue = new \WPackio\Enqueue(
			// Name of the project, same as `appName` in wpackio.project.js
			'canaan',
			// Output directory, same as `outputPath` in wpackio.project.js
			'dist',
			// Version of your plugin
			canaan_conf::$staticVersionID,
			// Type of your project, same as `type` in wpackio.project.js
			'theme',
			// Plugin location, pass false in case of theme.
			false
		);
		// Enqueue a few of our entry points
		add_action( 'wp_enqueue_scripts', [ $this, 'theme_enqueue' ] );
	}

	public function theme_enqueue() {
		// Enqueue files[0] (name = app) - entryPoint main
		$this->enqueue->enqueue( 'assets', 'main', [] );
		// // Enqueue files[0] (name = app) - entryPoint mobile
		// $this->enqueue->enqueue( 'app', 'mobile', [] );
		// // Enqueue files[1] (name = foo) - entryPoint main
		// $this->enqueue->enqueue( 'foo', 'main', [] );
		// // Enqueue files[2] (name = reactapp) - entryPoint main
		// $this->enqueue->enqueue( 'reactapp', 'main', [] );
	}
}


// Init
new MyThemeInit();