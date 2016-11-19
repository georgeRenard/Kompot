<?php

class MyDB extends SQLite3
   {
      function __construct($file)
      {
         $this->open($file);
      }
   }



class SQLite3_module
{	
	public function db_test($file_location = "../../DB Browser for SQLite/myDB.db"){
		
		/*
		$check_start = mb_substr($file_location, 0, 3);
		if ($check_start !== "../"){	$file_location = "../".$file_location;	}
		
		$file_location_exp = explode("/",$file_location);
		$file_path = "";
		foreach ($file_location_exp as $key => $value) {
			if (strpos($value,".db") === false) {
				$file_path .= $value."/";
			}
		}
		*/
		//echo "<br /> file_location: $file_location <br /> file_path: $file_path<br /> ";
		
		if (!file_exists($file_location)) {
			echo "Database file was not found!!!<br />";
			echo "Creating $file_location file:<br />";
			fopen($file_location,"w") or die ("Unable to create the file!");
			$this->db_create($file_location);
			
		} else {
			//echo "Файлът $file_location съществува<br />";
		}
	}
	
	
	
	public function db_result($result){
		foreach($result as $key=>$value){
			foreach($value as $key1=>$value1){
				$res = array($key1,$value1);
			}
		}
		return $res;
	}
	
	
	
	private function db_open($file, $shout="mute"){
		$db = new MyDB($file);
		if(!$db){
		  echo $db->lastErrorMsg();
		} else {
		  if ($shout !== "mute")	{	echo "Database opened successfully<br />";	}
		}
		$db->busyTimeout(5000);
		return $db;
	}
	
	private function db_create($file_location){
		require_once("__autoload.php");
		__autoload("cipher");
		
        $registered = date("Y-m-d H:i:s",time());
		$email = mb_strtolower(adminUsername,"UTF-8");
		$password = hash("sha256",passwordAdmin);
		$crc = Cipher::crc_encrypt($email." || ".$registered, cryptSalt);
		$crcAuth = Cipher::crc_encrypt($email." || ".$registered.' || B.U.K.U.', cryptSalt);
		
		
		//CREATE TABLE IF NOT EXISTS "products" ("status" INTEGER, "id" VARCHAR NOT NULL, "givenName" VARCHAR NOT NULL, "description" VARCHAR NOT NULL, "fabric" VARCHAR NOT NULL, "price" INTEGER, "shipping" INTEGER, "spacer" CHAR, "registered" VARCHAR, "updated" VARCHAR, "user" VARCHAR, PRIMARY KEY ("id", "givenName"));
        
        $sql =<<<EOF
	CREATE TABLE IF NOT EXISTS "users" ("status" INTEGER, "email" VARCHAR NOT NULL UNIQUE, "password" VARCHAR NOT NULL , "crc" text, "spacer" CHAR, "registered" VARCHAR, "confirmed" VARCHAR, "updated" VARCHAR, "user" VARCHAR, PRIMARY KEY ("email", "crc"));
	
	CREATE TABLE IF NOT EXISTS "profile" ("status" INTEGER, "email" VARCHAR NOT NULL UNIQUE, "first" VARCHAR, "last" VARCHAR, "address" VARCHAR, "city" VARCHAR, "state" VARCHAR, "zip" VARCHAR, "country" VARCHAR, "phone" VARCHAR, "crc" text, "spacer" CHAR, "registered" VARCHAR, "updated" VARCHAR, "user" VARCHAR, PRIMARY KEY ("email", "crc"));
		
	CREATE TABLE IF NOT EXISTS "products" ("status" INTEGER, "AD" VARCHAR NOT NULL, "AC" INTEGER,"givenName" VARCHAR NOT NULL, "description" VARCHAR NOT NULL, "fabric" VARCHAR NOT NULL, "price" FLOAT, "shipping" FLOAT, "permalink" VARCHAR NOT NULL, "keywords" TEXT, "meta" TEXT, "spacer" CHAR, "registered" VARCHAR, "updated" VARCHAR, "user" VARCHAR, PRIMARY KEY ("AD","AC","permalink","givenName"));
	
	CREATE TABLE IF NOT EXISTS "auth" ("user" VARCHAR NOT NULL , "crc" VARCHAR, "info" TEXT, "method" TEXT, "registered" VARCHAR DEFAULT CURRENT_TIMESTAMP);
	
	INSERT INTO "users" (status,email,password,crc,registered,confirmed,user) VALUES ('1', '$email', '$password', '$crc', '$registered', '$registered', 'B.U.K.U.');
	INSERT INTO "profile" (status,email,first,last,address,city,state,zip,country,phone,crc,registered,user) VALUES ('1', '$email', 'B.U.K.U.', '', '', '', '', '', '', '', '$crcAuth', '$registered', 'B.U.K.U.');
EOF;

        $db = $this->db_open($file_location);

        $ret = $db->exec($sql);

        if(!$ret){
          echo $db->lastErrorMsg();
        } else {
          echo "Table created successfully<br />";
        }

        $db->close();	
	}
    
	
	public function db_create_ext($file_location, $sql, $shout = "shout"){
        
            $tableName = explode('"', substr($sql,0,80));
        
			if (file_exists($file_location)) {
				$sqlTable = "SELECT CASE WHEN (SELECT 1 FROM sqlite_master WHERE type='table' AND name='".$tableName[1]."') THEN 1 ELSE 0 END AS found FROM sqlite_master LIMIT 1";
				
				$testTable = $this->db_oper($file_location, $sqlTable);
				
				if ($testTable[0]["found"] === 0){
					$db = $this->db_open($file_location, $shout);
					
					$ret = $db->exec($sql);
					
					if(!$ret){
					  echo $db->lastErrorMsg();
					} else {
					  if ($shout !== "mute"){	echo "Table created successfully<br />";	}
					}
				
					$db->close();
				}
				 
			} else {
				if ($shout !== "mute"){	echo "The database file: $file_location does not exists<br />";	}
                $this->db_create($file_location);
			}	
	}
	
	public function db_oper($file_location, $sql){
		$array = array();
		if (file_exists($file_location)) {
				
			$db = $this->db_open($file_location, "mute");
			
			$res = $db->query($sql);
			if (strpos($sql,'INSERT') === false){
				while($row = $res->fetchArray(SQLITE3_ASSOC) ){
					$array[] = $row;
				}
				$db->close();
				return $array;
			}
			 
		} else {
			echo "The database file: $file_location does not exists<br />";
		}
	}

}



?>