function initMeeting() {
	
	window.jesus = new Jesus();

	$(".validatorField").each(function(data, target) {
		$(target).on('change keyup', Validator.validate);
		
		$(target).on('change keyup', window.jesus.saveToJson);
	});
}

function createPanes() {
	$('body').empty();
	$('<div>').attr('id', 'input').appendTo($('body'));
	$('<div>').attr('id', 'output').appendTo($('body'));
	
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
	$.get('backend/index.php?do=loadAll').done(function(data) {
		var list = $('<div>');
		var el = $('<div>').text("Nytt årsmöte");
		el.data('motestyp', 'arsmote');
		el.appendTo(list);

		el = $('<div>').text("Nytt styrelsemöte");
		el.data('motestyp', 'styrelsemote');
		el.appendTo(list);		

		el = $('<div>').text("Nytt konstituerande styrelsemöte");
		el.data('motestyp', 'konstituerande_styrelsemote');
		el.appendTo(list);		
		
		for(var i in data) {
			var el = $('<div>').text(data[i]['title']);
			el.data('id', data[i]['id']);
			el.appendTo(list);
		}
		list.find('div').on('click', function(ev) {
			var id = $(ev.currentTarget).data('id');
			if(id) {
				$.post('backend/index.php?do=load', JSON.stringify({ 'id': id })).done(function(data) {
					console.log(data);
					window.json = data;
					createPanes();
				});
			} else {
				var typ = $(ev.currentTarget).data('motestyp');
				
				if(typ == 'arsmote') {
					window.json = window.originalArsmote;
				} else if(typ == 'styrelsemote') {
					window.json = window.originalStyrelsemote;
				} else if(typ == 'konstituerande_styrelsemote') {
					window.json = window.originalKonstituerande;
				} else {
					alert("Smurf");
				}
				createPanes();
			}
		});
		list.appendTo('body');
	});
});