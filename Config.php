<?php 
// User should not access this file directly

defined('BASE_PATH') or exit('ERROR: NO DIRECT SCRIPT ALLOWED!');

// error reporting true for on and false for off

$ERROR_REPORTING = true; 

// domain of website http(s)://example.com

$BASE_URL = 'http://localhost/chatapp/'; 

// lets set database !

$DATABASE = array(
	'status'   => true, // false if no need to connect to DB
	'hostname' => 'localhost', // HostName of DataBase 
	'username' => 'root', // UserName of DataBase
	'password' => '', // Password for DataBase
	'dbname'   => 'newchat' // Name of DataBase
); 

// This is the landing page of your Application

$DEFAULT = 'Login'; 


?>
