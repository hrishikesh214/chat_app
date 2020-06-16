<?php 

require getFullPath('cl');

$chat_data = getChats(getParams(3)); 

reset_refresh();
reset_read_status(getParams(3));

echo "<table class='table table-striped table-hover'>";

if($chat_data):
foreach ($chat_data as $md):
	$sender_name = getUsername($md['senderid']);
?>	

	<tr>
		<td><strong><?=$sender_name?></strong></td>
		<td><?=$md['msg']?></td>
	</tr>

<?php endforeach; endif;
if(! $chat_data) { show_msg(); }
echo "</table>";
echo '
	<script type="text/javascript">
 		$("#msgLoading").remove();
 	</script>
';

 ?>
