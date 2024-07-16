<!-- header php -->
<?php 
include('layout/header.php');

include('../koneksi.php');

// jumlah product 
$stmtProduct = $conn->prepare("SELECT * FROM tb_produk");
$stmtProduct->execute();
$resultProduct = $stmtProduct->get_result()->num_rows;


// jumlah users
$stmtUser = $conn->prepare("SELECT * FROM tb_user");
$stmtUser->execute();
$resultUser = $stmtUser->get_result()->num_rows;


// jumlah pendapatan
$stmtPaid = $conn->prepare("SELECT SUM(amount_paid) FROM orders");
$stmtPaid->execute();
$resultPaid = $stmtPaid->get_result()->fetch_assoc();

// jumlah orders
$stmtOrders = $conn->prepare("SELECT * FROM orders");
$stmtOrders->execute();
$resulOrders = $stmtOrders->get_result()->num_rows;

?>

            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                            <h6 class="op-7 mb-2">Welcome Admin!</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fa-solid fa-tag"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Products</p>
                                                <h4 class="card-title"><?= $resultProduct ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Users</p>
                                                <h4 class="card-title"><?= $resultUser ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                                <i class="fa-solid fa-basket-shopping"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Sales</p>
                                                <h4 class="card-title"><?= number_format($resultPaid['SUM(amount_paid)'])?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                <i class="far fa-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Orders</p>
                                                <h4 class="card-title"><?= $resulOrders ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!-- footer -->
<?php include("layout/footer.php") ?>