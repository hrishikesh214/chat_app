<?php 
function getChatList(){
	global $db;
	$f_userid = $_SESSION['user']['id'];
	$fq = $db->query("SELECT * FROM `chats` WHERE userid1 = '{$f_userid}' OR userid2 = '{$f_userid}' ORDER BY `time` DESC");
	if($fq->num_rows>0){
		$chatlist = $fq->fetch_all(MYSQLI_ASSOC);
		return ($chatlist);
	}
	else{
		$_SESSION['curr_msg'] = array(
			'type' => 'warning',
			'msg'  => 'No Chats! Go to search and start chatting now!'
		);
		return false;
	}
}

function show_msg(){
		if(isset($_SESSION['curr_msg'])){
			echo '<div class="container sticky-top alert alert-'.$_SESSION['curr_msg']['type'].'" 		role="alert">
				'.$_SESSION['curr_msg']['msg'].'
				</div>';
			unset($_SESSION['curr_msg']);
		}
}

function checkLogin(){
	if( isset($_SESSION['user']['id'])){
		return true;
	}
	else{
		return false;
	}
}

function getUsername($e){
	global $db;

	$db->select('username');
	$db->where(array('userid'=>$e));
	$q = $db->get('logs');

	if($q->num_rows>0){	
		$row = $q->fetch_array(MYSQLI_ASSOC);
		return $row['username'];
	}
	else{
		return false;
	}

}

function getChats($chatid){
	global $db;

	$db->select('*');
	$db->where(array('chatid'=>$chatid));
	$q = $db->get('msgs');

	if($q->num_rows>0){
		$msgs = $q->fetch_all(MYSQLI_ASSOC);
		return ($msgs);
	}
	else{
		$_SESSION['curr_msg'] = array(
			'type' => 'warning',
			'msg'  => 'No Msgs! Say Hi!'
		);
		return false;
	}
}
function getChatUsername($chatid){
	global $db;

	$db->select('userid1','userid2');
	$db->where(array('chatid'=>$chatid));
	$q = $db->get('chats');

	if($q->num_rows>0){	
		$row = $q->fetch_array(MYSQLI_ASSOC);
		$row = ($row['userid1']==$_SESSION['user']['id'])?$row['userid2']:$row['userid1'];
		return getUsername($row);
	}
	else{
		return false;
	}

}

function getChatUserid($chatid){
	global $db;

	$db->select('userid1','userid2');
	$db->where(array('chatid'=>$chatid));
	$q = $db->get('chats');

	if($q->num_rows>0){	
		$row = $q->fetch_array(MYSQLI_ASSOC);
		$row = ($row['userid1']==$_SESSION['user']['id'])?$row['userid2']:$row['userid1'];
		return $row;
	}
	else{
		return false;
	}

}

function getMsgId(){
	global $db;
	$id = rand();

	$db->select('msgid');
	$q = $db->get('msgs');

	foreach($q as $x){
		$x = $x['msgid'];
		if($id == $x){
			getMsgId();
		}
	}
	return $id;
}

function get_to_refresh(){
	global $db;

	$db->select('to_refresh');
	$db->where(array('userid'=>$_SESSION['user']['id']));
	$q = $db->get('logs')->fetch_array(MYSQLI_ASSOC);

	$q= $q['to_refresh'];
	return $q;
}

function reset_refresh(){
	global $db;

	$db->where(array('userid'=>$_SESSION['user']['id']));
	$q = $db->update('logs',array('to_refresh'=>0));

	return true;
}

function get_read_status($e){
	global $db;
	$db->select('userid1','rS1','rS2');
	$db->where(array('chatid'=>$e));
	$q = $db->get('chats');
	$x = ($q['userid1']==$_SESSION['user']['id'])?2:1;
	$q = array('rS'=> $q['rS'.$x], 'user' => $x);
	return $q;
}
function reset_read_status($e){
	global $db;

	$db->select('userid1');
	$db->where(array('chatid'=>$e));
	$q = $db->get('chats')->fetch_array(MYSQLI_ASSOC);

	$x = ($q['userid1']==$_SESSION['user']['id'])?1:2;
	if($x == 1){
		$q = $db->query("UPDATE `chats` SET `rS1` = 0 WHERE `chatid` = '{$e}' ");
	}
	else{
		$q = $db->query("UPDATE `chats` SET `rS2` = 0 WHERE `chatid` = '{$e}' ");
	}
}

function getChatId(){
	global $db;
	$id = rand();
	$db->select('*');
	$q = $db->get('chats')->fetch_all(MYSQLI_ASSOC);
	foreach($q as $x){
		$x = $x['chatid'];
		if($id == $x){
			getChatId();
		}
	}
	return $id;
}

function chat_add_handle($e){
	global $db;
	$myid = $_SESSION['user']['id'];
	$q = $db->query("SELECT `chatid` FROM `chats` WHERE (`userid1` = '{$myid}' AND `userid2` = '{$e}') OR (`userid1` = '{$e}' AND `userid2` = '{$myid}')");

	if($q->num_rows>0){
		return array('type'=>true, 'chatid'=>$q->fetch_array(MYSQLI_ASSOC)['chatid']);
	}
	else{
		return array('type'=>false, 'chatid'=>getChatId());
	}
}

function get_status($e){
	global $db;
	$db->select('status');
	$db->where(array('userid'=>$e));
	$q = $db->get('logs');
	return $q->fetch_array(MYSQLI_ASSOC)['status'];
}

function send_refresh(){
	global $db;
	$list = getChatList();
	if($list != null or $list != ''){
		foreach ($list as $item) {
		$un = getChatUserid($item['chatid']);
		$db->where(array('userid'=>$un));
		$uq = $db->update('logs',array('to_refresh'=>1));
		}
	}
	
}

function getNewUserId(){
	global $db;
	$id = rand();
	$db->select('userid');
	$q = $db->get('logs')->fetch_all(MYSQLI_ASSOC);
	foreach($q as $x){
		$x = $x['userid'];
		if($id == $x){
			getNewUserId();
		}
	}
	return $id;
}

 ?>