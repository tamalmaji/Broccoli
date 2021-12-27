<?php
require_once "../../config/_dbconnection.php";
$sql = 'SELECT * FROM broccoli_catagory ORDER BY catagory_id  DESC';
$statement  = $pdo->prepare($sql);
$statement->execute();
$catagorys = $statement ->fetchAll(PDO::FETCH_ASSOC);

$title = '';
$price = '';
$discount = '';
$qty = '';
$desc = '';
$catagory_id = '';
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
        $sql = 'INSERT INTO broccoli_product (product_name, product_desc, product_price, catagory_id, discount_price, product_quantity, product_img, create_at, update_at) 
        VALUE(:title, :desc, :price, :catagory_id, :discount, :qty, :product_img,  :create_at, :update_at )';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':title', $title);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':catagory_id', $catagory_id);
            $statement->bindValue(':discount', $discount);
            $statement->bindValue(':qty', $qty);
            $statement->bindValue(':desc', $desc);
            $statement->bindValue(':product_img', $upload_dir);
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
<div class=" content-wrapper" style="min-height: 485.139px;">
    <div class="row m-5">
        <div class="col-12">
            <a href="product.php" class="btn btn-outline-primary">Back to Product</a>
        </div>
        <div class="col-12 mt-5 mb-5">
            <?php include_once "_formProduct.php" ?>
        </div>
    </div>
</div>

<?php include_once "../basbord-partials/footer.php" ?>