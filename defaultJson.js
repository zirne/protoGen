var meetingPoints =  {
	meetingOpen : {
		type: "meetingOpen",
		title: "Mötets öppnande",
		data: {
			meetingOpener: "mlg",
			meetingOpenTime: "2016-01-03 12:34:56"
		},
		html : function(p) {
			var html = $("<div>");
			$("<h2>").text(p.title).appendTo(html);
			$("<p>").text( p.data.meetingOpener + " öppnade mötet klockan " + p.data.meetingOpenTime ).appendTo(html);
			return html;
		},
		form : function(p) {
			var html = $("<div>");
			$("<h2>").text(p.title).appendTo(html);
			var form = $("<form>").appendTo(html);
			$("<span>").text("Mötets öppnare: ").appendTo(form);
			$("<input>").val(p.data.meetingOpener).addClass("validatorField").addClass("meetingOpener").appendTo(form);
			$("<br>").appendTo(form);

			$("<span>").text("Öppnat klockan: ").appendTo(form);
			$("<input>").val(p.data.meetingOpenTime).addClass("validatorField").addClass("meetingOpenTime").appendTo(form);

			return html;
		},
		validation: function(p) {
			if(p.data.meetingOpener == "") {
				return "Någon måste öppna";
			}

			if(p.data.meetingOpenTime == "") {
				return "Ni måste öppna nån gång";
			}

			return null;
		},
		save : function(p, target) {
			p.data.meetingOpenTime = $(target).find('input.meetingOpenTime').first().val();
			p.data.meetingOpener = $(target).find('input.meetingOpener').first().val();
			return p;
		}
	},
	vb: {
		type: "vb",
		title: "Verksamhetsberättelse för föregående år",
		data: {
			text: "Hej, vi hackar årsmötesprotokollsgenerator"
		},
		html : function(p) {
			var html = $("<div>");
			$("<h2>").text(p.title).appendTo(html);
			$("<p>").text( p.data.text ).appendTo(html);
			return html;
		},
		form : function(p) {
			var html = $("<div>");
			$("<h2>").text(p.title).appendTo(html);
			$("<textarea>").text(p.data.text).addClass("validatorField").appendTo(html);
			return html;
		},
		validation: function(p) {
			if(p.data.text == "ingenting") {
				return "Ni måste göra något";
			}

			if(p.data.text.length <= 30) {
				return "Verksamhetsberättelsen är för kort";
			}
			return null;
		},
		save : function(p, target) {
			p.data.text = $(target).find('textarea').first().val();
			return p;
		}
	},
	customQuestion : {
		type: "customQuestion",
		data: {
			title: "Fråga om glass",
			text: "Glass är gott. Vi bör äta glass på alla möten.",
			beslut: "vi ska köpa 5 liter glass till nästa möte.",
		},
		html : function(p) {
			var html = $("<div>");
			$("<h2>").text(p.data.title).appendTo(html);
			$("<p>").text( p.data.text ).appendTo(html);

			var beslut = $("<p>");
			$("<h4>").text("Beslut").appendTo(beslut);
			$('<strong>').text('att ').appendTo(beslut);
			beslut.append( p.data.beslut ).appendTo(html);

			return html;
		},
		form : function(p) {
			var html = $("<div>");
			var form = $("<form>").appendTo(html);

			$("<span>").text("Frågans titel: ").appendTo(form);
			$("<input>").val(p.data.title).addClass("validatorField").addClass("title").appendTo(form);
			$("<br>").appendTo(form);

			$("<span>").text("Brödtext: ").appendTo(form);
			$("<input>").val(p.data.text).addClass("validatorField").addClass("text").appendTo(form);
			$("<br>").appendTo(form);

			$("<span>").text("Beslut: ").appendTo(form);
			$("<input>").val(p.data.beslut).addClass("validatorField").addClass("beslut").appendTo(form);

			return html;
		},
		validation: function(p) {
			if(p.data.title.length <= 5) {
				return "Ni måste skriva titel";
			}
			if(p.data.text.length <= 5) {
				return "Ni måste skriva brödtext";
			}
			if(p.data.beslut.length <= 5) {
				return "Ni måste skriva beslut";
			}
			return null;
		},
		save : function(p, target) {
			p.data.title = $(target).find('input.title').first().val();
			p.data.text = $(target).find('input.text').first().val();
			p.data.beslut = $(target).find('input.beslut').first().val();
			return p;
		}
	}
};

window.originalArsmote = {
	orgName: "Ung Pirat Hackerspace",
	meetingTitle: "Årsmöte för Hackerspace",
	meetingPoints: [
		ProtoGen.copyPoint(meetingPoints.meetingOpen),
		ProtoGen.copyPoint(meetingPoints.vb)
	]
};


window.originalStyrelsemote = {
	orgName: "Ung Pirat Hackerspace",
	meetingTitle: "Styrelsemote för Hackerspace",
	meetingPoints: [
		ProtoGen.copyPoint(meetingPoints.meetingOpen)
	]
};


window.originalKonstituerande = {
	orgName: "Ung Pirat Hackerspace",
	meetingTitle: "Konstituerande Styrelsemote för Hackerspace",
	meetingPoints: [
		ProtoGen.copyPoint(meetingPoints.meetingOpen),
		ProtoGen.copyPoint(meetingPoints.vb)
	]
};
