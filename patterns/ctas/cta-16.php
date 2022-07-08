<?php
/**
 * Description: CTA with background image and demo form
 * Categories: cta
 * Keywords: cta
 */
?>
<!-- wp:cover {"url":"<?php echo maidp_get_image_url( 'placeholder-square' ); ?>","dimRatio":80,"overlayColor":"heading","verticalSpacingTop":"md","verticalSpacingBottom":"md","verticalSpacingLeft":"md","verticalSpacingRight":"md"} -->
<div class="wp-block-cover"><span aria-hidden="true" class="wp-block-cover__background has-heading-background-color has-background-dim-80 has-background-dim"></span><img class="wp-block-cover__image-background" alt="placeholder image" src="<?php echo maidp_get_image_url( 'placeholder-square' ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","textColor":"white"} -->
<h2 class="has-text-align-center has-white-color has-text-color">Your lead magnet</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"is-style-default"} -->
<p class="has-text-align-center is-style-default">Lorem ipsum dolor sit amet, est quas epicurei cu. Ei pri quot pertinax. Ad suas argumentum mel.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"backgroundColor":"white","textColor":"heading","verticalSpacingTop":"md","verticalSpacingBottom":"sm","verticalSpacingLeft":"md","verticalSpacingRight":"md","marginTop":"xl"} -->
<div class="wp-block-group has-heading-color has-white-background-color has-text-color has-background"><!-- wp:paragraph {"align":"center","fontSize":"sm"} -->
<p class="has-text-align-center has-sm-font-size"><strong>Ad suas argumentum mel, in mel esse.</strong></p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<form>
	<p><input type="text" id="name" name="name" placeholder="Name"></p>
	<p><input type="email" id="email" name="email" placeholder="Email"></p>
	<p><input type="submit" value="Sign Up" style="width:100%;"></p>
</form>
<!-- /wp:html -->

<!-- wp:paragraph {"align":"center","fontSize":"xs","spacingTop":"md"} -->
<p class="has-text-align-center has-xs-font-size"><em>This form is for demo purposes only.</em></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
