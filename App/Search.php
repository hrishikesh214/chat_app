<?php require_once getFullPath('header'); $now_page = 'search'; ?>

<?php show_msg(); ?>
<title>Search</title>
<style type="text/css">
	.searched{
		cursor: pointer;
	}
</style>
<div class="row mt-5 mx-1">
	<div class="col-lg-6 offset-lg-3">
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1">@</span>
			</div>
			<input type="text" id="search" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
		</div>
	</div>
</div>
<div class="row mt-5 mx-1">
	<div class="col-lg-6 offset-lg-3" id="searchContent">
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#search').keyup(function(){
			let wait = '<span class="alert alert-primary text-purple-2" id="searchLoading">Loading...</span>';
			$('#searchContent').html(wait);
			let un = $(this).val();
			$.ajax({
				url: '<?=base_url("search_uname/")?>'+un, 
				success: function(response){
					$('#searchContent').html(response);
				}
			});
		});
	});
</script>