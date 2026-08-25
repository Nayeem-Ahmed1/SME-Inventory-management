<?php
if (!empty($_GET['aside']) && $_GET['aside'] === 'Suppliers') :

  $sup_drop_down_arr = [
    'All Suppliers' => 'all_suppliers',
    'Add New' => 'add_new_supplier'
  ];

  $sup_drop_down_keys = array_keys($sup_drop_down_arr);
?>

  <div class="sup_drop_container">
    <?php foreach ($sup_drop_down_keys as $key) : ?>
      <a href="dashboard.php?view=<?= $sup_drop_down_arr[$key] ?>">
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