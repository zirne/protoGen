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
