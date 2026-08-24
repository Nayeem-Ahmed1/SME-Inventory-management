<?php
if (!empty($_GET['aside']) && $_GET['aside'] === 'Admins') :

  $admin_drop_down_arr = [
    'All Admins' => 'all_admins',
    'Add New' => 'add_new_admin',
    'Manage' => ''
  ];

  $admin_drop_down_keys =  array_keys($admin_drop_down_arr);
?>


  <div class="admin_drop_container">
    <?php foreach ($admin_drop_down_keys as $key) : ?>
      <a href="dashboard.php?view=<?= $admin_drop_down_arr[$key] ?>">
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