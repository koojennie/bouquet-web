<?php include ("layout/header.php");?>

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">User</h3>
                <h6 class="op-7 mb-2">Manajemen user Bloom & Bliss</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel User</h4>
                        <div class="d-flex justify-content-end">
                            <a href="addUserPage.php" class="btn btn-primary">Tambah User</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="katalog-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama User</th>
                                        <th>Email User</th>
                                        <th>No Handphone</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
                                    $stmt = $conn->prepare('SELECT * FROM tb_user');
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $num = 0;
                                    while ($row = $result->fetch_assoc()):
                                        $num++;
                                        ?>
                                        <tr>
                                            <td><?= $num; ?></td>
                                            <td><?= $row['usn_user'] ?></td>
                                            <td><?= $row['nama_user'] ?></td>
                                            <td><?= $row['email_user'] ?></td>
                                            <td><?= $row['notelp_user'] ?></td>
                                            <td>
                                                <a href="editUserPage.php?id=<?= $row['id_user'] ?>"
                                                    class="btn btn-sm btn-warning btn-round"><i class="fas fa-edit"
                                                        aria-hidden="true"></i></a>
                                                <button class="btn btn-sm btn-danger btn-round delete-button"
                                                    data-id="<?php echo $row['id_user']; ?>" data-type="User"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
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

<?php include ("layout/footer.php"); ?>