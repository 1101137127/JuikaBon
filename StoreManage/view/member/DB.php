<?php

$servername = 'localhost';
$username = 'misuser';
$password = 'misuser';
$dbname = 'misuser';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->exec("set name utf8");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
//$conn = null;
?>