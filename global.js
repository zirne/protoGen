function ProtoGen(initial_json) {
	this.jesus = new Jesus();
	this.json = null;
	var that = this;
	that.json = initial_json;
	drawScreen();

	function drawScreen() {
		$('body').empty();
		$('<div>').attr('id', 'input').appendTo($('body'));
		$('<div>').attr('id', 'output').appendTo($('body'));
		
		// create the left pane, ie the form
		FormGenerator.generateForm(that.json, that.jesus);
		
		// display the error messages
		for(var i in that.json.meetingPoints) {
			var target = $("#" + that.json.meetingPoints[i].id);
			Validator.validateMeetingPoint(target);
		}
		
		// create the right pane, ie the html output
		HtmlGenerator.generateHtml(that.json);
		
		// add event listeners to forms
		$(".validatorField").each(function(data, target) {
			$(target).off('change keyup');
			$(target).on('change keyup', Validator.validate);
			$(target).on('change keyup', function(event) {
				that.jesus.pointChanged(event, that.json);
			});
		});
		
		$('<div>').text("Ny punkt").appendTo('body').on('click', function(ev) {
			var punkt = jQuery.extend(true, {},window.newMeetingPoint);
			punkt.id = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 8);
			that.json.meetingPoints.push(punkt);
			drawScreen();
			that.jesus.saveAll(that.json);
		});
	};
};

ProtoGen.showStartScreen = function() {
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
					new ProtoGen(data);
				});
			} else {
				var typ = $(ev.currentTarget).data('motestyp');
				
				if(typ == 'arsmote') {
					new ProtoGen(window.originalArsmote);
				} else if(typ == 'styrelsemote') {
					new ProtoGen(window.originalStyrelsemote);
				} else if(typ == 'konstituerande_styrelsemote') {
					new ProtoGen(window.originalKonstituerande);
				} else {
					alert("Smurf");
				}
			}
		});
		list.appendTo('body');
	});
};

$(document).ready(function() {
	ProtoGen.showStartScreen();
});