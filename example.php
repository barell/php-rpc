<?php

spl_autoload_register(function ($className) {
	$parts = explode('\\', $className);
	if ($parts[0] == 'JsonRpcServer') {
		$parts[0] = 'src';
    	$file = implode('/', $parts) . '.php';
    	
    	if (file_exists($file)) {
    		require $file;
    	}
    }
});

class ExampleService
{
	public function hello()
	{
		return 'Hello world!';
	}
}

use JsonRpcServer\Server;

$server = Server::createDefault();

$server->addMethod('hello', array('ExampleService', 'hello'));
$server->handle()->output();

// or return details about all handler callbacks
//$server->reflector()->getDetails();
