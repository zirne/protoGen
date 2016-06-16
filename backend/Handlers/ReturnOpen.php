<?php //ReturnOpen
class ReturnOpen{
	public function handle(){
		$repo = new MeetingRepository();
		$meetings = $repo->loadAll();

		$loadedMeetings = array();
		
		foreach($meetings as $key => $value){
			if($value->enabled === 1){
				$meeting = array();
				$meeting['id'] = $value->id;
				$meeting['title'] = $value->title;
				$meeting['editable'] = $value->editable;
				$loadedMeetings[] = $meeting;// same as array_push
			}
		}
		
		return $loadedMeetings;
	} 
}
