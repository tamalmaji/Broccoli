<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!is_dir('../../public/img/users')) {
        mkdir('../../public/img/users');
    }

    $image = $_FILES['file']['name'];
    $imageSize = $_FILES['file']['size'];
    $temp_dir = $_FILES['file']['tmp_name'];

    $upload_dir = $user['users_img'];
    $imgExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png');

    if (in_array($imgExt, $valid_extensions)) {
        if ($imageSize < 5000000) {
            if ($user['users_img']) {
                unlink('../../public/' . $user['users_img']);
            }
            $picProfile = rand(1000, 1000000) . '.' . $imgExt;
            $upload_dir = 'img/users/' . $picProfile;
            $upload_File_dir = '../../public/img/users/' . $picProfile;
            move_uploaded_file($temp_dir, $upload_File_dir);
        } else {
            $img_err = 'File Size should be under 5 mb';
        }
    } else {
        $img_err = 'Upload file should be jpg or jpeg or png';
    }
}
