<?php

class Balance
{
	
    private $db = null;
    private $loged = null;
    private $fields = array();

    public $name;

    function __construct($db, $loged) 
	{	
        $this->db = $db;
        $this->loged = $loged;
	}
	
    function currentMonth() 
	{	
        if(!$this->db) return SERVER_ERROR;

        $id = $this->loged->id;

        $month = date('m');
        $year = date('Y');
	
        $incomesQuery = "SELECT date_of_income, amount, name, income_comment FROM incomes
		                             AS inc INNER JOIN incomes_category_assigned_to_user AS ic ON
									 inc.income_category_assigned_to_user_id = ic.id AND 
									 inc.user_id = ic.user_id AND ic.user_id ='$id' AND inc.user_id = ic.user_id 
									 AND MONTH(date_of_income) = '$month' AND 
									 YEAR(date_of_income) = '$year' AND inc.user_id = '$id'";

        $expensesQuery = "SELECT date_of_expense, amount, name , expense_comment FROM 
		                              expenses AS exp INNER JOIN expenses_category_assigned_to_user 
									  AS ec ON exp.expenses_category_assigned_to_user_id = ec.id 
									  AND exp.user_id = ec.user_id AND ec.user_id = '$id' AND 
									  exp.user_id = ec.user_id AND MONTH(date_of_expense) = '$month' 
									  AND YEAR(date_of_expense) = '$year' AND exp.user_id = '$id'";

        $incomesSum = "SELECT SUM(amount) FROM incomes WHERE user_id = '$id' 
		                          AND MONTH(date_of_income) = '$month' AND YEAR(date_of_income) = '$year'";
								  
        $expenseSum = "SELECT SUM(amount) FROM expenses WHERE user_id = '$id' 
		                          AND MONTH(date_of_expense) = '$month' AND YEAR(date_of_expense) = '$year'";


        $incomesResult = $this->db->query($incomesQuery);
        $expensesResult = $this->db->query($expensesQuery);

        $incomeSumResult =$this->db->query($incomesSum);
        $expenseSumResult =$this->db->query($expenseSum);
        $incomeSumRow = $incomeSumResult->fetch_assoc();
        $expenseSumRow = $expenseSumResult->fetch_assoc();

        $expensePie = "SELECT name, SUM(amount) FROM expenses AS exp INNER JOIN 
		                        expenses_category_assigned_to_user AS ec ON exp.expenses_category_assigned_to_user_id = ec.id 
								AND exp.user_id = ec.user_id AND ec.user_id = '$id' AND exp.user_id = ec.user_id 
								AND MONTH(date_of_expense) = '$month' AND YEAR(date_of_expense) = '$year' AND exp.user_id = '$id' GROUP BY(name)";
													
        $expenseCategoryPie = $this->db->query($expensePie);
		
		$dataPoints = array();
	
	     while($row=$expenseCategoryPie->fetch_assoc()){
		
		    $dataPoints [] = array('label'=>$row['name'], 'y'=>$row['SUM(amount)']);	
	    }

        if((!$incomesResult) && (!$expensesResult) && (!$incomeSumResult) && (!$expenseSumResult)) {
			
            $news = "Błąd";
			
        } else if (($incomesResult->num_rows < 1) &&  ($expensesResult->num_rows < 1) && 
		          ($incomeSumResult->num_rows < 1) && ($expenseSumResult->num_rows < 1)) {
	
            $news = "Brak";
			
        } else 
		{

            $news = false;
            $incomesCounter = 1;
            $expensesCounter = 1;
            include('templates/balanceForm.php');
        }
    }

    function previousMonth() 
	{
		
        if(!$this->db) return SERVER_ERROR;

        $id = $this->loged->id;
	
        $month = date('m')-1;
        $year = date('Y');
	
        $incomesQuery = "SELECT date_of_income, amount, name, income_comment FROM 
		                            incomes AS inc INNER JOIN incomes_category_assigned_to_user AS ic ON inc.income_category_assigned_to_user_id = ic.id 
									AND inc.user_id = ic.user_id AND ic.user_id ='$id' AND inc.user_id = ic.user_id 
									AND MONTH(date_of_income) = '$month' AND YEAR(date_of_income) = '$year' AND inc.user_id = '$id'";

        $expensesQuery = "SELECT date_of_expense, amount, name, expense_comment FROM expenses AS exp 
                                      INNER JOIN expenses_category_assigned_to_user AS ec ON exp.expenses_category_assigned_to_user_id = ec.id AND 
									  exp.user_id = ec.user_id AND ec.user_id = '$id' AND exp.user_id = ec.user_id 
									  AND MONTH(date_of_expense) = '$month' AND YEAR(date_of_expense) = '$year' AND exp.user_id = '$id'";

        $incomesSum = "SELECT SUM(amount) FROM incomes WHERE user_id = '$id' 
		                          AND MONTH(date_of_income) = '$month' AND YEAR(date_of_income) = '$year'";
								  
       $expenseSum = "SELECT SUM(amount) FROM expenses WHERE user_id = '$id' 
	                            AND MONTH(date_of_expense) = '$month' AND YEAR(date_of_expense) = '$year'";


       $incomesResult = $this->db->query($incomesQuery);
       $expensesResult = $this->db->query($expensesQuery);
       
       $incomeSumResult =$this->db->query($incomesSum);
       $expenseSumResult =$this->db->query($expenseSum);
       $incomeSumRow = $incomeSumResult->fetch_assoc();
       $expenseSumRow = $expenseSumResult->fetch_assoc();
       
       $expensePie = "SELECT name, SUM(amount) FROM expenses AS exp INNER JOIN 
	                          expenses_category_assigned_to_user AS ec ON exp.expenses_category_assigned_to_user_id = ec.id AND exp.user_id = ec.user_id 
							  AND ec.user_id = '$id' AND exp.user_id = ec.user_id AND MONTH(date_of_expense) = '$month' 
							  AND YEAR(date_of_expense) = '$year' AND exp.user_id = '$id' GROUP BY(name)";
       
       $expenseCategoryPie = $this->db->query($expensePie);
	   
	   $dataPoints = array();
	
	     while($row=$expenseCategoryPie->fetch_assoc()){
		
		    $dataPoints [] = array('label'=>$row['name'], 'y'=>$row['SUM(amount)']);	
	    }

			
        if((!$incomesResult) && (!$expensesResult) && (!$incomeSumResult) && (!$expenseSumResult)) {
			
            $news = "Błąd";
			
        }else if (($incomesResult->num_rows < 1) &&  ($expensesResult->num_rows < 1) && 
		          ($incomeSumResult->num_rows < 1) && ($expenseSumResult->num_rows < 1)) {
        	
            $news = "Brak";
			
        } else {
        
        $news = false;
        $incomesCounter = 1;
        $expensesCounter = 1;
        include('templates/balanceForm.php');
	    }
    }

    function currentYear() 
	{
	
        if(!$this->db) return SERVER_ERROR;
        
        $id = $this->loged->id;
        	
        $month = date('m')-1;
        $year = date('Y');
        	
        $incomesQuery = "SELECT date_of_income, amount, name, income_comment FROM incomes AS inc 
		                            INNER JOIN incomes_category_assigned_to_user AS ic ON inc.income_category_assigned_to_user_id = ic.id AND inc.user_id = ic.user_id 
									AND ic.user_id ='$id' AND YEAR(date_of_income) = '$year' AND inc.user_id = '$id'";
        
        $expensesQuery = "SELECT date_of_expense, amount, name, expense_comment FROM expenses AS exp 
                                      INNER JOIN expenses_category_assigned_to_user AS ec ON exp.expenses_category_assigned_to_user_id = ec.id 
									  AND exp.user_id = ec.user_id AND ec.user_id = '$id' AND exp.user_id = ec.user_id 
									  AND YEAR(date_of_expense) = '$year' AND exp.user_id = '$id'";
        
        $incomesSum = "SELECT SUM(amount) FROM incomes WHERE user_id = '$id' 
		                          AND YEAR(date_of_income) = '$year'";
								  
        $expenseSum = "SELECT SUM(amount) FROM expenses WHERE user_id = '$id' 
		                          AND YEAR(date_of_expense) = '$year'";
        
        
        $incomesResult = $this->db->query($incomesQuery);
        $expensesResult = $this->db->query($expensesQuery);
        
        $incomeSumResult =$this->db->query($incomesSum);
        $expenseSumResult =$this->db->query($expenseSum);
        $incomeSumRow = $incomeSumResult->fetch_assoc();
        $expenseSumRow = $expenseSumResult->fetch_assoc();
        
        $expensePie = "SELECT name, SUM(amount) FROM expenses AS exp INNER JOIN expenses_category_assigned_to_user AS ec 
		                       ON exp.expenses_category_assigned_to_user_id = ec.id AND exp.user_id = ec.user_id AND ec.user_id = '$id'
							   AND YEAR(date_of_expense) = '$year' AND exp.user_id = '$id' GROUP BY(name)";
        
        $expenseCategoryPie = $this->db->query($expensePie);
		
		$dataPoints = array();
	
	     while($row=$expenseCategoryPie->fetch_assoc()){
		
		    $dataPoints [] = array('label'=>$row['name'], 'y'=>$row['SUM(amount)']);	
	    }
        
        			
        if((!$incomesResult) && (!$expensesResult) && (!$incomeSumResult) && (!$expenseSumResult)) {
			
            $news = "Błąd";
			
        } else if (($incomesResult->num_rows < 1) &&  ($expensesResult->num_rows < 1) && 
		            ($incomeSumResult->num_rows < 1) && ($expenseSumResult->num_rows < 1)) {
        	
              $news = "Brak";
				
        } else {
        
            $news = false;
            $incomesCounter = 1;
            $expensesCounter = 1;
            include('templates/balanceForm.php');
        }

    }

    function periodOfTime() {
    	
        if(!$this->db) return SERVER_ERROR;
        
        $start_date = $_POST['firstDate'];
        $end_date = $_POST['secondDate'];
        
        $id = $this->loged->id;
        	
        	
        $incomesQuery = "SELECT date_of_income, amount, name, income_comment FROM incomes AS 
		                            inc INNER JOIN incomes_category_assigned_to_user AS ic ON inc.income_category_assigned_to_user_id = ic.id 
									AND inc.user_id = ic.user_id AND ic.user_id ='$id' AND date_of_income BETWEEN '$start_date' AND '$end_date'  
									AND inc.user_id = '$id'";
        
        $expensesQuery = "SELECT date_of_expense, amount, name, expense_comment FROM expenses AS exp 
                                     INNER JOIN expenses_category_assigned_to_user AS ec ON exp.expenses_category_assigned_to_user_id = ec.id 
		                             AND exp.user_id = ec.user_id AND ec.user_id = '$id' AND exp.user_id = ec.user_id 
		                             AND date_of_expense BETWEEN '$start_date' AND '$end_date' AND exp.user_id = '$id'";
        
        $incomesSum = "SELECT SUM(amount) FROM incomes WHERE user_id = '$id' 
	                             AND date_of_income BETWEEN '$start_date' AND '$end_date'";
								 
        $expenseSum = "SELECT SUM(amount) FROM expenses WHERE user_id = '$id' 
		                         AND date_of_expense BETWEEN '$start_date' AND '$end_date'";
        
        
        $incomesResult = $this->db->query($incomesQuery);
        $expensesResult = $this->db->query($expensesQuery);
        
        $incomeSumResult =$this->db->query($incomesSum);
        $expenseSumResult =$this->db->query($expenseSum);
        $incomeSumRow = $incomeSumResult->fetch_assoc();
        $expenseSumRow = $expenseSumResult->fetch_assoc();
        
        $expensePie = "SELECT name, SUM(amount) FROM expenses AS exp INNER JOIN expenses_category_assigned_to_user AS ec 
		                       ON exp.expenses_category_assigned_to_user_id = ec.id AND exp.user_id = ec.user_id AND ec.user_id = '$id'
							   AND date_of_expense BETWEEN '$start_date' AND '$end_date' AND exp.user_id = '$id' GROUP BY(name)";
        
        $expenseCategoryPie = $this->db->query($expensePie);
		
		$dataPoints = array();
	
	     while($row=$expenseCategoryPie->fetch_assoc()){
		
		    $dataPoints [] = array('label'=>$row['name'], 'y'=>$row['SUM(amount)']);	
	    }
        
        			
        if((!$incomesResult) && (!$expensesResult) && (!$incomeSumResult) && (!$expenseSumResult)) {
			
            $news = "Błąd";
			
        } else if (($incomesResult->num_rows < 1) &&  ($expensesResult->num_rows < 1) 
			        && ($incomeSumResult->num_rows < 1) && ($expenseSumResult->num_rows < 1)) {
        	
            $news = "Brak";
			
        } else {
        
            $news = false;
            $incomesCounter = 1;
            $expensesCounter = 1;
            include('templates/balanceForm.php');
        }
    }
}
?>