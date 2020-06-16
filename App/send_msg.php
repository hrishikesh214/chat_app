<?php 

require getFullPath('cl');
$chatid= getParams();

$to_send = isset($_POST['msg'])?$_POST['msg']:null;

$reciever_rs = get_read_status($chatid);
$reciever_rs['rS'] = $reciever_rs['rS'] + 1;

$senderid = $_SESSION['user']['id'];
$msgid= getMsgId();
$to_username = getChatUserid(getParams());

if($to_send != null or $to_send != ''){
	$sq = $db->query("INSERT INTO `msgs` (`chatid`, `senderid`, `msgid`, `msg`, `time`) VALUES ('{$chatid}', '{$senderid}', '{$msgid}', '{$to_send}', NULL) ") or die("fail 1");

	$w = $db->query("UPDATE `logs` SET `to_refresh` = 1 WHERE `userid` = '{$to_username}'") or die("fail 2");

	if($reciever_rs['user']==1){
		$uq = $db->query("UPDATE `chats` SET `lastMsg` = '{$to_send}', `rS1` = '{$reciever_rs['rS']}' ,`time` = now() WHERE `chatid` = '{$chatid}'") or die("fail 3 ");
	}
	else{
		$uq = $db->query("UPDATE `chats` SET `lastMsg` = '{$to_send}', `rS2` = '{$reciever_rs['rS']}',`time` = now() WHERE `chatid` = '{$chatid}'") or die("fail 4 ");
	}

}

echo "done";
 ?>