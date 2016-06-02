class HtmlGenerator {

	static generateHtml(json) {
		var o = $("#output");
		o.empty();
		
		$("<h1>Möte för " + json.orgName + "</h1>").appendTo(o);
		
		for(var i in json.meetingPoints) {
			var p = json.meetingPoints[i];
			var output = "";
			
			if(p.type == "vb") {
				output = HtmlGenerator.vb(p);
			} else if (p.type == "meetingOpen") {
				output = HtmlGenerator.meetingOpen(p);
			} else {
				console.error("Todo: Write html generator function for " + p.type);
			}
			
			o.append("<p>" + output + "</p>");
		}
	}

	static vb(p) {
		return '<h2>'+ p.title +'</h2><p>' + p.data.text + '</p>';
	}

	static meetingOpen(p) {
		return '<h2>'+ p.title +'</h2><p>' + p.data.meetingOpener + " öppnade mötet klockan " + p.data.meetingOpenTime + '</p>';
	}
}