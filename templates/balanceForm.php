<?php if(!$this) die();?>

<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Wydatki z wybranego okresu."
	},
	subtitles: [{
		text: "Waluta: (PLN)"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

</head>
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
<div class="container" >
	<div class = "row justify-content-around" id="balanceContent">	
	
		<?php if($news): ?> <div class="news" style="font-size: 20px;"><?=$news;?></div> <?php endif; ?>
		
	    <div class="dropdown">
	    	<button class="btn btn-light dropdown-toggle" type="button" id="dropdownButton" data-toggle="dropdown">Wybierz okres</button>
	    	<div class="dropdown-menu">
	    		<a class="dropdown-item" id="currentMonth" href="index.php?action=showCurrentBalance">Bieżący miesiąc</a>
	    		<a class="dropdown-item" id="previousMonth" href="index.php?action=showPreviousBalance">Poprzedni miesiąc</a>
	    		<a class="dropdown-item" id="currentYear" href="index.php?action=showCurrentYear">Obecny rok</a>
	    		<a class="dropdown-item" id="custom" data-toggle="modal" data-target="#periodOfTime" href="#">Wybierz zakres</a>
	    	</div>		
	    </div>
		<div class="modal" id="periodOfTime" tabindex="-1">
				<div class="modal-dialog" role="document">
				    <div class="modal-content">
					    <div class="modal-header">
					        <h5 class="modal-title">Wprowadź nowe imię:</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					            <span aria-hidden="true">×</span>
					        </button>
					    </div>
					    <form action ="index.php?action=showPeriodOfTime" 
					    		   method = "post">
					        <div class="modal-body">
					            <div class="input-group input-group-sm mb-6">
					            		<label for="firstDate">Data startowa:</label>
					            		<input type="date" class="form-control" name="firstDate" aria-label="firstDate" aria-describedby="inputGroup-sizing-sm" value="<?php $date = new DateTime(); echo $date->format('Y-m-d');  ?>">
					            </div>
					            <div class="input-group input-group-sm mb-6">
					            		<label for="secondDate">Data końcowa:</label>
					            		<input type="date" class="form-control" name="secondDate" aria-label="secondDate" aria-describedby="inputGroup-sizing-sm" value="<?php $date = new DateTime(); echo $date->format('Y-m-d');  ?>">
					            </div>
				            </div>
				            <div class="modal-footer">
				                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-cancel-outline"></i>Zamknij</button>
				                <button type="submit" class="btn btn-success"><i class="icon-plus-outline"></i>Zatwierdź</button>
				            </div>
				        </form>
			        </div>
				</div>
		</div>
		<div class="table-responsive-sm">			
		    <table class="table table-sm">
		        <thead>
		        	<tr>
		        		<th colspan="5">Tabela przychodów</th>
		        	</tr>
		        	<tr class="table-success">
		        		<th>#</th><th>Data</th><th>Kwota [PLN]</th><th>Kategoria</th><th>Komentarz</th>
		        	</tr>
		        </thead>
		        <tbody>
		            <?php while($incomesRow = $incomesResult->fetch_row()):?>
		            <tr>
		                <?php $incomesCount = count($incomesRow); ?>
                        
		                <td><?=$incomesCounter++?></td>
		                <?php for($i = 0; $i < $incomesCount; $i++): ?>
		                 <td><?=$incomesRow[$i]?></td>
		                <?php endfor; ?>
		            </tr>
		            <?php endwhile; ?>
		        </tbody>
		    </table> 
		</div>
		
		<div style="padding: 5px"></div>
		
		<div class="table-responsive-sm">
			<table class="table table-sm">
				<thead>
					<tr>
						<th colspan="5">Tabela wydatków</th>
					</tr>
					<tr class="table-danger">
						<th>#</th><th>Data</th><th>Kwota [PLN]</th><th>Kategoria</th><th>Komentarz</th>
					</tr>
				</thead>
				<tbody>
				    <?php while($expensesRow = $expensesResult->fetch_row()):?>
				    <tr>
				        <?php $expensesCount = count($expensesRow);?>
                        
				        <td><?=$expensesCounter++?></td>
				        <?php for($i = 0; $i < $expensesCount; $i++): ?>
				        <td><?=$expensesRow[$i]?></td>
				        <?php endfor; ?>
				    </tr>
			        <?php endwhile; ?>
			    </tbody>
			</table>
		</div>	
	</div>
	<div class = "row justify-content-around" id="balanceContent">	
	    <p class="h3" style="color: black"> Bilans: <?php  echo	$bilans = $incomeSumRow['SUM(amount)'] - $expenseSumRow['SUM(amount)']; ?> </p>
	    <?php if($bilans > 0): ?> 
		    <p class="h1" style="color: green"> Doskonale zarządzasz swoimi finansami !! </p>
		<?php elseif($bilans == 0) : ?>
		    <p class="h1"> Nie jest najgorzej ale mogłoby być lepiej!!</p>
		<?php else : ?>
		    <p class="h1" style="color: red"> Musisz popracować nad swoimi wydatkami !!</p>
		<?php endif ?>
	
	</div>
	<div class = "row justify-content-around" id="balanceContent">
		<div class="row justify-content-center">
			<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

		</div>
	</div>
</div>
