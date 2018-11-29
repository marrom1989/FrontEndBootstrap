<?php

include 'MyDB.php';

class PortalFront extends Portal
{
	
    public $loged = null;

    function __construct($host, $user, $pass, $db) 
	{
	
        $this-> db = $this->initDB($host, $user, $pass, $db);
        $this->loged = $this->getActualUser();
    }

    function getActualUser() 
	{
	
        if(isset($_SESSION['loged'])) {
			
            return $_SESSION['loged'];
        } else {
			
            return null;
        }
    }

    function setNews($news) 
	{
    	
        $_SESSION['news'] = $news;
		
    }
    
    function getNews() 
	{
    	
        if(isset($_SESSION['news'])){
        $news = $_SESSION['news'];
        unset($_SESSION['news']);
        return $news;
		
        } else {
		
            return null;
        }
    }

    function login() 
	{
	
        if(!$this->db) return SERVER_ERROR;
        
        if($this->loged)  return 	NO_LOGIN_REQUIRED;
        
        if(!isset($_POST['name']) || !isset($_POST['password'])) {
			
        	return FROM_DATA_MISSING;
        }
        
        $name = $_POST['name'];
        $pass = $_POST['password'];
        
        $userNameLength = mb_strlen($name, 'utf8');
        $userPassLength = mb_strlen($pass, 'utf8');
        
        if($userNameLength < 5 || $userNameLength > 50 || $userPassLength < 6 || $userPassLength > 100) {
        	
            return ACTION_FAILED;
        }
        
        $userName = $this->db->real_escape_string($name);
        $pass = $this->db->real_escape_string($pass);
        
        $query = "SELECT `user_id`, `name`, `password` FROM users WHERE `name` = '$userName'";
        
        if(!$result = $this->db->query($query)){
        	
            return SERVER_ERROR;
        }
        
        if($result->num_rows <> 1){
        	
        return ACTION_FAILED;
        } else {
        	
            $row = $result->fetch_row();
            $pass_db = $row[2];
            	
            if(crypt($pass, $pass_db) != $pass_db){
            		
                return ACTION_FAILED;
            } else {
                $nick = $row[1];
                $_SESSION['loged'] = new User($row[0], $nick);
                return ACTION_OK;
            }
        }	
    }

    function logout() 
	{
    	
        $this->loged = null;
        if(isset($_SESSION['loged'])) {
        		
            unset($_SESSION['loged']);
        }
    }

    function registerUser() 
	{
    	
        if(!$this->db) return SERVER_ERROR;
        
        if((!isset($_POST['login'])) || (!isset($_POST['password'])) || (!isset($_POST['repeatedPassword']))) {
			
            return FROM_DATA_MISSING;
        }
        
        $name = $_POST['login'];
        $pass = $_POST['password'];
        $repeatedPass = $_POST['repeatedPassword'];
        
        $userNameLength = mb_strlen($name, 'utf8');
        $userPassLength = mb_strlen($pass, 'utf8');
        $userRepeatedPassLength = mb_strlen($repeatedPass, 'utf8');
        
        if($userNameLength < 5 || $userNameLength > 50 || $userPassLength < 6 || $userPassLength > 100) {
        	
            return ACTION_FAILED;
        }
        
        if($pass != $repeatedPass) {
        	
            return PASSWORD_DO_NOT_MATCH;
        }
        
        $query = "SELECT user_id FROM users WHERE `name` = '$name'";
        $result = $this->db->query($query);
        
        $number= $result->num_rows;
        if($number> 0) {
        	
            return USER_NAME_ALREADY_EXISTS;
        }
        
        $hashPassword = password_hash($pass, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO users VALUES (NULL, '$name', '$hashPassword')";
        
        $result = $this->db->query($query);
        
        if($result) {
        	
            $this->db->query("INSERT INTO incomes_category_assigned_to_user(user_id, name) 
			                             SELECT (SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1), name FROM incomes_category_default");
										 
            $this->db->query("INSERT INTO expenses_category_assigned_to_user(user_id, name) 
			                             SELECT (SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1), name FROM expenses_category_default");
										 
            $this->db->query("INSERT INTO payment_method_assigned_to_user(user_id, pay_name) 
			                            SELECT (SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1), pay_name FROM payment_methods_default");
        	
            return ACTION_OK;
        } else {
        	
            return ACTION_FAILED;
        }
    }

    function addValues()
	{
    	
        $add = new Incomes($this->db, $this->loged);
        return $add->addValues();
    }

    function addExpense()
	{
    	
        $addExp = new Expenses($this->db, $this->loged);
        return $addExp->addExpense();
    }
    
    function changeName()
	{
    	
        $changeName = new Settings($this->db, $this->loged);
        return $changeName->changeName();
    }
    
    function changePassword()
	{
    	
        $changePassword = new Settings($this->db, $this->loged);
        return $changePassword->changePassword();
    }
    
    function showBalance() 
	{
    	
        $showBalance = new Balance($this->db, $this->loged);
        return $showBalance->currentMonth();
    }
    
    function showPreviousBalance() 
	{
    	
        $showPreviousBalance = new Balance($this->db, $this->loged);
        return $showPreviousBalance->previousMonth();
    }
    
    function showCurrentYear() 
	{
    	
        $showCurrentYear = new Balance($this->db, $this->loged);
        return $showCurrentYear->currentYear();
    }
    
    function showPeriodOfTime() 
	{
    	
        $showPeriodOfTime = new Balance($this->db, $this->loged);
        return $showPeriodOfTime->periodOfTime();
    }
    
    function changeIncomeCategory() 
	{
    	
        $changeIncomeCategory = new Settings($this->db, $this->loged);
        return $changeIncomeCategory->changeNameIncomeCategory();
    }
    function changeExpenseCategory() 
	{
    	
        $changeExpenseCategory = new Settings($this->db, $this->loged);
        return $changeExpenseCategory->changeNameExpenseCategory();
    }
    
    function changePaymentCategory() 
	{
    	
        $changePaymentCategory = new Settings($this->db, $this->loged);
        return $changePaymentCategory->changeNamePaymentCategory();
    }
    
    function addNewIncomes() 
	{
    	
        $addNewIncomes = new Settings($this->db, $this->loged);
        return $addNewIncomes->newIncomesCategory();
    }
    
    function addNewExpenses() 
	{
    	
        $addNewExpenses = new Settings($this->db, $this->loged);
        return $addNewExpenses->newExpensesCategory();
    }
    
    function deleteIncomes() 
	{
    	
        $deleteIncomes = new Settings($this->db, $this->loged);
        return $deleteIncomes->incomesDelete();
    }
    function deleteExpenses() 
	{
    	
        $deleteExpenses = new Settings($this->db, $this->loged);
        return $deleteExpenses->expensesDelete();
    }
    function addPaymentCategory() 
	{
    	
        $addPaymentCategory = new Settings($this->db, $this->loged);
        return $addPaymentCategory->newPaymentCategory();
    }
    function deletePayment() 
	{
    	
        $deletePayment = new Settings($this->db, $this->loged);
        return $deletePayment->paymentDelete();
    }
}
?>