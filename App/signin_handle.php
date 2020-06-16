<?php 

if($_POST['password'] != $_POST['cPassword']){
	$_SESSION['curr_msg']=array(
		'type'=>'danger',
		'msg' =>'Password not matched with confirm password !'
	);
	redirect(base_url('Signin'));
}

require getFullPath('cl');

$userid = getNewUserId();
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$aq = $db->query("INSERT INTO `logs`(`userid`, `username`, `password`, `email`, `status`, `to_refresh`, `time`) VALUES ('{$userid}', '{$username}', '{$password}', '{$email}', 1, 0, null)");

$_SESSION['user']['id'] = $userid;
$_SESSION['user']['username'] = $username;
redirect(base_url('Feed'));

?>