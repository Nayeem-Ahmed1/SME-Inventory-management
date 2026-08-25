<div class="add_supplier_container">

  <div class="add_supplier_caption">
    Add New Supplier
  </div>

  <form action="actions/add_supplier.php" method="POST">

    <div>
      <label>Company Name</label>
      <input type="text" name="company_name" class="special_field" required>
    </div>

    <div>
      <label>Contact Person</label>
      <input type="text" name="contact_person" class="special_field" required>
    </div>

    <div>
      <label>Phone</label>
      <input type="text" name="phone" class="special_field" required>
    </div>

    <div>
      <label>Email</label>
      <input type="email" name="email" class="special_field" required>
    </div>

    <div>
      <label>Address</label>
      <textarea name="address" rows="3"></textarea>
    </div>

    <div>
      <label>Payment Terms</label>
      <input type="text" name="payment_terms" placeholder="Example: cash" class="special_field">
    </div>

    <div>
      <button type="submit">
        Add Supplier
      </button>
    </div>
  </form>
</div>