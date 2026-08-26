<?php
if (!empty($_GET['aside']) && $_GET['aside'] === 'Sales') :

  $sale_drop_down_arr = [
    'New Order' => 'new_order',
    'Orders' => 'orders',
    'Invoices' => 'invoices'
  ];

  $sale_drop_down_keys = array_keys($sale_drop_down_arr);
?>

  <div class="sale_drop_container">
    <?php foreach ($sale_drop_down_keys as $key) : ?>
      <a href="dashboard.php?view=<?= $sale_drop_down_arr[$key] ?>">
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