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
                    <a href="cart.php" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                    <a href="cart.php" class="theme-btn-2 btn btn-effect-2">Checkout</a>
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
                            <h6 class="section-subtitle ltn__secondary-color">//  Welcome to our company</h6>
                            <h1 class="section-title white-color">My Account</h1>
                        </div>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>My Account</li>
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
                                <div class="col-lg-4">
                                    <div class="ltn__tab-menu-list mb-50">
                                        <div class="nav">
                                            <a class="active show" data-toggle="tab" href="#liton_tab_1_1">Dashboard <i class="fas fa-home"></i></a>
                                            <a data-toggle="tab" href="#liton_tab_1_2">Orders <i class="fas fa-file-alt"></i></a>
                                            <!-- <a data-toggle="tab" href="#liton_tab_1_3">Downloads <i class="fas fa-arrow-down"></i></a> -->
                                            <a data-toggle="tab" href="#liton_tab_1_4">address <i class="fas fa-map-marker-alt"></i></a>
                                            <a data-toggle="tab" href="#liton_tab_1_5">Account Details <i class="fas fa-user"></i></a>
                                            <a href="login.php">Logout <i class="fas fa-sign-out-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="liton_tab_1_1">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>Hello <strong><?php echo $user['user_nicename'] ?></strong> (not <strong><?php echo $user['user_nicename'] ?></strong>? <small><a href="login-register.php">Log out</a></small> )</p>
                                                <p>From your account dashboard you can view your <span>recent orders</span>, manage your <span>shipping and billing addresses</span>, and <span>edit your password and account details</span>.</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="liton_tab_1_2">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Jun 22, 2019</td>
                                                                <td>Pending</td>
                                                                <td>$3000</td>
                                                                <td><a href="cart.php">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Nov 22, 2019</td>
                                                                <td>Approved</td>
                                                                <td>$200</td>
                                                                <td><a href="cart.php">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>Jan 12, 2020</td>
                                                                <td>On Hold</td>
                                                                <td>$990</td>
                                                                <td><a href="cart.php">View</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="tab-pane fade" id="liton_tab_1_3">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Date</th>
                                                                <th>Expire</th>
                                                                <th>Download</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Carsafe - Car Service PSD Template</td>
                                                                <td>Nov 22, 2020</td>
                                                                <td>Yes</td>
                                                                <td><a href="#"><i class="far fa-arrow-to-bottom mr-1"></i> Download File</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Carsafe - Car Service HTML Template</td>
                                                                <td>Nov 10, 2020</td>
                                                                <td>Yes</td>
                                                                <td><a href="#"><i class="far fa-arrow-to-bottom mr-1"></i> Download File</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Carsafe - Car Service WordPress Theme</td>
                                                                <td>Nov 12, 2020</td>
                                                                <td>Yes</td>
                                                                <td><a href="#"><i class="far fa-arrow-to-bottom mr-1"></i> Download File</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="tab-pane fade" id="liton_tab_1_4">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>The following addresses will be used on the checkout page by default.</p>
                                                <div class="row">
                                                    <div class="col-md-6 col-12 learts-mb-30">
                                                        <h4>Shipping Address</h4>
                                                    </div>
                                                    <div class="col-md-6 col-12 learts-mb-30">
                                                        <a href="../shippingaddress/addShipingAdd.php" class="btn theme-btn-1 btn-effect-1 text-uppercase">Add</a>
                                                        <h4>Shipping Address <small class="ml-3"><a href="../shippingaddress/updateShipingAdd.php" class="btn theme-btn-1 btn-effect-1 text-uppercase">edit</a></small></h4>
                                                        <address>
                                                            <p><strong>Alex Tuntuni</strong></p>
                                                            <p>1355 Market St, Suite 900 <br>
                                                                San Francisco, CA 94103</p>
                                                            <p>Mobile: (123) 456-7890</p>
                                                        </address>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="liton_tab_1_5">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>The following addresses will be used on the checkout page by default.</p>
                                                <div class="ltn__form-box">
                                                    <form action="#">
                                                        <div class="row mb-50">
                                                            <div class="col-md-6">
                                                                <label>First name:</label>
                                                                <input type="text" name="ltn__name">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Last name:</label>
                                                                <input type="text" name="ltn__lastname">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Display Name:</label>
                                                                <input type="text" name="ltn__lastname" placeholder="Ethan">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Display Email:</label>
                                                                <input type="email" name="ltn__lastname" placeholder="example@example.com">
                                                            </div>
                                                        </div>
                                                        <fieldset>
                                                            <legend>Password change</legend>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label>Current password (leave blank to leave unchanged):</label>
                                                                    <input type="password" name="ltn__name">
                                                                    <label>New password (leave blank to leave unchanged):</label>
                                                                    <input type="password" name="ltn__lastname">
                                                                    <label>Confirm new password:</label>
                                                                    <input type="password" name="ltn__lastname">
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="btn-wrapper">
                                                            <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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

