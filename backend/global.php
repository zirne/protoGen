<?php
if(!function_exists('classAutoLoader')){
	function classAutoLoader($class){
		if(!class_exists($class)) {
			$classname = explode('\\', $class);
			$classname = $classname[count($classname) - 1];
			$classFile =  __DIR__ . '/Data/'.$classname.'.php';
			if(is_file($classFile)) {
				include $classFile;
			} else {
				$classFile=  __DIR__ . '/Classes/'.$classname.'.php';
				if(is_file($classFile)) {
					include $classFile;
				} else {
					$classFile =  __DIR__ . '/Handlers/'.$classname.'.php';
					if(is_file($classFile)) {
						include $classFile;
					} 
				}
			}
		}
	}
}

if(!function_exists('utf8_encode_if_needed')) {
	function utf8_encode_if_needed($text){
		$test = @json_encode($text);
		if($test == "null" || $test === false) {
			$res = utf8_encode($text);
			return $res;
		}
		return $text;
	}
}

spl_autoload_register('classAutoLoader');
require_once( __DIR__ . '/settings.php');
$settings = new Settings();
global $dbconnection;
$dbconnection = new Database($settings);