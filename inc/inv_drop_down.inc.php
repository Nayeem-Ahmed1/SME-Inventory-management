<?php
  if(!empty($_GET['aside']) && $_GET['aside'] === 'Inventory') :

  $inv_drop_down_arr = [
    'Current Stocks',
    'Low Stock',
    'Damaged Stock',
    'Out of Stock'
  ];
?>

<div class="inv_drop_container">
  <?php foreach($inv_drop_down_arr AS $key) : ?>
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