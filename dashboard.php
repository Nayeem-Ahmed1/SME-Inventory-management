<?php 
  session_start();
  if(!empty($_SESSION['user_id'])) :

  $title = 'Dashboard';

  include __DIR__ . '/views/header.php';
  include __DIR__ . '/config/db.config.php';

  if(empty($_SESSION['active_sidebar'])){
    $_SESSION['active_sidebar'] = 'Dashboard';
  }
  
  if(!empty($_GET['aside']) && $_GET['aside'] != NULL){
    $_SESSION['active_sidebar'] = $_GET['aside'];
  } else {
    $_SESSION['active_sidebar'] = 'Dashboard';
  }

  if(!empty($_GET['aside']) && $_GET['aside'] === 'Log Out'){
    header('Location: logout.php');
    die();
  }
?>

<?php 
  $sidebarArr = [
    'Dashboard' => 'fa-solid fa-gauge-high',
    'Admins' => 'fa-solid fa-user-tie',
    'Employees' => 'fa-solid fa-address-card',
    'Suppliers' => 'fa-solid fa-truck-field',
    'Products' => 'fa-solid fa-cube',
    'Purchases' =>'fa-solid fa-cart-arrow-down',
    'Sales' => 'fa-solid fa-money-bill-1',
    'Warehouse' => 'fa-solid fa-warehouse',
    'Inventory' => 'fa-regular fa-house',
    'Customers' => 'fa-solid fa-user',
    'Roles' => 'fa-solid fa-user-gear',
    'Log Out' => 'fa-solid fa-arrow-right-from-bracket'
  ];

  $keys = array_keys($sidebarArr);

?>

  <div class="dashboard_container">


    <nav>
      <?php include __DIR__ . '/inc/navbar.inc.php' ?>
      <?php include __DIR__ . '/inc/nav_drop_down.inc.php' ?>
    </nav>


    <aside>
      <?php foreach($keys AS $key) : ?>
      <a href="<?= !empty($_GET['aside']) && $_GET['aside'] === $key ? 'dashboard.php' : '?aside=' . $key ; ?>">
        <div class="item <?= $_SESSION['active_sidebar'] === $key ? 'active' : ''; ?>">
          <div>
            <i class="<?= $sidebarArr[$key]; ?>"></i>
            <?= $key; ?>
          </div>
          <span>></span> 
        </div>
      </a>
      <?php endforeach; ?>
      <div class="empty_space"> 
      </div>
    </aside>
    
    <?php include __DIR__ . '/inc/admin_drop_down.inc.php' ?>
    <?php include __DIR__ . '/inc/emp_drop_down.inc.php' ?>
    <?php include __DIR__ . '/inc/supplier_drop_drown.inc.php' ?>
    <?php include __DIR__ . '/inc/prod_drop_down.inc.php' ?>
    <?php include __DIR__ . '/inc/purchase_drop_down.inc.php' ?>
    <?php include __DIR__ . '/inc/sale_drop_down.inc.php' ?>
    <?php include __DIR__ . '/inc/warehouse_drop_down.inc.php' ?>
    <?php include __DIR__ . '/inc/inv_drop_down.inc.php' ?>
    <?php include __DIR__ . '/inc/cust_drop_down.inc.php' ?>

    <div class="main">
        Dashboard Data
    </div>
  </div>


</body>
</html>

<?php else : header('Location: login.php'); die(); endif; ?>
