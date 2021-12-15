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
        $sql = 'SELECT userType_id  FROM broccoli_usertype WHERE userType_name = :title';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':title', $title);
            if ($statement->execute()) {
                if ($statement->rowCount() === 1) {
                    $title_err = 'UserType alrady exits';
                }
            }else{
                die('Somthing went Wrong');
            }
        }
        unset($statement);
    }
    
    if (empty($title_err)) {
        $sql = 'INSERT INTO broccoli_usertype (userType_name, create_at, update_at) 
        VALUE(:title, :create_at, :update_at)';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':title', $title);
            $statement->bindValue(':create_at', $date);
            $statement->bindValue(':update_at', $date);
            if ($statement->execute()) {
                header('location: userType.php');
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
            <a href="userType.php" class="btn btn-outline-primary">Back to UserType</a>
        </div>
        <div class="col-12 mt-5">
            <?php include_once "_formUserType.php" ?>
        </div>
    </div>
</div>

<?php include_once "../basbord-partials/footer.php" ?>