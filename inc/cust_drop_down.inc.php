<?php
  if(!empty($_GET['aside']) && $_GET['aside'] === 'Customers') :

  $cust_drop_down_arr = [
    'All Customers',
    'Add Customer',
    'Orders',
    'Outstanding Balance'
  ];
?>

<div class="cust_drop_container">
  <?php foreach($cust_drop_down_arr AS $key) : ?>
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