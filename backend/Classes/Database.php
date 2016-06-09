<?php
class Database extends PDO {
	public function __construct($settings) {
	
		parent::__construct(
			'mysql:host='.$settings->dbhostname.';port='.$settings->dbport.';dbname='.$settings->dbname, 
			$settings->dbusername, 
			$settings->dbpwd
		);
		
		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->setAttribute(PDO::ATTR_PERSISTENT, true);
		$this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}
}