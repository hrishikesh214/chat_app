<?php 

require getFullPath('cl');

$reciever_id = getParams();

$nD = chat_add_handle($reciever_id);

if($nD['type']){
	redirect(base_url('Chat/'.$nD['chatid']));
}
else{
	$aq = $db->query("INSERT INTO `chats`(`chatid`, `userid1`, `userid2`, `lastMsg`, `time`, `rS1`, `rS2`) VALUES ('{$nD['chatid']}', '{$_SESSION['user']['id']}', '{$reciever_id}', '', null, 0, 0)") or die("fail");

	redirect(base_url('Chat/'.$nD['chatid']));
}

 ?>