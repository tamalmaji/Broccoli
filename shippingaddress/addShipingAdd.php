<?php
session_start();
require_once "../config/_dbconnection.php";
if (!isset($_SESSION['user_login']) || empty($_SESSION['user_login'])) {
    header('location: login.php');
}
$login = $_SESSION['user_login'] ?? NULL;
$sql = 'SELECT * FROM broccoli_users  WHERE user_login = :login';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':login', $login);
    if ($statement->execute()) {
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    }
}

$sqli = 'SELECT * FROM broccoli_shippingaddress WHERE user_id = :user_id';
?>
<?php
$user_id = $user['user_id'];
$fName = '';
$num = '';
$pin = '';
$build = '';
$street = '';
$landmark = '';
$city = '';
$state = '';
$date = date('Y-m-d H:i:s');

$fName_err = '';
$num_err = '';
$pin_err = '';
$build_err = '';
// $street_err = '';
// $landmark_err = '';
$city_err = '';
$state_err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST);

    $fName = trim($_POST['fName']);
    $num =  trim($_POST['num']);
    $pin =  trim($_POST['pin']);
    $build =  trim($_POST['build']);
    $street =  trim($_POST['street']);
    $landmark =  trim($_POST['landmark']);
    $city =  trim($_POST['city']);
    $state =  trim($_POST['state']);

    if (empty($fName)) {
        $fName_err = 'Please enter a name.';
    }
    if (empty($num)) {
        $num_err = 'Please enter a phone number so we can call if there are any issues with delivery.';
    }
    if (empty($pin)) {
        $pin_err = 'Please enter a ZIP or postal code.';
    }
    if (empty($build)) {
        $build_err = 'Please enter an address.';
    }
    if (empty($city)) {
        $city_err = 'Please enter a city name.';
    }
    if (empty($state)) {
        $state_err = 'Please enter a state, region or province.';
    }

    if (empty($fName_err) && empty($num_err) && empty($pin_err) && empty($build_err) && empty($city_err) && empty($state_err)) {
        $sqll = 'INSERT INTO broccoli_shippingaddress (user_id, shippingAddress_fname, shippingAddress_mNum, shippingAddress_pin, shippingAddress_house, shippingAddress_street, shippingAddress_landmark, shippingAddress_city, create_at, update_at) 
        VALUE(:user_id, :shippingAddress_fname, :shippingAddress_mNum, :shippingAddress_pin, :shippingAddress_house, :shippingAddress_street, :shippingAddress_landmark, :shippingAddress_city, :create_at, :update_at)';

        if ($statementt = $pdo->prepare($sqll)) {
            $statementt->bindValue(':user_id', $user_id);
            $statementt->bindValue(':shippingAddress_fname', $fName);
            $statementt->bindValue(':shippingAddress_mNum', $num);
            $statementt->bindValue(':shippingAddress_pin', $pin);
            $statementt->bindValue(':shippingAddress_house', $build);
            $statementt->bindValue(':shippingAddress_street', $street);
            $statementt->bindValue(':shippingAddress_landmark', $landmark);
            $statementt->bindValue(':shippingAddress_city', $city);
            $statementt->bindValue(':create_at', $date);
            $statementt->bindValue(':update_at', $date);
            if ($statementt->execute()) {
                header('location: ../public/account.php');
            }
        }
    }
}
?>
<?php include_once "../outPartials/header.php" ?>


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
                    <a href="cart.php" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                    <a href="cart.php" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                </div>
                <p>Free Shipping on All Orders Over $100!</p>
            </div>

        </div>
    </div> -->
<!-- Utilize Cart Menu End -->

<!-- Utilize Mobile Menu Start -->
<?php include_once "../outPartials/mobileMenu.php" ?>
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
                        <h1 class="section-title white-color">ADD Shipping Address</h1>
                    </div>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li>Shipping Address</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<!-- WISHLIST AREA START -->
<div class="liton__wishlist-area pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- PRODUCT TAB AREA START -->
                <div class="ltn__product-tab-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="account-login-inner">
                                    <?php include_once "./_form.php" ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCT TAB AREA END -->
            </div>
        </div>
    </div>
</div>
<!-- WISHLIST AREA START -->

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
                                    <img src="../public/img/icons/icon-img/11.png" alt="#">
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
                                    <img src="../public/img/icons/icon-img/12.png" alt="#">
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
                                    <img src="../public/img/icons/icon-img/13.png" alt="#">
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
                                    <img src="../public/img/icons/icon-img/14.png" alt="#">
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

<?php include_once "../outPartials/footer.php" ?>