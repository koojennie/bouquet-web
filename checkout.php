<?php
require 'koneksi.php';

$grand_total = 0;
$allItems = '';
$items = [];

$sql = "SELECT cart.*, tb_produk.bouquet_name
  FROM cart 
  INNER JOIN tb_produk
  ON cart.bouquet_id = tb_produk.bouquet_id
  ";
$stmt = $conn->prepare($sql);
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

// var_dump($allProduct);
// die;



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
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4 class="text-center text-info p-2">Complete your order!</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <!-- <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6> -->
          <h6 class="lead"><b>Product(s) : </b>
            <?php foreach ($allProduct as $row):
              ?>
              <p><?= $row['bouquet_name'] ?> (<?= $row['bouquet_qty'] ?>) </p>
            <?php endforeach ?>

          </h6>
          <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
          <h5><b>Total Amount Payable : </b><?= number_format($grand_total) ?></h5>
        </div>
        <form action="" method="post" id="placeOrder">
          <?php foreach ($allProduct as $row):
            ?>
            <input type="hidden" name="produk_id_<?= $row['bouquet_id'] ?>" value="<?= $row['bouquet_id'] ?>">
            <input type="hidden" name="produk_qty_<?= $row['bouquet_id'] ?>" value="<?= $row['bouquet_qty'] ?>">
          <?php endforeach ?>
          <!-- <input type="hidden" name="products" value="<?= $allItems; ?>"> -->
          <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
          <!-- <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
                    </div> -->
          <div class="form-group">
            <textarea name="address" class="form-control" rows="3" cols="10"
              placeholder="Enter Delivery Address Here..."></textarea>
          </div>
          <h6 class="text-center lead">Select Payment Mode</h6>
          <div class="form-group">
            <select name="pmode" class="form-control">
              <option value="" selected disabled>-Select Payment Mode-</option>
              <option value="cod">Cash On Delivery</option>
              <option value="netbanking">Net Banking</option>
              <option value="cards">Debit/Credit Card</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function () {

      // Sending Form data to the server
      $("#placeOrder").submit(function (e) {
        e.preventDefault();
        $.ajax({
          url: 'action.php',
          method: 'post',
          data: $('form').serialize() + "&action=order",
          success: function (response) {
            $("#order").html(response);
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
  </script>
</body>

</html>