<div class="modal fade" id="viewDetailOrderid<?= $row['order_id'] ?>" tabindex="-1"
  aria-labelledby="ModalLabelDetail<?= $row['order_id'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabelDetail<?= $row['order_id'] ?>">Detail Order
          <strong><?= $row['order_id'] ?></strong>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body">

        <!-- collapse & button collapse customer  -->
        <div class="align-item-center row">
          <div class="col-8">
            <h5 class="mb-1 mx-2">Customer</h5>
          </div>
          <div class="col-4">
            <a class="btn btn-primary btn-rounded mb-3" data-bs-toggle="collapse" href="#collapseViewCustomer" role="button"
              aria-expanded="false" aria-controls="collapseViewCustomer">
              Show / Hide
            </a>
          </div>

          <!-- collapse customer -->
          <div class="collapse" id="collapseViewCustomer">
            <div class="row">
              <div class="col-sm-6 col-lg-4">
                <div class="card card-info p-3">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-1">
                        <b>Name</b>
                      </h6>
                      <h6>
                        <?= $row['nama_user'] ?>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card card-info p-3">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-1">
                       <b>Email</b>
                      </h6>
                      <h6>
                        <?= $row['email_user'] ?>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card card-info p-3">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-1">
                        <b>Phone Number</b>
                      </h6>
                      <h6>
                        <?= $row['notelp_user'] ?>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-8">
                <div class="card card-info p-3">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-1">
                       <b>Address</b>
                      </h6>
                      <h6>
                        <?= $row['address'] ?>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- collapse & button collapse orders -->
        <div class="align-item-center row">
          <div class="col-8">
            <h5 class="mb-1 mx-2">Order</h5>
          </div>
          <div class="col-4">
            <a class="btn btn-primary btn-rounded mb-3" data-bs-toggle="collapse" href="#collapseViewDetailOrder" role="button"
              aria-expanded="false" aria-controls="collapseViewDetailOrder">
              Show / Hide
            </a>
          </div>

          <!-- collapse customer -->
          <div class="collapse" id="collapseViewDetailOrder">
            <div class="row">
              <div class="col-sm-6 col-lg-2">
                <div class="card card-info p-3">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-1">
                        <b> Order ID </b>
                      </h6>
                      <h6>
                        <?= $row['order_id'] ?>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card card-info p-3">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-1">
                       <b> Total Price </b>
                      </h6>
                      <h6>
                        Rp.<?= number_format($row['amount_paid']) ?>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card card-info p-3">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-1">
                        <b>Metode Payment</b>
                      </h6>
                      <h6>
                        <?= $row['pmode'] ?>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card card-info p-3">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-1">
                        <b>Order Date </b>
                      </h6>
                      <h6>
                        <?php
                        $datefromdatabase = $row['order_date'];
                        // Ubah format tanggal dari Y-M-D ke format yang diinginkan
                        $date = date('j F Y', strtotime($datefromdatabase));
                        ?>
                        <?= $date ?>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">

              <h3>Items</h3>

                <?php
                $productArray = explode(', ', $row['nameProducts']);
                $quantityArray = explode(', ', $row['qtys']);
                $priceArray = explode(', ', $row['priceProducts']);
                $imageArray = explode(', ', $row['imageProducts']);
                $subtotal = 0;

                for ($i = 0; $i < count($productArray); $i++) {
                  $subTotalItem = $quantityArray[$i] * $priceArray[$i];
                  $subtotal += $subTotalItem;
                  ?>
                  <div class="col-lg-4">
                    <div class="card-list py-4">
                      <div class="item-list">
                        <div class="avatar">
                          <img src="../assets/images/flowers/<?= $imageArray[$i]; ?>" alt="..." class="avatar-img rounded-circle" />
                        </div>
                        <div class="info-user ms-3">
                          <div class="username"><?= $productArray[$i] ?></div>
                          <div class="status"><?= $quantityArray[$i] ?> x Rp. <?= number_format($priceArray[$i]) ?> </div>
                        </div>
                        <div class="ms-3">
                          SubTotal : Rp. <?= number_format($subTotalItem) ?>
                        </div>
                      </div>
                    </div>

                  </div>

                  <?php
                }
                ?>

              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
        <a href="report/orderReportPerOrder.php?order_id=<?= $row['order_id'] ?>" class="btn btn-info btn-round"><i class="fas fa-print"></i> Cetak</a>
        </div>
      </div>
    </div>
  </div>