// === a) Fill out the contact form (https://eyemax.ch/kontakt-impressum/) - form has ID 22791
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
        console.log( "Kontakt-Impressum form mail sent" );
        ga( 'send', 'event', 'Kontakt-Impressum form', 'mail_sent' );
    }
}, false );

// === b) Fill out this form here: https://eyemax.ch/preise/ - form has ID 22858
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
        console.log( "Preise form mail sent" );
        ga( 'send', 'event', 'Preise form', 'mail_sent' );
    }
}, false );


// just a *test* event ...
/*
$(document).ready(function() {
	$("form#MyFormID").each(function() {
		var jqForm = $(this);
		var jsForm = this;
		var action = jqForm.attr("action");
		jqForm.submit(function(event) { // when someone submits the form(s) - CHANGE TO MATCH the EVENT, could be onclick etc.
			event.preventDefault(); // don't submit the form yet
			ga('send', 'event', 'MyCategory', 'MyAction', 'MyLabel', MyValue); // create and send a custom event
			setTimeout(function() { // now wait 300 milliseconds...
				jsForm.submit(); // ... and continue with the form submission
			},300);
		});
	});
});
*/
