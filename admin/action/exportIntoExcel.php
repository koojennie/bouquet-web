<?php

require '../../vendor/autoload.php'; // Mengimpor autoload file dari Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

// Mengimpor file koneksi ke database
include("../../koneksi.php");

// Membuat objek spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Menambahkan judul pada sheet
$sheet->setCellValue('A1', 'Laporan Penjualan Bloom & Bliss');
$sheet->setCellValue('A2', 'Print date :' . date('j F Y'));

// Mengatur style untuk judul
$titleStyle = [
    'font' => [
        'bold' => true,
        'size' => 14,
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
    ],
];

// Mengatur style untuk paragraf biasa
$pStyle = [
    'font' => [
        'bold' => false,
        'size' => 12,
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
    ],
];

$sheet->mergeCells('A1:G1');
$sheet->mergeCells('A2:G2');
$sheet->getStyle('A1:G1')->applyFromArray($titleStyle);
$sheet->getStyle('A2:G2')->applyFromArray($pStyle);

// Menambahkan satu baris kosong
$sheet->setCellValue('A3', '');

// Menambahkan header pada sheet
$headers = ["No", "Order Date", "Product Code", "Product", "Price", "Qty", "Total Price"];
$sheet->fromArray($headers, null, 'A4');

// Memberikan warna dan border pada header serta mengatur alignment teks ke tengah
$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['argb' => Color::COLOR_BLACK],
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['argb' => 'FFC0CB'], // Warna pink
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
];

$sheet->getStyle('A4:G4')->applyFromArray($headerStyle);

// Fetch data records from database
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
$rowIndex = 5; // Mulai dari baris kelima karena baris pertama dan kedua digunakan untuk judul, baris ketiga untuk baris kosong, dan baris keempat untuk header
$totalQty = 0;
$totalPrice = 0;

while ($row = $result->fetch_assoc()) {
    $sheet->fromArray(
        [
            $no,
            $row['order_date'],
            $row['bouquet_code'],
            $row['bouquet_name'],
            $row['bouquet_price'],
            $row['Quantity'],
            $row['Total Price']
        ],
        null,
        "A$rowIndex"
    );

    // Mengatur format mata uang untuk kolom harga dan total harga
    $sheet->getStyle("E$rowIndex")->getNumberFormat()->setFormatCode('Rp #,##0');
    $sheet->getStyle("G$rowIndex")->getNumberFormat()->setFormatCode('Rp #,##0');

    // Menambahkan border pada setiap sel data
    $sheet->getStyle("A$rowIndex:G$rowIndex")->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ],
    ]);

    // Menambahkan total Qty dan Total Price
    $totalQty += $row['Quantity'];
    $totalPrice += $row['Total Price'];

    $no++;
    $rowIndex++;
}

// Menambahkan total Qty dan Total Price di baris baru
$sheet->setCellValue("A$rowIndex", 'Total Buket Terjual');
$sheet->setCellValue("C$rowIndex", $totalQty);
$sheet->setCellValue("D$rowIndex", 'Total Penjualan');
$sheet->setCellValue("F$rowIndex", $totalPrice);

// Menggabungkan kolom untuk label total
$sheet->mergeCells("A$rowIndex:B$rowIndex");
$sheet->mergeCells("D$rowIndex:E$rowIndex");
$sheet->mergeCells("F$rowIndex:G$rowIndex");

// Mengatur style untuk total
$totalStyle = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
    ],
];

$sheet->getStyle("A$rowIndex:G$rowIndex")->applyFromArray($totalStyle);

// Mengatur format mata uang untuk total penjualan
$sheet->getStyle("F$rowIndex")->getNumberFormat()->setFormatCode('Rp #,##0');

// Mengatur lebar kolom agar otomatis menyesuaikan dengan konten
foreach (range('A', 'G') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Menyimpan file ke format Excel (.xls)
$writer = new Xls($spreadsheet);
$fileName = "Laporan Penjualan Bloom & Bliss " . date("Y-m-d") . ".xls";
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=\"$fileName\"");
$writer->save("php://output");

exit;
?>
