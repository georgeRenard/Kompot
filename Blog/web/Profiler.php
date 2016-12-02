<?php


class Profiler
{
    
    
    
    public function renderProfile($email,$gender,$country,$genre)
    {
        
        $id = DataRetriever::getUserId($email);
        $defaultImageUrl = "../../Default-Profile-Picture.jpg";
        $query = "INSERT OR IGNORE INTO userOptionalData(id,gender,country,genre,imageUrl) VALUES ('$id','$gender','$country','$genre')";
        
        $result = $this->dbQuery($query);
        if(!empty($result))
        {
            
            return;
            
        }
            
    }
    
    
}





