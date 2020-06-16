<?php 
/*
*-----------------------------------------------------------------
*--- COME ON LET'S START ROUTING ---------------------------------
*-----------------------------------------------------------------
*
*	** First of all lets check That no one run this file directly ! 
*/
	defined('BASE_PATH') or exit('ERROR: NO DIRECT SCRIPT ALLOWED!');

/*
*-----------------------------------------------------------------
*
*	Now let's start Session ! 
*
*-----------------------------------------------------------------
*/
	session_start();
/*
*-----------------------------------------------------------------
*
*	Ok Now when we have started Session, lets get all require 
*	Variables and functions from Config and Library
*
*-----------------------------------------------------------------
*/
	require_once 'Config.php';
	require_once 'Library.php';
/*
*----------------------------------------------------------------
*
*	So lets set Error Reporting !
*	Here user will have two values
*		- true  : -1 will be passed so all errors will be shown
*		- false : 0 will be passed. No one wants their users to
*				  see unknown error, so just make it look better !
*
*----------------------------------------------------------------
*/
	error_reporting('-'.$ERROR_REPORTING);

/*
*----------------------------------------------------------------
*
*	Now we will put mysqli_report to catch basic errors !
*
*----------------------------------------------------------------
*/
	mysqli_report(MYSQLI_REPORT_STRICT);

/*
*----------------------------------------------------------------
*
*	Now let us get some fresh url request !
*
*----------------------------------------------------------------
*/

	$REQ_URL_RAW = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
/*
*----------------------------------------------------------------
*
*	Ok now when we have full url let us remove base url !
*	
*	But wait, before removing let's check if $BASE_URL in config
* 	File have '/' at last, if not add it !
*
*----------------------------------------------------------------
*/
	if( $BASE_URL == NULL or $BASE_URL == ''){
		exit('ERROR: Please Set $BASE_URL in Config.php !');
	}
	if( substr( $BASE_URL, -1 ) != '/'){
		$BASE_URL = $BASE_URL . '/';
	}

	$REQ_URL = isset($_GET['URL'])?$_GET['URL']:$DEFAULT;
/*
*-----------------------------------------------------------------
*
*	OK now we will set 404 throwing function so it will throw 404
*	error whenever needed !
*
*	Before defining a function we will always check if it exists !
*
*-----------------------------------------------------------------
*/
	if( ! function_exists('throw404')){
		function throw404($f,$p){
			$_SESSION['SEFN'] = $f;
			$_SESSION['SEPN'] = $p;
			include_once(BASE_PATH . '/error/404.php');
		}
	}
/*
*-----------------------------------------------------------------
*
*	WOW... Now its Intresting ! 
*	Lets start meshing with the precious load function !
*	Yes thats heart of this System !
*
*-----------------------------------------------------------------
*/
	if( ! function_exists( 'load' ) ){

		function load( $e ){
/*
*----------------------------------------------------------------
*
*	Yeah now we are in it! Let's get some variables from config 
*	file...
*
*----------------------------------------------------------------
*/
			global $DEFAULT;
			global $db;
/*
*----------------------------------------------------------------
*
*	Thats it, Now we will take a $file_path variable so that
*	if requested url has sub-directory we can add it here without
*	hampering BASE_PATH! 
*
*----------------------------------------------------------------
*/
			$file_path = BASE_PATH . '/';
/*
*----------------------------------------------------------------
*
*	Further lets explode the request to get array...
*	
*	First lets check if there is no request, then we will show our
*	landing page! Remember you can change it in Config.php
*
*----------------------------------------------------------------
*/
			$e = explode('/', $e);
			if(isset($e[0]) and $e[0]== ""){
				$e[0] = $DEFAULT;
			}
			$i = 0;
/*
*----------------------------------------------------------------
*	SO LETS GET THE FILE WITH NAME ONLY IT WILL SMOOTHIFY !
*----------------------------------------------------------------
*/
			$file_name = glob( $file_path.$e[$i].'*' );
			if( $file_name != NULL OR $file_name != array() ){
				$file_name = $file_name[0];
			}
/*
*----------------------------------------------------------------
*	LETS CHECK IF FOLDER OR A FILE EXISTS WITH REQUESTED NAME!
*----------------------------------------------------------------
*/		
			if( ! is_array($file_name) and ( file_exists( $file_name) or is_dir($file_path . $e[$i] ) ) ){
/*
*----------------------------------------------------------------
*	SO WE WILL ADD THE DIRECTORY FIRST TO $file_path IF THE NAME
*	IS DIRECTORY...
*----------------------------------------------------------------
*/
				while( true ){
					if( is_dir( $file_path . $e[$i] ) ){
						$file_path = $file_path . $e[$i] . '/';
						$i++;
						if(!isset($e[$i]) || $e[$i] == NULL){
							break;
						}
					}
					else{
						break;
					}		
				}
/*
*---------------------------------------------------------------
*	SO IF IT IS NOT DIRECTORY THEN SIMPLY INCLUDE THE FILE
* 	BUT WAIT LETS MAKE IT MORE SMOOTH, WE WILL CHECK IF PHP OR 
*	HTML FILE EXISTS ELSE DONE 
*---------------------------------------------------------------
*/
				if( isset( $e[$i] ) and ( $e[$i] != null || $e[$i] != "" ) ){
					$file_name = glob( $file_path.$e[$i].'.*' );
					if($file_name != NULL OR $file_name != array()){
						$file_name = $file_name[0];
					}

					if( ! is_array($file_name) and file_exists($file_name) ){
						include_once( $file_name );
					}
					else{
						throw404($e[$i], $file_path );
						exit();
					}
				}
				else{
					$file_name = glob( $file_path.'index.*' );
					if($file_name != NULL OR $file_name != array()){
						$file_name = $file_name[0];
					}

					if( ! is_array($file_name) and file_exists($file_name)){
						include_once($file_name);
					}
					else{
						throw404("index",$file_path);
						exit();
					}
				}	
			}
			else{
				throw404($e[$i],BASE_PATH);
				exit();
			}
			// print_r(get_included_files());
			// exit(0);

		}
	}
/*
*-----------------------------------------------------------------
*	OK LOAD FUNCTION IS COMPLETED HERE SO LETS INCLUDE CDN LINKS
*-----------------------------------------------------------------
*
*-----------------------------------------------------------------
*---- YAY THATS IT! LETS START THE JOURNEY! ----------------------
*-----------------------------------------------------------------
*/
	load($REQ_URL);
?>