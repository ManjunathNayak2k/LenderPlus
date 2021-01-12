<?php
session_start();
ini_set('display_errors', 1);
include 'db.php';
use Kreait\Firebase\Factory;

Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
	include 'db.php';

    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password')
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}

	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}


	function save_user(){
		extract($_POST);


		if(empty($id)){
			$save = $this->db->query("INSERT INTO `users`(`username`,`password`,`type`) VALUES('$username','$password',$type)");
		}else{
			$save = $this->db->query("UPDATE `users` SET `username`='$username',`password`='$password',`type`=$type WHERE id = ".$id);
		}
		if($save)
			return 1;
		else
			return $this->db->error;
	}
	
	function delete_user(){
		extract($_POST);

		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}

	function save_loan(){
		
	extract($_POST);
	$date = date('Y-m-d');

	if(empty($id)){
		
		$ref_no = mt_rand(1,99999999);
		$i = 1;

		$qry = $this->db->query("SELECT ApplicationID FROM loan_application ORDER BY ApplicationID DESC LIMIT 1");
		
		if($qry->num_rows > 0){
			$check = $qry->fetch_array();
			$check1 = $check[0]+1;
			// $save = $this->db->query("INSERT INTO loan_list ('ref_no', 'loan_type_id', 'borrower_id', 'purpose', 'amount', 'plan_id', 'date_released') VALUES (");
			$check2 = $this->db->query("SELECT Income FROM borrower WHERE BorrowerID = ".$Borrower_id)->fetch_array();

			$response = file_get_contents('http://likithlending.herokuapp.com/params?loan_amnt='.$principal.'&term='.$term.'&int_rate='.$interest.'&annual_inc='.$check2[0].'');
			// return $response;
			$save = $this->db->query("INSERT INTO `loan_application`(`ApplicationID`,`Principal`, `Status`, `BorrowerID`, `InterestRate`, `Term`, `Rating`,`ApplicationDate`) VALUES ($check1,$principal,0,$Borrower_id,$interest,$term, $response,STR_TO_DATE('$date', '%Y-%m-%d'))");
		}
		else{
			$check1 = 1;
			$check = $this->db->query("SELECT Income FROM borrower WHERE BorrowerID = ".$Borrower_id)->fetch_array();

			$response = file_get_contents('http://likithlending.herokuapp.com/params?loan_amnt='.$principal.'&term='.$term.'&int_rate='.$interest.'&annual_inc='.$check[0].'');
			// return $response;
			$save = $this->db->query("INSERT INTO `loan_application`(`ApplicationID`,`Principal`, `Status`, `BorrowerID`, `InterestRate`, `Term`, `Rating`,`ApplicationDate`) VALUES ($check1,$principal,0,$Borrower_id,$interest,$term, $response,STR_TO_DATE('$date', '%Y-%m-%d'))");

		}
		if($save)
			return 1;
		else
			return $this->db->error;	

	}
	else{
		$Borrower_id = 	$this->db->query("SELECT BorrowerID FROM loan_application WHERE loan_application.ApplicationID = ".$id)->fetch_array();

		$save = $this->db->query("UPDATE `loan_application` SET `Principal`=$principal,`Status`=0,`BorrowerID`=$Borrower_id[0],`InterestRate`=$interest,`Term`=$term WHERE `ApplicationID`=$id");
		$check = $this->db->query("SELECT Income FROM loan_application,borrower WHERE loan_application.BorrowerID = borrower.BorrowerID and loan_application.ApplicationID = ".$id)->fetch_array();
		$response = file_get_contents('http://likithlending.herokuapp.com/params?loan_amnt='.$principal.'&term='.$term.'&int_rate='.$interest.'&annual_inc='.$check[0].'');
		$save = $this->db->query("UPDATE `loan_application` SET `Rating`=$response WHERE `ApplicationID`=$id");

		if($save)
			return 1;
		else
			return $this->db->error;
	}
	}
	function delete_loan(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM loan_application where ApplicationID = ".$id);
		if($delete)
			return 1;
		else
			return $this->db->error;
	}

	function sanction_loan(){
		
		extract($_POST);
		$date = date('Y-m-d');
		// return ("".$date);
		
		$save = $this->db->query("UPDATE `loan_application` SET `Status`=1 WHERE `ApplicationID`=$id");
		$appl = $this->db->query("SELECT * FROM `loan_application` WHERE `ApplicationID`=$id");

		foreach($appl->fetch_array() as $k => $v){
			$temp[$k] = $v;
		}
		
		$principal=$temp['Principal'];
		$bID=$temp['BorrowerID'];
		$lID=$_SESSION['login_id'];
		
		$appl = $this->db->query("SELECT * FROM `loan` ORDER BY LoanID DESC LIMIT 1");
		$num = mysqli_num_rows($appl);
		if($num == 0)
			$save = $this->db->query("INSERT INTO `loan`(`LoanID`, `Status`, `BorrowerID`, `LenderID`, `ApplicationID`, `DateCreated`) VALUES (1,0,$bID,$lID,$id,STR_TO_DATE('$date', '%Y-%m-%d'))");
		else
		{
			$check = $this->db->query("SELECT LoanID FROM loan ORDER BY LoanID DESC LIMIT 1")->fetch_array();
			$check1 = $check[0]+1;
			$save = $this->db->query("INSERT INTO `loan`(`LoanID`, `Status`, `BorrowerID`, `LenderID`, `ApplicationID`, `DateCreated`) VALUES ($check1,0,$bID,$lID,$id,STR_TO_DATE('$date', '%Y-%m-%d'))");
		}
		
		if($save)
			return 1;
		else
			return $this->db->error;
	}

	function signup_borrower(){
		extract($_POST);
		
		$data = " First Name = '$firstname' ";
		$data .= ", Last name = '$lastname' ";
		$data .= ", Email = '$email' ";
		$data .= ", Password = '".md5($password)."' ";
		$data .= ", Birthday = '$birthday' ";
		$data .= ", Gender = '$gender' ";
		$data .= ", Education = '$edu' ";
		$data .= ", Profession = '$profession' ";
		$data .= ", Income = '$income' ";
		$data .= ", Phone Number = '$phone' ";
		$data .= ", Aadhar = '$aadhar' ";
		$id = 3;

		$chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
		if($chk > 0){
			return 2;
		}
		$save = $this->db->query("INSERT INTO `users`(`username`,`password`,`type`) VALUES ('$email','$password',$id)");
		
		$check = $this->db->query("SELECT id FROM users where username = '$email'")->fetch_array();
		$check1 = $check[0];

		$save = $this->db->query("INSERT INTO `borrower`(`BorrowerID`, `FIrstName`, `LastName`, `Birthday`, `Gender`, `Education`, `Profession`, `Income`, `PhoneNumber`, `Aadhar`) VALUES ($check1,'$firstname','$lastname',STR_TO_DATE('$birthday', '%Y-%m-%d'),'$gender','$edu','$profession',$income,$phone,$aadhar)");
		if($save)
			return 1;
		else
			return $this->db->error;
		
		return ($save);
	}

	function signup_lender(){
		extract($_POST);
		
		$data = " First Name = '$firstname' ";
		$data .= ", Last name = '$lastname' ";
		$data .= ", Email = '$email' ";
		$data .= ", Password = '".md5($password)."' ";
		$data .= ", Birthday = '$birthday' ";
		$data .= ", Gender = '$gender' ";
		
		$data .= ", Phone Number = '$phone' ";
		$data .= ", Aadhar = '$aadhar' ";
		$id = 2;

		$chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
		if($chk > 0){
			return 2;
		}
		
		$save = $this->db->query("INSERT INTO `users`(`username`,`password`,`type`) VALUES ('$email','$password',$id)");
		
		$check = $this->db->query("SELECT id FROM users where username = '$email'")->fetch_array();
		$check1 = $check[0];

		$save = $this->db->query("INSERT INTO `lender`(`LenderID`, `FIrstName`, `LastName`, `Birthday`, `Gender`, `PhoneNumber`, `Aadhar`) VALUES ($check1,'$firstname','$lastname',STR_TO_DATE('$birthday', '%Y-%m-%d'),'$gender',$phone,$aadhar)");
		if($save)
			return 1;
		else
			return $this->db->error;
		
		return ($save);
	}
	
	function save_payment(){
		extract($_POST);
		$date = date('Y-m-d');
		// return ("".$date);
		
		$save = $this->db->query("UPDATE `loan` SET `Status`=1 WHERE `ApplicationID`=$id");
		// return 2;
		$appl = $this->db->query("SELECT * FROM `loan`,`loan_application` WHERE loan.ApplicationID=loan_application.ApplicationID AND loan.ApplicationID=".$id." and loan_application.ApplicationID=".$id);

		foreach($appl->fetch_array() as $k => $v){
			$temp[$k] = $v;
		}
		
		$principal=$temp['Principal'];
		$bID=$temp['BorrowerID'];
		$loanID=$temp['LoanID'];
		$lID=$_SESSION['login_id'];
		$term=$temp['Term'];
		$interest=$temp['InterestRate'];

		$total = ($principal + ($principal * ($interest/100) * ($term/12))) ;
		
		$appl = $this->db->query("SELECT * FROM `payments` ORDER BY PaymentID DESC LIMIT 1");
		$num = mysqli_num_rows($appl);
		if($num == 0)
		{
			$save = $this->db->query("INSERT INTO `payments`(`PaymentID`, `LoanID`, `LenderID`, `BorrowerID`, `PaymentDate`, `Amount`) VALUES (1,$loanID,$lID,$bID,STR_TO_DATE('$date', '%Y-%m-%d'),$total)");
		}	
		else
		{
			$check = $this->db->query("SELECT PaymentID FROM payments ORDER BY `payments` DESC LIMIT 1")->fetch_array();
			$check1 = $check[0]+1;
			$save = $this->db->query("INSERT INTO `payments`(`PaymentID`, `LoanID`, `LenderID`, `BorrowerID`, `PaymentDate`, `Amount`) VALUES ($check1,$loanID,$lID,$bID,STR_TO_DATE('$date', '%Y-%m-%d'),$total)");
		}
		
		if($save)
			return 1;
		else
			return $this->db->error;
		

	}

	function post_review(){
		extract($_POST);
		$date = date('Y-m-d');
		require_once './vendor/autoload.php';
    
		
		$factory = (new Factory())
			->withDatabaseUri('https://php-lend-default-rtdb.firebaseio.com');
		
		
		$database = $factory->createDatabase();
			$data = [
				'id' => $_SESSION['login_id'],
				'username' => $_SESSION['login_username'],
				'date' => $date,
				'feedback' => $review
			];

			$ref = "feedback/";
			$pushData =  $database->getReference($ref)->push($data);
		return 1;
	}
	function post_aadhar(){
		extract($_POST);
		
		require_once './vendor/autoload.php';
    
		
		$factory = (new Factory())
			->withDatabaseUri('https://php-lend-default-rtdb.firebaseio.com');
		
		
		$database = $factory->createDatabase();
			$data = [
				'id' => $_SESSION['login_id'],
				'aadhar' => $aadhar
			];

			$ref = "aadhar/";
			$pushData =  $database->getReference($ref)->push($data);
		return 1;
	}
}