<?php

class Expenses {
	
    private $db = null;
    private $loged = null;
    
    function __construct($db, $loged) 
	{
    	
        $this-> db = $db;
        $this-> loged = $loged;
    }
    
    function addExpense()
	{
    	
    	if(!$this->db) return SERVER_ERROR;
    	
    	if(!isset($_POST['amount']) || !isset($_POST['date']) || !isset($_POST['paymentMethod']) 
		  || !isset($_POST['category'])) {
			  
    	    return FROM_DATA_MISSING;
			
    	}
    	
    	$amount = $_POST['amount'];
    	$date = $_POST['date'];
    	$paymentMethod = $_POST['paymentMethod'];
    	$category = $_POST['category'];
    	$comment = $_POST['comment'];
    	$id = $this->loged->id;
    	
    	$query = "INSERT INTO expenses(user_id, expenses_category_assigned_to_user_id, payment_method_assigned_to_user_id, 
		                amount, date_of_expense, expense_comment) VALUES ((SELECT user_id FROM users WHERE user_id = '$id'), 
						(SELECT id FROM expenses_category_assigned_to_user WHERE name = '$category' AND user_id = '$id'), 
						(SELECT id FROM payment_method_assigned_to_user WHERE pay_name = '$paymentMethod' AND user_id = '$id'), 
						'$amount', '$date', '$comment')";
    	
    	$result = $this->db->query($query);
    		
    	if($result) {
    		
    	    return ACTION_OK;
    	} else {
    		
    	    return ACTION_FAILED;
    	}
    }
}

?>