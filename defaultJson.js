window.originalArsmote = {
	orgType: 123,
	orgName: "Ung Pirat Hackerspace",
	meetingTitle: "Årsmöte för Hackerspace",
	meetingPoints: [
		{
			id: "meetingOpen",
			type: "meetingOpen",
			title: "Mötets öppnande",
			datatype: "json",
			data: {
				meetingOpener: "mlg",
				meetingOpenTime: "2016-01-03 12:34:56"
			}
		},
		{
			id: "vb",         // vilken specifik punkt det är
			type: "vb",     // vilken typ av fråga det är
			title: "Verksamhetsberättelse för föregående år",
			datatype: "text",
			data: {
				text: "Hej, vi hackar årsmötesprotokollsgenerator"
			}
		}
	]
};


window.newMeetingPoint = {
			type: "customQuestion",     // vilken typ av fråga det är
			datatype: "json",
			data: {
				title: "Skriv din titel här",
				text: "Skriv vad punken handlar om här",
				beslut: "Vad ni kommer fram till.",
			}
		}

window.originalStyrelsemote = {
	orgType: 123,
	orgName: "Ung Pirat Hackerspace",
	meetingTitle: "Styrelsemote för Hackerspace",
	meetingPoints: [
		{
			id: "meetingOpen",
			type: "meetingOpen",
			title: "Mötets öppnande",
			datatype: "json",
			data: {
				meetingOpener: "mlg",
				meetingOpenTime: "2016-01-03 12:34:56"
			}
		}
	]
};


window.originalKonstituerande = {
	orgType: 123,
	orgName: "Ung Pirat Hackerspace",
	meetingTitle: "Konstituerande Styrelsemote för Hackerspace",
	meetingPoints: [
		{
			id: "meetingOpen",
			type: "meetingOpen",
			title: "Mötets öppnande",
			datatype: "json",
			data: {
				meetingOpener: "mlg",
				meetingOpenTime: "2016-01-03 12:34:56"
			}
		}
	]
};
