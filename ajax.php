<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}

if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}

if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}

if($action == 'signup_borrower'){
	$save = $crud->signup_borrower();
	if($save)
		echo $save;
}
if($action == 'signup_lender'){
	$save = $crud->signup_lender();
	if($save)
		echo $save;
}

if($action == "save_borrower"){
	$save = $crud->save_borrower();
	if($save)
		echo $save;
}

if($action == "save_loan"){
	$save = $crud->save_loan();
	if($save)
		echo $save;
}
if($action == "sanction_loan"){
	$save = $crud->sanction_loan();
	if($save)
		echo $save;
}
if($action == "delete_loan"){
	$save = $crud->delete_loan();
	if($save)
		echo $save;
}

if($action == "save_payment"){
	$save = $crud->save_payment();
	if($save)
		echo $save;
}
if($action == "delete_payment"){
	$save = $crud->delete_payment();
	if($save)
		echo $save;
}
if($action == "post_review"){
	$save = $crud->post_review();
	if($save)
		echo $save;
}
if($action == "post_aadhar"){
	$save = $crud->post_aadhar();
	if($save)
		echo $save;
}
