<?php
require_once "../../config/_dbconnection.php";


$date = date('Y-m-d H:i:s');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   if (empty($img_err)) {
       
   }
}

?>

<?php include_once "../basbord-partials/header.php" ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="productImages.php" class="btn btn-outline-primary">Back to Product multiple Images</a>
        </div>
        <div class="col-12 mt-5 mb-5">
            <?php include_once "_formproductImages.php" ?>
        </div>
    </div>
</div>

<?php include_once "../basbord-partials/footer.php" ?>