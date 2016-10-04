<?php
class FileRepository
{
	private $db;
	public function __construct() {
		global $dbconnection;
		$this->db = $dbconnection;
	}

	public function upload($file){

		//Check if $id is set
		if ($file->id === null)
		{
			//write to new row in db
			$query = "INSERT INTO tbl_attachments(name,type,data,meetingID,size,created,edited,deleted) VALUES(:name,:type,:data,:meetingID,:size,NOW(),NOW(),0)";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(':name', $file->name, PDO::PARAM_INT);
			$stmt->bindParam(':type', $file->type, PDO::PARAM_INT);
			$stmt->bindParam(':data', $file->data, PDO::PARAM_LOB);
			$stmt->bindParam(':meetingID', $file->meetingID, PDO::PARAM_INT);
			$stmt->bindParam(':size', $file->size, PDO::PARAM_INT);

			$stmt->execute();
			if (!$stmt->rowCount())
			{
				throw new Exception("No rows were updated");
			}
			$id = $this->db->lastInsertId();
			return $this->download($id);
		}
		else
		{//update existing row
			if (empty($file->id) OR $file->id === 0)
			{
				throw new Exception("id must be an integer");
			}
			else
			{//actually update
				$query = "UPDATE tbl_attachments SET name= :name, type = :type, data = :data, meetingID = :meetingID, size = :size, edited = NOW()) WHERE id = :id";
				$stmt = $this->db->prepare($query);
				$stmt->bindParam(':id', $file->id, PDO::PARAM_INT);
				$stmt->bindParam(':name', $file->name, PDO::PARAM_INT);
				$stmt->bindParam(':type', $file->type, PDO::PARAM_INT);
				$stmt->bindParam(':data', $file->data, PDO::PARAM_LOB);
				$stmt->bindParam(':meetingID', $file->meetingID, PDO::PARAM_INT);
				$stmt->bindParam(':size', $file->size, PDO::PARAM_INT);

				$stmt->execute();
				if (!$stmt->rowCount()){
					throw new Exception("No rows were updated");
				}
				$id = $file->id;
				$ordern =  $this->download($id);
				return $ordern;
			}
		}
	}

	public function download($id){
		if (empty($id) OR $id === 0)
		{
			throw new Exception("invalid argument");
		}
		else
		{//load from db
			$query = "SELECT * FROM tbl_attachments WHERE id=:theId";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(':theId', $id, PDO::PARAM_INT);
			$stmt->execute();

			if (!$stmt->rowCount())
			{
				throw new Exception("Nothing to load!");
			}
			else
			{
				$stmt->setFetchMode(PDO::FETCH_CLASS, 'File');
				//return $stmt->fetchAll();
				return $stmt->fetch();
			}
		}
	}

	public function loadAllFiles(){
		$query = "SELECT * FROM tbl_attachments";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		if (!$stmt->rowCount())
			{
				throw new Exception("Nothing to load!");
			}
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'File');
		return $stmt->fetchAll();
	}
}
