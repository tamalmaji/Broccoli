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

$oPwd = '';
$pwd = '';
$cpwd = '';
$date = date('Y-m-d H:i:s');

$oPwd_err = '';
$pwd_err = '';
$cpwd_err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_EMAIL);

    $oPwd = trim($_POST['oPwd']);
    $pwd = trim($_POST['pwd']);
    $cpwd = trim($_POST['cpwd']);

    if (empty($cpwd)) {
        $oPwd_err = 'Please enter old Password';
    }else{
        $sqli = 'SELECT user_pass FROM broccoli_users WHERE user_id = :id';
        if ($statements = $pdo->prepare($sqli)) {
            $statements->bindValue(':id', $id);
            if ($statements->execute()) {
                $row = $statements->fetch(PDO::FETCH_ASSOC);
                $haspassword = $row['user_pass'];
                if (password_verify($oPwd, $haspassword)) {
                    // echo 'password metch';
                }else{
                    $oPwd_err = 'The password you enterd is not valid';
                }
            }
        }
    }


    if (empty($pwd)) {
        $pwd_err = 'Please enter Password and Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters ';
    } elseif (strlen($pwd) < 8 || strlen($pwd) > 16) {
        $pwd_err = "Password should be min 8 characters and max 16 characters";
    } elseif (!preg_match("/\b/", $pwd)) {
        $pwd_err = "Password should  contain  at least one digite";
    } elseif (!preg_match("/[A-Z]/", $pwd)) {
        $pwd_err = "Password should  contain at least one Capital Letter";
    } elseif (!preg_match("/[a-z]/", $pwd)) {
        $pwd_err = "Password should  contain at least one Small Letter";
    } elseif (!preg_match("/\W/", $pwd)) {
        $pwd_err = "Password should  contain at least one special character";
    } elseif (preg_match("/\s/", $pwd)) {
        $pwd_err = "Password should not contain any white space";
    }
    if (empty($cpwd)) {
        $cpwd_err = 'Please enter Confirm Password';
    }
    if ($pwd !== $cpwd) {
        $cpwd_err = 'Password do not match';
    }


    if (empty($oPwd_err) && empty($pwd_err) && empty($cpwd_err)) {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $sql = 'UPDATE broccoli_users SET user_pass = :oPwd, update_at = :update_at WHERE user_id = :id';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':oPwd', $pwd);
            $statement->bindValue(':id', $id);
            $statement->bindValue(':update_at', $date);
            if ($statement->execute()) {
                header('location: users.php');
            }else{
                die('Somthing Went Wrong');
            }
        }unset($statement);
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
            <form action="" method="post">
                <div class="form-group">
                    <label for="pwd">Old User Password</label>
                    <input type="password" class="form-control <?php echo (!empty($oPwd_err)) ? 'is-invalid' : ''; ?>" name="oPwd" placeholder="Enter Password" value="<?php echo $oPwd; ?>">
                    <samp class="invalid-feedback"><?php echo $oPwd_err; ?></samp>
                </div>
                <div class="form-group">
                    <label for="pwd">New User Password</label>
                    <input type="password" class="form-control <?php echo (!empty($pwd_err)) ? 'is-invalid' : ''; ?>" name="pwd" placeholder="Enter Password" value="<?php echo $pwd; ?>">
                    <samp class="invalid-feedback"><?php echo $pwd_err; ?></samp>
                </div>
                <div class="form-group">
                    <label for="pwd">New User Confirm Password</label>
                    <input type="password" class="form-control <?php echo (!empty($cpwd_err)) ? 'is-invalid' : ''; ?>" name="cpwd" placeholder="Enter Confirm Password" value="<?php echo $cpwd; ?>">
                    <samp class="invalid-feedback"><?php echo $cpwd_err; ?></samp>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div>
<br>
<br><br>
<?php include_once "../basbord-partials/footer.php" ?>