// === a) Fill out the Kontakt-impressum form - form has ID 22791
// trigger this for just submitting form
document.addEventListener( 'wpcf7submit', function( event ) {
    if ( '22791' == event.detail.contactFormId ) {
        console.log( "Kontakt-Impressum form submitted" );
        ga( 'send', 'event', 'Kontakt-Impressum form', 'submit' );
    }
}, false );
// trigger this for successfully sent emails (if the difference from the above is high we'll need to check why mails aren't sent properly)
document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( '22791' == event.detail.contactFormId ) {
        console.log( "Kontakt-Impressum form mail sent successfuly" );
        ga( 'send', 'event', 'Kontakt-Impressum form', 'mail_sent' );
    }
}, false );

// === b) Fill out the Preise form - form has ID 22858
// trigger this for just submitting form
document.addEventListener( 'wpcf7submit', function( event ) {
    if ( '22858' == event.detail.contactFormId ) {
        console.log( "Preise form submitted" );
        ga( 'send', 'event', 'Preise form', 'submit' );
    }
}, false );
// trigger this for successfully sent emails (if the difference from the above is high we'll need to check why mails aren't sent properly)
document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( '22858' == event.detail.contactFormId ) {
        console.log( "Preise form mail sent successfuly" );
        ga( 'send', 'event', 'Preise form', 'mail_sent' );
    }
}, false );

// === b) Sign up for newsletter on kontakt-impressum page
// trigger this for just submitting the form
jQuery(document).ready(function() {
	if ( typeof mc4wp !== 'undefined' ) {
		mc4wp.forms.on('submitted', function(form) {
			console.log( "Sign up form submitted" );
			ga && ga( 'send', 'event', 'Sign up form', 'submit' );
		});
	}
});
// trigger this for successful subscription to list (if the difference from the above is high we'll need to check why users can't subscribe even if they try)
jQuery(document).ready(function() {
	if ( typeof mc4wp !== 'undefined' ) {
		mc4wp.forms.on('subscribed', function(form) {
			console.log( "Sign up form subscribed successfuly" );
			ga && ga( 'send', 'event', 'Sign up form', 'subscribed' );
		});
	}
});

// === c) add a product to the whishlist
// ...together with the product ID, maybe we'll use this later on in reporting?
jQuery(document).ready(function() {
	jQuery('a.add_to_wishlist').click(function(){
		var wish_product_id = jQuery(this).data('product-id');
		console.log('Product added to whishlist: ' + wish_product_id);
		ga( 'send', 'event', 'Forms', 'Sign-up', 'Product: ' + wish_product_id );
	});
});

/* // === ONLY A TEST ... 
jQuery(document).ready(function() {
	jQuery("form#mc4wp-form-1").each(function() {
		var jqForm = jQuery(this);
		var jsForm = this;
		var action = jqForm.attr("action");
		jqForm.submit(function(event) { // when someone submits the form(s) - CHANGE TO MATCH the EVENT, could be onclick etc.
			event.preventDefault(); // don't submit the form yet
			console.log( "Mailchimp form submitted" );
			ga( 'send', 'event', 'Newsletter sign up form', 'submit' );
			setTimeout(function() { // now wait 300 milliseconds...
				jsForm.submit(); // ... and continue with the form submission
			},300);
		});
	});
});
*/
