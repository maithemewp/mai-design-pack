<?php
/**
 * Description: Simple CTA with background image.
 * Categories: cta, section
 * Keywords: cover, image, cta, section
 */
?>

<!-- wp:cover {"url":"<?php echo maidp_get_image_url( 'landscape' ); ?>", "dimRatio":80,"overlayColor":"heading","align":"full","contentWidth":"xl","verticalSpacingTop":"md","verticalSpacingBottom":"md"} -->
<div class="wp-block-cover alignfull"><span aria-hidden="true" class="wp-block-cover__background has-heading-background-color has-background-dim-80 has-background-dim"></span><img class="wp-block-cover__image-background" alt="placeholder image" src="<?php echo maidp_get_image_url( 'landscape' ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:acf/mai-columns {"name":"acf/mai-columns","data":{"columns":"custom","_columns":"mai_columns_columns","arrangement_0_columns":"fill","_arrangement_0_columns":"mai_columns_arrangement_columns","arrangement_1_columns":"auto","_arrangement_1_columns":"mai_columns_arrangement_columns","arrangement":2,"_arrangement":"mai_columns_arrangement","arrangement_md_0_columns":"fill","_arrangement_md_0_columns":"mai_columns_md_arrangement_columns","arrangement_md_1_columns":"auto","_arrangement_md_1_columns":"mai_columns_md_arrangement_columns","arrangement_md":2,"_arrangement_md":"mai_columns_md_arrangement","arrangement_sm_0_columns":"fill","_arrangement_sm_0_columns":"mai_columns_sm_arrangement_columns","arrangement_sm_1_columns":"auto","_arrangement_sm_1_columns":"mai_columns_sm_arrangement_columns","arrangement_sm":2,"_arrangement_sm":"mai_columns_sm_arrangement","arrangement_xs_0_columns":"full","_arrangement_xs_0_columns":"mai_columns_xs_arrangement_columns","arrangement_xs":1,"_arrangement_xs":"mai_columns_xs_arrangement","align_columns":"start","_align_columns":"mai_columns_align_columns","align_columns_vertical":"middle","_align_columns_vertical":"mai_columns_align_columns_vertical","column_gap":"xl","_column_gap":"mai_columns_column_gap","row_gap":"xl","_row_gap":"mai_columns_row_gap","margin_top":"","_margin_top":"mai_columns_margin_top","margin_bottom":"","_margin_bottom":"mai_columns_margin_bottom"},"mode":"preview"} -->
<!-- wp:acf/mai-column {"name":"acf/mai-column","data":{"align_column_vertical":"start","_align_column_vertical":"mai_column_align_column_vertical","spacing":"","_spacing":"mai_column_spacing","background":"","_background":"mai_column_background","shadow":"0","_shadow":"mai_columns_shadow","first_xs":"0","_first_xs":"mai_columns_first_xs","first_sm":"0","_first_sm":"mai_columns_first_sm","first_md":"0","_first_md":"mai_columns_first_md"},"mode":"preview"} -->
<!-- wp:heading -->
<h2>This is a nice CTA</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Lorem ipsum dolor sit amet, est quas epicurei cu. Ei pri quot pertinax.</p>
<!-- /wp:paragraph -->
<!-- /wp:acf/mai-column -->

<!-- wp:acf/mai-column {"name":"acf/mai-column","data":{"align_column_vertical":"start","_align_column_vertical":"mai_column_align_column_vertical","spacing":"","_spacing":"mai_column_spacing","background":"","_background":"mai_column_background","shadow":"0","_shadow":"mai_columns_shadow","first_xs":"0","_first_xs":"mai_columns_first_xs","first_sm":"0","_first_sm":"mai_columns_first_sm","first_md":"0","_first_md":"mai_columns_first_md"},"mode":"preview"} -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- /wp:acf/mai-column -->
<!-- /wp:acf/mai-columns --></div></div>
<!-- /wp:cover -->
