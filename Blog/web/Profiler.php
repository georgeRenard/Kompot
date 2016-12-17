<?php


class Profiler
{

    private $id;
    private $country;
    private $city;
    private $gender;
    private $genres;
    
    public function __construct($id,$country,$city,$genres,$gender){

        $this->sanitizeInput($city,$country);
        $this->gender = SQLite3::escapeString($gender);
        $this->genres = SQLite3::escapeString($genres);
        $this->id = SQLite3::escapeString($id);
        
    }
    
    #DB Query function
    private function dbQuery($query="")
    {
        
        $db = new SQLite3_module();
        $dbPath = "../../DB Browser for SQLite/myDB.db";
        $dbr = $db->db_oper($dbPath,$query);
        return $dbr; 
        
    }
    
    private function profileExists(){

        $query = "SELECT * FROM userOptionalData WHERE id = '$this->id'";
        
        $result = $this->dbQuery($query);
        
        return $result;
    
    }
    
    private function sanitizeInput($city,$country)
    {
        
        $city = trim($city);
        $city = strip_tags($city);
        $city = SQLite3::escapeString($city);
        $this->city = htmlspecialchars($city);
    
        $country = trim($country);
        $country = strip_tags($country);
        $country = SQLite3::escapeString($country);
        $this->country = htmlspecialchars($country);
        
        
    }
    

    private function deriveQueryType(){

        $defaultImageUrl = "../../Default-Profile-Picture.jpg";
        $queryType = "";
        $isPresent = false;
        $result = $this->profileExists();
        $country = $this->city . ", " . $this->country;
        
        if(!empty($result)){
            $isPresent = true;
            $defaultImageUrl = $result[0]['imageUrl'];
        }
        
        if($isPresent){
            $queryType = "UPDATE userOptionalData SET id = '$this->id' , gender = '$this->gender', country = '$this->country'
            , genre = '$this->genres' , imageUrl = '$defaultImageUrl'";
        }else {
            $queryType = "INSERT OR IGNORE INTO userOptionalData(id,gender,country,genre,imageUrl) VALUES ('$this->id','$this->gender','$country','$this->genres','$defaultImageUrl')";
        }
        
        return $queryType;
        
    }
    
    public function saveProfileData()
    {
        $queryType = $this->deriveQueryType();
        
        $result = $this->dbQuery($queryType);
        
        return empty($result);
        
    }
    
    
}





