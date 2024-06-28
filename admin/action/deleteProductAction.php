<?php
// File action delete

// Mengimpor file koneksi ke database
include ("../../koneksi.php");

// Cek apakah ada permintaan POST dan apakah ID telah diset
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Mendapatkan ID dari permintaan POST
    $id = $_POST['id'];

    var_dump($id);

    // Siapkan pernyataan SQL untuk menghapus data
    $sql = "DELETE FROM tb_produk WHERE bouquet_id = ?";

    // Persiapkan pernyataan
    if ($stmt = $conn->prepare($sql)) {
        // Ikat variabel ke pernyataan sebagai parameter
        $stmt->bind_param("i", $id);

        // Jalankan pernyataan
        if ($stmt->execute()) {
            // Jika penghapusan berhasil
            echo "success";
        } else {
            // Jika penghapusan gagal
            echo "error";
        }

        // Tutup pernyataan
        $stmt->close();
    } else {
        // Jika pernyataan gagal disiapkan
        echo "error";
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika tidak ada permintaan POST atau ID tidak diset
    echo "invalid_request";
}
?>
