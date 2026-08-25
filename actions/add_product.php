<?php
include __DIR__ . '/../config/db.config.php';
include __DIR__ . '/../inc/func/image_resize.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $product_name = trim($_POST['product_name']);
  $category_id = (int) $_POST['category_id'];
  $brand_id = (int) $_POST['brand_id'];
  $unit_id = (int) $_POST['unit_id'];
  $supplier_id = (int) $_POST['supplier_id'];
  $purchase_price = (float) $_POST['purchase_price'];
  $selling_price = (float) $_POST['selling_price'];
  $description = trim($_POST['description']);
  $product_image = NULL;

  if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {

    $product_image = 'product_' . time() . '.jpg';
    $new_path = __DIR__ . '/../uploads/' . $product_image;

    resizeImage($_FILES['product_image']['tmp_name'], $new_path);
  }
  if ($product_image !== NULL) {
    $image_value = "'{$product_image}'";
  } else {
    $image_value = "NULL";
  }


  $sql = "INSERT INTO products( category_id, brand_id, unit_id, supplier_id, product_name, product_image, description, purchase_price, selling_price ) VALUES( {$category_id}, {$brand_id}, {$unit_id}, {$supplier_id}, '{$product_name}', {$image_value}, '{$description}', {$purchase_price}, {$selling_price})";

  dbQuery($sql);

  header('Location: ../dashboard.php?view=all_products');
  die();
}
