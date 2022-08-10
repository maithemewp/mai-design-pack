<?php

/**
 * Plugin Name:     Mai Design Pack
 * Plugin URI:      https://bizbudding.com/mai-design-pack/
 * Description:     Unlimited access to all Mai Plugins, and more. Requires Mai Theme v2.
 * Version:         1.1.0
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
			define( 'MAI_DESIGN_PACK_VERSION', '1.1.0' );
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
	}

	/**
	 * Run the hooks.
	 *
	 * @since   0.1.0
	 * @return  void
	 */
	public function hooks() {
		$plugins_link_hook = 'plugin_action_links_mai-design-pack/mai-design-pack.php';
		add_filter( $plugins_link_hook, [ $this, 'plugins_link' ], 10, 4 );
		add_action( 'plugins_loaded',   [ $this, 'updater' ] );
		add_action( 'init',             [ $this, 'register_block_pattern_categories' ], 4 );
		add_action( 'init',             [ $this, 'unregister_block_pattern_categories' ] );
		add_action( 'init',             [ $this, 'register_block_patterns' ], 4 );
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
	function plugins_link( $actions, $plugin_file, $plugin_data, $context ) {
		if ( class_exists( 'Mai_Engine' ) ) {
			$actions['settings'] = sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=mai-theme' ), __( 'Plugins', 'mai-engine' ) );
		}

		return $actions;
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
	 * Registers block pattern categories.
	 *
	 * @since 1.1.0
	 *
	 * @return void
	 */
	function register_block_pattern_categories() {
		// Types: Blocks, Sections, Homepages
		// CTA 1 (Block)
		// CTA 2 (Section)

		// Contact Forms
		// CTAs
		// FAQs
		// Features
		// Footers
		// Hero
		// Homepages
		// Landing Pages
		// Logos
		// Podcasts
		// Portfolios
		// Pricing Tables
		// Team
		// Testimonials

		$cats = [
			'mai_cta'     => __( 'Mai CTAs', 'mai-engine' ),
			'mai_feature' => __( 'Mai Features', 'mai-engine' ),
			'mai_hero'    => __( 'Mai Heroes', 'mai-engine' ),
			'mai_posts'   => __( 'Mai Post Grid', 'mai-engine' ),
			'mai_pricing' => __( 'Mai Pricing Tables', 'mai-engine' ),
			'mai_team'    => __( 'Mai Team', 'mai-engine' ),
			'mai_section' => __( 'Mai (Full Width Sections)', 'mai-engine' ),
			'mai'         => __( 'Mai (All Patterns)', 'mai-engine' ),
		];

		foreach ( $cats as $name => $label ) {
			register_block_pattern_category( $name,	[ 'label' => $label ] );
		}
	}

	function unregister_block_pattern_categories() {
		$cats = [
			'featured',
		];

		foreach ( $cats as $cat ) {
			unregister_block_pattern_category( $cat );
		}
	}

	/**
	 * Registers block patterns.
	 *
	 * Settable fields include:
	 *
	 *   - Description
	 *   - Categories       (comma-separated values)
	 *   - Keywords         (comma-separated values)
	 *
	 * @since 1.1.0
	 *
	 * @return void
	 */
	function register_block_patterns() {
		if ( ! function_exists( 'register_block_pattern' ) ) {
			return;
		}

		// Loop through patterns directories.
		foreach ( glob( dirname( __FILE__ ) . '/patterns/*' ) as $dir ) {
			// Get array of files.
			$files =  glob( $dir . '/*.php' );
			// Order them correctly, respecting the numbers at the end.
			natsort( $files );
			// Loop through files.
			foreach ( $files as $file ) {
				$base = basename( $file, '.php' );
				$data = get_file_data(
					$file,
					[
						'title'       => __( 'Title', 'mai-engine' ),
						'description' => __( 'Description', 'mai-engine' ),
						'categories'  => __( 'Categories', 'mai-engine' ),
						'keywords'    => __( 'Keywords', 'mai-engine' ),
					]
				);

				ob_start();
				include $file;
				$content    = ob_get_clean();
				$title      = function_exists( 'mai_convert_case' ) ? mai_convert_case( $base, 'title' ) : $base;
				$categories = array_map( 'trim', explode( ',', $data['categories'] ) );
				$keywords   = array_map( 'trim', explode( ',', $data['keywords'] ) );

				// Adds `mai_` prefix.
				foreach ( $categories as $index => $category ) {
					$categories[ $index ] = 'mai_' . $category;
				}

				// Adds 'mai' as standalone category and keyword.
				$categories = array_merge( [ 'mai' ], $categories );
				$keywords   = array_merge( [ 'mai' ], $keywords );

				// Maybe add Section label.
				if ( in_array( 'mai_section', $categories ) ) {
					$title .= ' (Section)'; // Translated below.
				}

				register_block_pattern(
					'mai/' . $base,
					[
						'title'       => __( $title, 'mai-engine' ),
						'description' => __( $data['description'], 'mai-engine' ),
						'content'     => trim( $content ),
						'categories'  => $categories,
						'keywords'    => $keywords,
					]
				);
			}
		}
	}

	/**
	 * Gets a placeholder image url.
	 *
	 * @since 1.1.0
	 *
	 * @param string $filename The image file name withiout extension.
	 *
	 * @return string
	 */
	function get_image_url( $filename ) {
		$ext  = false !== strpos( $filename, 'placeholder' ) ? 'jpg' : 'png';
		$file = esc_html( sprintf( 'assets/img/%s.%s', $filename, $ext ) );
		return file_exists( MAI_DESIGN_PACK_PLUGIN_DIR . $file ) ? MAI_DESIGN_PACK_PLUGIN_URL . $file : '';
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

/**
 * Get Mai_Design_Pack Running.
 *
 * @since 0.1.0
 *
 * @return void
 */
mai_design_pack();
