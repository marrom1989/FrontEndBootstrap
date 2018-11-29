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
            	<div class="h2">Opcje:</div>
            	<div class="h6 border-top">Modyfikacja konta użytkownika: <?php if($news): ?> <div class="news" style="font-size: 20px;"><?=$news;?></div> <?php endif; ?></div>
            	
				<div style="padding: 5px"></div>
				
            	<div class="row justify-content-center">
            		<div class="col-12 align-self-center">
            			<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#changeName">
            			  Zmień imię
            			</button>
            		</div>
            		<div class="modal" id="changeName" tabindex="-1">
            			<div class="modal-dialog" role="document">
            			    <div class="modal-content">
								<div class="modal-header">
								    <h5 class="modal-title">Wprowadź nowe imię:</h5>
								    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								    	<span aria-hidden="true">×</span>
								    </button>
								</div>
								<form action ="index.php?action=newName" 
										method = "post">
								    <div class="modal-body">
								        <div class="input-group input-group-sm mb-3">
								        	<div class="input-group-prepend">
								        		<span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-user"></i></span>
								        	</div>
								        	<input type="text" class="form-control" name="name" placeholder="Nowe imię" aria-label="Login" aria-describedby="inputGroup-sizing-sm">
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
            	</div>
				
             <div style="padding: 5px"></div>
             
            <div class="row justify-content-center" >
                <div class="col-12 align-self-center">
                     <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#changePassword">
                      Zmień hasło
                    </button>
                </div>
                 <div class="modal" id="changePassword" tabindex="-1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Wprowadź nowe hasło:</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
              	 	        <form action ="index.php?action=newPassword" 
              	 	  	 	   method = "post">
                                <div class="modal-body">
              	 	  	            <div class="input-group input-group-sm mb-3">
              	 	  	                <div class="input-group-prepend">
              	 	  	  	                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-user"></i></span>
              	 	  	                </div>
              	 	  	                <input type="password" class="form-control" name="oldPassword" placeholder="Stare hasło" aria-label="oldPassword" aria-describedby="inputGroup-sizing-sm">
              	 	  	                <input type="password" class="form-control" name="newPassword" placeholder="Nowe hasło" aria-label="newPassword" aria-describedby="inputGroup-sizing-sm">
              	 	  	                <input type="password" class="form-control" name="repeatedNewPassword" placeholder="Powtórz hasło" aria-label="repeatedNewPassword" aria-describedby="inputGroup-sizing-sm">
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
            </div>
              <!-- INCOMES-->
             <div style="padding: 5px"></div>
			 
            <div class="h6 border-top">Modyfikacja kategorii:
               <div style="padding: 5px"></div>
            	<div class="row justify-content-center">
            				<div class="col-12 align-self-center">
            					<div class="dropdown">
            						<button class="btn btn-success dropdown-toggle btn-block" type="button" id="incomesList" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            							Przychody
            						</button>
            							<div class="dropdown-menu" aria-labelledby="incomesList">
            								<a class="dropdown-item" href="#"><button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#changeIncomes">
            								Zmień nazwę kategorii
            								</button></a>
            								<a class="dropdown-item" href="#"><button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#newIncomes">
            								Dodaj nową kategorię
            								</button></a>
            								<a class="dropdown-item" href="#"><button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#deleteIncomes">
            							  Usuń kategorię
            							</button></a>
            							</div>
            					</div>
            				</div>
				<!-- Change category modal-->					
            					 <div class="modal" id="changeIncomes" tabindex="-1">
            						<div class="modal-dialog" role="document">
            						  <div class="modal-content">
            							<div class="modal-header">
            							  <h5 class="modal-title">Wybierz element do modyfikacji:</h5>
            							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            								<span aria-hidden="true">×</span>
            							  </button>
            							</div>
            					<form action ="index.php?action=newIncomes" 
            								   method = "post">	
            							<div class="modal-body">
            								<div class="form-group">
            									<select class="form-control form-control-sm" id="incomes_category" name="incomesCategory">
            										<option selected> Wybierz kategorię </option>
            										<?php 
            											$id = $portal->loged->id;
            											$query = "SELECT name FROM incomes_category_assigned_to_user WHERE user_id = '$id'";
            											
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
            										<input type="text" class="form-control" name="changedIncomesCategory" placeholder="Wprowadź nową nazwę kategorii" aria-label="category" aria-describedby="inputGroup-sizing-sm">
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
				<!-- New category modal-->						
            					 <div class="modal" id="newIncomes" tabindex="-1">
            						<div class="modal-dialog" role="document">
            						  <div class="modal-content">
            							<div class="modal-header">
            							  <h5 class="modal-title">Wpisz nazwę nowej kategorii:</h5>
            							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            								<span aria-hidden="true">×</span>
            							  </button>
            							</div>
            						<form action ="index.php?action=addNewCotegoryOfIncomes" 
            								   method = "post">	
            						<div class="modal-body">
            							<div class="input-group input-group-sm mb-3">
            								<div class="input-group-prepend">
            									<span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-vector-pencil"></i></span>
            								</div>
            									<input type="text" class="form-control" name="newIncomesCategory" placeholder="Wprowadź nową kategorię" aria-label="category" aria-describedby="inputGroup-sizing-sm">
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
				<!-- Delete category modal-->						
            					<div class="modal" id="deleteIncomes" tabindex="-1">
            						<div class="modal-dialog" role="document">
            						  <div class="modal-content">
            							<div class="modal-header">
            							  <h5 class="modal-title">Wpisz nazwę usuwanej kategorii:</h5>
            							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            								<span aria-hidden="true">×</span>
            							  </button>
            							</div>
            						<form action ="index.php?action=deleteCategoryOfIncomes" 
            								   method = "post">	
            						<div class="modal-body">
            							<div class="input-group input-group-sm mb-3">
            								<div class="input-group-prepend">
            									<span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-vector-pencil"></i></span>
            								</div>
            									<input type="text" class="form-control" name="deleteIncomesCategory" placeholder="Wprowadź nazwę kategorii" aria-label="category" aria-describedby="inputGroup-sizing-sm">
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
            					
            					
            					 <div style="padding: 5px"></div>
				<!-- EXPENSES-->					 
            					<div class="col-12 align-self-center">
            					<div class="dropdown">
            						<button class="btn btn-danger dropdown-toggle btn-block" type="button" id="expensesList" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            							Wydatki
            						</button>
            							<div class="dropdown-menu" aria-labelledby="expensesList">
            								<a class="dropdown-item" href="#"><button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#changeExpenses">
            								Zmień nazwę kategorii
            								</button></a>
            								<a class="dropdown-item" href="#"><button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#newExpenses">
            								Dodaj nową kategorię
            								</button></a>
            								<a class="dropdown-item" href="#"><button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteExpenses">
            							  Usuń kategorię
            							</button></a>
            							</div>
            					</div>
            				</div>
				<!-- Change category modal-->					
            					 <div class="modal" id="changeExpenses" tabindex="-1">
            						<div class="modal-dialog" role="document">
            						  <div class="modal-content">
            							<div class="modal-header">
            							  <h5 class="modal-title">Wybierz element do modyfikacji:</h5>
            							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            								<span aria-hidden="true">×</span>
            							  </button>
            							</div>
            						<form action ="index.php?action=newExpenses" 
            								   method = "post">		
            						<div class="modal-body">
            							<div class="form-group">
            								<select class="form-control form-control-sm" id="expensesCategory" name="expenseCategory">
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
            									<input type="text" class="form-control" name="changedExpensesCategory" placeholder="Wprowadź nową nazwę kategorii" aria-label="category" aria-describedby="inputGroup-sizing-sm">
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
				<!-- New category modal-->	
            
            		 <div class="modal" id="newExpenses" tabindex="-1">
            						<div class="modal-dialog" role="document">
            						  <div class="modal-content">
            							<div class="modal-header">
            							  <h5 class="modal-title">Wpisz nazwę nowej kategorii:</h5>
            							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            								<span aria-hidden="true">×</span>
            							  </button>
            							</div>
            						<form action ="index.php?action=addNewCotegoryOfExpenses" 
            								   method = "post">		
            						<div class="modal-body">
            							<div class="input-group input-group-sm mb-3">
            								<div class="input-group-prepend">
            									<span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-vector-pencil"></i></span>
            								</div>
            									<input type="text" class="form-control" name="newExpensesCategory" placeholder="Wprowadź nową kategorię" aria-label="category" aria-describedby="inputGroup-sizing-sm">
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
            
				<!-- Delete category modal-->	
            
            					<div class="modal" id="deleteExpenses" tabindex="-1">
            						<div class="modal-dialog" role="document">
            						  <div class="modal-content">
            							<div class="modal-header">
            							  <h5 class="modal-title">Wpisz nazwę usuwanej kategorii:</h5>
            							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            								<span aria-hidden="true">×</span>
            							  </button>
            							</div>
            						<form action ="index.php?action=deleteCategoryOfExpenses" 
            								   method = "post">	
            						<div class="modal-body">
            							<div class="input-group input-group-sm mb-3">
            								<div class="input-group-prepend">
            									<span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-vector-pencil"></i></span>
            								</div>
            									<input type="text" class="form-control" name="deleteExpensesCategory" placeholder="Wprowadź nową kategorię" aria-label="category" aria-describedby="inputGroup-sizing-sm">
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
            					 <div style="padding: 5px"></div>
            <!--PAYMENT-->					 
            					<div class="col-12 align-self-center">
            					<div class="dropdown">
            						<button class="btn btn-warning dropdown-toggle btn-block" type="button" id="expensesList" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            							Płatności
            						</button>
            							<div class="dropdown-menu" aria-labelledby="expensesList">
            								<a class="dropdown-item" href="#"><button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#changePayments">
            								Zmień nazwę kategorii
            								</button></a>
            								<a class="dropdown-item" href="#"><button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#newPayment">
            								Dodaj nową kategorię
            								</button></a>
            								<a class="dropdown-item" href="#"><button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#deletePayment">
            							  Usuń kategorię
            							</button></a>
            							</div>
            					</div>
            				</div>
				<!--Change category modal-->						
            					 <div class="modal" id="changePayments" tabindex="-1">
            						<div class="modal-dialog" role="document">
            						  <div class="modal-content">
            							<div class="modal-header">
            							  <h5 class="modal-title">Wybierz element do modyfikacji:</h5>
            							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            								<span aria-hidden="true">×</span>
            							  </button>
            							</div>
            						<form action ="index.php?action=newPayment" 
            								   method = "post">	
            						<div class="modal-body">
            							<div class="form-group">
            								<select class="form-control form-control-sm" id="expenses_payment" name="paymentCategory">
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
            							<div class="input-group input-group-sm mb-3">
            								<div class="input-group-prepend">
            									<span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-vector-pencil"></i></span>
            								</div>
            									<input type="text" class="form-control" name="changedPaymentMethod" placeholder="Wprowadź nową nazwę kategorii" aria-label="category" aria-describedby="inputGroup-sizing-sm">
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
				<!--New category modal-->	
            
            					<div class="modal" id="newPayment" tabindex="-1">
            						<div class="modal-dialog" role="document">
            						  <div class="modal-content">
            							<div class="modal-header">
            							  <h5 class="modal-title">Wpisz nazwę nowej kategorii:</h5>
            							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            								<span aria-hidden="true">×</span>
            							  </button>
            							</div>
            						<form action ="index.php?action=addNewCategoryOfPayment" 
            								   method = "post">		
            						<div class="modal-body">
            							<div class="input-group input-group-sm mb-3">
            								<div class="input-group-prepend">
            									<span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-vector-pencil"></i></span>
            								</div>
            									<input type="text" class="form-control" name="newPaymentCategory" placeholder="Wprowadź nową kategorię" aria-label="category" aria-describedby="inputGroup-sizing-sm">
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
				<!-- Delete category modal-->	
            
            					<div class="modal" id="deletePayment" tabindex="-1">
            						<div class="modal-dialog" role="document">
            						  <div class="modal-content">
            							<div class="modal-header">
            							  <h5 class="modal-title">Wpisz nazwę usuwanej kategorii:</h5>
            							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            								<span aria-hidden="true">×</span>
            							  </button>
            							</div>
            						<form action ="index.php?action=deleteCategoryOfPayment" 
            								   method = "post">	
            						<div class="modal-body">
            							<div class="input-group input-group-sm mb-3">
            								<div class="input-group-prepend">
            									<span class="input-group-text" id="inputGroup-sizing-sm"><i class="icon-vector-pencil"></i></span>
            								</div>
            									<input type="text" class="form-control" name="deletePaymentCategory" placeholder="Wprowadź nową kategorię" aria-label="category" aria-describedby="inputGroup-sizing-sm">
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
            				</div>
            </div>
        </div>
    </div>
    </article>
</main>