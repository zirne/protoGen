function HtmlGenerator() {

	this.htmlTimeout = null;
	
	this.generateHtml = function(json) {
		var o = $("#output");
		o.empty();
		
		$("<h1>Möte för " + json.orgName + "</h1>").appendTo(o);
		
		for(var i in json.meetingPoints) {
			var p = json.meetingPoints[i];
			var output = null;
			
			if(typeof meetingPoints[p.type].html == 'function') {
				output = meetingPoints[p.type].html(p);
			} else {
				console.info("Todo: Write html generator function for " + p.type);
			}
			
			var wrapper = $("<p>");
			wrapper.append(output);
			o.append(wrapper);
		}
	};
};
