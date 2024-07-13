<?php
$month = $_POST['month'];
$year = $_POST['year'];
$monthName;

switch ($month) {
  case 12:
    $monthName = "DESEMBER";
    break;
  case 11:
    $monthName = "NOVEMBER";
    break;
  case 10:
    $monthName = "OKTOBER";
    break;
  case 9:
    $monthName = "SEPTEMBER";
    break;
  case 8:
    $monthName = "AGUSTUS";
    break;
  case 7:
    $monthName = "JULI";
    break;
  case 6:
    $monthName = "JUNI";
    break;
  case 5:
    $monthName = "MEI";
    break;
  case 4:
    $monthName = "APRIL";
    break;
  case 3:
    $monthName = "MARET";
    break;
  case 2:
    $monthName = "FEBRUARI";
    break;
  case 1:
    $monthName = "JANUARI";
    break;
  default:
    $monthName = "BULAN TIDAK DIKENALI";
    break;
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Laporan Penjualan Per Bulan</title>
  <link href="../../assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body onload="print()">
  <!--Menampilkan data detail obat-->
  <?php
  include '../../koneksi.php';
  ?>

  <div class="row">
    <div class="text-center">
      <h1>Bloom & Bliss</h1>
      <h3>Laporan Bulanan</h3>
      <h5>BULAN <?= $monthName ?> TAHUN <?= $year ?></h5>
      <br/>
      <table class="table table-bordered table-striped table-hover">
        <tbody>
          <thead>
            <tr>
              <td>No</td>
              <th>Order Date</th>
              <th>Product Code</th>
              <th>Product</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Total Price</th>
            </tr>
          </thead>
        <tbody>
          <tr>
            <?php
            $query = "
              SELECT 
                orders.order_date ,
                tb_produk.bouquet_code ,
                tb_produk.bouquet_name ,
                tb_produk.bouquet_price,
                tb_produk.bouquet_image,
                SUM(order_detail.qty) AS `Quantity`,
                SUM(tb_produk.bouquet_price * order_detail.qty) AS `Total Price`
            FROM 
                orders
            JOIN 
                order_detail  ON orders.order_id = order_detail.order_id
            JOIN 
                tb_produk  ON order_detail.bouquet_id = tb_produk.bouquet_id
            WHERE
                YEAR(orders.order_date) = ? AND MONTH(orders.order_date) = ?
            GROUP BY 
                orders.order_date, tb_produk.bouquet_code, tb_produk.bouquet_name
            ORDER BY 
                orders.order_date DESC;
                  ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $year, $month);
            $stmt->execute();
            $result = $stmt->get_result();
            $results = $result->fetch_all(MYSQLI_ASSOC);
            $num = 0;
            // var_dump($results);
            // die;
            
            foreach ($results as $row):
              $num += 1;
              ?>
            <tr>
              <td><?= $num ?></td>
              <td><?= $row['order_date'] ?></td>
              <td><?= $row['bouquet_code'] ?></td>
              <td><?= $row['bouquet_name'] ?></td>
              <td>Rp. <?= number_format($row['bouquet_price']) ?></td>
              <td><?= $row['Quantity'] ?></td>
              <td>
                <?php ?>
                Rp. <?= number_format($row['Total Price']) ?>
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