function initMeeting() {

	$(".validatorField").each(function(data, target) {
		$(target).on('change keyup', Validator.validate);
		
		$(target).on('change keyup', Jesus.saveToJson);
	});
}

function createPanes() {
	// create the left pane, ie the form
	FormGenerator.generateForm(json);
	
	// display the error messages
	for(var i in json.meetingPoints) {
		var target = $("#" + json.meetingPoints[i].id);
		Validator.validateMeetingPoint(target);
	}
	
	// create the right pane, ie the html output
	HtmlGenerator.generateHtml(json);
	
	// add event listeners to forms
	initMeeting();
}
	
$(document).ready(function() {
	//load the meeting data, either from default or storage
	window.json = window.originalJson;
	var jsonFromStorage = localStorage.getItem("json");
	if(jsonFromStorage) {
		jsonFromStorage = JSON.parse(jsonFromStorage);
		if(jsonFromStorage) {	
			window.json = jsonFromStorage;
		}
	}
	
	createPanes();
	
	$("#resetButton").on('click', function(e) {
		e.preventDefault();
		window.json = window.originalJson;
		createPanes();
	});
});