<?php
class ProtoGen {
	public function onMessage(){
		if ($_GET['do'] !== "upload"){
			$payload = file_get_contents("php://input");
			$postdata = json_decode($payload, true);
		}

		try{
			$result = null;
			switch ($_GET['do']) {
				case 'save':
					$result = (new Save())->handle($postdata);
					break;

				case 'load':
					$result = (new Load())->handle($postdata);
					break;

				case 'loadAll':
					$result = (new LoadAll())->handle($postdata);
					break;

				case 'upload';
					$result = (new Upload())->handle($_FILES, $_POST);
					break;

				case 'download';
					$result = (new Download())->handle($_GET);
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
