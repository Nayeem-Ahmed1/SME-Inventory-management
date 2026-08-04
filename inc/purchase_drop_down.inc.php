<?php
  if(!empty($_GET['aside']) && $_GET['aside'] === 'Purchases') :

  $pur_drop_down_arr = [
    'New Purchase',
    'Purchase Orders',
    'Pending Orders',
    'Invoices'
  ];
?>

<div class="pur_drop_container">
  <?php foreach($pur_drop_down_arr AS $key) : ?>
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