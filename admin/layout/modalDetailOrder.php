<div class="modal fade" id="viewDetailOrderid<?= $row['bouquet_id'] ?>" tabindex="-1"
  aria-labelledby="ModalLabelDetail<?= $row['order_id'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabelDetail<?= $row['order_id'] ?>">Detail Produk
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
            <a class="btn btn-primary mb-3" data-bs-toggle="collapse" href="#collapseViewCustomer" role="button"
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
                        Nama Customer
                      </h6>
                      <h6>
                        <b><?= $row['nama_user'] ?></b>
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
                        Email Customer
                      </h6>
                      <h6>
                        <b><?= $row['email_user'] ?></b>
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
                        Number Telp Customer
                      </h6>
                      <h6>
                        <b><?= $row['notelp_user'] ?></b>
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
                        Alamat Customer
                      </h6>
                      <h6>
                        <b><?= $row['address'] ?></b>
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
            <a class="btn btn-primary mb-3" data-bs-toggle="collapse" href="#collapseViewDetailOrder" role="button"
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
                        Order Id
                      </h6>
                      <h6>
                        <b><?= $row['order_id'] ?></b>
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
                        Total Price
                      </h6>
                      <h6>
                        <b>Rp.<?= number_format($row['amount_paid']) ?></b>
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
                        Metode Payment
                      </h6>
                      <h6>
                        <b><?= $row['pmode'] ?></b>
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
                        Order Date
                      </h6>
                      <h6>
                        <?php 
                          $datefromdatabase = $row['order_date'];
                          // Ubah format tanggal dari Y-M-D ke format yang diinginkan
                          $date = date('j F Y', strtotime($datefromdatabase));
                        ?>
                        <b><?= $date ?></b>
                      </h6>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <!-- <table>
                  <th>Nama</th>
                  <th>Prices</th>
                  
                </table> -->
              </div>
              <!-- <div class="col-12">
                <div class="card card-info">
                  <div class="d-flex align-item-center">
                    <h6 class="mb-1">
                      Order
                    </h6>
                    <table>
                        <th>No</th>
                        <th>Pesanan</th>
                        <th>Harga</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                    </table>
                  </div>
                </div>
              </div> -->
              
            </div>
          </div>



        </div>


        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
    </div>
  </div>