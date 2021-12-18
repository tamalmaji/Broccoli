<?php




    $upload_dir = $productRel['images'];

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
            // } else {
            //     $img_err = 'File Size should be under 5 mb';
            // }
        } else {
            $img_err = 'Upload file should be jpg or jpeg or png';
        } 
    }
