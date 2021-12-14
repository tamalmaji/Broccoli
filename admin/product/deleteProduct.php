<?php
$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('location: userType.php');
    exit;
}
require_once "../../config/_dbconnection.php";
$statement = $pdo->prepare('DELETE FROM broccoli_product  WHERE product_id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
header('location: product.php');