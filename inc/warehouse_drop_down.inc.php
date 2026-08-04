<?php
  if(!empty($_GET['aside']) && $_GET['aside'] === 'Warehouse') :

  $wh_drop_down_arr = [
    'All Warehouses',
    'Add New',
    'Transfers',
  ];
?>

<div class="wh_drop_container">
  <?php foreach($wh_drop_down_arr AS $key) : ?>
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