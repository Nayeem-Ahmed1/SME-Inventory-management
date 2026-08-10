<?php 
  if(!empty($_GET['nav']) && $_GET['nav'] === 'drop_click') :

    $drop_down_items = [
      [
        'label' => 'Profile',
        'icon' => 'fa-solid fa-circle-user',
        'url' => 'profile.php'
      ],
      [
        'label' => 'Edit Profile',
        'icon' => 'fa-solid fa-user-gear',
        'url' => 'edit_profile.php' 
      ],
      [
        'label' => 'Sign Out',
        'icon' => 'fa-solid fa-arrow-right-from-bracket',
        'url' => 'logout.php'
      ]
    ];
?>

<div class="nav_drop_container">
    <?php foreach($drop_down_items AS $item) :?>
      <a href="<?= $item['url']; ?>">
        <div class="item">
            <i class="<?= $item['icon'] ?>"></i>
            <?= $item['label']; ?>
        </div>
      </a>
      <?php endforeach; ?>
</div>


<?php endif ?>