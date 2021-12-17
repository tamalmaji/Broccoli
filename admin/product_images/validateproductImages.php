<?php
 if (!is_dir('../../public/img/')) {
    mkdir('../../public/img/products');
}

    $image = $_FILES['file']['name'];
    $imageSize = $_FILES['file']['size'];
    $temp_dir = $_FILES['file']['tmp_name'];

    $upload_dir = $product['product_img'];

    // $upload_dir = '../../public/img/products/';
    $imgExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png');

    if (in_array($imgExt, $valid_extensions)) {
        if ($imageSize < 5000000) {
            if ($product['product_img']) {
                unlink('../../public/' . $product['product_img']);
            }
            $picProfile = rand(1000, 1000000) . '.' . $imgExt;
            $upload_dir = 'img/products/' . $picProfile;
            $upload_File_dir = '../../public/img/products/' . $picProfile;
            move_uploaded_file($temp_dir, $upload_File_dir);
        } else {
            $img_err = 'File Size should be under 5 mb';
        }
    } else {
        $img_err = 'Upload file should be jpg or jpeg or png';
    }
