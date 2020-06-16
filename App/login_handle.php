<?php 

$un = $_POST['username'];
$pw = $_POST['password'];

$db->select('*');
$db->where(array('username'=>$un,'password'=>$pw));
$q = $db->get('logs');

if($q->num_rows>0){
	$data = $q->fetch_array(MYSQLI_ASSOC);

	$db->where(array('userid'=>$data['userid']));
	$status_update = $db->update('logs',array('status'=>1));

	$_SESSION['user']['id'] = $data['userid'];
	$_SESSION['user']['username'] = $data['username'];
	redirect(base_url('Feed'));
}else{
	$_SESSION['curr_msg']=array(
		'type'=>'danger',
		'msg' =>'Username And Password not matched!'
	);
	redirect(base_url());
}

?>