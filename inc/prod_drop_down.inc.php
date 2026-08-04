<?php
  if(!empty($_GET['aside']) && $_GET['aside'] === 'Products') :

  $prod_drop_down_arr = [
    'All Products',
    'Add New',
    'Catagories',
    'Brands',
    'Units'
  ];
?>

<div class="prod_drop_container">
  <?php foreach($prod_drop_down_arr AS $key) : ?>
  <a href="">
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