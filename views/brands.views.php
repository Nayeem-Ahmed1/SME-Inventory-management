<?php
$brands = dbQuery("SELECT * FROM brands ORDER BY brand_id DESC");
?>

<div class="brand_container">
  <div class="brand_caption">
    Brands
  </div>

  <form action="actions/add_brand.php" method="POST">
    <div>
      <label>Brand Name</label>
      <input class="special_field" type="text" name="brand_name" placeholder="Enter brand name" required>
    </div>
    <button type="submit">
      Add Brand
    </button>
  </form>

  <div class="brand_table">
    <table>
      <tr>
        <th>Serial</th>
        <th>Brand Name</th>
        <th>Created At</th>
      </tr>
      <?php for ($i = 0; $i < count($brands); $i++) : ?>
        <tr>
          <td>
            <?= $i + 1 ?>
          </td>
          <td>
            <?= $brands[$i]['brand_name'] ?>
          </td>
          <td>
            <?= $brands[$i]['created_at'] ?>
          </td>
        </tr>

      <?php endfor; ?>
    </table>
  </div>
</div>