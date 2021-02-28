<?php

spl_autoload_register('autoload');

function autoload($className){
	
	$ext = '.class.php';
	$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	if(strpos($url,'includes') == true){
		
		$classPath = '../classes/';
		$contrPath = '../classes/controller/';
		$modelPath = '../classes/model/';
	}
	else{
		$classPath = 'classes/';
		$contrPath = 'classes/controller/';
		$modelPath = 'classes/model/';
	}
	
	if(!file_exists($classPath.$className.$ext)){
		if(file_exists($contrPath.$className.$ext)){
	
			require_once $contrPath.$className.$ext;
		}
		else{
			require_once $modelPath.$className.$ext;
		}
	}
	else{
		require_once $classPath.$className.$ext;
	}
}