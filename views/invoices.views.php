<div class="all_container">
  <div class="table_caption">
    Sales Invoices
  </div>

  <?php

  $invoices = dbQuery(" SELECT sales_orders.*, customers.customer_name,users.full_name
  FROM sales_orders
  JOIN customers
  ON sales_orders.customer_id = customers.customer_id
  JOIN users
  ON sales_orders.user_id = users.user_id
  WHERE sales_orders.order_status = 'confirmed'
  ORDER BY sales_orders.sale_id DESC ");
  ?>

  <table>
    <tr>
      <th>Serial</th>
      <th>Invoice No.</th>
      <th>Customer</th>
      <th>Date</th>
      <th>Total Amount</th>
      <th>Processed By</th>
      <th>Actions</th>
    </tr>

    <?php if (!empty($invoices)) : ?>
      <?php for ($i = 0; $i < count($invoices); $i++) : ?>

        <tr>
          <td>
            <?= $i + 1 ?>
          </td>
          <td>
            INV-<?= str_pad($invoices[$i]['sale_id'], 5, '0') ?>
          </td>
          <td>
            <?= $invoices[$i]['customer_name'] ?>
          </td>
          <td>
            <?= $invoices[$i]['sale_date'] ?>
          </td>
          <td>
            ৳<?= number_format((float) $invoices[$i]['total_amount'], 2) ?>
          </td>
          <td>
            <?= $invoices[$i]['full_name'] ?>
          </td>
          <td>
            <a
              href="invoice_pdf.php?id=<?= $invoices[$i]['sale_id'] ?>"
              target="_blank">
              Invoice
            </a>

          </td>
        </tr>
      <?php endfor; ?>
    <?php else : ?>
      <tr>
        <td colspan="7">
          No confirmed invoices found.
        </td>
      </tr>
    <?php endif; ?>
  </table>
</div>