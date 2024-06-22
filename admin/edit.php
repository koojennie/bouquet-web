<?php 
include ('layout/header.php');


// cek apakah ada id
$id = $_GET['id'];

if(isset($id)) {
    include "../koneksi.php";
    $query = "SELECT * FROM tb_produk WHERE bouquet_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
}

?>

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Edit Product</h3>
                <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Product</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="bouquetCode">Code Bouqeut</label>
                                        <input type="text" class="form-control" id="bouquetCode" placeholder="Enter code" value="<?= $result['bouquet_code'] ?>" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bouquetName">Name Bouqeut</label>
                                    <input type="text" class="form-control" id="bouquetName" placeholder="Enter Name" value="<?= $result['bouquet_name'] ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Image Bouquet</label>
                                    <input type="file" class="form-control" id="exampleInputName1" value=""
                                        name="image" <?= empty($result['bouquet_image']) ? 'required' : '' ?>>
                                </div>
                                <small id="emailHelp2" class="form-text text-muted">Preview image</small>
                                <div class="form-group">
                                    <img src="../assets/images/flowers/<?= $result['bouquet_image'] ?>" class="img-thumbnail" style="max-width:120px" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="comment">Description</label>
                                    <textarea class="form-control" id="comment" rows="5" required><?= $result['bouquet_description'] ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="bouquetType">Type Bouquet</label>
                                    <input type="text" class="form-control" id="bouquetType" placeholder="Enter type" value="<?= $result['bouquet_type'] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="bouquetPrice">Price (Rp)</label>
                                    <input type="text" class="form-control" id="bouquetPrice" placeholder="Price" value="<?= $result['bouquet_price'] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="bouquetQuantity">Quantity</label>
                                    <input type="number" class="form-control" id="bouquetQuantity" min="0" value="<?= $result['bouquet_qty'] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="bouquetRatings">Ratings</label>
                                    <input type="number" class="form-control" id="bouquetRatings"  step=".01" value="<?= $result['bouquet_ratings']?>"/>
                                </div>
                                
                                <div class="form-group">
                                    <label for="bouquetCategory">Category Bouqeut</label>
                                    <select class="form-select form-control" id="bouquetCategory">
                                        <option value="wedding" <?= $result['bouquet_category'] == 'wedding' ? "selected": ""?> >Wedding</option>
                                        <option value="graduation" <?= $result['bouquet_category'] == 'graduation' ? "selected": ""?> >Graduation</option>
                                        <option value="birthday" <?= $result['bouquet_category'] == 'birthday' ? "selected": ""?>>Birthday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 pt-5">
                                <a href="produk.php" class="btn btn-secondary">BACK</a>
                                <button class="btn btn-primary">UPDATE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
<?php include ('layout/footer.php') ?>