<?php
/**
 * Description: Full width CTA section with dark background, feature list, and overlapped border CTA
 * Categories: cta, section
 * Keywords: cta, section
 */
?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"heading","textColor":"white","contentWidth":"xl","verticalSpacingTop":"lg","verticalSpacingBottom":"lg"} -->
<section class="wp-block-group alignfull has-white-color has-heading-background-color has-text-color has-background"><!-- wp:acf/mai-columns {"name":"acf/mai-columns","data":{"columns":"2","_columns":"mai_columns_columns","align_columns":"start","_align_columns":"mai_columns_align_columns","align_columns_vertical":"middle","_align_columns_vertical":"mai_columns_align_columns_vertical","column_gap":"xxxxl","_column_gap":"mai_columns_column_gap","row_gap":"xxxl","_row_gap":"mai_columns_row_gap","margin_top":"","_margin_top":"mai_columns_margin_top","margin_bottom":"","_margin_bottom":"mai_columns_margin_bottom"},"mode":"preview"} -->
<!-- wp:acf/mai-column {"name":"acf/mai-column","data":{"align_column_vertical":"start","_align_column_vertical":"mai_column_align_column_vertical","spacing":"","_spacing":"mai_column_spacing","background":"","_background":"mai_column_background","shadow":"0","_shadow":"mai_columns_shadow","first_xs":"0","_first_xs":"mai_columns_first_xs","first_sm":"0","_first_sm":"mai_columns_first_sm","first_md":"0","_first_md":"mai_columns_first_md"},"mode":"preview"} -->
<!-- wp:paragraph {"textColor":"primary","className":"is-style-subheading","fontSize":"xs"} -->
<p class="is-style-subheading has-primary-color has-text-color has-xs-font-size">Intro Heading</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>This is a nice heading</h2>
<!-- /wp:heading -->

<?php if ( class_exists( 'Mai_List' ) ) { ?>
<!-- wp:acf/mai-list {"name":"acf/mai-list","data":{"mai_list_type":"ul","mai_list_location":"start","mai_list_icon_clone":{"mai_icon_style":"light","mai_icon_choices":"check-circle"},"mai_list_icon_color_clone":{"mai_icon_color":"","mai_icon_background":""},"mai_list_icon_size":"","mai_list_icon_padding":"","mai_list_icon_border_radius":"","mai_list_icon_gap":"md","mai_list_icon_margin_top":"0","mai_list_content_margin_top":"2","mai_list_columns_clone":{"mai_columns":"1","mai_columns_responsive":"0","mai_column_gap":"md","mai_row_gap":"md","mai_margin_top":"","mai_margin_bottom":""}},"mode":"preview"} -->
<!-- wp:acf/mai-list-item {"name":"acf/mai-list-item","data":{"style":"light","_style":"mai_icon_style","icon":"","_icon":"mai_icon_choices","icon_clone":"","_icon_clone":"mai_list_item_icon_clone","color_icon":"","_color_icon":"mai_icon_color","color_background":"","_color_background":"mai_icon_background","icon_color_clone":"","_icon_color_clone":"mai_list_item_icon_color_clone"},"mode":"preview"} -->
<!-- wp:paragraph -->
<p>Add a list of features here</p>
<!-- /wp:paragraph -->
<!-- /wp:acf/mai-list-item -->

<!-- wp:acf/mai-list-item {"name":"acf/mai-list-item","data":{"style":"light","_style":"mai_icon_style","icon":"","_icon":"mai_icon_choices","icon_clone":"","_icon_clone":"mai_list_item_icon_clone","color_icon":"","_color_icon":"mai_icon_color","color_background":"","_color_background":"mai_icon_background","icon_color_clone":"","_icon_color_clone":"mai_list_item_icon_color_clone"},"mode":"preview"} -->
<!-- wp:paragraph -->
<p>Add a list of features here</p>
<!-- /wp:paragraph -->
<!-- /wp:acf/mai-list-item -->

<!-- wp:acf/mai-list-item {"name":"acf/mai-list-item","data":{"style":"light","_style":"mai_icon_style","icon":"","_icon":"mai_icon_choices","icon_clone":"","_icon_clone":"mai_list_item_icon_clone","color_icon":"","_color_icon":"mai_icon_color","color_background":"","_color_background":"mai_icon_background","icon_color_clone":"","_icon_color_clone":"mai_list_item_icon_color_clone"},"mode":"preview"} -->
<!-- wp:paragraph -->
<p>Add a list of features here</p>
<!-- /wp:paragraph -->
<!-- /wp:acf/mai-list-item -->
<!-- /wp:acf/mai-list -->
<?php } else { ?>
<!-- wp:heading {"textAlign":"center","style":{"color":{"background":"#ff0000"}},"textColor":"white"} -->
<h2 class="has-text-align-center has-white-color has-text-color has-background" style="background-color:#ff0000">Requires Mai Lists plugin.</h2>
<!-- /wp:heading -->
<?php } ?>
<!-- /wp:acf/mai-column -->

<!-- wp:acf/mai-column {"name":"acf/mai-column","data":{"align_column_vertical":"start","_align_column_vertical":"mai_column_align_column_vertical","spacing":"","_spacing":"mai_column_spacing","background":"","_background":"mai_column_background","shadow":"0","_shadow":"mai_columns_shadow","first_xs":"0","_first_xs":"mai_columns_first_xs","first_sm":"0","_first_sm":"mai_columns_first_sm","first_md":"0","_first_md":"mai_columns_first_md"},"mode":"preview"} -->
<!-- wp:group {"backgroundColor":"primary","verticalSpacingTop":"xs","verticalSpacingRight":"xs"} -->
<div class="wp-block-group has-primary-background-color has-background"><!-- wp:group {"backgroundColor":"white","verticalSpacingTop":"md","verticalSpacingBottom":"md","verticalSpacingLeft":"md","verticalSpacingRight":"md","marginBottom":"-lg","marginLeft":"-lg"} -->
<div class="wp-block-group has-white-background-color has-background"><!-- wp:paragraph {"align":"center","textColor":"black","className":"is-style-heading","fontSize":"xl"} -->
<p class="has-text-align-center is-style-heading has-black-color has-text-color has-xl-font-size"><strong>CTA Heading Here</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","textColor":"black"} -->
<p class="has-text-align-center has-black-color has-text-color">Lorem ipsum dolor sit amet, est quas epicurei cu. Ei pri quot pertinax.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link">Buy Now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:acf/mai-column -->
<!-- /wp:acf/mai-columns --></section>
<!-- /wp:group -->
