<?php

$database="MYSQL_DATABASE";
$host="db";
$dbuser="MYSQL_USER";
$dbpassword='MYSQL_PASSWORD';

try{
    $conn=new PDO("mysql:host=$host;dbname=$database",$dbuser,$dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection succesful";
}catch(PDOException $e){
    die("Connection failed".$e->getMessage());
}