function Jesus() {
	
	var saveTimeout = null;
	var htmlTimeout = null;
	var that = this;
	
	this.saveOrder = function(json) {
		var oldList = json.meetingPoints;
		json.meetingPoints = [];
		$("#input p").each(function(id, el) {
			var currentId = $(el).find('div').attr('id');
			for(var i in oldList) {
				if(oldList[i]['id'] == currentId) {
					json.meetingPoints.push(oldList[i]);
				}
			}
		});
		HtmlGenerator.generateHtml(json);
		that.saveAll(json);
	}

	this.pointChanged = function(event, json) {
		var target = $(event.currentTarget).parents(".meetingPointContainer").first();
		var type = $(target).data('type');

		for(var i in json.meetingPoints) {
			var p = json.meetingPoints[i];	
			if(p.id == $(target).attr('id')) {
				if(type == "vb") {
					json.meetingPoints[i].data = vb(json.meetingPoints[i].data, target);
				}else if(type == "meetingOpen") {
					json.meetingPoints[i].data = meetingOpen(json.meetingPoints[i].data, target);
				}else if(type == "customQuestion") {
					json.meetingPoints[i].data = customQuestion(json.meetingPoints[i].data, target);
										
				} else {
					console.info("Todo: Write save function for " + type);
				}
				
				if(!htmlTimeout) {
					htmlTimeout = setTimeout(function() {
						HtmlGenerator.generateHtml(json);
						htmlTimeout = null;
					}, 200);
				}
				that.saveAll(json);
				return true;
			}
		}
	}

	this.saveAll = function(json) {
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
	}
	
	var vb = function(data, target) {
		data.text = $(target).find('textarea').first().val();
		return data;
	}
	
	var meetingOpen = function(data, target) {
		data.meetingOpenTime = $(target).find('input.meetingOpenTime').first().val();
		data.meetingOpener = $(target).find('input.meetingOpener').first().val();	
		return data;
	}
	
	var customQuestion = function(data, target) {
		data.title = $(target).find('input.title').first().val();
		data.text = $(target).find('input.text').first().val();	
		data.beslut = $(target).find('input.beslut').first().val();	
		return data;
	}
}