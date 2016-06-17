class FormGenerator {

	static generateForm(json, jesus) {
		var o = $("#input");
		o.empty();
	
		for(var i in json.meetingPoints) {
			var p = json.meetingPoints[i];
			var output = "";
		
			if(p.type == "vb") {
				output = FormGenerator.vb(p);
			} else if (p.type == "meetingOpen") {
				output = FormGenerator.meetingOpen(p);
			} else if (p.type == "customQuestion") {
				output = FormGenerator.customQuestion(p);
			} else {
				console.info("Todo: Write form generator function for " + p.type);
			}
			
			var a = $("<p>").append(output);
			o.append(a);
			
		}
		o.sortable({
			appendTo: o,
			axis: "y",
			connectWith: "p",
			stop: function() {
				jesus.saveOrder(json)
			}
		});
	}

	static vb(p) {
		var data = '<div class="meetingPointContainer" id="' + p.id + '" data-type="'+ p.type +'" data-datatype="'+ p.type +'"><h2>'+ p.title +'</h2><textarea class="validatorField">'+p.data.text+'</textarea><br><span class="errorMessage" id="'+ p.id +'_error"></span></div>';
		return data;
	}

	static meetingOpen(p) {
		var data = '<div class="meetingPointContainer" id="' + p.id + '" data-type="'+ p.type +'" data-datatype="'+ p.type +'">'
				+ '<h2>'+ p.title +'</h2><form>'
				+ 'Mötets öppnare: <input value="'+p.data.meetingOpener +'" class="validatorField meetingOpener"><br>'
				+ 'Öppnat klockan: <input type="time" value="'+p.data.meetingOpenTime +'" class="validatorField meetingOpenTime"><br>'
				+ '<br><span class="errorMessage" id="'+ p.id +'_error"></span></form></div>';
		return data;
	}
	

	static customQuestion(p) {
		var data = '<div class="meetingPointContainer" id="' + p.id + '" data-type="'+ p.type +'" data-datatype="'+ p.type +'">'
				+ 'Titel: <input value="'+p.data.title +'" class="validatorField title"><br>'
				+ 'Text: <input value="'+p.data.text +'" class="validatorField text"><br>'
				+ 'Beslut: <input type="time" value="'+p.data.beslut +'" class="validatorField beslut"><br>'
				+ '<br><span class="errorMessage" id="'+ p.id +'_error"></span></form></div>';
		return data;
	}	
}