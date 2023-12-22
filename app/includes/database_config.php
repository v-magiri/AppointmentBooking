<?php
include './config.php';

$host = $config['DB_HOST'];
$port = $config['DB_PORT'];
$database = $config['DB_DATABASE'];
$dbuser = $config['DB_USERNAME'];
$dbpassword = $config['DB_PASSWORD'];

// $database="MYSQL_DATABASE";
// $host="db";
// $dbuser="MYSQL_USER";
// $dbpassword='MYSQL_PASSWORD';

try{
    // $conn=new PDO("mysql:host=$host;dbname=$database",$dbuser,$dbpassword);
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$database", $dbuser, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection succesful";
}catch(PDOException $e){
    die("Connection failed".$e->getMessage());
}