<?php
if (!empty($_GET['aside']) && $_GET['aside'] === 'Employees') :

  $emp_drop_down_arr = [
    'View All' => 'all_employees',
    'Add New' => 'add_new_employee',
    'Manage' => ''
  ];

  $emp_drop_down_keys = array_keys($emp_drop_down_arr);
?>

  <div class="emp_drop_container">
    <?php foreach ($emp_drop_down_keys as $key) : ?>
      <a href="dashboard.php?view=<?= $emp_drop_down_arr[$key] ?>">
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