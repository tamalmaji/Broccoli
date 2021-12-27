<?php
require_once "../config/_dbconnection.php";
$name = '';
$login = '';
$email = '';
$pwd = '';
$cpwd = '';
$date = date('Y-m-d H:i:s');
$type = 3;

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
    } else {
        $sql = 'SELECT user_id  FROM broccoli_users WHERE user_email = :email';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':email', $email);
            if ($statement->execute()) {
                if ($statement->rowCount() === 1) {
                    $email_err = 'Email is alrady exits';
                }
            } else {
                die('Somthing Went Wrong');
            }
        }
        unset($statement);
    }

    if (empty($login)) {
        $login_err = 'Please Enter Login id';
    } else {
        $sql = 'SELECT user_id  FROM broccoli_users WHERE user_login  = :login';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':login', $login);
            if ($statement->execute()) {
                if ($statement->rowCount() === 1) {
                    $login_err = 'Login id is alrady exits';
                }
            } else {
                die('Somthing Went Wrong');
            }
        }
        unset($statement);
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
                header('location: login.php');
            }
        }
    }
    unset($pdo);
}
?>
<?php include_once "../partials/header.php" ?>
<!-- Utilize Cart Menu Start -->
<!-- <div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
        <div class="ltn__utilize-menu-inner ltn__scrollbar">
            <div class="ltn__utilize-menu-head">
                <span class="ltn__utilize-menu-title">Cart</span>
                <button class="ltn__utilize-close">×</button>
            </div>
            <div class="mini-cart-product-area ltn__scrollbar">
                <div class="mini-cart-item clearfix">
                    <div class="mini-cart-img">
                        <a href="#"><img src="img/product/1.png" alt="Image"></a>
                        <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                    </div>
                    <div class="mini-cart-info">
                        <h6><a href="#">Red Hot Tomato</a></h6>
                        <span class="mini-cart-quantity">1 x $65.00</span>
                    </div>
                </div>
                <div class="mini-cart-item clearfix">
                    <div class="mini-cart-img">
                        <a href="#"><img src="img/product/2.png" alt="Image"></a>
                        <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                    </div>
                    <div class="mini-cart-info">
                        <h6><a href="#">Vegetables Juices</a></h6>
                        <span class="mini-cart-quantity">1 x $85.00</span>
                    </div>
                </div>
                <div class="mini-cart-item clearfix">
                    <div class="mini-cart-img">
                        <a href="#"><img src="img/product/3.png" alt="Image"></a>
                        <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                    </div>
                    <div class="mini-cart-info">
                        <h6><a href="#">Orange Sliced Mix</a></h6>
                        <span class="mini-cart-quantity">1 x $92.00</span>
                    </div>
                </div>
                <div class="mini-cart-item clearfix">
                    <div class="mini-cart-img">
                        <a href="#"><img src="img/product/4.png" alt="Image"></a>
                        <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                    </div>
                    <div class="mini-cart-info">
                        <h6><a href="#">Orange Fresh Juice</a></h6>
                        <span class="mini-cart-quantity">1 x $68.00</span>
                    </div>
                </div>
            </div>
            <div class="mini-cart-footer">
                <div class="mini-cart-sub-total">
                    <h5>Subtotal: <span>$310.00</span></h5>
                </div>
                <div class="btn-wrapper">
                    <a href="cart.html" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                    <a href="cart.html" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                </div>
                <p>Free Shipping on All Orders Over $100!</p>
            </div>

        </div>
    </div> -->
<!-- Utilize Cart Menu End -->

<!-- Utilize Mobile Menu Start -->
<?php include_once "../partials/mobileMenu.php" ?>

<!-- Utilize Mobile Menu End -->

<div class="ltn__utilize-overlay"></div>

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="img/bg/9.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                    <div class="section-title-area ltn__section-title-2">
                        <h6 class="section-subtitle ltn__secondary-color">// Welcome to our company</h6>
                        <h1 class="section-title white-color">Account</h1>
                    </div>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>Register</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<!-- LOGIN AREA START (Register) -->
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Register <br>Your Account</h1>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. <br>
                        Sit aliquid, Non distinctio vel iste.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="account-login-inner">
                    <form action="register.php" method="POST" class="ltn__form-box contact-form-box">
                        <div class="form-group">
                            <input type="text" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" name="name" placeholder="Enter Name" value="<?php echo $name; ?>">
                            <samp class="invalid-feedback"><?php echo $name_err; ?></samp>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control <?php echo (!empty($login_err)) ? 'is-invalid' : ''; ?>" name="login" placeholder="Enter login Id" value="<?php echo $login; ?>">
                            <samp class="invalid-feedback"><?php echo $login_err; ?></samp>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" name="email" placeholder="Enter Email" value="<?php echo $email; ?>">
                            <samp class="invalid-feedback"><?php echo $email_err; ?></samp>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control <?php echo (!empty($pwd_err)) ? 'is-invalid' : ''; ?>" name="pwd" placeholder="Enter Password" value="<?php echo $pwd; ?>">
                            <samp class="invalid-feedback"><?php echo $pwd_err; ?></samp>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control <?php echo (!empty($cpwd_err)) ? 'is-invalid' : ''; ?>" name="cpwd" placeholder="Enter Confirm Password" value="<?php echo $cpwd; ?>">
                            <samp class="invalid-feedback"><?php echo $cpwd_err; ?></samp>
                        </div>
                        <div class="btn-wrapper">
                            <button class="theme-btn-1 btn reverse-color btn-block" type="submit">CREATE ACCOUNT</button>
                        </div>
                    </form>
                    <!-- <div class="by-agree text-center">
                        <p>By creating an account, you agree to our:</p>
                        <p><a href="#">TERMS OF CONDITIONS &nbsp; &nbsp; | &nbsp; &nbsp; PRIVACY POLICY</a></p>
                        <div class="go-to-btn mt-50">
                            <a href="login.html">ALREADY HAVE AN ACCOUNT ?</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- LOGIN AREA END -->

<!-- FEATURE AREA START ( Feature - 3) -->
<div class="ltn__feature-area before-bg-bottom-2 mb--30--- plr--5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__feature-item-box-wrap ltn__border-between-column white-bg">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="ltn__feature-item ltn__feature-item-8">
                                <div class="ltn__feature-icon">
                                    <img src="img/icons/icon-img/11.png" alt="#">
                                </div>
                                <div class="ltn__feature-info">
                                    <h4>Curated Products</h4>
                                    <p>Provide Curated Products for
                                        all product over $100</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="ltn__feature-item ltn__feature-item-8">
                                <div class="ltn__feature-icon">
                                    <img src="img/icons/icon-img/12.png" alt="#">
                                </div>
                                <div class="ltn__feature-info">
                                    <h4>Handmade</h4>
                                    <p>We ensure the product quality
                                        that is our main goal</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="ltn__feature-item ltn__feature-item-8">
                                <div class="ltn__feature-icon">
                                    <img src="img/icons/icon-img/13.png" alt="#">
                                </div>
                                <div class="ltn__feature-info">
                                    <h4>Natural Food</h4>
                                    <p>Return product within 3 days
                                        for any product you buy</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="ltn__feature-item ltn__feature-item-8">
                                <div class="ltn__feature-icon">
                                    <img src="img/icons/icon-img/14.png" alt="#">
                                </div>
                                <div class="ltn__feature-info">
                                    <h4>Free home delivery</h4>
                                    <p>We ensure the product quality
                                        that you can trust easily</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FEATURE AREA END -->
<?php include_once "../partials/footer.php" ?>