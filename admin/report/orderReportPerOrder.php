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
  <title>Receipt</title>
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

    .receipt-header{
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

    .receipt-body .info p {
      margin: 5px 0;
    }

    .receipt-body .items {
      margin-top: 10px;
      border-bottom: 1px solid #000;
    }

    .receipt-body .items table {
      width: 100%;
      border-collapse: collapse;
    }

    .receipt-body .items th, .receipt-body .items td {
      border: 1px solid #000;
      padding: 8px;
      text-align: left;
    }

    .receipt-body .total{
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    } 

    .receipt-footer{
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
      <h1>Data Detail Pesanan Bloom & Bliss</h1>
      <h3>Order Detail <?= $order_id ?></h3>
    </div>
    <div class="receipt-body">
      <div class="info">
        <div>
          <p>Nama Customer:</p>
          <p>Tanggal Order:</p>
          <p>Metode Payment:</p>
        </div>
        <div>
          <p><?= $results['nama_user'] ?></p>
          <p><?= date('j F Y', strtotime($results['order_date'])) ?></p>
          <p><?= $results['pmode'] ?></p>
        </div>
      </div>
      <div class="items">
        <h3>Products:</h3>
        <table>
          <thead>
            <tr>
              <th>Nama Produk</th>
              <th>Qty</th>
              <th>Harga Asli</th>
              <th>Total per Item</th>
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
      <div class="total">
        <p>Diskon</p>
        <p>Rp. <!-- Diskon di sini, tambahkan logika PHP jika diperlukan --></p>
      </div>
      <div class="total">
        <p>Total Amount</p>
        <p>Rp. <?= number_format($results['amount_paid']); ?></p>
      </div>
    </div>
    <div class="receipt-footer">
      <p><?= date("d-m-Y"); ?></p>
      <p>Admin Bloom & Bliss</p>
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
