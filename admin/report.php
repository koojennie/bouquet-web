<!-- header -->
<?php include ('layout/header.php'); ?>

<!-- start content -->

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Laporan Penjualan</h3>
                <h6 class="op-7 mb-2">Manajemen order Bloom & Bliss</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Laporan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="katalog-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Order Date</th>
                                        <th>Product Code</th>
                                        <th>Product Image</th>
                                        <th>Product</th>
                                        <th>Harga</th>
                                        <th>Quantity</th>
                                        <th>Total Harga</th>
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
                                            orders.order_date;
                                            ";

                                    // $query = "

                                    // ";

                                    $stmt = $conn->prepare($query);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()):
                                        ?>
                                    <tr>
                                        <td><?= $row['order_date']?></td>
                                        <td><?= $row['bouquet_code']?></td>
                                        <td>
                                            <img src="../assets/images/flowers/<?= $row['bouquet_image']?>" width="50px" alt="">
                                        </td>
                                        <td><?= $row['bouquet_name']?></td>
                                        <td>Rp. <?= number_format($row['bouquet_price'])?></td>
                                        <td><?= $row['Quantity']?></td>
                                        <!-- <td> belom ada</td> -->
                                        <td>
                                            <?php ?>
                                            Rp. <?= number_format($row['Total Price'])?>
                                        </td>
                                        <!-- <td><?= $row['amount_paid']?></td> -->
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
    </div>
</div>
    <!-- end content -->

    <!-- footer -->
    <?php include ('layout/footer.php'); ?>