<?php
$id = $_POST['id'] ?? NULL;
if (!$id) {
    header('location: catagory.php');
    exit;
}
require_once "../../config/_dbconnection.php";
$statement = $pdo->prepare('DELETE FROM broccoli_catagory  WHERE catagory_id  = :id');
$statement->bindValue(':id', $id);
$statement->execute();
header('location: catagory.php');