<?php

class runcommand {

	private static $instance;

	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
			self::$instance->setup_constants();
			self::$instance->setup_actions();
			self::$instance->setup_filters();
			self::$instance->require_files();
			self::$instance->setup_controllers();
		}
		return self::$instance;
	}

	private function setup_constants() {
		
	}

	private function setup_actions() {
		add_action( 'init', function(){
			if ( ! is_admin() ) {
				show_admin_bar( false );
			}
		});
		add_action( 'after_setup_theme', array( $this, 'action_after_setup_theme' ) );

	}

	private function setup_filters() {
		/**
		 * Ensure plugin assets loaded from within the theme are served at a corrected URL
		 */
		add_filter( 'plugins_url', function( $url = '', $path = '', $plugin = '' ){
			if ( empty( $plugin ) ) {
				return $url;
			}
			if  ( 0 === strpos( $plugin, get_stylesheet_directory() ) ) {
				$url_override = str_replace( get_stylesheet_directory(), get_stylesheet_directory_uri(), dirname( $plugin ) );
				$url = trailingslashit( $url_override ) . $path;
			}
			return $url;
		}, 9, 3 );
	}

	private function require_files() {

		require_once __DIR__ . '/lib/rest-api/plugin.php';

		spl_autoload_register( function( $class ) {
			$class = ltrim( $class, '\\' );
			if ( 0 !== stripos( $class, 'runcommand\\' ) ) {
				return;
			}

			$parts = explode( '\\', $class );
			array_shift( $parts ); // Don't need "runcommand"
			$last = array_pop( $parts ); // File should be 'class-[...].php'
			$last = 'class-' . $last . '.php';
			$parts[] = $last;
			$file = dirname( __FILE__ ) . '/inc/' . str_replace( '_', '-', strtolower( implode( $parts, '/' ) ) );
			if ( file_exists( $file ) ) {
				require $file;
			}
		});
	}

	private function setup_controllers() {
		$controllers = array(
			'\runcommand\Assets',
			'\runcommand\Content_Model',
			'\runcommand\REST\API',
		);
		foreach( $controllers as $controller ) {
			$controller::get_instance();
		}
	}

	public function action_after_setup_theme() {

		add_theme_support( 'title-tag' );
	}

	/**
	 * Get a rendered template part
	 *
	 * @param string $template
	 * @param array $vars
	 * @return string
	 */
	public static function get_template_part( $template, $vars = array() ) {
		$full_path = get_template_directory() . '/parts/' . $template . '.php';

		if ( ! file_exists( $full_path ) ) {
			return '';
		}

		ob_start();
		// @codingStandardsIgnoreStart
		if ( ! empty( $vars ) ) {
			extract( $vars );
		}
		// @codingStandardsIgnoreEnd
		include $full_path;
		return ob_get_clean();
	}

}

runcommand::get_instance();
