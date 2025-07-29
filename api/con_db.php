<?php 


$servername = 'LAPTOP-CAMALIG\SQLEXPRESS';
$username = 'sa';
$password = 'Jerickivan_29';
$database = 'MyajaxDB';

try{
    $mycon = new PDO("sqlsrv:Server=$servername;Database=$database", $username, $password);
    $mycon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connection Success';
}catch(PDOException $e){
    die('No Connection' . $e->getMessage());
}



?>