<div class="modal fade" id="viewDetailProdukid<?= $row['bouquet_id'] ?>" tabindex="-1"
  aria-labelledby="ModalLabelDetail<?= $row['bouquet_name'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabelDetail<?= $row['bouquet_name'] ?>">Detail Produk
          <strong><?= $row['bouquet_name'] ?></strong>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-8">
            <div class="col-lg-4">
              <div class="form-group">
                <input type="hidden" name="bouquet_id" value="<?= $row['bouquet_id'] ?>">
                <label for="bouquetCode">Code Bouqeut</label>
                <input type="text" class="form-control" id="bouquetCode" placeholder="Enter code" name="bouquet_code"value="<?= $row['bouquet_code'] ?>" disabled />
              </div>
            </div>
            <div class="form-group">
              <label for="bouquetName">Name Bouqeut</label>
              <input type="text" class="form-control" id="bouquetName" placeholder="Enter Name" name="bouquet_name"
                value="<?= $row['bouquet_name'] ?>" disabled />
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Image Bouquet</label>
            </div>
            <div class="form-group">
              <img src="../assets/images/flowers/<?= $row['bouquet_image'] ?>" class="img-thumbnail"
                style="max-width:180px" alt="">
            </div>
            <div class="form-group">
              <label for="comment">Description</label>
              <textarea class="form-control" id="comment" name="bouquet_description" rows="5"
                disabled><?= $row['bouquet_description'] ?></textarea>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="bouquetType">Type Bouquet</label>
              <input type="text" class="form-control" id="bouquetType" placeholder="Enter type" name="bouquet_type"
                value="<?= $row['bouquet_type'] ?>" disabled/>
            </div>
            <div class="form-group">
              <label for="bouquetPrice">Price (Rp)</label>
              <input type="text" class="form-control" id="bouquetPrice" placeholder="Price" name="bouquet_price"
                value="<?= number_format($row['bouquet_price']); ?>" disabled/>
            </div>
            <div class="form-group">
              <label for="bouquetQuantity">Quantity</label>
              <input type="number" class="form-control" id="bouquetQuantity" min="0" name="bouquet_qty"
                value="<?= $row['bouquet_qty'] ?>" disabled/>
            </div>
            <div class="form-group">
              <label for="bouquetRatings">Ratings</label>
              <input type="number" class="form-control" id="bouquetRatings" step=".01" name="bouquet_ratings"
                value="<?= $row['bouquet_ratings'] ?>" disabled/>
            </div>

            <div class="form-group">
              <label for="bouquetCategory">Category Bouqeut</label>
              <select class="form-select form-control" name="bouquet_category" id="bouquetCategory" disabled>
                <option value="wedding" <?= $row['bouquet_category'] == 'wedding' ? "selected" : "" ?>>Wedding</option>
                <option value="graduation" <?= $row['bouquet_category'] == 'graduation' ? "selected" : "" ?>>Graduation
                </option>
                <option value="birthday" <?= $row['bouquet_category'] == 'birthday' ? "selected" : "" ?>>Birthday
                </option>
              </select>
            </div>
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