<?php

require_once "../../config/_dbconnection.php";
$title = '';
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
        $sql = 'INSERT INTO broccoli_catagory (catagory_name, create_at, update_at) 
        VALUE(:title, :create_at, :update_at)';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':title', $title);
            $statement->bindValue(':create_at', $date);
            $statement->bindValue(':update_at', $date);
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

<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="catagory.php" class="btn btn-outline-primary">Back to Catagory</a>
        </div>
        <div class="col-12 mt-5">
            <?php include_once "_formCatagory.php" ?>
        </div>
    </div>
</div>

<?php include_once "../basbord-partials/footer.php" ?>