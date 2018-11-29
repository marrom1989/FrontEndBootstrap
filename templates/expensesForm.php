<?php if(!isset($portal)) die();?>
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
				<div class="h2 border-bottom">Wprowadź dane</div><?php if($news): ?> <div class="news" style=			"font-size: 20px;"><?=$news;?></div> <?php endif; ?>
					<form action ="index.php?action=addExpense" 
								   method = "post">
						<div class="input-group input-group-sm mb-3">
						    <div class="input-group-prepend">
						        <span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-vector-pencil"></i></span>
						    </div>
						    <input type="text" class="form-control" placeholder="Kwota" name="amount" aria-label="Login" aria-describedby="inputGroup-sizing-sm">
						</div>
						<div class="input-group input-group-sm mb-3">
						    <div class="input-group-prepend">
					            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-calendar"></i></span>
						    </div>
						    <input type="date" class="form-control" name="date" aria-label="Haslo" aria-describedby="inputGroup-sizing-sm" value="<?php $date = new DateTime(); echo $date->format('Y-m-d');  ?>">
						</div>
						<div class="form-group">
							<select class="form-control form-control-sm" id="expenses_payment" name="paymentMethod">
								<option selected> Wybierz sposób płatności </option>
								<?php 
									$id = $portal->loged->id;
									$query = "SELECT pay_name FROM payment_method_assigned_to_user WHERE user_id = '$id'";
									
									$result = $portal->db->query($query);
									while($row = $result->fetch_assoc()){
								?>
								
								<option value="<?php echo $row['pay_name'];?>"> <?php echo $row['pay_name'];?></option>
									
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control form-control-sm" id="expenses_category" name="category">
								<option selected> Wybierz kategorię </option>
								<?php 
									$id = $portal->loged->id;
									$query = "SELECT name FROM expenses_category_assigned_to_user WHERE user_id = '$id'";
									
									$result = $portal->db->query($query);
									while($row = $result->fetch_assoc()){
								?>
								
								<option value="<?php echo $row['name'];?>"> <?php echo $row['name'];?></option>
									
								<?php } ?>
							</select>
						</div>	
						<div class="input-group input-group-sm mb-3">
						    <div class="input-group-prepend">
						        <span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-vector-pencil"></i></span>
						    </div>
						    <input type="text" class="form-control" placeholder="Komentarz (opcjonalnie)" name="comment" aria-label="comment" aria-describedby="inputGroup-sizing-sm">
						</div>
							<div class="row justify-content-around">
								<button type="submit" class="btn btn-success"><i class="icon-money"></i>Dodaj</button>
								<button type="button" class="btn btn-danger"><i class="icon-cancel-outline"></i>Wróć</button>
							</div>
					</form>
			</div>		
		</div>
	</article>
</main>