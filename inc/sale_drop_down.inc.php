<?php
  if(!empty($_GET['aside']) && $_GET['aside'] === 'Sales') :

  $sale_drop_down_arr = [
    'New Sale',
    'Orders',
    'Invoices'
  ];
?>

<div class="sale_drop_container">
  <?php foreach($sale_drop_down_arr AS $key) : ?>
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