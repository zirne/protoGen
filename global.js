function ProtoGen() {
	var jesus = new Jesus();
	var htmlGenerator = new HtmlGenerator();
	var validator = new Validator();
	var formGenerator = new FormGenerator();
	var json = null;
	var that = this;
	showStartScreen();

	function initMeeting(initial_json) {
		json = initial_json;
		$('body').empty();
		$('<div>').attr('id', 'input').appendTo($('body'));
		$('<div>').attr('id', 'output').appendTo($('body'));
		
		// create the left pane, ie the form
		var interactiveFields = formGenerator.generateForm(json, jesus, htmlGenerator);
		
		// display the error messages
		validator.validate(json);

		// show error messages
		formGenerator.updateErrorMessages(json);
		
		// create the right pane, ie the html output
		htmlGenerator.generateHtml(json);
		
		// add event listeners to forms
		interactiveFields.each(function(data, target) {
			$(target).off('change keyup');

			$(target).on('change keyup', function(event) {
				// save changes to json (and also push to server)
				jesus.pointChanged(event, json);

				// generate error messages
				validator.validate(json);

				// show error messages
				formGenerator.updateErrorMessages(json);

				// update html
				if(!htmlGenerator.htmlTimeout) {
					htmlTimeout = setTimeout(function() {
						htmlGenerator.generateHtml(json);
						htmlGenerator.htmlTimeout = null;
					}, 200);
				}
			});
		});

		$('<div>').text("Ny punkt").appendTo('body').on('click', function(ev) {
			var punkt = ProtoGen.copyPoint(meetingPoints.customQuestion);

			json.meetingPoints.push(punkt);
			initMeeting(json);
			jesus.sendSaveRequest(json);
		});
	};

	function showStartScreen() {
		$.get('backend/index.php?do=loadAll').done(function(data) {
			$('body').empty();
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
						initMeeting(data);
					});
				} else {
					var typ = $(ev.currentTarget).data('motestyp');

					if(typ == 'arsmote') {
						initMeeting(window.originalArsmote);
					} else if(typ == 'styrelsemote') {
						initMeeting(window.originalStyrelsemote);
					} else if(typ == 'konstituerande_styrelsemote') {
						initMeeting(window.originalKonstituerande);
					} else {
						alert("Smurf");
					}
				}
			});
			list.appendTo('body');
		});
	};
};

ProtoGen.copyPoint = function(original) {
	var punkt = jQuery.extend(true, {},original);
	if(!punkt.id) {
		punkt.id = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 8);
	}
	return punkt;
};

$(document).ready(function() {
	new ProtoGen();
});
