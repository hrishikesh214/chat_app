<?php 

/**
*------------------------------------------------------------------
*--- PLEASE READ FOLLOWING BEFORE USING ---------------------------
*------------------------------------------------------------------
*
*	* Do not change this file settings...
*		- Change in this setting may crash System files
*
*		- Routing may not work as usual
*
*-------------------------------------------------------------------
*
*	* Give Project Name in title element of Head tag
*
*		- <title> Project Name </title> of this file
*
*-------------------------------------------------------------------
*
*	* You can change some usual setting in config.php
*
*		- Base url 
*
*		- Database details
*			-- Wrong details may stop application to run!
*
*		- Bootstrap 
*
*		- JQuery
*
*		- Default 
*			-- This is the landing page of the website not neccesarily 
*			   index!
*
*---------------------------------------------------------------------
*
*	* Database Connections can be set in config file
*
*		- Hostname, username, password, dbname
*
*		- Status :
*			-- true : Will connect database 
*					( Warning : Can give error if details not set! )
*
*			-- false : Database will not connect
*
*----------------------------------------------------------------------
*
*	* Root folder is define under 'BASE_PATH' const here
*
*----------------------------------------------------------------------
*	* SAVE ALL FILES IN 'App' Directory
*
*		-Its neccesary that you save all project files in 'App'
*
*----------------------------------------------------------------------
*
*	* You Can make your own lirary functions in library file
*
*----------------------------------------------------------------------
*
*	* To include library add follwing :- 
*		<?php require 'library.php'; ?>
*
*----------------------------------------------------------------------
*
*	* For writing all links You should include library and use base_url()
*	  function. 
*	
*-----------------------------------------------------------------------
*---- CREDITS ----------------------------------------------------------
*-----------------------------------------------------------------------
*	
* 	@package	Procedural Routing via PHP
*	@author 	Hrishikesh Vaze
*	@var 		MITWPU 	Btech CSE 
* 	@var 		Location 	Gujarat, India
*	@link 		(http://creativeweb.comuf.com/)
*	@link 		(http://creatorking.comuf.com/) 
*	@version 	Version 1.2.0
*	@since 		Version 1.0.0
*
*----------------------------------------------------------------------
*---- APPLICATION ENVIRONMENT SETTINGS --------------------------------
*----------------------------------------------------------------------
*
*	First Lets set BASE PATH To Application !
*	This is the path of the folder where your application or website 
*	root files will be saved! don't need of any setting here in index
*	page. All your files should be save in App Folder here!
*
* If change the name by you then, NO TRAILING SLASH !
*/
	define('BASE_PATH', './App');

/*
*----------------------------------------------------------------------
*---- SYSTEM DIRECTORY NAME -------------------------------------------
*----------------------------------------------------------------------
*
*	Now lets set System directory !
* 	NO NEED TO CHANGE THIS DIRECTORY !
* 	This is the folder where all system files are saved. 
*
*/
	define('VERSION', '1.2.0');
/*
*---------------------------------------------------------------------
*---- SO NOW WE KNOW ALL REQUIRED CONFIG -----------------------------
*---- LETS GO AND SET SYSTEM PATH ------------------------------------
*---------------------------------------------------------------------
*
*/
	define('SYS_PATH', './System');
/*
*-----------------------------------------------------------------------
*---- ALL SETTINGS ARE DONE --------------------------------------------
*-----------------------------------------------------------------------
*---- LET'S CHECK IF SYSTEM DIRECTORY EXISTS ! -------------------------
*-----------------------------------------------------------------------
*
*/
	if( ! is_dir( SYS_PATH )){
		exit('ERROR: System directory Not found !');
	}
/*
*
*
*----------------------------------------------------------------------
*---- LET'S CHECK IF APPLICATION ROOT DIRECTORY EXISTS ! --------------
*----------------------------------------------------------------------
*
*/
	if( ! is_dir( BASE_PATH )){
		exit('ERROR: Application Root directory Not found !');
	}
/*
* 	ALL SET !
*-----------------------------------------------------------------------
*---- AWAY WE GO ! -----------------------------------------------------
*-----------------------------------------------------------------------
*
*/
	require_once SYS_PATH . '/Router.php';

 ?>