<?php 
require_once 'Config.php';
require_once 'Database.php';
defined( 'BASE_PATH' ) or exit( 'ERROR: NO DIRECT SCRIPT ALLOWED!' );
mysqli_report( MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT );

$db = new Database();

if( ! function_exists( 'getParams' ) ){

	function getParams($n=2){
		if($n <= 1){
			return "Invalid Argument";
		}
		global $REQ_URL;
		$e = explode('/',$REQ_URL);
		if($e[count($e)-1] == ""){
			unset($e[count($e)-1]);
		}
		return isset($e[$n-1])?$e[$n-1]:"Parameter Not Found!";
	}

}

if( ! function_exists( 'redirect' ) ){

	function redirect($requested = ""){
		if($requested != NULL or $requested != ""){
			header('location: ' . $requested);
		}
		else{
			echo "Input not satisfied!";
		}
		
	}

}

if( ! function_exists( 'base_url' ) ){

	function base_url($ru=""){
		global $BASE_URL;
		$x = isset( $ru ) ? $ru : '' ; 
		return $BASE_URL  .$x;		
	}

}

if( ! function_exists( 'debug' ) ){

	function debug($variable){
		echo "<pre>";
		print_r( $variable );
	}

}

if( ! function_exists( 'getFullPath' ) ){

	function getFullPath( $e ){
		global $DEFAULT;
		global $db;
		$file_path = BASE_PATH . '/';
		$e = explode('/', $e);
		if( isset($e[0]) and $e[0]== "" ){
			$e[0] = $DEFAULT;
		}
		$i = 0;
		
		$file_name = glob( $file_path.$e[$i].'*' );
		if( $file_name != NULL OR $file_name != array() ){
			$file_name = $file_name[0];
		}

		if( ! is_array( $file_name ) and ( file_exists( $file_name ) or is_dir( $file_path . $e[$i] ) ) ){
			while(true){
				if(is_dir($file_path . $e[$i])){
					$file_path = $file_path . $e[$i] . '/';
					$i++;
					if( ! isset($e[$i]) || $e[$i] == NULL ){
						break;
					}
				}
				else{
					break;
				}		
			}

			if( isset( $e[$i] ) and ( $e[$i] != null || $e[$i] != "" ) ){
				$file_name = glob( $file_path.$e[$i].'.*' );
				if($file_name != NULL OR $file_name != array()){
					$file_name = $file_name[0];
				}

				if( ! is_array( $file_name ) and file_exists( $file_name ) ){
					return ( $file_name );
				}
				else{
					exit( 'Error : Following Path Not Exists!<br>' . $e[$i] . ' in Path ' . $file_path );
				}
			}
			else{
				$file_name = glob( $file_path.'index.*' );
				if( $file_name != NULL OR $file_name != array() ){
					$file_name = $file_name[0];
				}

				if( ! is_array( $file_name ) and file_exists( $file_name ) ){
					return ($file_name);
				}
				else{
					exit('Error : Following Path Not Exists!<br>' . $e[$i] . ' in Path ' . $file_path );
				}
			}	
		}
		else{
			exit( 'Error : Following Path Not Exists!<br>' . $e[$i] . ' in Path ' . $file_path );
		}

	}
}

?>