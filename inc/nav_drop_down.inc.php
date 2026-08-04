<?php 
  if(!empty($_GET['nav']) && $_GET['nav'] === 'drop_click') :

    $drop_down_arr = [
        'Profile' => 'fa-solid fa-circle-user',
        'Edit Profile' => 'fa-solid fa-user-gear',
        'Sign Out' => 'fa-solid fa-arrow-right-from-bracket'
    ];

    $drop_down_arr_Keys = array_keys($drop_down_arr);
?>

<div class="nav_drop_container">
    <?php foreach($drop_down_arr_Keys AS $key) :?>
      <a href="<?= $key === 'Sign Out' ? 'logout.php' : ''; ?>">
        <div class="item">
            <i class="<?= $drop_down_arr[$key] ?>"></i>
            <?= $key; ?>
        </div>
      </a>
      <?php endforeach; ?>
</div>


<?php endif ?>