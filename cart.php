<!-- halaman tabel cart -->
<?php
session_start();
// cek ada session nya gak pake id_user sama username user
if (!isset($_SESSION['id_user']) || !isset($_SESSION['usn_user'])) {
  header("Location: login_register.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cart - Bloom & Bliss</title>
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
</head>

<body>
  <div class="container">
    <div class="row">
      <header class="site-header-cart">
        <div class="container">
          <div class="row">
            <div class="col-lg-2">
              <div class="header-logo">
                <a href="index.php">
                  <img src="logo.png" width="50" height="50" alt="Logo">
                </a>
              </div>
            </div>
            <div class="col-lg-10">
              <div class="main-navigation">
                <button class="menu-toggle"><span></span><span></span></button>
                <nav class="header-menu">
                  <ul class="menu food-nav-menu">
                    <li><a href="home.php#home">Home</a></li>
                    <li><a href="home.php#about">About</a></li>
                    <li><a href="home.php#catalog">Catalog</a></li>
                    <li><a href="home.php#review">Review</a></li>
                    <li><a href="home.php#contact">Contact</a></li>
                  </ul>
                </nav>
                <div class="header-right">
                  <a href="cart.php" class="header-btn header-cart">
                    <i class="fa-regular fa-cart-shopping"></i>
                    <span id="cart-item" class="cart-number">0</span>
                  </a>
                  <li>
                    <img src="assets/images/user.png" width="45" height="45" class="profile">
                    <ul>
                        <!-- untuk dropdown profile menu -->
                        <li class="sub-item">
                            <i class="fa-solid fa-user-gear"></i>
                            <a href="profile.php">
                                <p>Edit profile</p>
                            </a>
                        </li>
                        <li class="sub-item">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <a href="logout.php">
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                  </li>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div id="alert-container"></div>
          <h4 class="text-h4 text-center text-info m-0">Products in your cart!</h4>
          <div class="table-responsive mt-2">
            <table class="table table-bordered table-striped text-center">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total Price</th>
                  <th>
                    <a href="javascript:void(0);" class="badge-danger badge p-1"
                      onclick="confirmClearCart('action.php?clear=all');"><i
                        class="fa-solid fa-trash-list"></i>&nbsp;&nbsp;Clear Cart</a>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                require 'koneksi.php';
                $sess_user_id = $_SESSION['id_user'];

                $query = 'SELECT cart.*, tb_produk.bouquet_name, tb_produk.bouquet_price, tb_produk.bouquet_image
                          FROM cart
                          INNER JOIN tb_produk
                          ON cart.bouquet_id = tb_produk.bouquet_id
                          WHERE cart.user_id = ?';  // Ensure this is the correct column name in tb_produk table
                
                $stmt = $conn->prepare($query);
                $stmt->bind_param('i',$sess_user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $grand_total = 0;
                while ($row = $result->fetch_assoc()):
                  ?>
                  <tr>
                    <td><?= $row['cart_id'] ?></td>
                    <input type="hidden" class="pidc" value="<?= $row['cart_id'] ?>">
                    <td><img src="assets/images/flowers/<?= $row['bouquet_image'] ?>" width="50"></td>
                    <td><?= $row['bouquet_name'] ?></td>
                    <td>
                      <i class="fa-light fa-rupiah-sign"></i>&nbsp;&nbsp;<?= number_format($row['bouquet_price']); ?>
                    </td>
                    <input type="hidden" class="pprice" value="<?= $row['bouquet_price'] ?>">
                    <td>
                      <input type="number" class="form-control itemQty" value="<?= $row['bouquet_qty'] ?>"
                        style="width:75px;">
                    </td>
                    <td><i class="fa-light fa-rupiah-sign"></i>&nbsp;&nbsp;<?= number_format($row['total_price']); ?></td>
                    <td>
                      <a href="javascript:void(0);" class="text-danger lead"
                        onclick="confirmRemoval('action.php?remove=<?= $row['cart_id'] ?>');">
                        <i class="fa-regular fa-trash"></i>
                        <div class="text"><b>Remove Item</b></div>
                      </a>
                    </td>
                  </tr>
                  <?php $grand_total += $row['total_price']; ?>
                <?php endwhile; ?>
                <tr>
                  <td colspan="3">
                    <a href="home.php" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i>&nbsp;&nbsp;Continue
                      Shopping</a>
                  </td>
                  <td colspan="2"><b>Grand Total</b></td>
                  <td><b><i class="fa-solid fa-rupiah-sign"></i>&nbsp;&nbsp;<?= number_format($grand_total, 2); ?></b>
                  </td>
                  <td>
                    <a href="javascript:void(0);" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="confirmCheckout();"><i class="fa-solid fa-bag-shopping"></i>&nbsp;&nbsp;Checkout</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  </header>



  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script>
    function confirmRemoval(url) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to remove this item?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#fb6f92',
        cancelButtonColor: '#bbb',
        confirmButtonText: 'Yes, remove it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
      });
    }

    function confirmClearCart(url) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to clear your cart?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#fb6f92',
        cancelButtonColor: '#bbb',
        confirmButtonText: 'Yes, clear it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
      });
    }

    function confirmCheckout() {
      Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to proceed to checkout?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#fb6f92', // Ubah warna tombol OK di sini
        cancelButtonColor: '#bbb',
        confirmButtonText: 'Yes, proceed!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'checkout.php';
        }
      });
    }

    <?php if (isset($_SESSION['showAlert']) && $_SESSION['showAlert'] == 'block') { ?>
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '<?php echo $_SESSION['message']; ?>',
        confirmButtonColor: '#fb6f92'
      });
      <?php unset($_SESSION['showAlert']); unset($_SESSION['message']); ?>
    <?php } ?>
  </script>


  <script type="text/javascript">
    $(document).ready(function () {

      // Change the item quantity
      $(".itemQty").on('change', function () {
        var $el = $(this).closest('tr');

        var pidc = $el.find(".pidc").val();
        var pprice = $el.find(".pprice").val();
        var qty = $el.find(".itemQty").val();
        location.reload(true);
        $.ajax({
          url: 'action.php',
          method: 'post',
          cache: false,
          data: {
            qty: qty,
            pidc: pidc,
            pprice: pprice
          },
          success: function (response) {
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
          success: function (response) {
            $("#cart-item").html(response);
          }
        });
      }
    });
  </script>
</body>

</html>