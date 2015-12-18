<?php
/**
Author: Dennis Sesma
***/

/** Debugging**/

ini_set('display_errors',1);
error_reporting(E_ALL);


include "bootstrap.php";

//Start program
$obj = new main();



class main 
{
	public function __construct()
	{
		$router = new router;		
	}
}


