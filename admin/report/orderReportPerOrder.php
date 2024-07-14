<?php
// Ambil data order_id dari URL
$order_id = $_GET['order_id'];

include '../../koneksi.php';
$query = "
SELECT 
    tb_user.*,
    orders.*, 
    tb_produk.bouquet_id,
    GROUP_CONCAT(tb_produk.bouquet_name SEPARATOR ', ') AS nameProducts,
    GROUP_CONCAT(tb_produk.bouquet_price SEPARATOR ', ') AS priceProducts,
    GROUP_CONCAT(tb_produk.bouquet_image SEPARATOR ', ') AS imageProducts,
    GROUP_CONCAT(order_detail.qty SEPARATOR ', ') AS qtys
FROM 
    tb_user
JOIN 
    orders ON tb_user.id_user = orders.id_user
JOIN 
    order_detail ON order_detail.order_id = orders.order_id
JOIN 
    tb_produk ON order_detail.bouquet_id = tb_produk.bouquet_id
WHERE
  orders.order_id = ?
GROUP BY 
    orders.order_id
ORDER BY 
    orders.order_date DESC;
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$results = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .receipt {
      width: 600px;
      padding: 10px;
      border: 1px solid #000;
      margin: 0 auto;
    }

    .receipt-header {
      text-align: center;
    }

    .receipt-header h1 {
      margin: 0;
    }

    .receipt-body {
      margin-top: 10px;
    }

    .receipt-body .info {
      display: flex;
      justify-content: space-between;
    }

    .receipt-body .info table {
      border-collapse: collapse;
      width: 100%;
    }

    .receipt-body .info table td {
      padding: 5px;
      border: none;
    }

    .receipt-body .items {
      margin-top: 10px;
      border-bottom: 1px solid #000;
    }

    .receipt-body .items table {
      width: 100%;
      border-collapse: collapse;
    }

    .receipt-body .items th,
    .receipt-body .items td {
      border: 1px solid #000;
      padding: 8px;
      text-align: left;
    }

    .receipt-body .total {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .receipt-footer {
      margin: 30px 0 0 0;
      text-align: right;
      border-top: 1px solid #000;
      padding-top: 10px;
    }
  </style>
</head>

<body>
  <div class="receipt">
    <div class="receipt-header">
      <img src="../../assets/images/header-report.png" alt="logo" width="300">
      <h2>Invoice</h2>
      <h3>Invoice No <?= $order_id ?></h3>
    </div>
    <div class="receipt-body">
      <div class="info">
        <table>
          <tbody>
            <tr>
              <td>Name            : </td>
              <td><?= $results['nama_user'] ?></td>
            </tr>
            <tr>
              <td>Email           : </td>
              <td><?= $results['email_user'] ?></td>
            </tr>
            <tr>
              <td>Phone Number    : </td>
              <td><?= $results['notelp_user'] ?></td>
            </tr>
            <tr>
              <td>Address         : </td>
              <td><?= $results['address'] ?></td>
            </tr>
            <tr>
              <td>Order Date      : </td>
              <td><?= date('j F Y', strtotime($results['order_date'])) ?></td>
            </tr>
            <tr>
              <td>Payment Method  : </td>
              <td><?= $results['pmode'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="items">
        <h3>Products:</h3>
        <table>
          <thead>
            <tr>
              <th>Product</th>
              <th>Qty</th>
              <th>Item Price</th>
              <th>Total Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $productArray = explode(', ', $results['nameProducts']);
            $priceArray = explode(', ', $results['priceProducts']);
            $quantityArray = explode(', ', $results['qtys']);
            $allTotal = 0;
            for ($i = 0; $i < count($productArray); $i++) {
              $subTotalItem = $quantityArray[$i] * $priceArray[$i];
              $allTotal += $subTotalItem;
              $subTotalItemFormatted = number_format($subTotalItem);
              $priceFormatted = number_format($priceArray[$i]);
              echo "<tr>
                      <td>{$productArray[$i]}</td>
                      <td>{$quantityArray[$i]}</td>
                      <td>Rp. {$priceFormatted}</td>
                      <td>Rp. {$subTotalItemFormatted}</td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="total">
        <p>Subtotal</p>
        <p>Rp. <?= number_format($allTotal); ?></p>
      </div>
      <?php
      $amount_paid = $results['amount_paid'];
      $discountAmount = $allTotal - $amount_paid;
      $discountPercentage = ($discountAmount / $allTotal) * 100;
      ?>
      <div class="total">
        <p>Discount (<?= number_format($discountPercentage); ?>%)</p>
        <p>Rp. <?= number_format($discountAmount); ?> </p>
      </div>
      <div class="total">
        <strong>
          <p>Amount Paid</p>
        </strong>
        <strong>
          <p>Rp. <?= number_format($amount_paid); ?></p>
        </strong>
      </div>
    </div>
    <div class="receipt-footer">
      <p><?= date("d-m-Y"); ?></p>
      <p>Bloom & Bliss Admin</p>
    </div>
  </div>
  <script>
    window.print();
  </script>
</body>

</html>

<?php
$conn->close();
?>
