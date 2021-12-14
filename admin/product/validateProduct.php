<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST);
    $title = trim($_POST['title']);
    $price = trim($_POST['price']);
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
}