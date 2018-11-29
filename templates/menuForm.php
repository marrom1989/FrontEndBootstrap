<?php if(!isset($portal)) die(); ?>
<nav class="navbar navbar-expand-xl navbar-light bg-light" id="navSpec">
	<a class="navbar-brand" href="#">Menu:</a>
	<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
		<span class="navbar-toggler-icon"></span>
	</button>	
	<div class="collapse navbar-collapse" id="navbarMenu">
	    <ul class="navbar-nav">
	    	<li class="nav-item" id="menu">
	    		<a href="index.php?action=showMenu" class="nav-link"><i class="icon-home-outline"></i>Strona główna</a>
	    	</li>
	    	<li class="nav-item" id="income">
	    		<a href="index.php?action=showAddIncomes" class="nav-link"><i class="icon-money"></i>Dodaj przychód</a>
	    	</li>
	    	<li class="nav-item" id="expense">
	    		<a href="index.php?action=showAddExpenses" class="nav-link"><i class="icon-wallet"></i>Dodaj wydatek</a>
	    	</li>
	    	<li class="nav-item" id="balance">
	    		<a href="index.php?action=showCurrentBalance" class="nav-link"><i class="icon-chart-bar"></i>Bilans</a>
	    	</li>
	    	<li class="nav-item" id="settings">
	    		<a href="index.php?action=showSettings" class="nav-link"><i class="icon-params"></i>Ustawienia</a>
	    	</li>
	    	<li class="nav-item">
	    		<a href="index.php?action=logout" class="nav-link"><i class="icon-cancel-outline"></i>Wyloguj</a>
	    	</li>	
	    </ul>	
	</div>
</nav>
<main>	
    <article>	
         <div class="container" >
         		<div class = "row justify-content-around" id="content">
         		    <?php if($news): ?> <div class="news" style="font-size: 20px;"><?=$news;?></div> <?php endif; ?>	
         		    
         		    <p class="h1"> Witaj !! W czym Ci dzisiaj mogę pomóc ?</p>
         		</div>	
         </div>	
    </article>
</main>