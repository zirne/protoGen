<?php //Meeting.php
class Meeting {
	public $id;
	public $text;
	public $title;
	public $enabled;
	public $editable;
	public $created;
	public $edited;
	
	public function __construct($data = null) {
		if (is_array($data)) {
			if (isset($data['id'])) {
				$this->id = $data['id'];
			}
			$this->text = $data['text'];
			$this->title = $data['title'];
			$this->enabled = $data['enabled'];
			$this->editable = $data['editable'];
			$this->created = $data['created'];
			$this->edited = $data['edited'];
		}
	}

}