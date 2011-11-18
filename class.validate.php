<?php //class.validate.php
include('class.database.php');
class Validate extends Database{
	var $display;
	var $questions;
	function __construct(){
		//Set questions array
		$this->questions = $this->query("SELECT * FROM questions");
		
		//Start session
		session_start();
		if(!$_SESSION['Authorized']) $_SESSION['Authorized'] = 0;		
	}
	
	public function clean($str){
		return addslashes(stripslashes(trim($str)));	
	}
	
	public function login($username,$password){
		$username = is_string($username) && !is_null($username) ? $this->clean($username) : '';
		$password = is_string($password) && !is_null($password) ?  $this->clean($password) : '';
		$check = $this->query("SELECT * FROM users WHERE username='$username' AND password=AES_ENCRYPT('$password','".parent::AESKEY."');");
		$check = $check[0];
		if($check){
			session_start();
			$_SESSION['Authorized'] = 1;
			$_SESSION['First_Name'] = $check['first_name'];
			$_SESSION['Last_Name'] = $check['last_name'];
			return true;
		}else{
			return false;	
		}
		
	}
	
	public function logout(){
		session_start();
		$_SESSION['Authorized'] = 0;
		session_destroy();	
	}
	
	public function register($username,$password,$firstname,$lastname,$question,$answer){
		$username = is_string($username) && !is_null($username) ? $this->clean($username) : '';
		$password = is_string($password) && !is_null($password) ?  $this->clean($password) : '';
		$firstname = is_string($firstname) && !is_null($firstname) ? $this->clean($firstname) : '';
		$lastname = is_string($lastname) && !is_null($lastname) ? $this->clean($lastname) : '';
		$question = is_integer($question*1) && !is_null($question) ? $this->clean($question) : '';
		$answer = is_string($answer) && !is_null($answer) ? $this->clean($answer) : '';
		if($firstname&&$lastname&&$username&&$password&&$question&&$answer){
			$insert = $this->query("INSERT IGNORE users SET
				first_name='$firstname',
				last_name='$lastname',
				username ='$username',
				password=AES_ENCRYPT('$password','".parent::AESKEY."'),
				q_id='$question',
				q_answer='$answer'
			");
			return $insert;
		}else{
			return false;	
		}
	}
	
	public function confirmsecret($username,$question,$answer){
		$username = is_string($username) && !is_null($username) ? $this->clean($username) : '';
		$question = is_integer($question*1) && !is_null($question) ? $this->clean($question) : '';
		$answer = is_string($answer) && !is_null($answer) ? $this->clean($answer) : '';
		$check = $this->query("SELECT AES_DECRYPT(password,'".parent::AESKEY."') AS password, first_name FROM users WHERE username='$username' 
			AND q_id='$question'
			AND q_answer='$answer'
		");
		$check = $check[0];
		if($check){
			return $check['password'];
		}else{
			return false;
		}
	}
	
	public function questionsDropDown($name){
		$questions = $this->questions;
		$questions_dropdown = "<select name='$name'>";
		foreach($questions as $v){
			$questions_dropdown .= "<option value='{$v['id']}'>{$v['question']}</option>";
		}
		$questions_dropdown .= "</select>";
		return $questions_dropdown;
	}
}

?>