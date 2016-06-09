<?php
class Load{
	public function handle($data){

		$repo = new OrderRepository();
		return $repo->load(3);
		//print_r($repo->load(1));
		//return "Hämtad data";
	} 


}
	//works
	//echo dbMan::load(8, $db);
	//echo dbMan::save("NY JSON BASERAD PÅ PDO PREPARE!", $db)
	//echo dbMan::save("NY JSON BASERAD PÅ PDO PREPARE!", $db, 3)
	//echo dbMan::save("JSOOOOOOOOOOOOOOON!", $db, 7);