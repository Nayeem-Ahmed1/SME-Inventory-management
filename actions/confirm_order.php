<?php

include __DIR__ . '/../config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $sale_id = (int) $_POST['sale_id'];

  if ($sale_id <= 0) {
    die("Invalid order.");
  }


  $order = dbQuery(" SELECT * FROM sales_orders WHERE sale_id = {$sale_id} AND order_status = 'pending' ");

  if (empty($order)) {
    die("Order not found or already confirmed.");
  }

  $warehouse_id = (int) $order[0]['warehouse_id'];

  $items = dbQuery(" SELECT * FROM sales_items WHERE sale_id = {$sale_id} ");

  if (empty($items)) {
    die("Cannot confirm an order with no products.");
  }

  foreach ($items as $item) {

    $product_id = (int) $item['product_id'];
    $quantity = (int) $item['quantity'];

    dbQuery(" UPDATE inventory SET current_stock = current_stock - {$quantity}, reserved_stock = reserved_stock - {$quantity} WHERE warehouse_id = {$warehouse_id} AND product_id = {$product_id} ");
  }

  dbQuery(" UPDATE sales_orders SET order_status = 'confirmed' WHERE sale_id = {$sale_id} ");

  header(
    'Location: ../dashboard.php?view=orders'
  );

  die();
}
