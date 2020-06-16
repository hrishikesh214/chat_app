<nav class="fixed-top navbar navbar-expand-lg navbar-dark bg-dark">	
	<a class="navbar-brand h2" href="<?=base_url()?>">Chat Application</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="container">
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<?php if(isset($_SESSION['user']['username'])): ?>
					<li class="nav-item">
						<a class="nav-link disabled active"><?=$_SESSION['user']['username'] ?></a>
					</li>
				<?php endif ?>
				<li class="nav-item">&nbsp&nbsp</li>
				<li class="nav-item">
					<a class="nav-link <?=($REQ_URL=='Feed')?'active disabled':''?>" href="<?=base_url('Feed')?>">Feed</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?=($REQ_URL=='Search')?'active disabled':''?>" href="<?=base_url('Search')?>">Search</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url('Logout')?>">Logout</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<script type="text/javascript">
	$(document).ready(function(){
		$('.navbar-toggler').click(function(){
			$('.collapse').toggle();
		});
	});
</script>