<?php
class Save{
	public function handle($data){
		$repo = new MeetingRepository();
		$meeting = null;

		if(isset($data['meetingID'])){
			$meeting = $repo->load($data['meetingID']);
			if($meeting->enabled == 0 OR $meeting->editable == 0){
				throw new Exception("Detta dokument är låst av förbundssekreteraren, kontakta hen på 0707-55 93 92 eller sekreterare@ungpirat.se");
			}
		} else {
			$meeting = new Meeting();
			$meeting->enabled = 1;
			$meeting->editable = 1;
		}

		$meeting->text = json_encode($data);
		$meeting->title = $data['meetingTitle'];
		$savedMeeting = $repo->save($meeting);

		$json = json_decode($savedMeeting->text);
		$json->meetingID = $savedMeeting->id;
		$json->created = $savedMeeting->created;
		$json->edited = $savedMeeting->edited;
		$json->editable = $savedMeeting->editable;

		return $json;
	}
}
