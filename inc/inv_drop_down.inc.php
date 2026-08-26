<?php
if (!empty($_GET['aside']) && $_GET['aside'] === 'Inventory') :

  $inv_drop_down_arr = [
    'Add Stock' => 'add_stock',
    'Current Stocks' => 'current_stocks',
    'Low Stock' => 'low_stock',
    'Damaged Stock' => 'damaged_stock',
    'Out of Stock' => 'out_of_stock'
  ];

  $inv_drop_down_keys = array_keys($inv_drop_down_arr);
?>

  <div class="inv_drop_container">
    <?php foreach ($inv_drop_down_keys as $key) : ?>
      <a href="dashboard.php?view=<?= $inv_drop_down_arr[$key] ?>">
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