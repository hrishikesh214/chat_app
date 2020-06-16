<?php 
require getFullPath('cl');
 if( ! checkLogin() ){redirect(base_url());} 

$db->where(array('userid'=>$_SESSION['user']['id']));
$db->update('logs',array('status'=>0));
send_refresh();
unset($_SESSION['user']);

redirect(base_url());
 ?>