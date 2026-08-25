<?php
$categories = dbQuery("SELECT * FROM categories ORDER BY category_id DESC");
?>

<div class="category_container">
  <div class="category_caption">
    Categories
  </div>

  <form action="actions/add_category.php" method="POST">
    <div>
      <label>Category Name</label>
      <input class="special_field" type="text" name="category_name" placeholder="Enter category name" required>
    </div>
    <button type="submit">
      Add Category
    </button>
  </form>

  <div class="category_table">
    <table>
      <tr>
        <th>Serial</th>
        <th>Category Name</th>
        <th>Created At</th>
      </tr>
      <?php for ($i = 0; $i < count($categories); $i++) : ?>
        <tr>
          <td>
            <?= $i + 1 ?>
          </td>
          <td>
            <?= $categories[$i]['category_name'] ?>
          </td>
          <td>
            <?= $categories[$i]['created_at'] ?>
          </td>
        </tr>
      <?php endfor; ?>
    </table>
  </div>
</div>