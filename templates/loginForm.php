<?php if(!isset($portal)) die(); ?>
<div class = "row justify-content-around" id="content">
	<div class="h2 border-bottom">Logowanie</div> <?php if($news): ?> <div class="news" style="font-size: 12px;"><?=$news;?></div> <?php endif; ?>
	<form action ="index.php?action=login" 
			   method = "post">
		<div class="input-group input-group-sm mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-user"></i></span>
			</div>
			<input type="text" class="form-control" name="name" placeholder="Login" aria-label="Login" aria-describedby="inputGroup-sizing-sm">
		</div>
		<div class="input-group input-group-sm mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-lock"></i></span>
			</div>
				<input type="password" class="form-control" name="password" placeholder="Hasło" aria-label="Haslo" aria-describedby="inputGroup-sizing-sm">
		</div>
		<button type="submit" class="btn btn-primary"><i class="icon-key"></i>Zaloguj</button>
		<a href="index.php?action=showMain"><button type="button" class="btn btn-secondary"><i class="icon-cancel-outline"></i>Zamknij</button></a>
	</form>
</div>		
