<?php
session_start();
if (!empty($_SESSION['user_id'])) :

  $title = 'Dashboard';

  include __DIR__ . '/views/header.php';
  include __DIR__ . '/config/db.config.php';

  if (empty($_SESSION['active_sidebar'])) {
    $_SESSION['active_sidebar'] = 'Dashboard';
  }

  if (!empty($_GET['aside']) && $_GET['aside'] != NULL) {
    $_SESSION['active_sidebar'] = $_GET['aside'];
  } else {
    $_SESSION['active_sidebar'] = 'Dashboard';
  }

  if (!empty($_GET['aside']) && $_GET['aside'] === 'Log Out') {
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
    'Purchases' => 'fa-solid fa-cart-arrow-down',
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
      <?php foreach ($keys as $key) : ?>
        <a href="<?= !empty($_GET['aside']) && $_GET['aside'] === $key ? 'dashboard.php' : '?aside=' . $key; ?>">
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
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'all_admins')  include __DIR__ . '/views/all_admins.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'add_new_admin') include __DIR__  . '/views/add_new_admin.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'add_new_employee') include __DIR__ . '/views/add_new_employee.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'all_employees') include __DIR__ . '/views/all_employees.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'all_suppliers') include __DIR__ . '/views/all_suppliers.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'add_new_supplier') include __DIR__ . '/views/add_new_supplier.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'all_products') include __DIR__ . '/views/all_products.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'add_new_product') include __DIR__ . '/views/add_new_product.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'categories') include __DIR__ . '/views/categories.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'brands') include __DIR__ . '/views/brands.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'units') include __DIR__ . '/views/units.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'all_warehouses') include __DIR__ . '/views/all_warehouses.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'add_warehouse') include __DIR__ . '/views/add_new_warehouse.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'add_stock') include __DIR__ . '/views/add_stock.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'current_stocks') include __DIR__ . '/views/current_stocks.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'low_stock') include __DIR__ . '/views/low_stock.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'damaged_stock') include __DIR__ . '/views/damaged_stock.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'out_of_stock') include __DIR__ . '/views/out_of_stock.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'all_customers') include __DIR__ . '/views/all_customers.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'add_customer') include __DIR__ . '/views/add_customer.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'customer_orders') include __DIR__ . '/views/customer_orders.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'new_order') include __DIR__ . '/views/new_order.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'add_order_items') include __DIR__ . '/views/add_order_items.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'orders') include __DIR__ . '/views/orders.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'invoices') include __DIR__ . '/views/invoices.views.php'; ?>
      <?php if (!empty($_GET['view']) && $_GET['view'] == 'transfers') include __DIR__ . '/views/transfers.views.php'; ?>
      <?php if (!empty($_GET['aside']) && $_GET['aside'] == 'Roles') include __DIR__ . '/views/roles.views.php'; ?>
      <?php if (!empty($_GET['aside']) && $_GET['aside'] == 'Dashboard') include __DIR__ . '/views/dashboard_home.views.php'; ?>
      <?php if ((empty($_GET['aside'])) && (empty($_GET['view']))) include __DIR__ . '/views/dashboard_home.views.php'; ?>
    </div>
  </div>
  </body>

  </html>

<?php else : header('Location: login.php');
  die();
endif; ?>