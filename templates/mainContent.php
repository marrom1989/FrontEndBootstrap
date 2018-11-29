<?php if(!isset($portal)) die();?>
<div class = "row justify-content-around" id="content">
		
		<?php if($news): ?> <div class="news" id="log"><p class="h3" style=" color: #111E2B;"><?=$news;?></p></div> <?php endif; ?>
	
	<p class="h3"> Zadbaj o swój domowy budżet !!</p>
	<p> Zarejestruj się i wykorzystaj wszystkie możliwości jakie daje Ci ta aplikacja aby łatwiej zarządzać swoimi finansami.</p>
	<p> Dodawaj przychody, zapisuj wydatki według dostępnych kategorii lub twórz własne oraz zestawiaj je w wybranych przedziałach czasowych.</p>
	<p> Sprawdź czy dobrze zarządzasz domowym budżetem czy jednak jesteś już pod "kreską".</p>
	<p class="h3"> Ta aplikacja pozwoli Ci utrzymać kontrolę nad swoimi finansami !! </p>	
</div>
<div class = "row justify-content-center">
	<a href="index.php?action=showRegistration"><button type="button" class="btn btn-danger border-dark"><i class="icon-plus-outline"></i> Rejestracja</button></a>
	<a href="index.php?action=showLogin"><button type="button" class="btn btn-primary border-dark"><i class="icon-key"></i> Logowanie</button></a>	
</div>