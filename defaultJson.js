window.originalJson = {
	orgType: 123,
	orgName: "Ung Pirat Hästpolololololo",
	meetingTitle: "Ung Pirat Hästpolololololo årsmöte ej hårdkodat 2016",
	meetingPoints: [
		{
			id: "meetingOpens",
			type: "meetingOpen",
			title: "Mötets öppnande",
			datatype: "json",
			data: {
				meetingOpener: "mlg",
				meetingOpenTime: "2016-01-03 12:34:56"
			}
		},
		{
			id: "meetingOpena",
			type: "meetingOpen",
			title: "Mötets andra öppnande",
			datatype: "json",
			data: {
				meetingOpener: "mlg",
				meetingOpenTime: "2016-01-03 12:34:56"
			}
		},
		{
			id: "meetingOpen",
			type: "meetingOpen",
			title: "Mötets tredje öppnande",
			datatype: "json",
			data: {
				meetingOpener: "din mamma",
				meetingOpenTime: "2017-01-03 12:34:56"
			}
		},
		{
			id: "vb",         // vilken specifik punkt det är
			type: "vb",     // vilken typ av fråga det är
			title: "Verksamhetsberättelse för föregående år",
			datatype: "text",
			data: {
				text: "Hej, jag är en hästpool"
			}
		}
	]
};
