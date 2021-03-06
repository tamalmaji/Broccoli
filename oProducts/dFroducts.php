<?php
require_once "../config/_dbconnection.php";

$sql = 'SELECT * FROM broccoli_catagory WHERE catagory_name = :catagory_name';
if ($statement = $pdo->prepare($sql)) {
    $statement->bindValue(':catagory_name', 'DRIED FOODS');
    if ($statement->execute()) {
        $catagorys =  $statement->fetch(PDO::FETCH_ASSOC);
        $id = $catagorys['catagory_id'];
        $sqli = 'SELECT * FROM broccoli_product WHERE catagory_id = :id';
        if ($statements = $pdo->prepare($sqli)) {
            $statements->bindValue(':id', $id);
            if ($statements->execute()) {
                $drirdFoods = $statements->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
}



?>
<?php foreach ($drirdFoods as $i => $drirdFood) : ?>
    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
        <div class="ltn__product-item ltn__product-item-3 text-center" <?php echo $drirdFood['product_id']; ?>>
            <div class="product-img">
                <a href="product-details.html"><img src="./<?php echo $drirdFood['product_img'] ?>" alt="#"></a>
                <div class="product-badge">
                    <ul>
                        <li class="sale-badge">New</li>
                    </ul>
                </div>
                <div class="product-hover-action">
                    <ul>
                        <li>
                            <a href="product-details.php?id=<?php echo $drirdFood['product_id'] ?>" title="Quick View">
                                <i class="far fa-eye"></i>
                            </a>
                        </li>
                        <li>
                            <a href="cart.php?id=<?php echo $drirdFood['product_id'] ?>" title="Add to Cart">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </li>
                        <li>
                            <a href="wishlist.php?id=<?php echo $drirdFood['product_id'] ?>" title="Wishlist">
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
                        <li class="review-total"> <a href="#"> (24)</a></li>
                    </ul>
                </div>
                <h2 class="product-title"><a href="product-details.php"><?php echo $drirdFood['product_name'] ?></a></h2>
                <div class="product-price">
                    <span><?php echo $drirdFood['discount_price'] ?></span>
                    <del><?php echo $drirdFood['product_price'] ?></del>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>