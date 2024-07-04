<?php

// Mengimpor file koneksi ke database
include("../../koneksi.php");

// Filter the excel data 
function filterData(&$str) { 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

$fileName = "Report Bloom & Bliss " . date("Y-m-d") . ".xls";

// define column
$data = array(
    "No",
    "Order Date",
    "Product Code",
    "Product",
    "Harga",
    "Qty",
    "Total Harga"
);

$date = date('j F Y');
$excelData = "Laporan Penjualan Bloom & Bliss \n Print date :$date  \n\n"; // Adding header line
$excelData .= implode("\t", array_values($data)) . "\n"; 

// fetch data records from database and store in array
$query = "
SELECT 
    orders.order_date,
    tb_produk.bouquet_code,
    tb_produk.bouquet_name,
    tb_produk.bouquet_price,
    tb_produk.bouquet_image,
    SUM(order_detail.qty) AS `Quantity`,
    SUM(tb_produk.bouquet_price * order_detail.qty) AS `Total Price`
FROM 
    orders
JOIN 
    order_detail ON orders.order_id = order_detail.order_id
JOIN 
    tb_produk ON order_detail.bouquet_id = tb_produk.bouquet_id
GROUP BY 
    orders.order_date, tb_produk.bouquet_code, tb_produk.bouquet_name
ORDER BY 
    orders.order_date DESC;
 ";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$no = 1;
while ($row = $result->fetch_assoc()) {
    $lineData = array(
        $no,
        $row['order_date'], 
        $row['bouquet_code'], 
        $row['bouquet_name'], 
        $row['bouquet_price'], 
        $row['Quantity'], 
        $row['Total Price']
    );
    $no+=1;
    array_walk($lineData, 'filterData'); // Apply filterData to each element of $lineData
    $excelData .= implode("\t", array_values($lineData)) . "\n"; // Append lineData to $excelData
}

// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 

// Render excel data 
echo $excelData; 

exit;

?>
