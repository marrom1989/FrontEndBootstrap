<?php

class User
{

    public $id;
    public $nick;

    function __construct($id, $nick) 
	{
	
       $this->id = $id;
       $this->nick = $nick;
    }
}
?>