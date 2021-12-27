<?php

$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('location: users.php');
    exit;
}
require_once "../../config/_dbconnection.php";
$sqi = 'SELECT * FROM broccoli_users WHERE user_id = :id';
$statements = $pdo->prepare($sqi);
$statements->bindValue(':id', $id);
$statements->execute();

$user = $statements->fetch(PDO::FETCH_ASSOC);

$sql = 'DELETE FROM broccoli_users WHERE user_id = :id';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        if ($user['users_img']) {
            unlink('../../public/' . $user['users_img']);
        }
        $sqll = 'DELETE FROM broccoli_shippingaddress WHERE user_id = :id';
        if ($statementt = $pdo->prepare($sqll)) {
            $statementt->bindValue(':id', $id);
            if ($statementt->execute()) {
                header('location: users.php');
            }
        }
    }

    
}
