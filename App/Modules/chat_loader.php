<?php 

require getFullPath('cl');

$c_data = getChatList();
reset_refresh();

if( is_array($c_data) ){
	foreach ($c_data as $cd) {
		$to_id = ($cd['userid1'] == $_SESSION['user']['id'])?$cd['userid2']:$cd['userid1'];
		$rS = ($cd['userid1'] == $_SESSION['user']['id'])?$cd['rS1']:$cd['rS2'];
		$to_name = getUsername($to_id);
		$last_msg = $cd['lastMsg'];
		$last_msg = (strlen($last_msg) > 30) ? substr($last_msg,0,27).'...' : $last_msg;
		$last_time = $cd['time'];

		$rsx = ($rS != 0 )?'<span class="badge badge-warning">'.$rS.'</span>&nbsp':'&nbsp&nbsp&nbsp&nbsp&nbsp';

		$user_status = get_status($to_id);
		$status_color = ($user_status)?'success':'secondary';

		echo '
				<a style="color:black; text-decoration:none;" href="'.base_url('Chat/'.$cd['chatid']).'"><div style="cursor:pointer" class="row my-2 p-2 chat-list-item border border-dark">
 					<span class="h6 col-sm-2 text-'.$status_color.'">'.$to_name .'</span>
 					<span class="col-sm-6"><b>|</b>&nbsp'.$last_msg.'</span>
 					<span class="col-sm-4">'.$rsx.'<b>|</b>&nbsp'.$last_time.'</span>
 				</div></a>
		';
	}
}
else{
	show_msg();
}


echo '
		<script type="text/javascript">
				$("#chatLoading").remove();
		</script>
';

 ?>

