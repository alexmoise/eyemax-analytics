
// a first *test* event ...
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
