<!-- header -->
<?php include ('layout/header.php'); ?>

<!-- start content -->

<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Laporan Penjualan</h3>
        <h6 class="op-7 mb-2">Manajemen laporan Bloom & Bliss</h6>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Tabel Laporan</h4>
            <div class="d-flex justify-content-end">
              <a href="report/laporanReportAll.php" target="_blank" class="btn btn-info">Cetak Semua Data Laporan</a>
              <button class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#cetak_perbulan_laporan">Cetak
                Perbulan</button>
              <a href="action/exportIntoExcel.php" class="btn btn-success" target="_blank">Cetak Excel</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="katalog-datatables" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <td><b>NO</b></td>
                    <th>Order Date</th>
                    <th>Product Code</th>
                    <th>Product Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';
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
                  GROUP BY 
                      orders.order_date, tb_produk.bouquet_code, tb_produk.bouquet_name
                  ORDER BY 
                      orders.order_date DESC; ";

                  // $query = "
                  
                  // ";
                  
                  $stmt = $conn->prepare($query);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $num = 0;
                  while ($row = $result->fetch_assoc()):
                    $num += 1;
                    ?>
                    <tr>
                      <td><?= $num ?></td>
                      <td><?= $row['order_date'] ?></td>
                      <td><?= $row['bouquet_code'] ?></td>
                      <td>
                        <img src="../assets/images/flowers/<?= $row['bouquet_image'] ?>" width="40px" alt="">
                      </td>
                      <td><?= $row['bouquet_name'] ?></td>
                      <td>Rp. <?= number_format($row['bouquet_price']) ?></td>
                      <td><?= $row['Quantity'] ?></td>
                      <td>
                        <?php ?>
                        Rp. <?= number_format($row['Total Price']) ?>
                      </td>
                    </tr>

                    <?php
                  endwhile;
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include ('layout/modalCetak.php'); ?>
  </div>
</div>
<!-- end content -->

<!-- footer -->
<?php include ('layout/footer.php'); ?>