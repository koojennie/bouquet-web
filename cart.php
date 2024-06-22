<!-- halaman tabel cart -->
<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cart - Bloom & Bliss</title>
  <!-- all ini dari w3 LIAT LAGI -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <!-- for icons  -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
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
    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="index.html">
                            <img src="logo.png" width="50" height="50" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main-navigation">
                        <button class="menu-toggle"><span></span><span></span></button>
                        <nav class="header-menu">
                            <ul class="menu food-nav-menu">
                                <li><a href="#home">Home</a></li>
                                <li><a href="#about">About</a></li>
                                <li><a href="#catalouge">Catalouge</a></li>
                                <li><a href="#review">Review</a></li>
                                <li><a href="#contact">Contact</a></li>
                            </ul>
                        </nav>
                        <div class="header-right">
                            <a href="cart.php" class="header-btn header-cart">
                                <i class="uil uil-shopping-bag"></i>
                                <span id="cart-item" class="cart-number">0</span>
                            </a>
                            <a href="profile.php" class="header-btn">
                                <i class="uil uil-user-md"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div style="display:<?php if (isset($_SESSION['showAlert'])) {
    echo $_SESSION['showAlert'];
    } else {
    echo 'none';
    } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    } unset($_SESSION['showAlert']); ?></strong>
                </div>
                <div class="table-responsive mt-2">
                <table class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <td colspan="7">
                    <h4 class="text-center text-info m-0">Products in your cart!</h4>
                    </td>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>
                    <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                    require 'koneksi.php';
                    $stmt = $conn->prepare('SELECT * FROM cart');
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $grand_total = 0;
                    while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $row['cart_id'] ?></td>
                    <input type="hidden" class="pid" value="<?= $row['cart_id'] ?>">
                    <td><img src="assets/images/flowers/<?= $row['bouquet_image'] ?>" width="50"></td>
                    <td><?= $row['bouquet_name'] ?></td>
                    <td>
                    <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['bouquet_price'],2); ?>
                    </td>
                    <input type="hidden" class="pprice" value="<?= $row['bouquet_price'] ?>">
                    <td>
                    <input type="number" class="form-control itemQty" value="<?= $row['bouquet_qty'] ?>" style="width:75px;">
                    </td>
                    <td><i class="fa-solid fa-rupiah-sign"></i>&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?></td>
                    <td>
                    <a href="action.php?remove=<?= $row['cart_id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php $grand_total += $row['total_price']; ?>
                <?php endwhile; ?>
                <tr>
                    <td colspan="3">
                    <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                        Shopping</a>
                    </td>
                    <td colspan="2"><b>Grand Total</b></td>
                    <td><b><i class="fa-solid fa-rupiah-sign"></i>&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                    <td>
                    <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
        </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Change the item quantity
    $(".itemQty").on('change', function() {
      var $el = $(this).closest('tr');

      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);
      $.ajax({
        url: 'action.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pid: pid,
          pprice: pprice
        },
        success: function(response) {
          console.log(response);
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
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
</body>

</html>