<!-- header -->
<?php include ('layout/header.php'); ?>

<!-- start content -->

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Produk</h3>
                <h6 class="op-7 mb-2">Manajemen produk Bloom & Bliss</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Produk</h4>
                        <div class="d-flex justify-content-end">
                            <a href="addProductPage.php" class="btn btn-primary">Tambah Produk</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="katalog-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Bouquet Code</th>
                                        <th>Bouquet Name</th>
                                        <th>Price</th>
                                        <!-- <th>Quantity</th> -->
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
                                    $stmt = $conn->prepare('SELECT * FROM tb_produk');
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td><?= $row['bouquet_code'] ?></td>
                                            <td><?= $row['bouquet_name'] ?></td>
                                            <td>Rp <?= number_format($row['bouquet_price']) ?></td>
                                            <td><?= $row['bouquet_category'] ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary btn-round" data-bs-toggle="modal"
                                                    data-bs-target="#viewDetailProdukid<?= $row['bouquet_id'] ?>"><i
                                                        class="fas fa-eye" aria-hidden="true"></i></button>
                                                <a href="editProductPage.php?id=<?= $row['bouquet_id'] ?>"
                                                    class="btn btn-sm btn-warning btn-round"><i class="fas fa-edit"
                                                        aria-hidden="true"></i></a>
                                                <button class="btn btn-sm btn-danger btn-round delete-button"
                                                    data-id="<?php echo $row['bouquet_id']; ?>" data-type="product"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <!-- modal -->
                                        <?php include ('layout/modal.php'); ?>
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
    <!-- end content -->


    <!-- footer -->
    <?php include ('layout/footer.php'); ?>