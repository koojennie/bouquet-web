<?php
include ('layout/header.php');

?>

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Add User</h3>
                <h6 class="op-7 mb-2">Manajemen user Bloom & Bliss</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add User</div>
                    </div>
                    <div class="card-body">
                        <form action="action/insertUserAction.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                        <input type="hidden" name="id_user" value="">
                                            <label for="usnUser">Username</label>
                                            <input type="text" class="form-control" id="usnUser"
                                                placeholder="Enter username" name="usn_user" value=""
                                                required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fullName">Name</label>
                                        <input type="text" class="form-control" id="fullName"
                                            placeholder="Enter name" name="nama_user" value="" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="emailUser">Email</label>
                                        <input type="email" class="form-control" id="emailUser" value=""
                                            placeholder="Enter email" name="email_user" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="noUser">Phone Number</label>
                                        <input type="text" class="form-control" id="noUser" value="" 
                                            placeholder="Enter phone number" name="notelp_user" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwUser">Password</label>
                                        <input type="password" class="form-control" id="pwUser" value="" 
                                            placeholder="Enter password" name="pw_user" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 pt-5">
                                    <a href="user.php" class="btn btn-secondary">BACK</a>
                                    <button class="btn btn-primary" type="submit">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script></script> -->

<!-- footer -->
<?php include ('layout/footer.php') ?>