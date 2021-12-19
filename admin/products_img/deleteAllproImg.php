<?php
$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('location: productsImg.php');
    exit;
}
require_once "../../config/_dbconnection.php";

$sqli = 'SELECT * FROM broccoli_product_images  WHERE product_id  = :id';
if ($statement = $pdo->prepare($sqli)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        $pros = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($pros as $key => $pro) {
            # code...
            if ($pro['images']) {
                unlink('../../public/' . $pro['images']);
            }
        }
        $sqll = 'DELETE FROM broccoli_product_images WHERE product_id = :id';
        if ($statements = $pdo->prepare($sqll)) {
            $statements->bindValue(':id', $id);
            if ($statements->execute()) {
                header('location: productsImg.php');
            }
        }
    }
}
