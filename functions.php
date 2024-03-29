<?php 

session_start();

function signup($data)
{
	$errors = array();
 
	//validate 
	if(!preg_match('/^[a-zA-Z]+$/', $data['username'])){
		$errors[] = "Please enter a valid username";
	}

	if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
		$errors[] = "Please enter a valid email";
	}

	if(strlen(trim($data['password'])) < 4){
		$errors[] = "Password must be atleast 4 chars long";
	}

	if($data['password'] != $data['password2']){
		$errors[] = "Passwords must match";
	}

	$check = database_run("select * from userdetail where email = :email limit 1",['email'=>$data['email']]);
	if(is_array($check)){
		$errors[] = "That email already exists";
	}

	//save
	if(count($errors) == 0){

		$arr['username'] = $data['username'];
		$arr['email'] = $data['email'];
		$arr['password'] = hash('sha256',$data['password']);
		// $arr['date'] = date("Y-m-d H:i:s");
		$arr['number'] = $data['number'];
		$arr['address'] = $data['address'];

		$query = "insert into userdetail (username,email,password,number,address) values 
		(:username,:email,:password,:number,:address)";

		database_run($query,$arr);
	}
	return $errors;
}

function login($data)
{
	$errors = array();
 
	//validate 
	if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
		$errors[] = "Please enter a valid email";
	}
	
	// Validate Password Length
	if (strlen(trim($data['password'])) < 4) {
		$errors[] = "Password must be at least 4 characters long";
	}
 
	//check
	if(count($errors) == 0){

		$arr['email'] = $data['email'];
		$password = hash('sha256', $data['password']);

		$query = "select * from userdetail where email = :email limit 1";

		

		$row = database_run($query,$arr);
		print_r($row);

		if(is_array($row)){
			$row = $row[0];
			print_r($row->password);

			if($password == $row->password){
				
				$_SESSION['USER'] = $row;
				$_SESSION['LOGGED_IN'] = true;
			}else{
				$errors[] = "wrong email or password";
			}

		}else{
			$errors[] = "wrong email or password";
		}
	}
	return $errors;
}

function database_run($query,$vars = array())
{
	$string = "mysql:host=localhost;dbname=verifyuser";
	$con = new PDO($string,'root','');

	if(!$con){
		return false;
	}

	$stm = $con->prepare($query);
	$check = $stm->execute($vars);

	if($check){
		
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		if(count($data) > 0){
			return $data;
		}
	}

	return false;
}

function check_login($redirect = true){

	if(isset($_SESSION['USER']) && isset($_SESSION['LOGGED_IN'])){

		return true;
	}

	if($redirect){
		header("Location: login.php");
		die;
	}else{
		return false;
	}
	
}



