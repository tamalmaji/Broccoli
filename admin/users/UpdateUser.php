<?php
require_once "../../config/_dbconnection.php";
$id = $_GET['id'] ?? NULL;
if (!$id) {
    header('location: users.php');
    exit;
}
$sql = 'SELECT * FROM broccoli_users WHERE user_id = :id';
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

$statements = $pdo->prepare('SELECT * FROM broccoli_usertype');
$statements->execute();
$catagorys = $statements->fetchAll(PDO::FETCH_ASSOC);

$type = $user['user_type'];

$statementss = $pdo->prepare('SELECT * FROM broccoli_usertype WHERE userType_id = :catid');
$statementss->bindValue(':catid', $type);
$statementss->execute();
$catId = $statementss->fetch(PDO::FETCH_ASSOC);

// $uType = ['userType_name'];

$name = $user['user_nicename'];
$login = $user['user_login'];
$email = $user['user_email'];
$type = $user['user_type'];
$date = date('Y-m-d H:i:s');
$upload_dir = '';

$img_err = '';
$name_err = '';
$login_err = '';
$email_err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_EMAIL);

    $name = trim($_POST['name']);
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $type = trim($_POST['type']);

    if (empty($name)) {
        $name_err = 'Please Enter Name';
    }

    if (empty($login)) {
        $login_err = 'Please Enter Login id';
    }
    if (empty($email)) {
        $email_err = 'Please Enter Email';
    }
    include_once "./userImage.php";

    if (empty($name_err) && empty($login_err) && empty($email_err) && empty($img_err)) {
        $sql = 'UPDATE broccoli_users SET user_login = :login, user_nicename = :name, user_email = :email, user_type = :type, users_img = :users_img, update_at = :update_at WHERE user_id = :id';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':login', $login);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':type', $type);
            $statement->bindValue(':users_img', $upload_dir);
            $statement->bindValue(':update_at', $date);
            $statement->bindValue(':id', $id);
            if ($statement->execute()) {
                header('location: users.php');
            }
        }
    }
    unset($pdo);
}

?>
<?php include_once "../basbord-partials/header.php" ?>

<div class=" mb-5 content-wrapper" style="min-height: 485.139px;">
    <div class="row m-5">
        <div class="col-12">
            <a href="users.php" class="btn btn-outline-primary">Back to Users</a>
        </div>
        <div class="col-12 mt-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="">
                    <label for="exampleInputFile">Update Your Images</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            <input type="file" class="custom-file-input <?php echo (!empty($img_err)) ? 'is-invalid' : ''; ?>" id="exampleInputFile" name="file">
                            <samp class="invalid-feedback"><?php echo $img_err; ?></samp>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" name="name" placeholder="Enter Name" value="<?php echo $name; ?>">
                    <samp class="invalid-feedback"><?php echo $name_err; ?></samp>
                </div>
                <div class="form-group">
                    <label for="login">User Login id</label>
                    <input type="text" class="form-control <?php echo (!empty($login_err)) ? 'is-invalid' : ''; ?>" name="login" placeholder="Enter login Id" value="<?php echo $login; ?>">
                    <samp class="invalid-feedback"><?php echo $login_err; ?></samp>
                </div>
                <div class="form-group">
                    <label for="email">User Email</label>
                    <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" name="email" placeholder="Enter Email" value="<?php echo $email; ?>">
                    <samp class="invalid-feedback"><?php echo $email_err; ?></samp>
                </div>
                <div class="form-group">
                    <label for="userType">User Type</label>
                    <select class="form-select" name='type'>
                        <option value="<?php echo $catId['userType_id']; ?>">
                            <?php echo $catId['userType_name']; ?>
                        </option>
                        <?php foreach ($catagorys as $i => $catagory) : ?>
                            <option value="<?php echo $catagory['userType_id'] ?>"><?php echo $catagory['userType_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div>
<br>
<br><br>
<?php include_once "../basbord-partials/footer.php" ?>