<?php //class.database.php
class Database{
	const DB_NAME = 'wd_db';
	const DB_HOST = 'localhost';
	const DB_USER = 'wd_user';
	const DB_PASS = 'password';
	const AESKEY = 'lakj023lea02ajde0le';
	
	var $conn; // Set a global connection
	
	private function connect() {
		//Establish a mysql link and connect to the database
		$this->conn = mysql_connect(self::DB_HOST,self::DB_USER,self::DB_PASS,true) or die("ERROR: Unable to connect ".mysql_error());
		mysql_select_db(self::DB_NAME,$this->conn);
		
		//Set utf8 encoding to ensure encoding is consistent with database
		mysql_set_charset("utf8",$this->conn);
	}
	
    public function query($sql) {
		$result = array(); //Set result to NULL in case no result exists
		
		if (!$this->conn) $this->connect(); //If no connection exists, connect to the database.
	
		$q = mysql_query($sql,$this->conn) or die("Error: ".mysql_error());
		
		if ($q){//If the query is successful, fetch the result and add it to an array
			while($r = mysql_fetch_assoc($q)){
				$result[] = $r; 
			}
		}
		if(strstr(strtolower($sql),'insert')) $result = mysql_insert_id();
		mysql_free_result($q); //Free up the memory
		return $result;
    }
	
}

?>