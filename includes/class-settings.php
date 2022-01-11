<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Main Mai_Design_Pack Class.
 *
 * @since 0.1.0
 */
class Mai_Design_Pack_Settings {
	/**
	 * Get is started.
	 */
	function __construct() {
		$this->hooks();
	}

	/**
	 * Runs hooks.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	function hooks() {
		add_action( 'admin_enqueue_scripts',          [ $this, 'enqueue' ] );
		add_action( 'wp_ajax_mai_design_pack_action', [ $this, 'ajax' ] );
		add_filter( 'mai_admin_submenu_page_label',   [ $this, 'label' ] );
		add_filter( 'mai_admin_menu_page_callback',   [ $this, 'callback' ] );
		add_filter( 'plugin_action_links_mai-design-pack/mai-design-pack.php', [ $this, 'add_settings_link' ], 10, 4 );
	}

	/**
	 * Enqueue styles and scripts.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	function enqueue() {
		$screen = get_current_screen();

		if ( 'toplevel_page_mai-theme' !== $screen->id ) {
			return;
		}

		wp_enqueue_style(
			'mai-design-pack',
			MAI_DESIGN_PACK_PLUGIN_URL . '/assets/css/mai-design-pack.css',
			[],
			MAI_DESIGN_PACK_VERSION
		);

		wp_enqueue_script(
			'mai-design-pack',
			MAI_DESIGN_PACK_PLUGIN_URL . '/assets/js/mai-design-pack.js',
			[ 'jquery' ],
			MAI_DESIGN_PACK_VERSION,
			true
		);

		wp_localize_script(
			'mai-design-pack',
			'maiDesignPackVars',
			[
				'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
				'ajaxNonce'   => wp_create_nonce( 'mai-design-pack' ),
				'loadingText' => __( 'Loading', 'mai-design-pack' ),
			]
		);
	}

	/**
	 * Runs ajax to install, activate, or deactivate plugins.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	function ajax() {
		check_ajax_referer( 'mai-design-pack', 'nonce' );

		$succes       = false;
		$dependencies = $this->get_dependencies();
		$action       = filter_input( INPUT_GET, 'trigger', FILTER_SANITIZE_STRING );
		$slug         = filter_input( INPUT_GET, 'slug', FILTER_SANITIZE_STRING );

		if ( $dependencies && $action && $slug ) {
			$key = sprintf( '%s/%s.php', $slug, $slug );

			if ( 'activate' === $action && class_exists( 'WP_Dependency_Installer' ) && isset( $dependencies[ $key ] ) ) {
				$config = [ $dependencies[ $key ] ];
				WP_Dependency_Installer::instance()->register( $config )->admin_init();

				wp_send_json_success(
					[
						'message' => 'Plugin activated!',
						'html'    => $this->get_deactivate_button( $slug ),
						'active'  => true,
					]
				);

			} elseif ( 'deactivate' === $action ) {
				deactivate_plugins( $key );

				wp_send_json_success(
					[
						'message' => 'Plugin deactivated!',
						'html'    => $this->get_activate_button( $slug ),
						'active'  => false,
					]
				);
			}
		}

		wp_send_json_error( [ 'error' => 'Sorry, something went wrong.' ] );

		wp_die();
	}

	/**
	 * Gets admin menu page label.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	function label() {
		return 'Mai Design Pack';
	}

	/**
	 * Gets admin menu page callback.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	function callback() {
		return [ $this, 'admin_menu_page' ];
	}

	/**
	 * Renders admin menu page content.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	function admin_menu_page() {
		$has_wpdi = class_exists( 'WP_Dependency_Installer' );

		echo '<div class="wrap">';
			echo '<h1 class="wp-heading-inline">Mai Design Pack</h1>';
			echo '<div class="mai-addons">';
				$addons       = $this->get_addons();
				$dependencies = $this->get_dependencies();

				if ( ! function_exists( 'is_plugin_active' ) ) {
					require_once ABSPATH . 'wp-admin/includes/plugin.php';
				}

				$can_activate = current_user_can( 'activate_plugins' );
				$can_install  = current_user_can( 'install_plugins' );

				foreach ( $addons as $slug => $addon ) {
					$addon       = wp_parse_args( $addon,
						[
							'desc'     => '',
							'docs'     => '',
							'settings' =>  '',
						]
					);
					$dependency   = $this->get_dependency( $slug );
					$plugin_slug  = sprintf( '%s/%s.php', $slug, $slug );
					$is_installed = $this->is_installed( $plugin_slug );
					$is_active    = $this->is_active( $plugin_slug );
					$class        = 'mai-addon';
					$class       .= $is_active ? ' mai-addon-is-active' : '';
					printf( '<div class="%s">', $class );

						printf( '<h2 class="mai-addon-name">%s</h2>', $dependency['name'] );
						printf( '<p>%s</p>', $addon['desc'] );
						echo '<p class="mai-addon-actions">';

							if ( class_exists( 'WP_Dependency_Installer' ) ) {
								if ( $is_installed ) {
									if ( $can_activate ) {
										if ( $is_active ) {
											echo $this->get_deactivate_button( $slug );
										} else {
											echo $this->get_activate_button( $slug );
										}
									}
								} else {
									if ( $can_install ) {
										echo $this->get_install_button( $slug );
									}
								}
							}

						echo '</p>';

						echo '<p class="mai-addon-links">';

							if ( $addon['docs'] ) {
								printf( '<a class="mai-addon-docs" target="_blank" href="%s"><span class="dashicons dashicons-media-document"></span> %s</a>', $addon['docs'], __( 'Documentation', 'mai-design-pack' ) );
							}

							if ( $addon['settings'] && $is_installed ) {
								printf( '<a class="mai-addon-settings" href="%s"><span class="dashicons dashicons-admin-generic"></span> %s</a>', $addon['settings'], __( 'Settings', 'mai-design-pack' ) );
							}

						echo '</p>';

					echo '</div>';
				}

			echo '</div>';
		echo '</div>'; /* .wrap */
	}

	/**
	 * Gets deactivate button markup.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	function get_deactivate_button( $slug ) {
		$html  = sprintf( '<span class="mai-addon-active">%s</span>', __( 'Active', 'mai-design-pack' ) );
		$html .= sprintf( '<button class="mai-addon-deactivate button button-secondary" data-action="deactivate" data-slug="%s">%s</button>', $slug, __( 'Deactivate', 'mai-design-pack' ) );
		return $html;
	}

	/**
	 * Gets activate button markup.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	function get_activate_button( $slug ) {
		return sprintf( '<button class="mai-addon-activate button button-primary" data-action="activate" data-slug="%s">%s</button>', $slug, __( 'Activate', 'mai-design-pack' ) );
	}

	/**
	 * Gets install button markup.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	function get_install_button( $slug ) {
		return sprintf( '<button class="mai-addon-install button button-primary" data-action="activate" data-slug="%s">%s</button>', $slug, __( 'Install & Activate', 'mai-design-pack' ) );
	}

	/**
	 * Checks if a plugin is installed.
	 *
	 * @since 0.1.0
	 *
	 * @return bool
	 */
	function is_installed( $plugin_slug ) {
		$plugins = $this->get_installed_plugins();
		return array_key_exists( $plugin_slug, $plugins ) || in_array( $plugin_slug, $plugins, true );
	}

	/**
	 * Checks if a plugin is active.
	 *
	 * @since 0.1.0
	 *
	 * @return bool
	 */
	function is_active( $plugin_slug ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		return is_plugin_active( $plugin_slug );
	}

	/**
	 * Gets all installed plugins.
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	function get_installed_plugins() {
		static $plugins = null;

		if ( ! is_null( $plugins ) ) {
			return $plugins;
		}

		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$plugins = get_plugins();

		return $plugins;
	}

	/**
	 * Gets a dependency array data.
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	function get_dependency( $slug ) {
		$dependencies = $this->get_dependencies();
		$key          = sprintf( '%s/%s.php', $slug, $slug );
		return isset( $dependencies[ $key ] ) ? $dependencies[ $key ] : [];
	}

	/**
	 * Gets all dependency data.
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	function get_dependencies() {
		static $dependencies = null;

		if ( ! is_null( $dependencies ) ) {
			return $dependencies;
		}

		$dependencies = [
			'mai-icons/mai-icons.php' => [
				'name'     => 'Mai Icons',
				'host'     => 'github',
				'slug'     => 'mai-icons/mai-icons.php',
				'uri'      => 'maithemewp/mai-icons',
				'branch'   => 'master',
				'required' => true,
			],
			'mai-testimonials/mai-testimonials.php' => [
				'name'     => 'Mai Testimonials',
				'host'     => 'github',
				'slug'     => 'mai-testimonials/mai-testimonials.php',
				'uri'      => 'maithemewp/mai-testimonials',
				'branch'   => 'master',
				'required' => true,
			],
			'mai-favorites/mai-favorites.php' => [
				'name'     => 'Mai Favorites',
				'host'     => 'github',
				'slug'     => 'mai-favorites/mai-favorites.php',
				'uri'      => 'maithemewp/mai-favorites',
				'branch'   => 'master',
				'required' => true,
			],
			'mai-portfolio/mai-portfolio.php' => [
				'name'     => 'Mai Portfolio',
				'host'     => 'github',
				'slug'     => 'mai-portfolio/mai-portfolio.php',
				'uri'      => 'maithemewp/mai-portfolio',
				'branch'   => 'master',
				'required' => true,
			],
			'mai-accordion/mai-accordion.php' => [
				'name'     => 'Mai Accordion',
				'host'     => 'github',
				'slug'     => 'mai-accordion/mai-accordion.php',
				'uri'      => 'maithemewp/mai-accordion',
				'branch'   => 'master',
				'required' => true,
			],
			'mai-notices/mai-notices.php' => [
				'name'     => 'Mai Notices',
				'host'     => 'github',
				'slug'     => 'mai-notices/mai-notices.php',
				'uri'      => 'maithemewp/mai-notices',
				'branch'   => 'master',
				'required' => true,
			],
			'mai-table-of-contents/mai-table-of-contents.php' => [
				'name'     => 'Mai Table of Contents',
				'host'     => 'github',
				'slug'     => 'mai-table-of-contents/mai-table-of-contents.php',
				'uri'      => 'maithemewp/mai-table-of-contents',
				'branch'   => 'master',
				'required' => true,
			],
			'mai-ads-extra-content/mai-ads-extra-content.php' => [
				'name'     => 'Mai Ads & Extra Content',
				'host'     => 'github',
				'slug'     => 'mai-ads-extra-content/mai-ads-extra-content.php',
				'uri'      => 'maithemewp/mai-ads-extra-content',
				'branch'   => 'master',
				'required' => true,
			],
			'mai-custom-content-areas/mai-custom-content-areas.php' => [
				'name'     => 'Mai Custom Content Areas',
				'host'     => 'github',
				'slug'     => 'mai-custom-content-areas/mai-custom-content-areas.php',
				'uri'      => 'maithemewp/mai-custom-content-areas',
				'branch'   => 'master',
				'required' => true,
			],
			'mai-archive-pages/mai-archive-pages.php' => [
				'name'     => 'Mai Archive Pages',
				'host'     => 'github',
				'slug'     => 'mai-archive-pages/mai-archive-pages.php',
				'uri'      => 'maithemewp/mai-archive-pages',
				'branch'   => 'master',
				'required' => true,
			],
			'mai-display-taxonomy/mai-display-taxonomy.php' => [
				'name'     => 'Mai Display Taxonomy',
				'host'     => 'github',
				'slug'     => 'mai-display-taxonomy/mai-display-taxonomy.php',
				'uri'      => 'maithemewp/mai-display-taxonomy',
				'branch'   => 'master',
				'required' => true,
			],
			'mai-config-generator/mai-config-generator.php' => [
				'name'     => 'Mai Config Generator',
				'host'     => 'github',
				'slug'     => 'mai-config-generator/mai-config-generator.php',
				'uri'      => 'maithemewp/mai-config-generator',
				'branch'   => 'master',
				'required' => true,
			],
		];

		return $dependencies;
	}

	function get_addons() {
		static $addons = null;

		if ( ! is_null( $addons ) ) {
			return $addons;
		}

		$addons = [
			'mai-icons'                => [
				'desc' => __( 'Include unique icons on your website with the Mai Icons plugin. There are over 7000 icons to choose from! Customization options include size, color, spacing, and more.', 'mai-design-pack' ),
				'docs' => '',
			],
			'mai-testimonials'         => [
				'desc'     => __( 'With Mai Testimonials, show off all the great things your customers have to say about you, while building credibility and increasing conversions.', 'mai-design-pack' ),
				'docs'     => 'https://docs.bizbudding.com/docs/mai-testimonials/',
				'settings' => admin_url( 'edit.php?post_type=testimonial' ),
			],
			'mai-favorites'            => [
				'desc'     => __( 'Use Mai Favorites to give your visitors a way to easily browse collections of your favorite things such as affiliate products, recommendations, services, and more.', 'mai-design-pack' ),
				'docs'     => 'https://docs.bizbudding.com/docs/mai-favorites/',
				'settings' => admin_url( 'edit.php?post_type=favorite' ),
			],
			'mai-portfolio'            => [
				'desc'     => __( 'Mai Portfolio is a versatile and lightweight portfolio plugin for Mai Theme. It creates a custom post type called “Portfolio” that has all of our Customizer layout settings ready to customize.', 'mai-design-pack' ),
				'docs'     => '',
				'settings' => admin_url( 'edit.php?post_type=portfolio' ),
			],
			'mai-accordion'            => [
				'desc' => __( 'Mai Accordion is perfect for displaying expandable FAQs, transcripts, resources, and even research. Add a title/question, then easily insert any block you want into the answer section.', 'mai-design-pack' ),
				'docs' => '',
			],
			'mai-notices'              => [
				'desc' => __( 'Use our Mai Notices plugin to display custom callout notices to grab attention and share special information in any content area on your posts, pages, and products.', 'mai-design-pack' ),
				'docs' => '',
			],
			'mai-table-of-contents'    => [
				'desc'     => __( 'Add the Mai Table of Contents to the beginning of your posts or pages to improve readability. The table is auto-created from your heading structure so readers can jump to the section they want easily.', 'mai-design-pack' ),
				'docs'     => '',
				'settings' => admin_url( sprintf( '%s.php?page=mai-table-of-contents', 'admin' ) ),
			],
			// 'mai-ads-extra-content'    => [
			// 	'desc' => __( 'Boost your sales by easily embedding CTAs, display ads, and more, anywhere on your site, all from one simple to manage spot with Mai Ads & Extra Content. ', 'mai-design-pack' ),
			// 	'docs' => '',
			// ],
			'mai-custom-content-areas' => [
				'desc' => __( 'Mai Custom Content Areas is a game changer when it comes to creating a conversion marketing strategy on your website. Easily display calls to action and other custom content in different locations on posts, pages, and custom post types conditionally by category, tag, taxonomy, keyword, and more.', 'mai-design-pack' ),
				'docs' => '',
			],
			'mai-archive-pages'        => [
				'desc' => __( 'Mai Archive Pages plugin allows you to build robust and SEO-friendly archive pages with blocks. Customize the content before and after your archive content to strategically build out your archive pages for SEO.', 'mai-design-pack' ),
				'docs' => '',
			],
			'mai-display-taxonomy'     => [
				'desc' => __( 'Mai Display Taxonomy is a utility plugin that creates a category to use with Mai Post Grid. It gives you total control over your grid content in various areas of your website.', 'mai-design-pack' ),
				'docs' => '',
			],
			'mai-config-generator'     => [
				'desc' => __( 'A developer plugin to help set custom defaults for a custom Mai Theme. The config.php file is the “default settings” for your site. If you install your custom theme, or site managers change any of the Customizer settings, the defaults will now come from your custom config.', 'mai-design-pack' ),
				'docs' => '',
			],
		];

		return $addons;
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
	 * @return array associative array of plugin action links
	 */
	function add_settings_link( $actions, $plugin_file, $plugin_data, $context ) {
		$url                 = admin_url( sprintf( '%s.php?page=mai-theme', 'admin' ) );
		$link                = sprintf( '<a href="%s">%s</a>', $url, __( 'Settings', 'mai-design-pack' ) );
		$actions['settings'] = $link;

		return $actions;
	}
}
