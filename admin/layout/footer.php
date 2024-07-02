<footer class="footer">
    <div class="container-fluid d-flex justify-content-center">
        <div class="copyright">
            2024 Develop by Developer <i class="fa fa-heart heart text-danger"></i> Us
        </div>
    </div>
</footer>
</div>



<!-- End Custom template -->
</div>
<!--   Core JS Files   -->
<script src="../assets/admin/js/core/jquery-3.7.1.min.js"></script>
<script src="../assets/admin/js/core/popper.min.js"></script>
<script src="../assets/admin/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="../assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Chart JS -->
<script src="../assets/admin/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="../assets/admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="../assets/admin/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="../assets/admin/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<!-- <script src="../assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> -->

<!-- jQuery Vector Maps -->
<script src="../assets/admin/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="../assets/admin/js/plugin/jsvectormap/world.js"></script>

<!-- Sweet Alert -->
<script src="../assets/admin/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Kaiadmin JS -->
<script src="../assets/admin/js/kaiadmin.min.js"></script>

<script>
    $(document).ready(function () {
        // Inisialisasi DataTables
        $("#katalog-datatables").DataTable({
            // columnDefs: [{ width: '10%', targets: 0 }]
        });

        // Tampilkan SweetAlert berdasarkan pesan successs
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');
        const reason = urlParams.get('reason');

        if (message === 'success') {
            swal("Success!", "", {
                icon: "success",
                buttons: {
                    confirm: {
                        className: "btn btn-success",
                    },
                },
            });
        }

        // tampilkan sweet alert untuk konfirmasi delete
        // $(".delete-button").click(function (e) {
        //     e.preventDefault();
        //     const id = $(this).data('id');

        //     swal({
        //         title: "Apakah ada yakin ingin menghapus?",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //     })
        //     .then((willDelete) => {
        //         if (willDelete) {
        //             $.ajax({
        //                 // lakukan request dengan ajax
        //                 url: "action/deleteProductAction.php",
        //                 type: "POST",
        //                 data: {id: id},
        //                 success: function (response) {
        //                     swal("Success! produk berhasil dihapus!", {
        //                         icon: "success",
        //                     }).then(() => {
        //                         location.reload();
        //                     });
        //                 },
        //                 error: function () {
        //                     swal("Error!", "Error ketika menghapus data", "error");
        //                 }
        //             })
        //         } else {
        //             swal("Gagal dihapus");
        //         }
        //     })
        // })

        $(".delete-button").click(function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            const type = $(this).data('type'); // menentukan tipe, bisa 'product' atau 'user'


            swal({
                title: "Apakah Anda yakin ingin menghapus?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    let url = "";
                    if (type === "product") {
                        url = "action/deleteProductAction.php";
                    } else if (type === "user") {
                        url = "action/deleteUserAction.php";
                    } else if (type === "order"){
                        url = "action/deleteOrderAction.php";
                    }

                    $.ajax({
                        // lakukan request dengan ajax
                        url: url,
                        type: "POST",
                        data: {id: id},
                        success: function (response) {
                            swal(`Success! ${type} berhasil dihapus!`, {
                                icon: "success",
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            swal("Error!", `Error ketika menghapus ${type}`, "error");
                        }
                    });
                } else {
                    swal("Gagal dihapus");
                }
            });
        });
    });

</script>
</body>

</html>