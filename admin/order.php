<!-- header -->
<?php include ('layout/header.php'); ?>

<!-- start content -->

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Order</h3>
                <h6 class="op-7 mb-2">Manajemen Order</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Table Order</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="katalog-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Method Payment</th>
                                        <th>Product</th>
                                        <th>Amount Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    include '../koneksi.php';
                                    $stmt = $conn->prepare('SELECT * FROM orders');
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()):
                                        ?>
                                    <tr>
                                        <td><?= $row['name']?></td>
                                        <td><?= $row['email']?></td>
                                        <td><?= $row['phone']?></td>
                                        <td><?= $row['address']?></td>
                                        <td><?= $row['pmode']?></td>
                                        <td><?= $row['products']?></td>
                                        <td><?= $row['amount_paid']?></td>
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