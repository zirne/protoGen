<?php
class ProtoGen {
	public function onMessage(){
		$payload = file_get_contents("php://input");
		$postdata = json_decode($payload, true);
	
		try{
			$result = null;
			switch ($_GET['do']) {
				case 'save':
					$result = (new Save())->handle($postdata);
					break;
				
				case 'load':
					$result = (new Load())->handle($postdata);
					break;

				default:
					# code...
					break;
			}

			$this->outputResult($result);
		}catch(Exception $e){

			$array = array();
			$array['error'] = $e->getMessage();
			$this->outputResult($array);
		}
	}
	private function outputResult($param){
		header('Content-Type: application/json');
		echo json_encode($param);
		exit;
	}

}