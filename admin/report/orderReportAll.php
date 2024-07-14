<!DOCTYPE html>
<html>

<head>
  <title>Pemesanan</title>
  <link href="../../assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body onload="print()">
  <!--Menampilkan data detail obat-->
  <?php
  include '../../koneksi.php';
  ?>

  <div class="row">
    <div class="text-center">
      <img src="../../assets/images/header-report.png" alt="logo" width="300">
      <h2>Detail Seluruh Pemesanan</h2>
      <br/>
      <table class="table table-bordered table-striped table-hover">
        <tbody>

          <thead>
            <tr>
              <th>Customer Name</th>
              <th>Product (qty)</th>
              <th>Total Price</th>
              <th>Method Payment</th>
              <th>Order Date</th>
            </tr>
          </thead>
        <tbody>
          <tr>
            <?php
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
              GROUP BY 
                  orders.order_id
              ORDER BY 
                  orders.order_id;
                  ";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            $results = $result->fetch_all(MYSQLI_ASSOC);

            // var_dump($results);
            // die;
            
            foreach ($results as $row):
              ?>
            <tr>
              <td><?= $row['nama_user'] ?></td>
              <td>
                <?php
                $productArray = explode(', ', $row['nameProducts']);
                $quantityArray = explode(', ', $row['qtys']);
                for ($i = 0; $i < count($productArray); $i++) {
                  echo "<p>{$productArray[$i]} ({$quantityArray[$i]})</p>";
                }
                ?>
              </td>
              <td>Rp. <?= number_format($row['amount_paid']); ?></td>
              <td><?= $row['pmode'] ?></td>
              <td>
                <?php
                $datefromdatabase = $row['order_date'];
                // Ubah format tanggal dari Y-M-D ke format yang diinginkan
                $date = date('j F Y', strtotime($datefromdatabase));
                ?>
                <?= $date ?>
              </td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>

        </tbody>
        <tfoot>
          <tr>
            <td colspan="8" class="text-right">
              <?= date("d-m-Y") ?>
              <br>
              <u>Bloom & Bliss Admin<strong></u><br>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>


</body>

</html>