function Jesus() {

	var saveTimeout = null;
	var that = this;

	this.pointChanged = function(event, json) {
		var target = $(event.currentTarget).parents(".meetingPointContainer").first();
		var type = $(target).data('type');

		for(var i in json.meetingPoints) {
			var p = json.meetingPoints[i];
			if(p.id == $(target).attr('id')) {

				if(typeof meetingPoints[p.type].save == 'function') {
					json.meetingPoints[i] = meetingPoints[p.type].save(json.meetingPoints[i], target);
				} else {
					console.info("Todo: Write save function for " + p.type);
				}
				that.sendSaveRequest(json);
				return true;
			}
		}
	};

	this.sendSaveRequest = function(json) {
		if(!saveTimeout) {
			saveTimeout = setTimeout(function() {
				$.ajax({
					url: "backend/index.php?do=save",
					contentType: "application/json",
					method: "POST",
					data: JSON.stringify(json)
				}).done(function(data) {
					if(data.error) {
						alert(data.error);
					} else {
						json.meetingID = data.meetingID;
					}
				}).error(function(data) {
					alert("Kunde inte spara");
				});
				saveTimeout = null;
			}, 2000);
		}
	};
};
