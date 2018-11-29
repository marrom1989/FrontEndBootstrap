<?php
class Portal 
{
	
    private $db = null;

    function __construct($host, $user, $pass, $db)
	{
	
        $this->db = $this->initDB($host, $user, $pass, $db);
		
    }

    function initDB($host, $user, $pass, $db) 
	{
	
        $db = new MyDB($host, $user, $pass, $db);
        $db -> query ('SET NAMES utf8');
        $db -> query ('SET CHARACTER_SET utf8_unicode_ci');
		
        if($db->connect_errno){
			
            $com = "Nie można się połączyć z bazą danych: ";
            $com .= $db->connect_errno;
            throw new Exception($com);
        }
		
        return $db;
    }
}
?>