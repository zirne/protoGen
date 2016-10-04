<?php
class File {
	public $id;
	public $name;
	public $type;
	public $data;
	public $meetingID;
	public $size;
	public $created;
	public $edited;

	public function __construct($data = null) {
		if (is_array($data)) {
			if (isset($data['id'])) {
				$this->id = $data['id'];
			}
			$this->name = $data['name'];
			$this->type = $data['type'];
			$this->data = $data['data'];
			$this->meetingID = $data['meetingID'];
			$this->created = $data['created'];
			$this->edited = $data['edited'];
		}
	}
}
