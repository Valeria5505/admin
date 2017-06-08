<?php

namespace Core;

class Application{


	protected $request;

	protected static $_instance;

	public static function getInstance()
	{ 
		if (self::$_instance === null)
		{ 
			self::$_instance = new self;
		} 
		return self::$_instance;
	}

	private  function __construct()
	{ 
		$this->request = new Request();
		
	}

	private function __clone()
	{ 
	}
	
	private function __wakeup()
	{
	}
	
	public function run(){
		$this->request->route();
	}
	
}