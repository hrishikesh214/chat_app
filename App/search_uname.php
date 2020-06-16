<?php 

$suname = getParams();
$suname =  ($suname=='Parameter Not Found!')?'':$suname;

global $db;

if($suname != NULL OR $suname != ''){
	$sq = $db->query("SELECT userid, username FROM `logs` WHERE username LIKE '%{$suname}%'");

	if($sq->num_rows>0){
		$sData = $sq->fetch_all(MYSQLI_ASSOC);
		foreach ($sData as $xs) {
			echo '
				<a href="'.base_url('chat_add/'.$xs['userid']).'" style="text-decoration:none; color:black;"><div class="container border mb-3 searched border-dark rounded p-2">
					<span class="text-dark h3">'.$xs['username'].'</span>
				</div></a>
			';
		}
	}
	else{
		echo '<span class="alert alert-warning text-purple-2">No Username Found!</span>';
	}
}
echo '
		<script type="text/javascript">
				$("#searchLoading").remove();
		</script>
';
?>