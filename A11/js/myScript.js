$(document).ready(function() {
	//hides all answers on load.
	for ( i = 0; i < 5; i++) {
		$("#Q" + (i + 1) + "A").hide();
	}
	//selects all id's that start with "Q"
	$('[id^="Q"]').click(function() {
		var id = $(this).attr("id");
		if ($("#" + id + "A").is(":visible")) {
			$("#" + id + "A").hide("slow");
			$("#" + id).children().remove();
			$("#" + id).append("<span>+</span>");
		} else {
			$("#" + id + "A").show("slow");
			$("#" + id).children().remove();
			$("#" + id).append("<span>-</span>");
		}
	});
}); 
