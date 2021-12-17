<?php
$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('location: userType.php');
    exit;
}
require_once "../../config/_dbconnection.php";

$sqli = 'SELECT * FROM broccoli_product WHERE product_id  = :id';
if ($statement = $pdo->prepare($sqli)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        $product = $statement->fetch(PDO::FETCH_ASSOC);
        if ($product['product_img']) {
            unlink('../../public/'.$product['product_img']);
        }
    }
}


$sql = 'DELETE FROM broccoli_product  WHERE product_id = :id';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        header('location: product.php');
    }
}
