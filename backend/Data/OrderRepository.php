<?php
class OrderRepository
{
	private $db;
	public function __construct() {
		global $dbconnection;
		$this->db = $dbconnection;
	}

	public function save($json, $id = NULL){
		$json = utf8_encode_if_needed($json);
		//Check if $id is set
		if ($id===null)
		{
			//write to new row in db
			try
			{
				$this->db->beginTransaction();
				$query = "INSERT INTO tbl_meeting(text,title,enabled,editable) VALUES(:json,:title,1,1)";
				$stmt = $this->db->prepare($query);
				$stmt->bindParam(':json', $json, PDO::PARAM_INT);
				$stmt->bindParam(':title', $json, PDO::PARAM_INT);
				$stmt->execute();
				$this->db->commit();
				if (!$stmt->rowCount())
				{
					trigger_error("No rows were updated");
				}
			} 
			catch(PDOException $ex) 
			{
			    //Something went wrong rollback!
			    $this->db->rollBack();
    			echo $ex->getMessage();
			}
		} 
		else 
		{//update existing row
			if (empty($id) OR $id === 0 OR is_int($id) === false)
			{
				trigger_error("id must be an integer");
			}
			else 
			{//actually update
				try 
				{
					$this->db->beginTransaction();
					$stmt = $db->prepare("UPDATE tbl_meeting SET text=? WHERE id=?");
					$stmt->execute(array($json, $id));
					$this->db->commit();
					if (!$stmt->rowCount()){
						trigger_error("No rows were updated");
					}
				} 
				catch(PDOException $ex) 
				{
			    	//Something went wrong rollback!
			    	$this->db->rollBack();
    				echo $ex->getMessage();
				}
			}		
		}
	}
		
	public function load($id){
		if (empty($id) OR $id === 0 OR is_int($id) === false) 
		{
			trigger_error("invalid argument");	
		} 
		else 
		{//load from db
			try 
			{
				$this->db->beginTransaction();
				$query = "SELECT text FROM tbl_meeting WHERE id=:theId";
				$stmt = $this->db->prepare($query);
				$stmt->bindParam(':theId', $id, PDO::PARAM_INT);
				$stmt->execute();
				$this->db->commit();
				$result = $stmt->fetchAll(PDO::FETCH_NUM);
				
				if (!$stmt->rowCount())
				{
					trigger_error("Nothing to load!");
				}
				else 
				{
					return $result;//($result[0][0]);
				}
			} 
			catch(PDOException $ex) 
			{
				$this->db->rollBack();
				echo $ex->getMessage();
			}
		}
	}
}