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
		initMenu();
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

		$('<div class="addNewMeetingPoint">').text("Ny punkt").appendTo('body').on('click', function(ev) {
			var punkt = ProtoGen.copyPoint(meetingPoints.customQuestion);

			json.meetingPoints.push(punkt);
			initMeeting(json);
			jesus.sendSaveRequest(json);
		});
	};

	function showStartScreen() {
		$('body').empty();
		initMenu();
	};

	function initMenu() {
		var menu = '<ul id="main-menu" style="width: 100%; position: fixed;">\
			<li>Nytt möte\
				<ul>\
					<li id="new-meeting-arsmote" class="nyttMoteMenu">Årsmöte</li>\
					<li id="new-meeting-styrelsemote" class="nyttMoteMenu">Styrelsemöte</li>\
					<li id="new-meeting-konst-styrelsemote" class="nyttMoteMenu">Konst. styrelsemöte</li>\
				</ul>\
			</li>\
			<li>Pågående möten\
				<ul id="menu-current-meetings">\
				</ul>\
			</li>';
		$('body').append(menu);

		// nya möten
		$("#main-menu").find('li.nyttMoteMenu').on('click', function(ev) {
			var typ = $(ev.currentTarget).attr('id');

			if(typ == 'new-meeting-arsmote') {
				initMeeting(window.originalArsmote);
			} else if(typ == 'new-meeting-styrelsemote') {
				initMeeting(window.originalStyrelsemote);
			} else if(typ == 'new-meeting-konst-styrelsemote') {
				initMeeting(window.originalKonstituerande);
			}
		});

		// pågående möten
		$.get('backend/index.php?do=loadAll').done(function(data) {
			var list = $('#menu-current-meetings');
			for(var i in data) {
				var el = $('<li>').text(data[i]['title']).addClass("pagaendeMotenMenu");
				el.data('meetingname', data[i]['id']);
				el.appendTo(list);
			}
			$("#main-menu").find('li.pagaendeMotenMenu').on('click', function(ev) {
				var meetingname = $(ev.currentTarget).data('meetingname');
				if(meetingname) {
					$.post('backend/index.php?do=load', JSON.stringify({ 'id': meetingname })).done(function(data) {
						initMeeting(data);
					});
				}
			});
			$( "#main-menu" ).menu("refresh");
		});

		$( "#main-menu" ).menu({
			  position: { my: "left top", at : "left bottom", collision: "fit" }
		});
	}
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
