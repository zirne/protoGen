<?php
class Save{
	public function handle($data){
		$repo = new MeetingRepository();
		
		$meeting = new Meeting();
		$meeting->text = json_encode($data);
		$meeting->title = $data['meetingTitle'];
		$meeting->enabled = 1;
		$meeting->editable = 1;
		$meeting->id = 1;
		
		$savedMeeting = $repo->save($meeting);
		//print_r($savedMeeting);
		
		$json = json_decode($savedMeeting->text);
		$json->meetingID = $savedMeeting->id;
		$json->created = $savedMeeting->created;
		$json->edited = $savedMeeting->edited;
		$json->editable = $savedMeeting->editable;
		
		
		return $json;
		//return "Sparad data";
	} 


}