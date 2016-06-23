function FormGenerator() {

	this.generateForm = function(json, jesus, htmlGenerator) {
		var o = $("#input");
		o.empty();

		for(var i in json.meetingPoints) {
			var p = json.meetingPoints[i];
			var htmlPoint = $('<div>');

			if(typeof meetingPoints[p.type].form == 'function') {
				meetingPoints[p.type].form(p).appendTo(htmlPoint);
			} else {
				console.info("Todo: Write form function for " + p.type);
			}

			htmlPoint.addClass("meetingPointContainer").attr("id", p.id);
			var wrapper = $("<div>").addClass("meetingPointWrapper").css("overflow", "unset");

			var wrapper2 = $("<div>").css("overflow", "auto");
			wrapper2.append(htmlPoint);
			$('<br>').appendTo(wrapper2);
			$('<span>').addClass("errorMessage").attr("id", p.id + "_error").appendTo(wrapper2);
			wrapper2.appendTo(wrapper);
			o.append(wrapper);

		}
		o.sortable({
			appendTo: o,
			axis: "y",
			connectWith: ".meetingPointWrapper",
			stop: function() {
				reorderPoints(json);
				jesus.sendSaveRequest(json);
				htmlGenerator.generateHtml(json);
			}
		});

		return o.find(".validatorField");
	};

	function reorderPoints(json) {
		var oldList = json.meetingPoints;
		json.meetingPoints = [];
		$("#input .meetingPointContainer").each(function(id, el) {
			var currentId = $(el).attr('id');
			for(var i in oldList) {
				if(oldList[i]['id'] == currentId) {
					json.meetingPoints.push(oldList[i]);
				}
			}
		});
	};

	this.updateErrorMessages = function(json) {
		for(var i in json.meetingPoints) {
			var p = json.meetingPoints[i];
			var errorMessage = p.error ? p.error : '';

			$('#' + p.id + '_error').text(errorMessage);
		}
	};
};
