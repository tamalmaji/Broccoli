<?php
require_once "../../config/_dbconnection.php";

$id = $_GET['id'] ?? NULL;
if (!$id) {
    header('Location: product.php');
    exit;
}

$sqli = 'SELECT * FROM broccoli_product WHERE product_id  = :id';
$statement = $pdo->prepare($sqli);
$statement->bindValue(':id', $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM broccoli_catagory ORDER BY catagory_id  DESC';
$statements  = $pdo->prepare($sql);
$statements->execute();
$catagorys = $statements ->fetchAll(PDO::FETCH_ASSOC);


$title = $product['product_name'];
$price = $product['product_price'];
$discount = $product['discount_price'];
$qty = $product['product_quantity'];
$desc = $product['product_desc'];
$date = date('Y-m-d H:i:s');

$title_err = '';
$price_err = '';
$discount_err = '';
$qty_err = '';
$desc_err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "./validateProduct.php";
    if (empty($title_err) && empty($price_err) && empty($discount_err) && empty($qty_err) && empty($desc_err)) {
        $sql = 'UPDATE broccoli_product SET product_name = :title, product_desc = :desc, product_price = :price, catagory_id = :catagory_id, discount_price = :discount, product_quantity = :qty, update_at = :update_at WHERE product_id  = :id';
        if ($statement = $pdo->prepare($sql)) {
            $statement->bindValue(':title', $title);
            $statement->bindValue(':desc', $desc);
            $statement->bindValue(':price', $price);
            // $statement->bindValue(':img', $upload_dir);
            $statement->bindValue(':catagory_id', $catagory_id);
            $statement->bindValue(':discount', $discount);
            $statement->bindValue(':qty', $qty);
            $statement->bindValue(':update_at', $date);
            $statement->bindValue(':id', $id);
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