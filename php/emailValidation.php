<?php

    require('class.sqlite3.php');
    
    private function dbQuery($query=""){ __autoload("sqlite3");
    $dbpath = $this->db; 
    $db = new SQLite3_module();
    
    $query = "SELECT email FROM users WHERE email = ";
                                        
    $dbr = db_oper($dbpath,$query);