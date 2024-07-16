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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Kaiadmin JS -->
<script src="../assets/admin/js/kaiadmin.min.js"></script>

<script>
    $(document).ready(function () {
        // Inisialisasi DataTables
        $("#katalog-datatables").DataTable({
            // columnDefs: [{ width: '10%', targets: 0 }]
        });

        // Tampilkan SweetAlert berdasarkan pesan success
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');
        const reason = urlParams.get('reason');
        const type = urlParams.get('type');

        if (message === 'success') {
            if (type === 'adduser') {
                Swal.fire({
                    title: 'Success!',
                    icon: 'success',
                    text: 'User berhasil ditambahkan',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#fb6f92'
                }).then(() => {
                    const newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
                    window.history.replaceState({ path: newURL }, '', newURL);
                });
            } else if(type=='updateuser'){
                Swal.fire({
                    title: 'Success!',
                    icon: 'success',
                    text: 'User berhasil diupdate',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#fb6f92'
                }).then(() => {
                    const newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
                    window.history.replaceState({ path: newURL }, '', newURL);
                });
            } else if(type=='addproduct'){
                Swal.fire({
                    title: 'Success!',
                    icon: 'success',
                    text: 'Produk berhasil ditambahkan',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#fb6f92'
                }).then(() => {
                    const newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
                    window.history.replaceState({ path: newURL }, '', newURL);
                });
            } else if(type=='updateproduct'){
                Swal.fire({
                    title: 'Success!',
                    icon: 'success',
                    text: 'Produk berhasil diupdate',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#fb6f92'
                }).then(() => {
                    const newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
                    window.history.replaceState({ path: newURL }, '', newURL);
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: `Terdapat kesalahan ketika menghapus`,
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#fb6f92',
                });
            }
        }


        // tampilkan sweet alert untuk konfirmasi delete
        $(".delete-button").click(function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            const type = $(this).data('type'); // menentukan tipe, bisa 'product' atau 'user'

            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batalkan',
                confirmButtonColor: '#fb6f92',
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "";
                    if (type === "Produk") {
                        url = "action/deleteProductAction.php";
                    } else if (type === "User") {
                        url = "action/deleteUserAction.php";
                    } else if (type === "Order") {
                        url = "action/deleteOrderAction.php";
                    }

                    $.ajax({
                        // lakukan request dengan ajax
                        url: url,
                        type: "POST",
                        data: { id: id },
                        success: function (response) {
                            Swal.fire({
                                title: 'Success!',
                                text: `${type} berhasil dihapus!`,
                                icon: 'success',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#fb6f92',
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            Swal.fire({
                                title: 'Error!',
                                text: `Error ketika menghapus ${type}`,
                                icon: 'error',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#fb6f92',
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Cancelled',
                        text: `${type} tidak jadi dihapus!`,
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#fb6f92',
                    });
                }
            });
        });

        
    });
</script>

</body>

</html>