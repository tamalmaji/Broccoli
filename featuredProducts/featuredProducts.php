<?php
require_once "../config/_dbconnection.php";
$sql = 'SELECT * FROM broccoli_product ORDER BY product_id DESC';
$statement  = $pdo->prepare($sql);
$statement->execute();
// $rows = $statement->rowCount();
$featuredProducts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php
$featuredProductss = array_splice($featuredProducts, 0, 8);
foreach ($featuredProductss as $featuredProduct) : ?>


    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
        <div class="ltn__product-item ltn__product-item-3 text-left">
            <div class="product-img">
                <a href="product-details.html"><img src="./<?php echo $featuredProduct['product_img'] ?>" alt="#"></a>
                <div class="product-badge">
                    <ul>
                        <li class="sale-badge">New</li>
                    </ul>
                </div>
                <div class="product-hover-action">
                    <ul>
                    <li>
                            <a href="product-details.php?id=<?php echo $featuredProduct['product_id'] ?>" title="Quick View" >
                                <i class="far fa-eye"></i>
                            </a>
                        </li>
                        <li>
                            <a href="cart.php?id=<?php echo $featuredProduct['product_id'] ?>" title="Add to Cart" >
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </li>
                        <li>
                            <a href="wishlist.php?id=<?php echo $featuredProduct['product_id'] ?>" title="Wishlist">
                                <i class="far fa-heart"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="product-info">
                <div class="product-ratting">
                    <ul>
                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                        <li><a href="#"><i class="far fa-star"></i></a></li>
                    </ul>
                </div>
                <h2 class="product-title"><a href="product-details.html"><?php echo $featuredProduct['product_name'] ?></a></h2>
                <div class="product-price">
                    <span>???<?php echo $featuredProduct['discount_price'] ?> </span>
                    <del>???<?php echo $featuredProduct['product_price'] ?></del>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>