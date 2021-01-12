<?php

require_once './vendor/autoload.php';
    
use Kreait\Firebase\Factory;

$factory = (new Factory())
    ->withDatabaseUri('https://php-lend-default-rtdb.firebaseio.com');


$database = $factory->createDatabase();


?>