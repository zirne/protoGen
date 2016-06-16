<?php
class MeetingRepository
{
	private $db;
	public function __construct() {
		global $dbconnection;
		$this->db = $dbconnection;
	}

	public function save($meeting){
		
		//Check if $id is set
		if ($meeting->id===null)
		{
			//write to new row in db
			$query = "INSERT INTO tbl_meeting(text,title,enabled,editable,created,edited) VALUES(:json,:title,:enabled,:editable,NOW(),NOW())";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(':json', $meeting->text, PDO::PARAM_INT);
			$stmt->bindParam(':title', $meeting->title, PDO::PARAM_INT);
			$stmt->bindParam(':enabled', $meeting->enabled, PDO::PARAM_INT);
			$stmt->bindParam(':editable', $meeting->editable, PDO::PARAM_INT);

			$stmt->execute();
			if (!$stmt->rowCount())
			{
				throw new Exception("No rows were updated");
			}
			$id = $this->db->lastInsertId();
			return $this->load($id);
		} 
		else 
		{//update existing row
			if (empty($meeting->id) OR $meeting->id === 0 OR is_int($meeting->id) === false)
			{
				throw new Exception("id must be an integer");
			}
			else 
			{//actually update
				$query = "UPDATE tbl_meeting SET text = :text, title = :title, enabled = :enabled, editable = :editable, edited = NOW() WHERE id=:id";
				$stmt = $this->db->prepare($query);
				$stmt->bindParam(':id', $meeting->id, PDO::PARAM_INT);
				$stmt->bindParam(':text', $meeting->text, PDO::PARAM_INT);
				$stmt->bindParam(':title', $meeting->title, PDO::PARAM_INT);
				$stmt->bindParam(':enabled', $meeting->enabled, PDO::PARAM_INT);
				$stmt->bindParam(':editable', $meeting->editable, PDO::PARAM_INT);

				$stmt->execute();
				if (!$stmt->rowCount()){
					throw new Exception("No rows were updated");
				}
				$id = $meeting->id;
				$ordern =  $this->load($id);
				return $ordern;
			}		
		}
	}
		
	public function load($id){
		if (empty($id) OR $id === 0)// OR is_int($id) === false) 
		{
			throw new Exception("invalid argument");
		} 
		else 
		{//load from db
			$query = "SELECT * FROM tbl_meeting WHERE id=:theId";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(':theId', $id, PDO::PARAM_INT);
			$stmt->execute();
			
			
			if (!$stmt->rowCount())
			{
				throw new Exception("Nothing to load!");
			}
			else 
			{
				$stmt->setFetchMode(PDO::FETCH_CLASS, 'Meeting');
				//return $stmt->fetchAll();
				return $stmt->fetch();
			}
		}
	}
}