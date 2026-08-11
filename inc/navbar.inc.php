<div class="nav_container">
  <div class="logo_sec">LOGO</div>
  <div class="dif_sec">

    <?php $string = empty($_GET['nav']) ? '?nav=drop_click' : 'dashboard.php' ?>

    <a href="<?= $string ?> ">
      <div class="photo_sec">
        <?php 
        $user_id = (int) $_SESSION['user_id'];

        $resultPhoto = dbQuery("SELECT profile_picture FROM users WHERE user_id = {$user_id}");

        $resultPhoto[0]['profile_picture'] != NULL ? $pp = $resultPhoto[0]['profile_picture'] : $pp = 'default.jpeg'; 
        ?>
        
        <div class="image">
          <img src="uploads/<?= $pp ?>" alt="pp">
        </div>
        <span class="arrow">
          <?php if(empty($_GET['nav'])) : ?>
          <i class="fa-solid fa-chevron-down"></i>
          <?php else : ?>
          <i class="fa-solid fa-angle-up"></i>
          <?php endif; ?>
        </span>
      </div>
    </a>
    <div class="full_name">
        <span class="name">
          <?php echo $_SESSION['full_name']; ?>
        </span>
        <span class="designation">
          <?php echo $_SESSION['role_name']; ?>
        </span>
    </div>
  </div>
</div>