<?php
if (!empty($_GET['aside']) && $_GET['aside'] === 'Products') :

  $prod_drop_down_arr = [
    'All Products' => 'all_products',
    'Add New' => 'add_new_product',
    'Catagories' => 'categories',
    'Brands' => 'brands',
    'Units' => 'units'
  ];

  $prod_drop_down_keys = array_keys($prod_drop_down_arr);
?>

  <div class="prod_drop_container">
    <?php foreach ($prod_drop_down_keys as $key) : ?>
      <a href="dashboard.php?view=<?= $prod_drop_down_arr[$key] ?>">
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