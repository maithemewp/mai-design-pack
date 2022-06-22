<?php
/**
 * Description: Full width background image hero
 * Categories: hero, section
 * Keywords: hero, section
 */
?>
<!-- wp:cover {"url":"<?php echo maidp_get_image_url( 'landscape' ); ?>","dimRatio":90,"overlayColor":"heading","align":"full","contentWidth":"md","verticalSpacingTop":"lg","verticalSpacingBottom":"lg"} -->
<div class="wp-block-cover alignfull"><span aria-hidden="true" class="wp-block-cover__background has-heading-background-color has-background-dim-90 has-background-dim"></span><img class="wp-block-cover__image-background" alt="placeholder image" src="<?php echo maidp_get_image_url( 'landscape' ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">This Is An Important Headline</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Lorem ipsum dolor sit amet, est quas epicurei cu. Ei pri quot pertinax. Ad suas argumentum mel, in mel esse illud erroribus. Dicat minimum eu per, eum fugit periculis et. Suas minim inimicus pri te.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->
