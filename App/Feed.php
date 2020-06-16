<?php include_once getFullPath('header'); $now_page = 'feed'; include_once getFullPath('cl'); ?>
<title>Feed | <?=$_SESSION['user']['username'] ?></title>
<?php send_refresh(); ?>
<script type="text/javascript">let to_const = 0;</script>

<div class="px-1">
	<div class="row mt-5">
		<div class="col-lg-6 offset-lg-3 px-1" id="chat_here">
			<center id="chatLoading"><span class="alert alert-primary text-purple-2" id="chatLoading">Loading...</span></center>
		</div>
	</div>
</div>

<div style="display:none" id="hidden"></div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#chat_here").load("<?=base_url('Modules/chat_loader')?>");

		setInterval(function(){
			$.ajax({
				url: '<?=base_url('Modules/check_to_refresh')?>',
				success: function(r){
					$('#hidden').html(r);
					if(to_const == "1"){
						$("#chat_here").load("<?=base_url('Modules/chat_loader')?>");
						to_const = 0;
					}
				}
			});
		},1000);
	});
</script>

