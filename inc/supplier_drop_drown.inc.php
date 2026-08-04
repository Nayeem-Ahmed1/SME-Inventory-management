<?php
  if(!empty($_GET['aside']) && $_GET['aside'] === 'Suppliers') :

  $sup_drop_down_arr = [
    'All Suppliers',
    'Add New',
  ];
?>

<div class="sup_drop_container">
  <?php foreach($sup_drop_down_arr AS $key) : ?>
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