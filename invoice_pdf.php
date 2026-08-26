<?php

include __DIR__ . '/config/db.config.php';
require __DIR__ . '/fpdf/fpdf.php';

if (empty($_GET['id'])) {
  die("Invoice not found.");
}

$sale_id = (int) $_GET['id'];

$order = dbQuery(" SELECT sales_orders.*, customers.customer_name, customers.phone, customers.email, customers.address, warehouses.warehouse_name, users.full_name
FROM sales_orders
JOIN customers
ON sales_orders.customer_id = customers.customer_id
JOIN warehouses
ON sales_orders.warehouse_id = warehouses.warehouse_id
JOIN users
ON sales_orders.user_id = users.user_id
WHERE sales_orders.sale_id = {$sale_id}
AND sales_orders.order_status = 'confirmed' ");

if (empty($order)) {
  die("Invoice not found.");
}

$order = $order[0];

$items = dbQuery(" SELECT sales_items.*, products.product_name FROM sales_items 
JOIN products
ON sales_items.product_id = products.product_id
WHERE sales_items.sale_id = {$sale_id} ");

//pdf
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 10, 'SALES INVOICE', 0, 1, 'C');

$pdf->Ln(5);

$pdf->SetFont('Arial', '', 11);
$invoice_no = 'INV-' . str_pad($sale_id, 5, '0');

$pdf->Cell(120, 8, 'Invoice No: ' . $invoice_no);
$pdf->Cell(0, 8, 'Date: ' . $order['sale_date'], 0, 1);
$pdf->Cell(0, 8, 'Warehouse: ' . $order['warehouse_name'], 0, 1);

$pdf->Ln(5);


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, 'Bill To', 0, 1);

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 7, 'Customer: ' . $order['customer_name'], 0, 1);
$pdf->Cell(0, 7, 'Phone: ' . $order['phone'], 0, 1);
$pdf->Cell(0, 7, 'Email: ' . $order['email'], 0, 1);
$pdf->Cell(0, 7, 'Address: ' . $order['address'], 0, 1);

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15, 10, 'SL', 1, 0, 'C');
$pdf->Cell(75, 10, 'Product', 1, 0, 'C');
$pdf->Cell(25, 10, 'Qty', 1, 0, 'C');
$pdf->Cell(35, 10, 'Price', 1, 0, 'C');
$pdf->Cell(40, 10, 'Subtotal', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

for ($i = 0; $i < count($items); $i++) {

  $pdf->Cell(15, 10, $i + 1, 1, 0, 'C');
  $pdf->Cell(75, 10, $items[$i]['product_name'], 1);
  $pdf->Cell(25, 10, $items[$i]['quantity'], 1, 0, 'C');
  $pdf->Cell(35, 10, number_format((float) $items[$i]['selling_price'], 2), 1, 0, 'R');
  $pdf->Cell(40, 10, number_format((float) $items[$i]['subtotal'], 2), 1, 1, 'R');
}

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(150, 10, 'Grand Total:', 0, 0, 'R');
$pdf->Cell(40, 10, 'BDT ' . number_format((float) $order['total_amount'], 2), 0, 1, 'R');

$pdf->Ln(10);
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(0, 8, 'Processed By: ' . $order['full_name'], 0, 1);
$pdf->Cell(0, 8, 'Thank you for your business.', 0, 1, 'C');

$pdf->Output('I', $invoice_no . '.pdf');
