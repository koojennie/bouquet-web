<?php 
include ('layout/header.php');

// cek apakah ada id
$id = $_GET['id'];

if(isset($id)) {
    include "../koneksi.php";
    $query = "SELECT * FROM tb_user WHERE id_user = ?";
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
                <h3 class="fw-bold mb-3">Edit User</h3>
                <h6 class="op-7 mb-2">Manajemen user Bloom & Bliss</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit User</div>
                    </div>
                    <div class="card-body">
                        <form action="action/updateUserAction.php" method="post">
                            <input type="hidden" name="id_user" value="<?= $result['id_user'] ?>">
                            <div class="row">
                                <div class="col-lg-8">                              
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="<?= $result['usn_user'] ?>" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?= $result['nama_user'] ?>" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?= $result['email_user'] ?>" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp">Phone Number</label>
                                        <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Enter No Telp" value="<?= $result['notelp_user'] ?>" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password">
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="change_password" name="change_password">
                                        <label class="form-check-label" for="change_password">Change Password</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- Kosong untuk tampilan responsif -->
                                </div>
                                <div class="col-lg-12 pt-5">
                                    <a href="user.php" class="btn btn-secondary">BACK</a>
                                    <button type="submit" class="btn btn-primary">UPDATE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- footer -->
<?php include ('layout/footer.php') ?>
