<?php
$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('location: product.php');
    exit;
}
require_once "../../config/_dbconnection.php";

$sqli = 'SELECT * FROM broccoli_product  WHERE product_id  = :id';
if ($statement = $pdo->prepare($sqli)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        $pros = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($pros as $key => $pro) {
            # code...
            if ($pro['product_img']) {
                unlink('../../public/'. $pro['product_img']);
            }
        }
        $sql = 'DELETE FROM broccoli_product  WHERE product_id = :id';
        if ($statements = $pdo->prepare($sql)) {
            $statements->bindValue(':id', $id);
            if ($statements->execute()) {

                $sqll = 'DELETE FROM broccoli_product_images WHERE product_id = :id';
                if ($statementss = $pdo->prepare($sqll)) {
                    $statementss->bindValue(':id', $id);
                    if ($statementss->execute()) { 
                        header('location: product.php');
                    }
                }
            }
        }
    }
}
