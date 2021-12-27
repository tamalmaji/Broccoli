<?php

$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('location: users.php');
    exit;
}
require_once "../config/_dbconnection.php";
$sql = 'DELETE FROM broccoli_shippingaddress WHERE shippingAddress_id  = :id';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':id', $id);
    $statement->execute();
    header('location: ../public/account.php');
    
}
