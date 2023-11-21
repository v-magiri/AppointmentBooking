<?php

$database="appointmentPortal";
$host="localhost";
$dbuser="root";
$dbpassword='';

try{
    $conn=new PDO("mysql:host=$host;dbname=$database",$dbuser,$dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection succesful";
}catch(PDOException $e){
    die("Connection failed".$e->getMessage());
}