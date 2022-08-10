<?php
/**
 * Description: Features grid list
 * Categories: feature, section
 * Keywords: category, service, feature, section
 */
?>
<!-- wp:group {"align":"full","contentWidth":"xl","verticalSpacingTop":"lg","verticalSpacingBottom":"lg"} -->
<div class="wp-block-group alignfull">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Our Features</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","maxWidth":"md"} -->
<p class="has-text-align-center">Lorem ipsum dolor sit amet, est quas epicurei cu. Ei pri quot pertinax. Ad suas argumentum mel, in mel esse illud erroribus. Dicat minimum eu per.</p>
<!-- /wp:paragraph -->

<?php if ( class_exists( 'Mai_List' ) ) { ?>
<!-- wp:acf/mai-list {"name":"acf/mai-list","data":{"mai_list_type":"ul","mai_list_location":"top-center","mai_list_icon_clone":{"mai_icon_style":"light","mai_icon_choices":"check"},"mai_list_icon_color_clone":{"mai_icon_color":"","mai_icon_background":"alt"},"mai_list_icon_size":"24","mai_list_icon_padding":"20","mai_list_icon_border_radius":"9999","mai_list_icon_gap":"md","mai_list_columns_clone":{"mai_columns":"3","mai_columns_responsive":"0","mai_align_columns":"start","mai_align_columns_vertical":"full","mai_column_gap":"xl","mai_row_gap":"xxl","mai_margin_top":"xxl","mai_margin_bottom":""}},"mode":"preview"} -->
<!-- wp:acf/mai-list-item {"name":"acf/mai-list-item","data":{"mai_list_item_icon_clone":{"mai_icon_style":"light","mai_icon_choices":"lightbulb-on"},"mai_list_item_icon_color_clone":{"mai_icon_color":"","mai_icon_background":""}},"mode":"preview"} -->
<!-- wp:paragraph {"align":"center","className":"is-style-heading"} -->
<p class="has-text-align-center is-style-heading">Feature Heading</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","fontSize":"sm"} -->
<p class="has-text-align-center has-sm-font-size">Lorem ipsum dolor sit amet, est quas epicurei cu. Ei pri quot pertinax.</p>
<!-- /wp:paragraph -->
<!-- /wp:acf/mai-list-item -->

<!-- wp:acf/mai-list-item {"name":"acf/mai-list-item","data":{"mai_list_item_icon_clone":{"mai_icon_style":"light","mai_icon_choices":"rocket-launch"},"mai_list_item_icon_color_clone":{"mai_icon_color":"","mai_icon_background":""}},"mode":"preview"} -->
<!-- wp:paragraph {"align":"center","className":"is-style-heading"} -->
<p class="has-text-align-center is-style-heading">Feature Heading</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","fontSize":"sm"} -->
<p class="has-text-align-center has-sm-font-size">Lorem ipsum dolor sit amet, est quas epicurei cu. Ei pri quot pertinax.</p>
<!-- /wp:paragraph -->
<!-- /wp:acf/mai-list-item -->

<!-- wp:acf/mai-list-item {"name":"acf/mai-list-item","data":{"mai_list_item_icon_clone":{"mai_icon_style":"light","mai_icon_choices":"badge-check"},"mai_list_item_icon_color_clone":{"mai_icon_color":"","mai_icon_background":""}},"mode":"preview"} -->
<!-- wp:paragraph {"align":"center","className":"is-style-heading"} -->
<p class="has-text-align-center is-style-heading">Feature Heading</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","fontSize":"sm"} -->
<p class="has-text-align-center has-sm-font-size">Lorem ipsum dolor sit amet, est quas epicurei cu. Ei pri quot pertinax.</p>
<!-- /wp:paragraph -->
<!-- /wp:acf/mai-list-item -->

<!-- wp:acf/mai-list-item {"name":"acf/mai-list-item","data":{"mai_list_item_icon_clone":{"mai_icon_style":"light","mai_icon_choices":"chart-line"},"mai_list_item_icon_color_clone":{"mai_icon_color":"","mai_icon_background":""}},"mode":"preview"} -->
<!-- wp:paragraph {"align":"center","className":"is-style-heading"} -->
<p class="has-text-align-center is-style-heading">Feature Heading</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","fontSize":"sm"} -->
<p class="has-text-align-center has-sm-font-size">Lorem ipsum dolor sit amet, est quas epicurei cu. Ei pri quot pertinax.</p>
<!-- /wp:paragraph -->
<!-- /wp:acf/mai-list-item -->

<!-- wp:acf/mai-list-item {"name":"acf/mai-list-item","data":{"mai_list_item_icon_clone":{"mai_icon_style":"light","mai_icon_choices":"trophy"},"mai_list_item_icon_color_clone":{"mai_icon_color":"","mai_icon_background":""}},"mode":"preview"} -->
<!-- wp:paragraph {"align":"center","className":"is-style-heading"} -->
<p class="has-text-align-center is-style-heading">Feature Heading</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","fontSize":"sm"} -->
<p class="has-text-align-center has-sm-font-size">Lorem ipsum dolor sit amet, est quas epicurei cu. Ei pri quot pertinax.</p>
<!-- /wp:paragraph -->
<!-- /wp:acf/mai-list-item -->

<!-- wp:acf/mai-list-item {"name":"acf/mai-list-item","data":{"mai_list_item_icon_clone":{"mai_icon_style":"light","mai_icon_choices":"user-alt"},"mai_list_item_icon_color_clone":{"mai_icon_color":"","mai_icon_background":""}},"mode":"preview"} -->
<!-- wp:paragraph {"align":"center","className":"is-style-heading"} -->
<p class="has-text-align-center is-style-heading">Feature Heading</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","fontSize":"sm"} -->
<p class="has-text-align-center has-sm-font-size">Lorem ipsum dolor sit amet, est quas epicurei cu. Ei pri quot pertinax.</p>
<!-- /wp:paragraph -->
<!-- /wp:acf/mai-list-item -->
<!-- /wp:acf/mai-list -->
<?php
} else {
	echo maidp_get_requires( 'mai-lists' );
}
?>
</div>
<!-- /wp:group -->
