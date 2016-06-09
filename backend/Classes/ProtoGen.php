<?php
class ProtoGen {
	public function onMessage(){
		$result = null;
		switch ($_GET['do']) {
			case 'save':
				$result = (new Save())->handle($_POST);
				break;
			
			case 'load':
				$result = (new Load())->handle($_POST);
				break;

			default:
				# code...
				break;
		}

		$this->outputResult($result);
	}
	private function outputResult($param){
		header('Content-Type: application/json');
		echo json_encode($param);
		exit;
	}

}