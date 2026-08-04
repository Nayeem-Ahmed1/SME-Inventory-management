<?php
  if(!empty($_GET['aside']) && $_GET['aside'] === 'Employees') :

  $emp_drop_down_arr = [
    'View All',
    'Add New',
    'Manage'
  ];
?>

<div class="emp_drop_container">
  <?php foreach($emp_drop_down_arr AS $key) : ?>
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