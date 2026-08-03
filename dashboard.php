<?php 
  session_start();
  if(!empty($_SESSION['user_id'])) :

  $title = 'Dashboard';

  include __DIR__ . '/views/header.php';
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
    'Catagories' => 'fa-solid fa-table-list',
    'Roles' => 'fa-solid fa-user-gear',
    'Units' => 'fa-solid fa-angle-up',
    'Brands' => 'fa-brands fa-gg-circle'];

  $keys = array_keys($sidebarArr);
?>

  <div class="dashboard_container">
    <nav></nav>
    <aside>
      <?php foreach($keys AS $key) : ?>
      <a href="">
        <div class="item">
          <div>
            <i class="<?php echo $sidebarArr[$key] ?>"></i>
            <?php echo $key ?>
          </div>
          <span>></span> 
        </div>
      </a>
      <?php endforeach; ?>
    </aside>
    <div class="main">

    </div>
  </div>

</body>
</html>

<?php else : header('Location: login.php'); die(); endif; ?>
