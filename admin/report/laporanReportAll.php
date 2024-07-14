<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penjualan</title>
    <link href="../../assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body onload="print()">
    <!--Menampilkan data detail obat-->
    <?php
    include '../../koneksi.php';
    ?>

    <div class="row">
        <div class="text-center">
            <img src="../../assets/images/header-report.png" alt="logo" width="300">
            <h2>Laporan Penjualan</h2>
            <br/>
            <table class="table table-bordered table-striped table-hover">
                <tbody>

                    <thead>
                        <tr>
                            <td>No</td>
                            <th>Order Date</th>
                            <th>Product Code</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                <tbody>
                    <tr>
                        <?php
                        $query = "
              SELECT 
                orders.order_date ,
                tb_produk.bouquet_code ,
                tb_produk.bouquet_name ,
                tb_produk.bouquet_price,
                tb_produk.bouquet_image,
                SUM(order_detail.qty) AS `Quantity`,
                SUM(tb_produk.bouquet_price * order_detail.qty) AS `Total Price`
            FROM 
                orders
            JOIN 
                order_detail  ON orders.order_id = order_detail.order_id
            JOIN 
                tb_produk  ON order_detail.bouquet_id = tb_produk.bouquet_id
            GROUP BY 
                orders.order_date, tb_produk.bouquet_code, tb_produk.bouquet_name
            ORDER BY 
                orders.order_date DESC;
                  ";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $results = $result->fetch_all(MYSQLI_ASSOC);
                        $num = 0;
                        // var_dump($results);
                        // die;
                        
                        foreach ($results as $row):
                            $num += 1;
                            ?>
                        <tr>
                            <td><?= $num ?></td>
                            <td><?= $row['order_date'] ?></td>
                            <td><?= $row['bouquet_code'] ?></td>
                            <td><?= $row['bouquet_name'] ?></td>
                            <td>Rp. <?= number_format($row['bouquet_price']) ?></td>
                            <td><?= $row['Quantity'] ?></td>
                            <td>
                                <?php ?>
                                Rp. <?= number_format($row['Total Price']) ?>
                            </td>
                        </tr>
                        <?php
                        endforeach;
                        ?>
                </tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8" class="text-right">
                            <?= date("d-m-Y") ?>
                            <br>
                            <u>Bloom & Bliss Admin<strong></u><br>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


</body>

</html>