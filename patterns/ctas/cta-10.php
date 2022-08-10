<?php
/**
 * Description: Full width CTA section with 1/2 image on left and overlapped content on right
 * Categories: cta, section
 * Keywords: cta, section
 */
?>
<!-- wp:group {"align":"full","backgroundColor":"alt","contentWidth":"lg","verticalSpacingTop":"md","verticalSpacingBottom":"md"} -->
<div class="wp-block-group alignfull has-alt-background-color has-background"><!-- wp:acf/mai-columns {"name":"acf/mai-columns","data":{"columns":"2","_columns":"mai_columns_columns","align_columns":"start","_align_columns":"mai_columns_align_columns","align_columns_vertical":"middle","_align_columns_vertical":"mai_columns_align_columns_vertical","column_gap":"","_column_gap":"mai_columns_column_gap","row_gap":"","_row_gap":"mai_columns_row_gap","margin_top":"","_margin_top":"mai_columns_margin_top","margin_bottom":"","_margin_bottom":"mai_columns_margin_bottom"},"mode":"preview"} -->
<!-- wp:acf/mai-column {"name":"acf/mai-column","data":{"align_column_vertical":"start","_align_column_vertical":"mai_column_align_column_vertical","spacing":"","_spacing":"mai_column_spacing","background":"","_background":"mai_column_background","shadow":"0","_shadow":"mai_columns_shadow","border":"0","_border":"mai_columns_border","radius":"0","_radius":"mai_columns_radius","first_xs":"0","_first_xs":"mai_columns_first_xs","first_sm":"0","_first_sm":"mai_columns_first_sm","first_md":"0","_first_md":"mai_columns_first_md"},"mode":"preview"} -->
<!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image"><img src="<?php echo maidp_get_image_url( 'placeholder-square' ); ?>" alt="placeholder image"/></figure>
<!-- /wp:image -->
<!-- /wp:acf/mai-column -->

<!-- wp:acf/mai-column {"name":"acf/mai-column","data":{"align_column_vertical":"start","_align_column_vertical":"mai_column_align_column_vertical","spacing":"","_spacing":"mai_column_spacing","background":"","_background":"mai_column_background","shadow":"0","_shadow":"mai_columns_shadow","border":"0","_border":"mai_columns_border","radius":"0","_radius":"mai_columns_radius","first_xs":"0","_first_xs":"mai_columns_first_xs","first_sm":"0","_first_sm":"mai_columns_first_sm","first_md":"0","_first_md":"mai_columns_first_md"},"mode":"preview"} -->
<!-- wp:group {"backgroundColor":"white","verticalSpacingTop":"md","verticalSpacingBottom":"md","verticalSpacingLeft":"md","verticalSpacingRight":"md","marginLeft":"-xxl"} -->
<div class="wp-block-group has-white-background-color has-background"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Nice Heading</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Lorem ipsum dolor sit amet, est quas epicurei cu. Ei pri quot pertinax. Ad suas argumentum mel, in mel esse illud erroribus.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-link"} -->
<div class="wp-block-button is-style-link"><a class="wp-block-button__link">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<!-- /wp:acf/mai-column -->
<!-- /wp:acf/mai-columns --></div>
<!-- /wp:group -->
