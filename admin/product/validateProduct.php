<?php
$upload_dir = '';
$date = date('Y-m-d H:i:s');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST);
    $title = trim($_POST['title']);
    $price = trim($_POST['price']);
    $catagory_id = trim($_POST['catagory_id']);
    $discount = trim($_POST['discount']);
    $qty = trim($_POST['qty']);
    $desc = trim($_POST['desc']);
    if (empty($title)) {
        $title_err = 'Enter Product Title';
    }
    if (empty($price)) {
        $price_err = 'Enter Product Price';
    }
    if (empty($discount)) {
        $discount_err = 'Enter Product discount Price';
    }
    if (empty($qty)) {
        $qty_err = 'Enter Product Quantity / Pice';
    }

    if (empty($desc)) {
        $desc_err = 'Enter Product Description';
    }

    if (!is_dir('../../public/img/products')) {
        mkdir('../../public/img/products');
    }


    // if (empty($title_err) && empty($price_err) && empty($discount_err) && empty($qty_err) && empty($desc_err)) {

    //     // $image = $_FILES['file']['name'];
    //     // $imageSize = $_FILES['file']['size'];
    //     // $temp_dir = $_FILES['file']['tmp_name'];

    //     // $upload_dir = $product['product_img'];

    //     // // $upload_dir = '../../public/img/products/';
    //     // $imgExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    //     // $valid_extensions = array('jpeg', 'jpg', 'png');

    //     // if (in_array($imgExt, $valid_extensions)) {
    //     //     if ($imageSize < 5000000) {
    //     //         if ($product['product_img']) {
    //     //             unlink('../../public/' . $product['product_img']);
    //     //         }
    //     //         $picProfile = rand(1000, 1000000) . '.' . $imgExt;
    //     //         $upload_dir = 'img/products/' . $picProfile;
    //     //         $upload_File_dir = '../../public/img/products/' . $picProfile;
    //     //         move_uploaded_file($temp_dir, $upload_File_dir);
    //     //     } else {
    //     //         $img_err = 'File Size should be under 5 mb';
    //     //     }
    //     // } else {
    //     //     $img_err = 'Upload file should be jpg or jpeg or png';
    //     // }
    // }
}
// 96000
