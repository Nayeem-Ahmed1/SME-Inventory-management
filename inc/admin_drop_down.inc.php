<?php
  if(!empty($_GET['aside']) && $_GET['aside'] === 'Admins') :

  $admin_drop_down_arr = [
    'All Admins',
    'Add New',
    'Manage'
  ];
?>

<div class="admin_drop_container">
  <?php foreach($admin_drop_down_arr AS $key) : ?>
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