//--------------------------------------------------------------------
	// Message alert
//--------------------------------------------------------------------
	// EXAMPLES - to be called within the $(document).ready();
	//message_alert(0, "User is updated."); // GREEN - Status Good message
	//message_alert(1, "An Error has occurred. Please fix."); // RED - Error message
	//message_alert(2, "Warning, robots.txt allows search engines to view this page."); // YELLOW - Warning message

// JS message alert
function message_alert(type, message, killtime) {
	// time before dismissal
	if (killtime != 0) { killtime = killtime || 10000; } //sets default time   //if (killtime === undefined) killtime = 5000;

	// kill duplicate messages
	$('.message_alert div:first-child').each(function() {
		if ($(this).html() == message) {
			$(this).parent().remove();
		}
	});

	// compile html
	data = "<div class=\"message_alert ";
	if (type == 0 || type == 'green') {
		data += "green";	// status
	} else if (type == 1 || type == 'red') {
		data += "red";		// error
	} else if (type == 2 || type == 'yellow') {
		data += "yellow";	// warning
	}
	data += "\"><div>"+message+"</div><div class=\"dismiss\">dismiss</div></div>";

	if (message) { // If message is not blank
		$("#message_alerts").prepend(data); // add to dom.
		$(".message_alert").slideDown({ // slide down
			complete: function(){ // delay and slide up.
				if (killtime != 0) {
					$(this).delay(killtime).animate({ height: 0, opacity: 0 }, "slow", function() { // Slide up and fade out
						$(this).remove(); // after custom effect, remove from dom.
					});
				}
			}
		});
		$(".message_alert .dismiss").on('click', function() { // message dismiss
			$(this).parent().remove(); // remove from dom
		});
	}
}