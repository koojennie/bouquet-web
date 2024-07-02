<!-- header -->
<?php include ('layout/header.php'); ?>

<!-- start content -->

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Order</h3>
                <h6 class="op-7 mb-2">Manajemen laporan Bloom & Bliss</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Order</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="katalog-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name Customer</th>
                                        <th>Product (qty)</th>
                                        <th>Total Price</th>
                                        <th>Method Payment</th>
                                        <th>Order Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
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
                                            <td>
                                                <button class="btn btn-sm btn-primary btn-round" data-bs-toggle="modal"
                                                    data-bs-target="#viewDetailOrderid<?= $row['order_id'] ?> "><i
                                                        class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-danger btn-round delete-button"
                                                    data-id="<?php echo $row['order_id']; ?>" data-type="order"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        <?php include ('layout/modalDetailOrder.php'); ?>

                                        <?php
                                    endforeach;
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