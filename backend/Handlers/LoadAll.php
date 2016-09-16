<?php //LoadAll
class LoadAll{
	public function handle(){
		$repo = new MeetingRepository();
		$meetings = $repo->loadAll();

		$loadedMeetings = array();

		foreach($meetings as $key => $value){
			if($value->enabled == 1){
				$meeting = array();
				$meeting['id'] = $value->id;
				$meeting['title'] = $value->title;
				$meeting['editable'] = $value->editable;

				$json = json_decode($value->text);
				$meeting['orgName'] = $json->orgName;

				$loadedMeetings[] = $meeting;// same as array_push
			}
		}

		return $loadedMeetings;
	}
}
