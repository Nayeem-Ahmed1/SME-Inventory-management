<?php

include __DIR__ . '/../config/db.config.php';

if (isset($_GET['id'])) {
  $customer_id = (int) $_GET['id'];

  $sales = dbQuery("SELECT sale_id FROM sales_orders WHERE customer_id = {$customer_id}");

  if (!empty($sales)) {
    die("This customer cannot be deleted because they already have sales orders.");
  }

  dbQuery("DELETE FROM customers WHERE customer_id = {$customer_id}");
}

header('Location: ../dashboard.php?view=all_customers');
die();
