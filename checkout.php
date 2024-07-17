<?php
session_start();
require 'koneksi.php';

// cek ada session nya gak pake id_user sama username user
if (!isset($_SESSION['id_user']) || !isset($_SESSION['usn_user'])) {
  header("Location: login_register.php");
  exit();
}

$grand_total = 0;
$allItems = '';
$items = [];

$sess_user_id = $_SESSION['id_user'];
$sess_user_username = $_SESSION['usn_user']; 

$sql = "SELECT cart.*, tb_produk.bouquet_name
  FROM cart 
  INNER JOIN tb_produk
  ON cart.bouquet_id = tb_produk.bouquet_id
  WHERE cart.user_id = ?
  ";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $sess_user_id);
$stmt->execute();
$result = $stmt->get_result();

$allProduct = [];

while ($row = $result->fetch_assoc()) {
  $grand_total += $row['total_price'];
  // $items[] = $row['ItemQty'];
  $allProduct[] = [
    'bouquet_id' => $row['bouquet_id'],
    'bouquet_qty' => $row['bouquet_qty'],
    'bouquet_name' => $row['bouquet_name'],
  ];
}
$allItems = implode(', ', $items);



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Checkout - Bloom & Bliss</title>
  <!-- for icons (font awesome) -->
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
  <!-- bootstrap  -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- for swiper slider  -->
  <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
  <!-- fancy box  -->
  <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
  <!-- custom css  -->
  <link rel="stylesheet" href="style.css">
  <!-- favicon -->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon"/>
  <!-- sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4 class="text-center text-info p-2">Complete your order!</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Product(s) : </b>
            <?php foreach ($allProduct as $row):
              ?>
              <p><?= $row['bouquet_name'] ?> (<?= $row['bouquet_qty'] ?>) </p>
            <?php endforeach ?>
          </h6>
          <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
          <h5><b>Total Amount Payable : Rp</b><span id="total-amount"><?= number_format($grand_total) ?></span></h5>
        </div>
        <form action="" method="post" id="placeOrder">
          <input type="hidden" name="session_user_id" value="<?= $sess_user_id; ?>">
          <input type="hidden" name="session_user_username" value="<?= $sess_user_username; ?>">
          <?php foreach ($allProduct as $row):
            ?>
            <input type="hidden" name="produk_id_<?= $row['bouquet_id'] ?>" value="<?= $row['bouquet_id'] ?>">
            <input type="hidden" name="produk_qty_<?= $row['bouquet_id'] ?>" value="<?= $row['bouquet_qty'] ?>">
          <?php endforeach ?>
          <input type="hidden" name="grand_total" id="total-amount-value" value="<?= $grand_total; ?>">
          <input type="hidden" name="discount" id="discount" value="">
          <div class="card">
            <div class="form-group">
              <h6><b>Your Address</b></h6>
              <textarea name="address" class="form-control" rows="3" cols="10"
                placeholder="Enter Delivery Address Here..." required oninvalid="this.setCustomValidity('Please enter your address 🏡');" 
                onchange="try{setCustomValidity('')}catch(e){};" x-moz-errormessage="Please enter your address 🏡"></textarea>
            </div>
            <div class="form-group mt-3">
              <h6><b>Payment Method</b></h6>
              <select name="pmode" class="form-control">
                <option value="" selected disabled>Select Payment Method</option>
                <option value="COD">Cash On Delivery</option>
                <option value="E-Banking">E-Banking</option>
                <option value="Card">Debit/Credit Card</option>
              </select>
            </div>
            <div class="form-group mt-3">
                <h6>Promo Code</h6>
                <input type="text" name="promo" class="form-control" id="promo-code" placeholder="Enter Promo Code Here...">
            </div>
            <div class="form-group mt-3">
                <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function () {

      // sweet alert untuk submit form
      $("#placeOrder").submit(function (e) {
        e.preventDefault();
        Swal.fire({
          title: 'Are you sure?',
          text: 'Do you want to place this order?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#fb6f92', // Ubah warna tombol OK di sini
          cancelButtonColor: '#bbb',
          confirmButtonText: 'Yes, place order!'
        }).then((result) => {
          if (result.isConfirmed) {
            // kirim data dari form ke server dengan ajax
            $.ajax({
              url: 'action.php',
              method: 'post',
              data: $('form').serialize() + "&action=order",
              success: function (response) {
                $("#order").html(response);
              }
            });
          }
        });
      });

      // Load total no.of items added in the cart and display in the navbar
      load_cart_item_number();

      function load_cart_item_number() {
        $.ajax({
          url: 'action.php',
          method: 'get',
          data: {
            cartItem: "cart_item"
          },
          success: function (response) {
            $("#cart-item").html(response);
          }
        });
      }
    });

    let usedPromoCodes = [];

    document.getElementById('promo-code').addEventListener('keyup', function(event) {
      if (event.key === 'Enter') {
        let promoCode = this.value.trim();
        let grandTotal = <?= $grand_total; ?>;

        if (usedPromoCodes.includes(promoCode)) {
          Swal.fire({
            icon: 'error',
            title: 'Promo code already used',
            text: 'You have already used this promo code. Please enter a different one.',
            confirmButtonColor: '#fb6f92' 
          });
          return;
        }

        // buat ajax req untuk diskon
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'apply_promo.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          if (xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            if (response.success) {
              Swal.fire({
                icon: 'success',
                title: 'Promo code succesfully applied',
                text: 'Great! You get 10% discount',
                confirmButtonColor: '#fb6f92'
              })
              document.getElementById('total-amount').innerText = response.new_total;
              document.getElementById('total-amount-value').value = response.new_total_value;
              document.getElementById('discount').value = response.discount;
              usedPromoCodes.push(promoCode); // Tambahkan kode promo ke daftar yang sudah digunakan
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Invalid promo code',
                text: 'Please enter the right promo code',
                confirmButtonColor: '#fb6f92' 
              });
            }
          }
        };
        xhr.send('promo=' + promoCode + '&grand_total=' + grandTotal);
      }
    });

    document.getElementById('placeOrder').addEventListener('keypress', function(event) {
      if (event.key === 'Enter') {
        event.preventDefault(); // mencegah form submit sendiri
      }
    });
  </script>

</body>

</html>