<?php if(!isset($portal)) die(); ?>
<div class = "row justify-content-around" id="content">
	<div class="h2">Rejestracja</div><?php if($news): ?> <div class="news" style="font-size: 12px;"><?=$news;?></div> <?php endif; ?>
	<form action ="index.php?action=registerUser"
					method ="post">
		<div class="input-group input-group-sm mb-3">
		    <div class="input-group-prepend">
			    <span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-user"></i></span>
		    </div>
		  <input type="text" class="form-control" placeholder="Login" name="login" aria-label="Login" aria-describedby="inputGroup-sizing-sm">
		</div>
		    <div class="input-group input-group-sm mb-3">
		        <div class="input-group-prepend">
		    	    <span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-lock"></i></span>
		        </div>
		        <input type="password" class="form-control" placeholder="Hasło" name="password" aria-label="Haslo" aria-describedby="inputGroup-sizing-sm">
		    </div>
		    <div class="input-group input-group-sm mb-3">
		         <div class="input-group-prepend">
		    	     <span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-key"></i></span>
		         </div>
		         <input type="password" class="form-control" placeholder="Potwierdź hasło" name="repeatedPassword" aria-label="Potwierdz_Haslo" aria-describedby="inputGroup-sizing-sm">
		    </div>
		    	<button type="submit" class="btn btn-primary btn-block"><i class="icon-plus-outline"></i>Zarejestruj</button>
				<div style="padding: 5px"></div>
		    	<a href="index.php?action=showMain"><button type="button" class="btn btn-secondary btn-block"><i class="icon-cancel-outline"></i>Zamknij</button></a>
		</form>
</div>	