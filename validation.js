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
			
		} else if(type == "meetingOpen") {
			var errorMessage = Validator.meetingOpen($(target).find(".meetingOpener").first().val(), $(target).find(".meetingOpenTime").first().val() );
			var errorFieldName = "#" + $(target).attr("id") + "_error";
			if(errorMessage) {
				$(errorFieldName).text(errorMessage);
			} else {
				$(errorFieldName).text("");
			}			
		} else if(type == "customQuestion") {
			var errorMessage = Validator.customQuestion( );
			var errorFieldName = "#" + $(target).attr("id") + "_error";
			if(errorMessage) {
				$(errorFieldName).text(errorMessage);
			} else {
				$(errorFieldName).text("");
			}			
			
		} else {
			console.info("todo: write validation function for " + type);
		}
	}

	static meetingOpen(who, time) {
		
		if(who == "") {
			return "Någon måste öppna";
		}

		if(time == "") {
			return "Ni måste öppna nån gång";
		}
		
		return null;
	}
	
	static customQuestion() {
		console.info("todo custom question validator");
		
		return null;
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