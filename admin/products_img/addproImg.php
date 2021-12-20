<?php
require_once "../../config/_dbconnection.php";


$id = $_GET['id'] ?? NULL;
if (!$id) {
    header('Location: productsImg.php');
}

$date = date('Y-m-d H:i:s');

if (!is_dir('../../public/img/productRelImg')) {
    mkdir('../../public/img/productRelImg');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($img_err)) {

        $valid_extensions = array('jpeg', 'jpg', 'png');
        foreach ($_FILES['image']['tmp_name'] as $i => $value) {
            $image = $_FILES['image']['name'][$i];
            // $imageSize = $_FILES['image']['size'][$i];
            $temp_dir = $_FILES['image']['tmp_name'][$i];

            $imgExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
            if (in_array($imgExt, $valid_extensions)) {
                // if ($imageSize < 5000000) {
                // if ($productRel['images']) {
                //     unlink('../../public/' . $productRel['images']);
                // }
                $picProfile = rand(1000, 1000000) . '.' . $imgExt;
                $upload_dir = 'img/productRelImg/' . $picProfile;
                $upload_File_dir = '../../public/img/productRelImg/' . $picProfile;
                move_uploaded_file($temp_dir, $upload_File_dir);
                $sql = 'INSERT INTO broccoli_product_images (images, product_id, create_at, update_at) 
                VALUE(:images, :product_id, :create_at, :update_at)';
                if ($statement = $pdo->prepare($sql)) {
                    $statement->bindValue(':images', $upload_dir);
                    $statement->bindValue(':product_id', $id);
                    $statement->bindValue(':create_at', $date);
                    $statement->bindValue(':update_at', $date);
                    if ($statement->execute()) {
                        header('location:  productsImg.php');
                    }
                }
                // } else {
                //     $img_err = 'File Size should be under 5 mb';
                // }
            } else {
                $img_err = 'Upload file should be jpg or jpeg or png';
            }
        }

    }
}
?>


<?php include_once "../basbord-partials/header.php" ?>
<div class=" content-wrapper" style="min-height: 485.139px;">
    <div class="row">
        <div class="col-12">
            <a href="./productsImg.php" class="btn btn-outline-primary">Back to Product multiple Images</a>
        </div>
        <div class="col-12 mt-5 mb-5">
            <?php include_once "_formproImg.php" ?>
        </div>
    </div>
</div>

<?php include_once "../basbord-partials/footer.php" ?>