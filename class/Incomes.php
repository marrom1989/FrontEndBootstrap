<?php

class Incomes 
{
	
    private $db = null;
    private $loged = null;

    function __construct($db, $loged) 
	{
	
        $this-> db = $db;
        $this-> loged = $loged;
	
    }

    function addValues() 
	{
	
        if(!$this->db) return SERVER_ERROR;

        if(!isset($_POST['price']) || !isset($_POST['date']) || !isset($_POST['category'])) {
	    return FROM_DATA_MISSING;
		
    }

        $price = $_POST['price'];
        $date = $_POST['date'];
        $category = $_POST['category'];
        $comment = $_POST['comment'];
        $id = $this->loged->id;
        
        $query = "INSERT INTO incomes(user_id, income_category_assigned_to_user_id, amount, 
		               date_of_income, income_comment) VALUES ((SELECT user_id FROM users WHERE user_id = '$id'), 
					   (SELECT id FROM incomes_category_assigned_to_user WHERE name = '$category' AND user_id = '$id'),
					   '$price', '$date', '$comment')";
        
        $result = $this->db->query($query);
        	
        if($result) {
        	
            return ACTION_OK;
			
        } else {
        	
            return ACTION_FAILED;
        }
	
	
    }
}

?>