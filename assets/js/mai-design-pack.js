( function ( document, $, undefined ) {

	$( '.mai-addon-actions' ).on( 'click', '.button', function(e){
		e.preventDefault();

		var $button = $( e.target );
		var $card   = $button.parents( '.mai-addon' );

		$card.addClass( 'mai-addon-loading' );
		$card.append( '<span class="mai-addon-loader">' + maiDesignPackVars.loadingText + '</span>' );

		$.ajax({
			method: 'GET',
			url: maiDesignPackVars.ajaxUrl,
			data: {
				'action': 'mai_design_pack_action',
				'nonce': maiDesignPackVars.ajaxNonce,
				'slug': $(this).attr( 'data-slug' ),
				'trigger': $(this).attr( 'data-action' ),
			},
			success: function( response ) {
				$button.parent( '.mai-addon-actions' ).html( response.data.html );
				$card.removeClass( 'mai-addon-loading' );
				$card.find( '.mai-addon-loader' ).remove();

				if ( response.data.active ) {
					$card.addClass( 'mai-addon-is-active' );
				} else {
					$card.removeClass( 'mai-addon-is-active' );
				}
			},
			fail: function( response ) {
				console.log( 'fail', response );
			}
		}).done( function( response )  {
			console.log( 'done', response );
		});
	})

})( this, jQuery );
