<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Daftar kode promo dan diskon yang sesuai
    $promo_codes = [
        'WELCOMEMB10%' => 0.10,
        // tambahkan kode promo lain jika diperlukan
    ];

    $promo_code = $_POST['promo'];
    $grand_total = $_POST['grand_total'];
    $response = [
        'success' => false,
        'new_total' => $grand_total,
        'new_total_value' => $grand_total,
        // 'discount' => null,
        'message' => 'Invalid promo code'
    ];

    if (array_key_exists($promo_code, $promo_codes)) {
        $discount = $promo_codes[$promo_code];
        $new_total = $grand_total - ($grand_total * $discount);
        $response['success'] = true;
        $response['new_total'] = number_format($new_total);
        $response['new_total_value'] = $new_total;
        $response['discount'] = $discount;
        $response['message'] = 'Promo code applied successfully';
    }

    echo json_encode($response);
}
?>