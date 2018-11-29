<?php if(!isset($portal)) die();?>
<!DOCTYPE>
<html>
<head>
	<meta charset = "utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>Home budget</title>
	<meta name = "discription" content = "Take care of your home budget. This application helps you to hold your hand on your moneys!!" />
	<meta name = "keywords" content = "budget, money, deposit, whithdraw, home budget, " />
	<meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel ="stylesheet" href = "css/style.css" type = "text/css" />
	<link rel ="stylesheet" href = "fontello/css/fontello.css" type = "text/css" />
	<link href="https://fonts.googleapis.com/css?family=Chakra+Petch:400,600&amp;subset=latin-ext" rel="stylesheet">
		
</head>
<body>
<header>
	<div class="row justify-content-center" id="logo"> 
		<div class="col-8 align-self-center">
				<p class="h1"><a href="index.php?action=showMain" id="link"><i class="icon-dollar"></i>Home Budget</a></p>
		</div>
		<div class="col-4 ">
			<?php if($portal->loged): ?>
                <div class="align-items-center" id="log" >Zalogowany: <?=$portal->loged->nick?></div>
            <?php else: ?>
                <div class="align-items-center" id="log">Nie jesteś zalogowany.</div>
            <?php endif ?>
		</div>	
	</div>
</header>
<main>
	<article>
		<div class="container ">
			
			<?php
			  switch($action):
			    case 'showLogin' :
					include 'templates/loginForm.php';
					break;
				case 'showRegistration' :
					include 'templates/registrationForm.php';
					break;
				case 'showAddIncomes' :
					include 'templates/incomeForm.php';
					break;
				case 'showAddExpenses' :
					include 'templates/expensesForm.php';
					break;
				case 'showCurrentBalance' :
					$portal->showBalance();
					break;
				case 'showPreviousBalance' :
					$portal->showPreviousBalance();
					break;
				case 'showCurrentYear' :
					$portal->showCurrentYear();
					break;
				case 'showPeriodOfTime' :
					$portal->showPeriodOfTime();
					break;		
				case 'showSettings' :
					include 'templates/settingsForm.php';
					break;	
				case 'showMenu' :
					include 'templates/menuForm.php';
					break;
				case 'showMain':
				default:
					include'templates/mainContent.php';
				endswitch;
			?>
		</div>
	</article>
</main>	
	
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>