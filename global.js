function ProtoGen() {
	var jesus = new Jesus();
	var htmlGenerator = new HtmlGenerator();
	var validator = new Validator();
	var formGenerator = new FormGenerator();
	var json = null;
	var that = this;
	showStartScreen();

	function listenInOnMeeting(json, refresh, doNotEmptyBody, scroll) {
		$.post('backend/index.php?do=load', JSON.stringify({ 'id': json.meetingID })).done(function(data) {
			if(!doNotEmptyBody || JSON.stringify(data) != JSON.stringify(json)) {
				json = data;
				if(!doNotEmptyBody) {
					$('body').empty();
					initMenu();
				} else {
					$('#output').remove();
				}
				$('<div>').attr('id', 'output').css('width', '100%').appendTo($('body'));
				htmlGenerator.generateHtml(json);
				if(doNotEmptyBody) {
					$(window).scrollTop(scroll);
				}
			}

			if(refresh) {
				 setTimeout(function() {
					listenInOnMeeting(json, true, true, $(window).scrollTop());
				}, 2000);
			}
		});
	}

	function initMeeting(initial_json) {
		json = initial_json;
		$('body').empty();
		initMenu();
		$('<div id="saveMarker">').appendTo('body');
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

			$(document).on('needsToRedraw', function() {
				initMeeting(json);
			});
		});

		$('<li>Aktuellt möte<ul><li class="addNewMeetingPoint">Ny punkt</li><li class="motesinstallningarMenu">Mötesinställningar</li></ul></li>').appendTo('#main-menu');

		$(".addNewMeetingPoint").on('click', function(ev) {
			var punkt = ProtoGen.copyPoint(meetingPoints.customQuestion);

			json.meetingPoints.push(punkt);
			initMeeting(json);
			jesus.sendSaveRequest(json);
		});

		$(".motesinstallningarMenu").on('click', function(ev) {
			$('<div title="Mötesinställningar"><strong>Organisationsnamn</strong><br><input placeholder="Ung Pirat Stockholm" id="orgNameInput"><br><br><strong>Mötesnamn</strong><br><input placeholder="Årsmöte 2017" id="meetingNameInput"></div>').appendTo('body').dialog({
				buttons: [
					{
						text: "Avbryt",
						click: function() {
							$( this ).dialog( "close" );
						}
					},
					{
						text: "Spara",
						click: function() {
							json.orgName = $("#orgNameInput").val();
							json.meetingTitle = $("#meetingNameInput").val();
							initMeeting(json);
							jesus.sendSaveRequest(json);
						}
					}
				]
			});
			$("#orgNameInput").val(json.orgName);
			$("#meetingNameInput").val(json.meetingTitle);
		});
		$( "#main-menu" ).menu("refresh");
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
			<li>Redigera möte\
				<ul id="menu-current-meetings">\
				</ul>\
			</li>\
			<li>Lyssna in på möte\
				<ul id="menu-listen-meetings">\
				</ul>\
			</li>\
			<li>Arkiverade möten\
				<ul id="menu-archived-meetings">\
				</ul>\
			</li>';
		$('body').append(menu);

		// nya möten
		$("#main-menu").find('li.nyttMoteMenu').on('click', function(ev) {
			var typ = $(ev.currentTarget).attr('id');

			$('<div title="Mötesinställningar"><strong>Organisationsnamn</strong><br><input placeholder="Ung Pirat Stockholm" id="orgNameInput"><br><br><strong>Mötesnamn</strong><br><input placeholder="Årsmöte 2017" id="meetingNameInput"></div>').appendTo('body').dialog({
				buttons: [
					{
						text: "Avbryt",
						click: function() {
							$( this ).dialog( "close" );
						}
					},
					{
						text: "Spara",
						click: function() {
							var meetingData = null;
							if(typ == 'new-meeting-arsmote') {
								meetingData = window.originalArsmote;
							} else if(typ == 'new-meeting-styrelsemote') {
								meetingData = window.originalStyrelsemote;
							} else if(typ == 'new-meeting-konst-styrelsemote') {
								meetingData = window.originalKonstituerande;
							}
							meetingData.orgName = $("#orgNameInput").val();
							meetingData.meetingTitle = $("#meetingNameInput").val();
							$( this ).dialog( "close" );
							initMeeting(meetingData);
						}
					}
				]
			});
		});

		// pågående möten
		$.get('backend/index.php?do=loadAll').done(function(data) {
			var currentMeetings = $('#menu-current-meetings');
			var archivedMeetings = $('#menu-archived-meetings');
			var listenMeetings = $('#menu-listen-meetings');
			for(var i in data) {
				var el = $('<li>').text(data[i]['title'] + " för " + data[i]['orgName']);
				el.data('meetingname', data[i]['id']);

				if(data[i]['editable'] == "1") {
					el.addClass("pagaendeMotenMenu");
					el.appendTo(currentMeetings);

					var el2 = $('<li>').text(data[i]['title'] + " för " + data[i]['orgName']);
					el2.data('meetingname', data[i]['id']);
					el2.addClass("listenMotenMenu");
					el2.appendTo(listenMeetings);
				} else {
					el.addClass("arkiveradeMotenMenu");
					el.appendTo(archivedMeetings);
				}
			}
			$("#main-menu").find('li.pagaendeMotenMenu, li.arkiveradeMotenMenu, li.listenMotenMenu').on('click', function(ev) {
				var meetingname = $(ev.currentTarget).data('meetingname');
				if(meetingname) {
					$.post('backend/index.php?do=load', JSON.stringify({ 'id': meetingname })).done(function(data) {
						if($(ev.currentTarget).hasClass("arkiveradeMotenMenu")) {
							listenInOnMeeting(data,false);
						} else if($(ev.currentTarget).hasClass("listenMotenMenu")) {
							listenInOnMeeting(data, true);
						} else {
							initMeeting(data);
						}
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
