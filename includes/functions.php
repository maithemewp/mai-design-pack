<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Gets a placeholder image url.
 *
 * @access private
 * @since TBD
 *
 * @param string $filename The image file name withiout extension.
 *
 * @return string
 */
function maidp_get_image_url( $filename ) {
	return mai_design_pack()->get_image_url( $filename );
}

/**
 * Gets a placeholder HTML when a plugin is not installed.
 *
 * @access private
 * @since TBD
 *
 * @param string $plugin The plugin name.
 *
 * @return string
 */
function maidp_get_requires( $plugin ) {
	$html  = '';
	$html .= '<!-- wp:group {"style":{"color":{"background":"#fe0000"}},"verticalSpacingTop":"xs","verticalSpacingBottom":"xs","verticalSpacingLeft":"xs","verticalSpacingRight":"xs"} -->';
	$html .= '<div class="wp-block-group has-background" style="background-color:#fe0000"><!-- wp:group {"backgroundColor":"white","verticalSpacingTop":"sm","verticalSpacingBottom":"sm","verticalSpacingLeft":"xs","verticalSpacingRight":"xs"} -->';
	$html .= '<div class="wp-block-group has-white-background-color has-background"><!-- wp:heading {"textAlign":"center","style":{"color":{"text":"#ff0000"}},"className":"is-style-subheading","fontSize":"xl"} -->';
	$html .= sprintf( '<h2 class="has-text-align-center is-style-subheading has-text-color has-xxl-font-size" style="color:#ff0000">%s %s %s</h2>', __( 'Requires', 'mai-design-pack' ), ucwords( str_replace( '-', ' ', $plugin ) ), __( 'plugin', 'mai-design-pack' ) );
	$html .= '<!-- /wp:heading --></div>';
	$html .= '<!-- /wp:group --></div>';
	$html .= '<!-- /wp:group -->';

	return $html;
}

