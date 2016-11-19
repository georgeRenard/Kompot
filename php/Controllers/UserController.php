<?php


class UserController
{
    
    
    private function dbQuery($query=""){ __autoload("sqlite3"); $dbpath = $this->db; $db = new SQLite3_module(); //$query = "SELECT rowid,status,email,registered,updated,user FROM users WHERE status>='1'"; $dbr = $db->db_oper($dbpath,$query); return $dbr; } а където искаш да го извикаш ползваш тези редове... $query = "INSERT OR IGNORE INTO users (status,email,password,crc,registered,user) VALUES ('9','$email','$password','$crc','$registered','$user')"; //echo $query; $dbr = $db->db_oper($dbpath,$query);
                                        
                                        
    private function addUserEntry()
    {
        
        $userName = $_POST['user[name]'];
        $password = $_POST['user[password]'];
        $email = $_POST['user[email]'];
        $passwordConfirm = $_POST['user[confirmPassword]'];
        
        if($password == $passwordConfirm){
            $query = "INSERT OR IGNORE INTO users (name,password,email) VALUES ('$name','$password','$email')";
            
            echo $query;
            $dbr = $db->db_oper($dbpath,$query);
            
        }else{
            
            header("Location: ../Kompot Website/Blog/web/register.html");
            die();
        }
        
    }
                                        
}
