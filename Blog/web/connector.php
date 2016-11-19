<?php

class MyDB extends SQLite3
{
    
    function __construct()
    {
        $this->open('../../DB Browser for SQLite/myDB.db')
    }
 
    $db = new MyDB
        
    if(!$db){
        
        echo $db->lastErrorMsg();
        
    }
    
}