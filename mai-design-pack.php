<?php

/**
 * Plugin Name:     Mai Design Pack
 * Plugin URI:      https://bizbudding.com/mai-design-pack/
 * Description:     Unlimited access to all Mai Add-On plugins, and more.
 * Version:         0.1.0
 *
 * Author:          BizBudding
 * Author URI:      https://bizbudding.com
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Main Mai_Design_Pack Class.
 *
 * @since 0.1.0
 */
final class Mai_Design_Pack {
	/**
	 * @var   Mai_Design_Pack The one true Mai_Design_Pack
	 * @since 0.1.0
	 */
	private static $instance;

	/**
	 * Main Mai_Design_Pack Instance.
	 *
	 * Insures that only one instance of Mai_Design_Pack exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since   0.1.0
	 * @static  var array $instance
	 * @uses    Mai_Design_Pack::setup_constants() Setup the constants needed.
	 * @uses    Mai_Design_Pack::includes() Include the required files.
	 * @uses    Mai_Design_Pack::hooks() Activate, deactivate, etc.
	 * @see     Mai_Design_Pack()
	 * @return  object | Mai_Design_Pack The one true Mai_Design_Pack
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			// Setup the setup.
			self::$instance = new Mai_Design_Pack;
			// Methods.
			self::$instance->setup_constants();
			self::$instance->includes();
			self::$instance->hooks();
		}
		return self::$instance;
	}

	/**
	 * Throw error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since   0.1.0
	 * @access  protected
	 * @return  void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'mai-design-pack' ), '1.0' );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @since   0.1.0
	 * @access  protected
	 * @return  void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'mai-design-pack' ), '1.0' );
	}

	/**
	 * Setup plugin constants.
	 *
	 * @access  private
	 * @since   0.1.0
	 * @return  void
	 */
	private function setup_constants() {
		// Plugin version.
		if ( ! defined( 'MAI_DESIGN_PACK_VERSION' ) ) {
			define( 'MAI_DESIGN_PACK_VERSION', '0.1.0' );
		}

		// Plugin Folder Path.
		if ( ! defined( 'MAI_DESIGN_PACK_PLUGIN_DIR' ) ) {
			define( 'MAI_DESIGN_PACK_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Includes Path.
		if ( ! defined( 'MAI_DESIGN_PACK_INCLUDES_DIR' ) ) {
			define( 'MAI_DESIGN_PACK_INCLUDES_DIR', MAI_DESIGN_PACK_PLUGIN_DIR . 'includes/' );
		}

		// Plugin Folder URL.
		if ( ! defined( 'MAI_DESIGN_PACK_PLUGIN_URL' ) ) {
			define( 'MAI_DESIGN_PACK_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File.
		if ( ! defined( 'MAI_DESIGN_PACK_PLUGIN_FILE' ) ) {
			define( 'MAI_DESIGN_PACK_PLUGIN_FILE', __FILE__ );
		}

		// Plugin Base Name
		if ( ! defined( 'MAI_DESIGN_PACK_BASENAME' ) ) {
			define( 'MAI_DESIGN_PACK_BASENAME', dirname( plugin_basename( __FILE__ ) ) );
		}
	}

	/**
	 * Include required files.
	 *
	 * @access  private
	 * @since   0.1.0
	 * @return  void
	 */
	private function includes() {
		// Include vendor libraries.
		require_once __DIR__ . '/vendor/autoload.php';
		// Includes.
		foreach ( glob( MAI_DESIGN_PACK_INCLUDES_DIR . '*.php' ) as $file ) { include $file; }
		// Instantiate classes.
		// $settings = new Mai_Design_Pack_Settings;
	}

	/**
	 * Run the hooks.
	 *
	 * @since   0.1.0
	 * @return  void
	 */
	public function hooks() {
		add_action( 'admin_init',        [ $this, 'updater' ] );
		add_action( 'after_setup_theme', [ $this, 'setup' ] ); // plugins_loaded was too early to check for 'mai-engine'.
		add_filter( 'plugin_action_links_mai-design-pack/mai-design-pack.php', [ $this, 'addons_link' ], 10, 4 );
	}

	/**
	 * Setup the updater.
	 *
	 * composer require yahnis-elsts/plugin-update-checker
	 *
	 * @since 0.1.0
	 *
	 * @uses https://github.com/YahnisElsts/plugin-update-checker/
	 *
	 * @return void
	 */
	public function updater() {
		// Bail if current user cannot manage plugins.
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		// Bail if plugin updater is not loaded.
		if ( ! class_exists( 'Puc_v4_Factory' ) ) {
			return;
		}

		// Setup the updater.
		$updater = Puc_v4_Factory::buildUpdateChecker( 'https://github.com/maithemewp/mai-design-pack/', __FILE__, 'mai-design-pack' );

		// Maybe set github api token.
		if ( defined( 'MAI_GITHUB_API_TOKEN' ) ) {
			$updater->setAuthentication( MAI_GITHUB_API_TOKEN );
		}

		// Add icons for Dashboard > Updates screen.
		if ( function_exists( 'mai_get_updater_icons' ) && $icons = mai_get_updater_icons() ) {
			$updater->addResultFilter(
				function ( $info ) use ( $icons ) {
					$info->icons = $icons;
					return $info;
				}
			);
		}
	}

	/**
	 * Load mai-engine files, or deactivate if active theme is not supported.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	function setup() {
		// Bail if no engine is anywhere.
		if ( ! ( class_exists( 'Mai_Theme_Engine' ) || class_exists( 'Mai_Engine' ) ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice' ] );
			return;
		}
	}

	/**
	 * Show notice that the plugin has been deactivated.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	function admin_notice() {
		printf(
			'<div class="notice notice-error is-dismissible"><p>%s%s%s%s%s%s</p></div>',
			'Mai Design Pack ',
			__( 'requires the ', 'mai-engine' ),
			'Mai Engine ',
			__( 'plugin. As a result, ', 'mai-engine' ),
			'Mai Design Pack ',
			__( 'has been deactivated.', 'mai-engine' )
		);

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	}

	/**
	 * Return the plugin action links. This will only be called if the plugin is active.
	 *
	 * @since 0.1.0
	 *
	 * @param array  $actions     Associative array of action names to anchor tags
	 * @param string $plugin_file Plugin file name, ie my-plugin/my-plugin.php
	 * @param array  $plugin_data Associative array of plugin data from the plugin file headers
	 * @param string $context     Plugin status context, ie 'all', 'active', 'inactive', 'recently_active'
	 *
	 * @return array Associative array of plugin action links
	 */
	function addons_link( $actions, $plugin_file, $plugin_data, $context ) {
		$actions['settings'] = sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=mai-theme' ), __( 'Add-ons', 'mai-engine' ) );

		return $actions;
	}
}

/**
 * The main function for that returns Mai_Design_Pack
 *
 * The main function responsible for returning the one true Mai_Design_Pack
 * Instance to functions everywhere.
 *
 * @since 0.1.0
 *
 * @return object|Mai_Design_Pack The one true Mai_Design_Pack Instance.
 */
function mai_design_pack() {
	return Mai_Design_Pack::instance();
}

// Get Mai_Design_Pack Running.
mai_design_pack();
