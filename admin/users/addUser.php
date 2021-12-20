<?php
require_once "../../config/_dbconnection.php";

$name = '';
$login = '';
$email = '';
$pwd = '';
$cpwd = '';
$date = date('Y-m-d H:i:s');
$type = 0;

$name_err = '';
$login_err = '';
$email_err = '';
$pwd_err = '';
$cpwd_err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_EMAIL);

    $name = trim($_POST['name']);
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $pwd = trim($_POST['pwd']);
    $cpwd = trim($_POST['cpwd']);

    if (empty($name)) {
        $name_err = 'Please Enter Name';
    }

    if (empty($email)) {
        $email_err = 'Please Enter Email';
    }else{
        $sql = 'SELECT user_id  FROM broccoli_users WHERE user_email = :email';
        if ($statement = $pdo->prepare($sql)) {
           $statement->bindValue(':email', $email);
           if ($statement->execute()) {
               if ($statement->rowCount() === 1) {
                   $email_err = 'Email is alrady exits';
               }
            }else{
                die('Somthing Went Wrong');
           }
        }
        unset($statement);
    }

    if (empty($login)) {
        $login_err = 'Please Enter Login id';
    }else{
        $sql = 'SELECT user_id  FROM broccoli_users WHERE user_login  = :login';
        if ($statement = $pdo->prepare($sql)) {
           $statement->bindValue(':login', $login);
           if ($statement->execute()) {
               if ($statement->rowCount() === 1) {
                   $login_err = 'Login id is alrady exits';
               }
            }else{
                die('Somthing Went Wrong');
           }
        }
        unset($statement);
    }

    if (empty($pwd)) {
       $pwd_err = 'Please enter Password and Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters ';
    }elseif(strlen($pwd) < 8 || strlen($pwd) > 16){
        $pwd_err = "Password should be min 8 characters and max 16 characters";
    }elseif( !preg_match("/\b/", $pwd)){
        $pwd_err = "Password should  contain  at least one digite";
    }elseif( !preg_match("/[A-Z]/", $pwd)){
        $pwd_err = "Password should  contain at least one Capital Letter";
    }elseif( !preg_match("/[a-z]/", $pwd)){
        $pwd_err = "Password should  contain at least one Small Letter";
    }elseif( !preg_match("/\W/", $pwd)){
        $pwd_err = "Password should  contain at least one special character";
    }elseif(preg_match("/\s/", $pwd)){
        $pwd_err = "Password should not contain any white space";
    }
    if (empty($cpwd)) {
        $cpwd_err = 'Please enter Confirm Password';
     }
    if ($pwd !== $cpwd) {
         $cpwd_err = 'Password do not match';
    }
    if (empty($name_err) && empty($login_err) && empty($email_err) && empty($pwd_err) && empty($cpwd_err)) {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO broccoli_users (user_login, user_pass, user_nicename, user_email, user_type, create_at, update_at) 
        VALUES (:login, :pwd, :name, :email, :type, :create_at, :update_at)';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':login', $login);
            $statement->bindValue(':pwd', $pwd);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':type', $type);
            $statement->bindValue(':create_at', $date);
            $statement->bindValue(':update_at', $date);
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
    <div class="row">
        <div class="col-12">
            <a href="userType.php" class="btn btn-outline-primary">Back to Users</a>
        </div>
        <div class="col-12 mt-5">
            <?php include_once "_formUser.php" ?>
        </div>
    </div>
</div>
<br>
<br><br>
<?php include_once "../basbord-partials/footer.php" ?>