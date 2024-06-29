<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/admin/css/bootstrap.min.css" />
</head>

<body onload="print()">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h1>Laporan Produk pada Website Bouquet</h1>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Bouquet Code</th>
                                <th>Bouquet Name</th>
                                <th>Price</th>
                                <!-- <th>Quantity</th> -->
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../koneksi.php';
                            $stmt = $conn->prepare('SELECT * FROM tb_produk');
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($row = $result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?= $row['bouquet_code'] ?></td>
                                    <td><?= $row['bouquet_name'] ?></td>
                                    <td>Rp <?= number_format($row['bouquet_price']) ?></td>
                                    <td><?= $row['bouquet_category'] ?></td>
                                </tr>
                                <?php
                            endwhile;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr></tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>