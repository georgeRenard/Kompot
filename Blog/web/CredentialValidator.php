<?php

require_once('User.php');

class CredentialValidator extends User
{
    
    private $user;
    
    public function __construct(User $user){
        
        $this->user = $user->initializePendingUser();
    
    }

    #DB Query function
    private function dbQuery($query="")
    {
        
        $db = new SQLite3_module();
        $dbPath = "../../DB Browser for SQLite/myDB.db";
        $dbr = $db->db_oper($dbPath,$query);
        return $dbr; 
        
    }
    
    public function isNameValid()
    {

       $error = false;
       $nameError = '';
       $name = $this->user['name'];

       if(empty($name)){
           
           $error = true;
           $nameError = "Please enter your full name.";
           
       }else if(strlen($name) < 4){
           
           $error = true;
           $nameError = "Name must have atleast 4 characters.";
           
       }else if(!preg_match("/^[a-zA-Z ]+$/", $name)){
           
           $error = true;
           $nameError = "Name must contain only alphabets and space.";
           
       }
        
       return array('errorMsg' => $nameError, 'hasError' => $error);
        
    }
    
    public function isPasswordValid(){
        
       #String Validation [Password];
        
       $error = false;
       $passwordError = '';
       $password = $this->user['password'];
       $confirmPassword = $this->user['confirmPassword'];    
        
       if(empty($password)){
           
           $error = true;
           $passwordError = "Please enter password.";
           
       }else if(strlen($password) < 6){
           
           $error = true;
           $passwordError = "Password must have atleast 6 characters.";
           
       }else if(($confirmPassword != "") && (!$this->arePasswordsEqual($password,$confirmPassword))){
           
           $error = true;
           $passwordError = "Passwords do not match";
           
       }
        
       return array('errorMsg' => $passwordError, 'hasError' => $error);
        
    }
    
    protected function arePasswordsEqual($password,$confirmPassword)
    {
        
        return $password == $confirmPassword;        
    }
    
    protected function areEmailsEqual($email,$confirmEmail)
    {

        return $email == $confirmEmail;
        
    }
    
    function isEmailValid(){
        
       #String Validations [Email]
       $error = false;
       $emailError = '';
       $email = $this->user['email'];
       $confirmEmail = $this->user['confirmEmail'];
        
       if((!filter_var($email,FILTER_VALIDATE_EMAIL)) || (!filter_var($confirmEmail,FILTER_VALIDATE_EMAIL)))
       {
           
           $error = true;
           $emailError = "Please enter a valid email adress.";
           
       }else if($email == $confirmEmail){
           
           #Check if the Email already exists in the Database
           $query = "SELECT email FROM users WHERE email='$email'";
           $result = $this->dbQuery($query);
           
           if(!empty($result)){
               $error = true;
               $emailError = "The provided Email is already in use.";
           }
           
       }else {
           $error=true;
           $emailError = "Emails do not match";
       }
        
       return array('errorMsg' => $emailError, 'hasError' => $error);
        
    }
    
}
