<?php
require_once "../../config/_dbconnection.php";

$title = '';
$price = '';
$discount = '';
$qty = '';
$desc = '';
$date = date('Y-m-d H:i:s');


$title_err = '';
$price_err = '';
$discount_err = '';
$qty_err = '';
$desc_err = '';
$img_err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "./validateProduct.php";
    if (empty($title_err) && empty($price_err) && empty($discount_err) && empty($qty_err) && empty($desc_err)) {
        // require_once "./uploadProductImage.php";
        $sql = 'INSERT INTO broccoli_product (product_name, product_desc, product_price, product_img, discount_price, product_quantity, create_at, update_at) 
        VALUE(:title, :desc, :price, :img, :discount, :qty,  :create_at, :update_at )';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':title', $title);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':img', $upload_dir);
            $statement->bindValue(':discount', $discount);
            $statement->bindValue(':qty', $qty);
            $statement->bindValue(':desc', $desc);
            $statement->bindValue(':create_at', $date);
            $statement->bindValue(':update_at', $date);
            if ($statement->execute()) {
                header('Location: product.php');
            }
        }
    }
}

?>

<?php include_once "../basbord-partials/header.php" ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="product.php" class="btn btn-outline-primary">Back to Product</a>
        </div>
        <div class="col-12 mt-5 mb-5">
            <?php include_once "_formProduct.php" ?>
        </div>
    </div>
</div>

<?php include_once "../basbord-partials/footer.php" ?>