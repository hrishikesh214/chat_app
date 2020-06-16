<?php require_once getFullPath('header'); require_once getFullPath('cl');?>
<title>Chat | <?=$_SESSION['user']['username'] ?></title>

<script type="text/javascript">let to_const = 0;</script>

<style type="text/css">
	#msgContent{
		max-height: 60vh;
		overflow-y: scroll;
	}
</style>

<div class="px-4">
	<div class="row mt-5">
		<div class="col-lg-6 p-2 rounded offset-lg-3 border border-dark h3">
			<center><strong><?=getChatUsername(getParams())?></strong></center>
		</div>
	</div>
	<div class="row mt-2">
		<div id="msgContent" class="col-lg-6 p-3 offset-lg-3">
			<center id="msgLoading"><span id="msgLoading" class="alert alert-info text-purple-2">Loading...</span></center>
		</div>
	</div>
	<div class="fixed-bottom px-1 pb-5 pt-3 row">
		<div class="input-group col-lg-6 offset-lg-3">
			<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1">Msg</span>
			</div>
			<input id="msgF" type="text" id="search" class="form-control" placeholder="Message" aria-label="Username" aria-describedby="basic-addon1">
			<button id="msgSend" class="btn btn-outline-success ml-1">Send</button>
		</div>
	</div>
</div>

<div style="display:none" id="hidden"></div>

<script type="text/javascript">
	$(document).ready(function(){
		let UR = '<?=base_url('Modules/msg_loader/'.getParams())?>';
		$('#msgContent').load('<?=base_url('Modules/msg_loader/'.getParams())?>');
		$(document).ajaxComplete(function(){
			$('#msgContent').scrollTop($('#msgContent').prop('scrollHeight'));
		});
		$('#msgSend').click(function(){
			let msg = $('#msgF').val();
			$.ajax({
				url: '<?=base_url('send_msg/'.getParams())?>',
				type:'post',
				data:'msg='+msg,
				success: function(response){
					$('#msgContent').load(UR);
					$('#msgF').val('');
					console.log(response);
					$(document).ajaxComplete(function(){
						$('#msgContent').scrollTop($('#msgContent').prop('scrollHeight'));
					});
				}
			});
		});
		
		setInterval(function(){
			$.ajax({
				url: '<?=base_url('Modules/check_to_refresh')?>',
				success: function(r){
					$('#hidden').html(r);
					if(to_const == "1"){
						$('#msgContent').load(UR);
						$(document).ajaxComplete(function(){
							$('#msgContent').scrollTop($('#msgContent').prop('scrollHeight'));
						});
						to_const = 0;
					}
				}
			});
		},1000);

	});
</script>