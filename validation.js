function Validator() {
	this.validate = function(json) {
		for(var i in json.meetingPoints) {
			var p = json.meetingPoints[i];
			var output = "";

			if(typeof meetingPoints[p.type].validation == 'function') {
				p.error = meetingPoints[p.type].validation(p);
			} else {
				console.info("Todo: Write validation function for " + p.type);
			}
		}
	};
};
Validator.fullNameCheck = function(name) {
	var re = /\s/;
	if (re.exec(name) !== null) {
		return true;
	}	else {
		return false;
	}
};
