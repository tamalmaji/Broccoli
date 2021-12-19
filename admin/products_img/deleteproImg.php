<?php

$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('Location : productsImg.php');
    exit;
}

require_once "../../config/_dbconnection.php";

$sqli = 'SELECT * FROM broccoli_product_images WHERE id = :id';
if ($statement = $pdo->prepare($sqli)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        $pro = $statement->fetch(PDO::FETCH_ASSOC);
        if ($pro['images']) {
            unlink('../../public/'. $pro['images']);
        }
        $sql = 'DELETE FROM broccoli_product_images WHERE id = :id';
        if ($statements = $pdo->prepare($sql)) {
            $statements->bindValue(':id', $id);
            if ($statements->execute()) {
                header('location: productsImg.php');
            }
        }
    }
} 
