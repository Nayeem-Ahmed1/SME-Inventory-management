<div class="add_warehouse_container">

  <div class="add_warehouse_caption">
    Add New Warehouse
  </div>

  <form action="actions/add_warehouse.php" method="POST">
    <div>
      <label>Warehouse Name</label>
      <input class="special_field" type="text" name="warehouse_name" placeholder="Enter warehouse name" required>
    </div>
    <div>
      <label>Location</label>
      <input class="special_field" type="text" name="location" placeholder="Enter warehouse location" required>
    </div>
    <div>
      <button type="submit">
        Add Warehouse
      </button>
    </div>
  </form>
</div>