<div class="add_customer_container">
  <div class="add_customer_caption">
    Add New Customer
  </div>

  <form action="actions/add_customer.php" method="POST">
    <div>
      <label>Customer Name</label>
      <input class="special_field" type="text" name="customer_name" required>
    </div>
    <div>
      <label>Phone</label>
      <input class="special_field" type="text" name="phone" required>
    </div>
    <div>
      <label>Email</label>
      <input class="special_field" type="email" name="email" required>
    </div>
    <div>
      <label>Address</label>
      <input class="special_field" type="text" name="address">
    </div>
    <div>
      <label>Outstanding Balance</label>
      <input class="special_field" type="number" name="outstanding_money" step="0.01" min="0" value="0">
    </div>
    <div>
      <button type="submit">
        Add Customer
      </button>
    </div>
  </form>
</div>