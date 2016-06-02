class FormGenerator {

	static generateForm(json) {
		var o = $("#input");
		o.empty();
	
		for(var i in json.meetingPoints) {
			var p = json.meetingPoints[i];
			var output = "";
		
			if(p.type == "vb") {
				output = FormGenerator.vb(p);
			} else if (p.type == "meetingOpen") {
				output = FormGenerator.meetingOpen(p);
			} else {
				console.error("Todo: Write form generator function for " + p.type);
			}
			
			o.append("<p>" + output + "</p>");
		}
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
}