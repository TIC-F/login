<?php
$server = 'localhost';
$username = 'root';
$password = '1234';
$database = 'php_login_database';
try {
$conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
}catch(PDOExpection $e){
    die('Connected failed: '.$e->getMessage());
}
?>