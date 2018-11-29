<?php

class Settings
{
	
    private $db = null;
    private $loged = null;

    function __construct($db, $loged) 
	{
	
	    $this-> db = $db;
	    $this-> loged = $loged;
    }

    function changeName()
	{
	
	    if(!$this->db) return SERVER_ERROR;
	    
	    if(!isset($_POST['name'])) {
			
	        return FROM_DATA_MISSING;
	    }
	    
	    $name = $_POST['name'];
	    $id = $this->loged->id;
	    
	    $userName = $this->db->real_escape_string($name);
	    
	    $query = "UPDATE users SET `name` = '$userName' WHERE `user_id` = '$id'";
	    
	    $result = $this->db->query($query);
	    
	    if($result) {
	    	
	    	return ACTION_OK;
	    } else {
	    	
	    	return ACTION_FAILED;
	    }
}

    function changePassword() 
	{
	
	    if(!$this->db) return SERVER_ERROR;
	    
	    if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword']) || !isset($_POST['repeatedNewPassword'])) {
			
	    	return FROM_DATA_MISSING;
	}
	
	    $oldPassword = $_POST['oldPassword'];
	    $newPassword = $_POST['newPassword'];
	    $repeatedNewPassword = $_POST['repeatedNewPassword'];
	    $id = $this->loged->id;
	    
	    $oldPass = $this->db->real_escape_string($oldPassword);
	    $newPass = $this->db->real_escape_string($newPassword);
	    $repNewPass = $this->db->real_escape_string($repeatedNewPassword);
	    
	    $query = "SELECT `user_id`, `name`, `password` FROM users WHERE `user_id` = '$id'";
	    
	    if(!$result = $this->db->query($query)){
	    	
	    	return SERVER_ERROR;
	    }
	    
	    if($result->num_rows <> 1){
	    	
	    	return ACTION_FAILED;
	    } else {
	    	
	        $row = $result->fetch_row();
	        $pass_db = $row[2];
	        	
	        if(crypt($oldPass, $pass_db) != $pass_db){
	        		
	        	return ACTION_FAILED;
	        } else {
		    	
		        $newPassLength = mb_strlen($newPass, 'utf8');
		    	$repNewPassLength = mb_strlen($repNewPass, 'utf8');
	        
		    	if($newPassLength < 6 || $newPassLength > 100) {
		    		
		    		return ACTION_FAILED;
		    	}
		    	
		    	if($newPass != $repNewPass) {
		    		
		    		return PASSWORD_DO_NOT_MATCH;
		    	}
		    	
		    	$hashPassword = password_hash($newPass, PASSWORD_DEFAULT);
	        
		    	$query = "UPDATE `users` SET `password` = '$hashPassword' WHERE `user_id` = '$id'";
		    	
		    	$result = $this->db->query($query);
	        
		    	if($result) {
		    		
		    		return ACTION_OK;
		    	} else {
		    		
		    		return ACTION_FAILED;
		    	}
		    }
        }
    }

    function changeNameIncomeCategory() 
    {
	
	    if(!$this->db) return SERVER_ERROR;
	    	
	    	if((!isset($_POST['incomesCategory']) || !isset($_POST['changedIncomesCategory']))) {
				
	    		return FROM_DATA_MISSING;
	    	}
	    
	    $oldNameCategory = $_POST['incomesCategory'];
	    $newNameCategory = $_POST['changedIncomesCategory'];
	    $id = $this->loged->id;
	    
	    $oldCategory = $this->db->real_escape_string($oldNameCategory);
	    $newCategory = $this->db->real_escape_string($newNameCategory);
	    
	    $query = "UPDATE `incomes_category_assigned_to_user` SET `name` = '$newCategory' WHERE `user_id` = '$id' AND name = '$oldCategory'";
	    
	    $result = $this->db->query($query);
	    	
	    if($result) {
	    				
	    	return ACTION_OK;
	    } else {
	    				
	    	return ACTION_FAILED;
	    }
    }
	
    function changeNameExpenseCategory() 
	{
	
	    if(!$this->db) return SERVER_ERROR;
	    	
	    if((!isset($_POST['expenseCategory']) || !isset($_POST['changedExpensesCategory']))) {
				
	        return FROM_DATA_MISSING;
	    }
	    
	    $oldNameCategory = $_POST['expenseCategory'];
	    $newNameCategory = $_POST['changedExpensesCategory'];
	    $id = $this->loged->id;
	    
	    $oldCategory = $this->db->real_escape_string($oldNameCategory);
	    $newCategory = $this->db->real_escape_string($newNameCategory);
	    
	    $query = "UPDATE `expenses_category_assigned_to_user` SET `name` = '$newCategory' WHERE `user_id` = '$id' AND name = '$oldCategory'";
	    
	    $result = $this->db->query($query);
	    	
	    if($result) {
	    				
	    	return ACTION_OK;
	    } else {
	    				
	    	return ACTION_FAILED;
	    }
    }
	
    function changeNamePaymentCategory() 
	{
	
	    if(!$this->db) return SERVER_ERROR;
	    	
	    if((!isset($_POST['paymentCategory']) || !isset($_POST['changedPaymentMethod']))) {
			
	    	return FROM_DATA_MISSING;
	    }
	    
	    $oldNameCategory = $_POST['paymentCategory'];
	    $newNameCategory = $_POST['changedPaymentMethod'];
	    $id = $this->loged->id;
	    
	    $oldCategory = $this->db->real_escape_string($oldNameCategory);
	    $newCategory = $this->db->real_escape_string($newNameCategory);
	    
	    $query = "UPDATE `payment_method_assigned_to_user` SET `pay_name` = '$newCategory' WHERE `user_id` = '$id' AND pay_name = '$oldCategory'";
	    
	    $result = $this->db->query($query);
	    	
	    if($result) {
	    				
	    	return ACTION_OK;
	    } else {
	    				
	    	return ACTION_FAILED;
	    }
    }
	
    function newIncomesCategory() {
    	
    	if(!$this->db) return SERVER_ERROR;
    		
    	if(!isset($_POST['newIncomesCategory'])) {
			
    		return FROM_DATA_MISSING;
    	}
    	
    	$newNameCategory = $_POST['newIncomesCategory'];
    	$id = $this->loged->id;
    	
    	$newCategory = $this->db->real_escape_string($newNameCategory);
    	
    	$query = "INSERT INTO `incomes_category_assigned_to_user`(id, user_id, name) VALUES (NULL, '$id', '$newCategory')";
    	
    	$result = $this->db->query($query);
    		
    	if($result) {
    					
    		return ACTION_OK;
    	} else {
    					
    		return ACTION_FAILED;
    	}
    }

    function newExpensesCategory() {
    	
    	if(!$this->db) return SERVER_ERROR;
    		
    	if(!isset($_POST['newExpensesCategory'])) {
			
    		return FROM_DATA_MISSING;
    	}
    	
    	$newNameCategory = $_POST['newExpensesCategory'];
    	$id = $this->loged->id;
    	
    	$newCategory = $this->db->real_escape_string($newNameCategory);
    	
    	$query = "INSERT INTO `expenses_category_assigned_to_user`(id, user_id, name) VALUES (NULL, '$id', '$newCategory')";
    	
    	$result = $this->db->query($query);
    		
    	if($result) {
    					
    		return ACTION_OK;
    	} else {
    					
    		return ACTION_FAILED;
    	}
    }
	
    function incomesDelete() 
	{
	
	    if(!$this->db) return SERVER_ERROR;
	    	
	    if(!isset($_POST['deleteIncomesCategory'])) {
			
	    	return FROM_DATA_MISSING;
	    }
	    
	    $deleteNameCategory = $_POST['deleteIncomesCategory'];
	    $id = $this->loged->id;
	    
	    $deleteCategory = $this->db->real_escape_string($deleteNameCategory);
	    
	    $query = "DELETE FROM incomes_category_assigned_to_user WHERE `name` = '$deleteCategory' AND `user_id` = '$id'";
	    
	    $result = $this->db->query($query);
	    	
	    if($result) {
	    				
	    	return ACTION_OK;
	    } else {
	    				
	    	return ACTION_FAILED;
	    }
    }
	
    function expensesDelete() 
	{
	
	    if(!$this->db) return SERVER_ERROR;
	    	
	    if(!isset($_POST['deleteExpensesCategory'])) {
				
	    	return FROM_DATA_MISSING;
	    }
	    
	    $deleteNameCategory = $_POST['deleteExpensesCategory'];
	    $id = $this->loged->id;
	    
	    $deleteCategory = $this->db->real_escape_string($deleteNameCategory);
	    
	    $query = "DELETE FROM expenses_category_assigned_to_user WHERE `name` = '$deleteCategory' AND `user_id` = '$id'";
	    
	    $result = $this->db->query($query);
	    	
	    if($result) {
	    				
	    	return ACTION_OK;
	    } else {
	    				
	    	return ACTION_FAILED;
	    }
    }

    function newPaymentCategory() {
	
	    if(!$this->db) return SERVER_ERROR;
	    	
	    if(!isset($_POST['newPaymentCategory'])) {
	    	
			return FROM_DATA_MISSING;
	    }
	    
	    $newNameCategory = $_POST['newPaymentCategory'];
	    $id = $this->loged->id;
	    
	    $newCategory = $this->db->real_escape_string($newNameCategory);
	    
	    $query = "INSERT INTO `expenses_category_assigned_to_user`(id, user_id, name) VALUES (NULL, '$id', '$newCategory')";
	    
	    $result = $this->db->query($query);
	    	
	    if($result) {
	    				
	    	return ACTION_OK;
	    } else {
	    				
	    	return ACTION_FAILED;
	    }
    }

    function paymentDelete() {
    	
    	if(!$this->db) return SERVER_ERROR;
    		
    	if(!isset($_POST['deletePaymentCategory'])) {
    			
			return FROM_DATA_MISSING;
    	}
    	
    	$deleteNameCategory = $_POST['deletePaymentCategory'];
    	$id = $this->loged->id;
    	
    	$deleteCategory = $this->db->real_escape_string($deleteNameCategory);
    	
    	$query = "DELETE FROM payment_method_assigned_to_user WHERE `pay_name` = '$deleteCategory' AND `user_id` = '$id'";
    	
    	$result = $this->db->query($query);
    		
    	if($result) {
    					
    		return ACTION_OK;
    	} else {
    					
    		return ACTION_FAILED;
    	}
    }
}
?>