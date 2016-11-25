<?php
require_once('class.sqlite3.inc.php');
require_once('DataRetriever.php');
require_once('CredentialValidator.php');

class User
{
 
    private $email;
    private $name;
    private $password;
    private $confirmEmail;
    private $confirmPassword;
    
    
    protected function initializePendingUser()
    {
        
        return array('name' => $this->name, 'email' => $this->email, 'password' => $this->password, 'confirmEmail' => $this->confirmEmail,
                    'confirmPassword' => $this->confirmPassword);
         
    }
        
    public function __construct($email,$password,$name="",$confirmEmail="",$confirmPassword=""){
        
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->confirmEmail = $confirmEmail;
        $this->confirmPassword = $confirmPassword;
        
        #Process the credentials
        
        $this->sqlEscape();
        $this->convertUserData();
        
    }
    
    
    #DB Query function
    private function dbQuery($query="")
    {
        
        $db = new SQLite3_module();
        $dbPath = "../../DB Browser for SQLite/myDB.db";
        $dbr = $db->db_oper($dbPath,$query);
        return $dbr; 
        
    }

    
    private function sqlEscape()
    {
        
       $this->name = SQLite3::escapeString($this->name);
       $this->email = SQLite3::escapeString($this->email);
       $this->password = SQLite3::escapeString($this->password);
       $this->confirmEmail = SQLite3::escapeString($this->confirmEmail);
       $this->confirmPassword = SQLite3::escapeString($this->confirmPassword);
        
    }
    
    private function convertUserData()
    {
        
        #Name Extraction / No HTML TAGS / No Special HTML Chars
        $this->name = trim($this->name);
        $this->name = strip_tags($this->name);
        $this->name = htmlspecialchars($this->name);
        
        #Email Extraction / No HTML TAGS / No Special HTML Chars
        $this->email = trim($this->email);
        $this->email = strip_tags($this->email);
        $this->email = htmlspecialchars($this->email);
        $this->confirmEmail = trim($this->confirmEmail);
        $this->confirmEmail = strip_tags($this->confirmEmail);
        $this->confirmEmail = htmlspecialchars($this->confirmEmail);
        
        #Password Extraction / No HTML TAGS / No Special HTML Chars    
        $this->password = trim($this->password);
        $this->password = strip_tags($this->password);
        $this->password = htmlspecialchars($this->password);
        $this->confirmPassword = trim($this->confirmPassword);
        $this->confirmPassword = strip_tags($this->confirmPassword);
        $this->confirmPassword = htmlspecialchars($this->confirmPassword);
        
    }
    
    
    public function registerUser()
    {
        
       #Encrypting the password using SHA256
       if(strlen($password) > 20){
         $password = hash('sha256',$password);  
       }
       
       #Registered on Timestamp:    
       $timestamp = new DateTime();
       $timestamp = date_format($timestamp,'Y-m-d T H:i:s');
        
       $query = "INSERT OR IGNORE INTO users(name,password,email,register) VALUES('$name','$password','$email','$timestamp')";
       $result = $this->dbQuery($query);
       
           
    }
    
    public function loginValidation($email,$password)
    {
        $email = SQLite3::escapeString($this->email);
        $password = SQLite3::escapeString($this->password);
        $password = hash('sha256',$password);
        $query = "SELECT id,email,password,name FROM users WHERE email = '$email'";
       
        $result = $this->dbQuery($query);
        $dbr = $result['0'];
        
        $credentials = new CredentialValidator($this);
        $doPasswordsMatch = $credentials->arePasswordsEqual($password,$dbr['password']);
        
        if (!empty($dbr) && $doPasswordsMatch)
        {   
            unset($email);
            unset($password);
            return $dbr['id'];
        }else{
            
            return false;
            
        }
        
    
    }
    
            
        
        
    
    
    
}

?>