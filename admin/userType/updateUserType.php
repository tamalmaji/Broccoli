<?php

require_once "../../config/_dbconnection.php";
$id = $_GET['id'] ?? NULL;
if (!$id) {
    header('location: userType.php');
}
$sql = 'SELECT * FROM broccoli_usertype WHERE userType_id = :id';
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();
$userType = $statement->fetch(PDO::FETCH_ASSOC);

$title = $userType['userType_name'];
$date = date('Y-m-d H:i:s');
$title_err = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_POST = filter_input_array(INPUT_POST);
    $title = trim($_POST['title']);
    
    // for validate title
    if (empty($title)) {
        $title_err = 'Please Enter a userType title';
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
        $sql = 'UPDATE broccoli_usertype SET userType_name = :title, update_at = :update_at WHERE  userType_id = :id';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':title', $title);
            $statement->bindValue(':update_at', $date);
            $statement->bindValue(':id', $id);
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
            <a href="userType.php" class="btn btn-outline-primary">Back to userType</a>
        </div>
        <div class="col-12 mt-5">
            <?php include_once "_formuserType.php" ?>
        </div>
    </div>
</div>

<?php include_once "../basbord-partials/footer.php" ?>