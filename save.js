class Jesus {

	static saveToJson(event) {
		var target = $(event.currentTarget).parents(".meetingPointContainer").first()
		var type = $(target).data('type');

		for(var i in json.meetingPoints) {
			var p = json.meetingPoints[i];	
			if(p.id == $(target).attr('id')) {
				if(type == "vb") {
					json.meetingPoints[i].data = Jesus.vb(json.meetingPoints[i].data, target);
				}else if(type == "meetingOpen") {
					json.meetingPoints[i].data = Jesus.meetingOpen(json.meetingPoints[i].data, target);
					
				} else {
					console.error("Todo: Write save function for " + type);
				}
				HtmlGenerator.generateHtml(json);
				localStorage.setItem("json", JSON.stringify(json));
				return true;
			}
		}
	}
		
	static vb(data, target) {
		data.text = $(target).find('textarea').first().val();
		return data;
	}
	
	static meetingOpen(data, target) {
		data.meetingOpenTime = $(target).find('input.meetingOpenTime').first().val();
		data.meetingOpener = $(target).find('input.meetingOpener').first().val();	
		return data;
	}
}