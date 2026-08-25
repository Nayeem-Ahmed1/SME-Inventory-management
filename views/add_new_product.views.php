<?php
$categories = dbQuery("SELECT * FROM categories");
$brands = dbQuery("SELECT * FROM brands");
$units = dbQuery("SELECT * FROM units");
$suppliers = dbQuery("SELECT * FROM suppliers");
?>

<div class="add_product_container">
  <div class="add_product_caption">
    Add New Product
  </div>

  <form action="actions/add_product.php" method="POST" enctype="multipart/form-data">

    <div>
      <label>Product Name</label>
      <input class="special_field" type="text" name="product_name" required>
    </div>
    <div>
      <label>Category</label>
      <select name="category_id" required>
        <option value="">Select Category</option>
        <?php foreach ($categories as $category) : ?>

          <option value="<?= $category['category_id'] ?>">
            <?= $category['category_name'] ?>
          </option>

        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label>Brand</label>
      <select name="brand_id" required>
        <option value="">Select Brand</option>
        <?php foreach ($brands as $brand) : ?>
          <option value="<?= $brand['brand_id'] ?>">
            <?= $brand['brand_name'] ?>
          </option>

        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label>Unit</label>
      <select name="unit_id" required>
        <option value="">Select Unit</option>
        <?php foreach ($units as $unit) : ?>

          <option value="<?= $unit['unit_id'] ?>">
            <?= $unit['unit_name'] ?>
          </option>

        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label>Supplier</label>
      <select name="supplier_id" required>
        <option value="">Select Supplier</option>
        <?php foreach ($suppliers as $supplier) : ?>

          <option value="<?= $supplier['supplier_id'] ?>">
            <?= $supplier['company_name'] ?>
          </option>

        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label>Purchase Price</label>
      <input class="special_field" type="number" step="0.01" name="purchase_price" required>
    </div>
    <div>
      <label>Selling Price</label>
      <input class="special_field" type="number" step="0.01" name="selling_price" required>
    </div>
    <div>
      <label>Description</label>
      <textarea name="description" rows="3"></textarea>
    </div>
    <div>
      <label>Product Image</label>
      <input type="file" name="product_image" accept="image/*">
    </div>
    <div>
      <button type="submit">
        Add Product
      </button>
    </div>
  </form>
</div>