class Validator {
	static validate(event) {
		var target = $(event.currentTarget).parents(".meetingPointContainer").first();
		Validator.validateMeetingPoint(target);
	}

	static validateMeetingPoint(target) {
		var type = $(target).data("type");
		if(type == "vb") {
			
			var errorMessage = Validator.vb($(target).find("textarea").first().val());
			var errorFieldName = "#" + $(target).attr("id") + "_error";
			if(errorMessage) {
				$(errorFieldName).text(errorMessage);
			} else {
				$(errorFieldName).text("");
			}
		} else {
			console.error("todo: write validation function for " + type);
		}
	}

	static vb(text) {
		//if(text.indexOf("ingenting") >= 0) {
		if(text == "ingenting") {
			return "Ni måste göra något";
		}
		
		if(text.length <= 30) {
			return "Verksamhetsberättelsen är för kort";
		}
		return null;
	}
	
}