jQuery( function( $ ) {

	if ( 0 < window.location.search.indexOf( 'show_review_form' ) ) {
		// Do not hide form.
		return;
	}

	$( '.comment-form' ).each( function() {
		var $this          = $( this ),
			$form_elements = $this.find( '> *:not(.comment-form-rating,.comment-notes)' ),
			// Store rating element for live triggers.
			$rating        = $this.find( '.comment-form-rating' ),
			$rating_select = $rating.find( 'select' );

		if ( ! $rating_select.length ) {
			return true;
		}

		$form_elements.hide();

		$rating_select.on( 'change', function() {
			$form_elements.show();
		} );

		// Trigger from rating parent div element since stars are not present at load time.
		// Cannot trigger from comment form as reCaptcha deletes all events from this element.
		$rating.on( 'click touchend', 'a', function( e ) {
			$form_elements.show();
		} );
	} );
} );
