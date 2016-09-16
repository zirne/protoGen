function HtmlGenerator() {

	this.htmlTimeout = null;
	this.generateHtml = function(json) {
		var o = $("#output");
		o.empty();

		var heading = $("<h1>").text(json.meetingTitle + " för " + json.orgName).appendTo(o);
		heading.height(40).css("padding", 0).css("margin", 0);
		var list = $("<ol>").appendTo(o);

		for(var i in json.meetingPoints) {
			var p = json.meetingPoints[i];
			var output = null;
			
			if(typeof meetingPoints[p.type].html == 'function') {
				output = meetingPoints[p.type].html(p);
			} else {
				console.info("Todo: Write html generator function for " + p.type);
			}
			
			var wrapper = $("<li>").css("overflow", "unset");
			var wrapper2 = $("<div>").css("overflow", "auto");

			wrapper2.append(output);
			wrapper.append(wrapper2);
			list.append(wrapper);

			var heightHtml = wrapper2.outerHeight(true);
			$("#" + p.id ).parents('.meetingPointWrapper').first().css("min-height",heightHtml);
			wrapper.height($("#" + p.id ).parents('.meetingPointWrapper').first().height());
			$("#input").css("padding-top", 70);
			$("#output").css("padding-top", 30);

		}
	};
};
