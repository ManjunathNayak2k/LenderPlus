<?php
include("db.php");



if(isset($_POST['push'])){
    $name = $_POST['name'];
    $email = $_POST['email'];


    $data = [
        'name' => $name,
        'email' => $email
    ];

    $ref = "contact_form_data/";
    $pushData =  $database->getReference($ref)->push($data);
}


if(isset($_POST['set'])){
    $name = $_POST['name'];
    $email = $_POST['email'];

    $data = [
        'name' => $name,
        'email' => $email
    ];

    $ref = "contact_form_data/";
    $pushData =  $database->getReference($ref)->set($data);
}


    
?>