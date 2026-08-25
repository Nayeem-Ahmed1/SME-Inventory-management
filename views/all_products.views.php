<div class="all_container">
  <div class="table_caption">
    All Products List
  </div>

  <table>
    <tr>
      <th>Serial</th>
      <th>Image</th>
      <th>Product Name</th>
      <th>Category</th>
      <th>Brand</th>
      <th>Unit</th>
      <th>Supplier</th>
      <th>Purchase Price</th>
      <th>Selling Price</th>
      <th>Actions</th>
    </tr>
    <?php
    $results = dbQuery(" SELECT products.*, categories.category_name, brands.brand_name, units.unit_name, suppliers.company_name
      FROM products
      JOIN categories
        ON products.category_id = categories.category_id
      JOIN brands
        ON products.brand_id = brands.brand_id
      JOIN units
        ON products.unit_id = units.unit_id
      JOIN suppliers
        ON products.supplier_id = suppliers.supplier_id");

    for ($i = 1; $i <= count($results); $i++) :
      $product = $results[$i - 1];
    ?>
      <tr>
        <td>
          <?= $i ?>
        </td>
        <td>
          <?php if (!empty($product['product_image'])) : ?>

            <img src="uploads/<?= $product['product_image'] ?>" width="50" height="50">

          <?php else : ?>
            No Image
          <?php endif; ?>
        </td>
        <td>
          <?= $product['product_name'] ?>
        </td>
        <td>
          <?= $product['category_name'] ?>
        </td>
        <td>
          <?= $product['brand_name'] ?>
        </td>
        <td>
          <?= $product['unit_name'] ?>
        </td>
        <td>
          <?= $product['company_name'] ?>
        </td>
        <td>
          <?= $product['purchase_price'] ?>
        </td>
        <td>
          <?= $product['selling_price'] ?>
        </td>
        <td>
          <a href="edit_product.php?id=<?= $product['product_id'] ?>">
            Edit
          </a>
          <a class="delete_button" href="inc/delete_product.php?id=<?= $product['product_id'] ?>">
            Delete
          </a>
        </td>
      </tr>
    <?php endfor; ?>
  </table>
</div>