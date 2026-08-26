<?php
if (!empty($_GET['aside']) && $_GET['aside'] === 'Warehouse') :

  $wh_drop_down_arr = [
    'All Warehouses' => 'all_warehouses',
    'Add New' => 'add_warehouse',
    'Transfers' => 'transfers',
  ];

  $wh_drop_down_keys = array_keys($wh_drop_down_arr);
?>

  <div class="wh_drop_container">
    <?php foreach ($wh_drop_down_keys as $key) : ?>
      <a href="dashboard.php?view=<?= $wh_drop_down_arr[$key] ?>">
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