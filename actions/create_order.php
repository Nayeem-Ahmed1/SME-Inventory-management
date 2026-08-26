<?php

session_start();

include __DIR__ . '/../config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $customer_id = (int) $_POST['customer_id'];
  $warehouse_id = (int) $_POST['warehouse_id'];
  $sale_date = $_POST['sale_date'];

  $user_id = (int) $_SESSION['user_id'];

  if ($customer_id <= 0 || $warehouse_id <= 0 || $user_id <= 0) {
    die("Invalid order information.");
  }

  $sql = "INSERT INTO sales_orders ( customer_id, warehouse_id, user_id, sale_date, total_amount ) VALUES ( {$customer_id}, {$warehouse_id}, {$user_id}, '{$sale_date}',0)";

  dbQuery($sql);

  $order = dbQuery(" SELECT sale_id FROM sales_orders WHERE customer_id = {$customer_id} AND warehouse_id = {$warehouse_id} AND user_id = {$user_id} ORDER BY sale_id DESC LIMIT 1 ");

  if (!empty($order)) {
    $sale_id = (int) $order[0]['sale_id'];

    header(
      "Location: ../dashboard.php?view=add_order_items&sale_id={$sale_id}"
    );

    die();
  }


  die("Could not create order.");
}
