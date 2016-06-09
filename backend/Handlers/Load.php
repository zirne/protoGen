<?php
class Load{
	public function handle($data){
		$id = $data['id'];
		$repo = new MeetingRepository();
		$savedMeeting = $repo->load($id);
		
		$json = json_decode($savedMeeting->text);
		$json->meetingID = $savedMeeting->id;
		$json->created = $savedMeeting->created;
		$json->edited = $savedMeeting->edited;
		$json->editable = $savedMeeting->editable;

		return $json;
	} 
}