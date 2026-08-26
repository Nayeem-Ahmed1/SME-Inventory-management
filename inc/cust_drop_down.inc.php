<?php
if (!empty($_GET['aside']) && $_GET['aside'] === 'Customers') :

  $cust_drop_down_arr = [
    'All Customers' => 'all_customers',
    'Add Customer' => 'add_customer',
    'Orders' => 'customer_orders',
    'Outstanding Balance' => ''
  ];

  $cust_drop_down_keys = array_keys($cust_drop_down_arr);
?>

  <div class="cust_drop_container">
    <?php foreach ($cust_drop_down_keys as $key) : ?>
      <a href="dashboard.php?view=<?= $cust_drop_down_arr[$key] ?>">
        <div class="item">
          <i class="fa-solid fa-arrow-right"></i>
          <div>
            <?= $key; ?>
          </div>
        </div>
      </a>
    <?php endforeach; ?>
  </div>

<?php endif; ?>