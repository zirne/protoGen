<?php
class Save{
	public function handle($data){
		$repo = new OrderRepository();
		$repo->save('En teststräng');
		return "OK";
		//return "Sparad data";
	} 


}