<?php

require_once "../../config/_dbconnection.php";
$id = $_GET['id'] ?? NULL;
if (!$id) {
    header('location: catagory.php');
}
$sql = 'SELECT * FROM broccoli_catagory WHERE catagory_id = :id';
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();
$catagory = $statement->fetch(PDO::FETCH_ASSOC);

$title = $catagory['catagory_name'];
$date = date('Y-m-d H:i:s');
$title_err = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_POST = filter_input_array(INPUT_POST);
    $title = trim($_POST['title']);
    
    // for validate title
    if (empty($title)) {
        $title_err = 'Please Enter a catagory title';
    }else{
        $sql = 'SELECT catagory_id FROM broccoli_catagory WHERE catagory_name = :title';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':title', $title);
            if ($statement->execute()) {
                if ($statement->rowCount() === 1) {
                    $title_err = 'Catagory alrady Exits';
                }
            }else{
                die('Somthing Went Worng');
            }
        }
        unset($statement);
    }
    
    if (empty($title_err)) {
        $sql = 'UPDATE broccoli_catagory SET catagory_name = :title, update_at = :update_at WHERE  catagory_id = :id';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':title', $title);
            $statement->bindValue(':update_at', $date);
            $statement->bindValue(':id', $id);
            if ($statement->execute()) {
                header('location: catagory.php');
            }else{
                die('Somthing Went Worong');
            }
        }
        unset($pdo);
    }
}

?>
<?php include_once "../basbord-partials/header.php" ?>

<div class=" content-wrapper" style="min-height: 485.139px;">
    <div class="row m-5">
        <div class="col-12">
            <a href="catagory.php" class="btn btn-outline-primary">Back to Catagory</a>
        </div>
        <div class="col-12 mt-5">
            <?php include_once "_formCatagory.php" ?>
        </div>
    </div>
</div>

<?php include_once "../basbord-partials/footer.php" ?>