<!-- ini untuk user/admin setelah login diarahkan ke home.php tapi isi kodenya sama kaya index.php -->
<?php
session_start();

// cek ada session nya gak pake id_user sama username user
if (!isset($_SESSION['id_user']) || !isset($_SESSION['usn_user'])) {
    header("Location: login_register.php");
    exit();
}?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Bloom & Bliss</title>
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

<body class="body-fixed">
    <!-- start of header  -->
    <header class="site-header">
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
                                <li><a href="#home">Home</a></li>
                                <li><a href="#about">About</a></li>
                                <li><a href="#catalouge">Catalouge</a></li>
                                <li><a href="#review">Review</a></li>
                                <li><a href="#contact">Contact</a></li>
                            </ul>
                        </nav>
                        <div class="header-right">
                            <a href="cart.php" class="header-btn header-cart">
                                <i class="fa-regular fa-cart-shopping"></i>
                                <span id="cart-item" class="cart-number">0</span>
                            </a>
                            <li>
                                <img src ="assets/images/user.png" width="45" height="45" class="profile">
                                <ul>
                                    <!-- untuk dropdown profile menu -->
                                    <li class="sub-item">
                                        <i class="fa-solid fa-user-gear"></i>
                                        <a href="login_register.php"><p>Switch Account</p></a>
                                    </li>
                                    <li class="sub-item">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        <a href="logout.php"><p>Logout</p></a>
                                    </li>
                                </ul>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header ends  -->

    <div id="viewport">
        <div id="js-scroll-content">
            
            <section class="main-banner" id="home">
                <div class="js-parallax-scene">
                    <div class="banner-shape-1 w-100" data-depth="0.30">
                        <img src="assets/images/buket1.png" alt="">
                    </div>
                    <div class="banner-shape-2 w-100" data-depth="0.25">
                        <img src="assets/images/buket2.png" alt="">
                    </div>
                </div>
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="banner-text">
                                    <h1 class="h1-title">
                                        Welcome to our
                                        <span>Flower Bouquet</span>
                                        shop.
                                    </h1>
                                    <p>Discover the enchanting elegance of our floral creations with a special prices at our bouquet shop, where every arrangement is a masterpiece designed to bring beauty and joy to your cherished moments.</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img-wp">
                                    <div class="banner-img" style="background-image: url(assets/images/main-b.jpg);">
                                    </div>
                                </div>
                                <div class="banner-img-text mt-4 m-auto">
                                    <h5 class="h5-title"><i>Bouquet.</i></h5>
                                    <p>delicately arranged and bursting with vibrant hues, whispers the silent poetry of nature's splendor, capturing the essence of fleeting beauty and timeless grace.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                              
            <section style="background-image: url(assets/images/about-us-back.png);"
            class="about-sec section" id="about">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sec-title text-center mb-5">
                                <p class="sec-sub-title mb-3">About Us</p>
                                <h2 class="h2-title">Give the best <span>flowers from us!</span></h2>
                                <div class="sec-title-shape mb-4">
                                    <img src="assets/images/title-shape.svg" alt="">
                                </div>
                                <p>Bloom & Bliss was established in 2020. specializes in crafting beautiful bouquets 
                                    of real flowers to celebrate everyones happy moments. From seasonal arrangements, 
                                    cup flowers, hand bouquets, table centerpieces, standing flowers to full event decorations 
                                    – our dedicated team is here to meet all your floral needs. Send the finest flower bouquet to 
                                    your loved ones today with Bloom & Bliss!
                                    Same-day delivery available for all orders placed before the cut-off time.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 m-auto">
                            <div class="about-video">
                                <div class="about-video-img" style="background-image: url(assets/images/about.jpeg);">
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="our-menu section bg-pink repeat-img" id="catalouge">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sec-title text-center mb-5">
                                    <p class="sec-sub-title mb-3">Our Catalouge</p>
                                    <h2 class="h2-title">choose your own, <span>give it to your loved ones</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="menu-tab-wp">
                            <div class="row">
                                <div class="col-lg-12 m-auto">
                                    <div class="menu-tab text-center">
                                        <ul class="filters">
                                            <div class="filter-active"></div>
                                            <li class="filter" data-filter=".all, .wedding, .graduation, .birthday">
                                                <img src="assets/images/flower-1.png" alt="">
                                                All
                                            </li>
                                            <li class="filter" data-filter=".wedding">
                                                <img src="assets/images/flower-2.png" alt="">
                                                Wedding
                                            </li>
                                            <li class="filter" data-filter=".graduation">
                                                <img src="assets/images/flower-3.png" alt="">
                                                Graduation
                                            </li>
                                            <li class="filter" data-filter=".birthday">
                                                <img src="assets/images/flower-4.png" alt="">
                                                Birthday
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="menu-list-row">
                            <div class="row g-xxl-5 bydefault_show" id="menu-dish">
                                <?php
                                    include 'koneksi.php';
                                    $stmt = $conn->prepare('SELECT * FROM tb_produk');
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()):
                                ?>
                                <!-- untuk bunga ke-1 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp <?= $row['bouquet_category'] ?>" data-cat="<?= $row['bouquet_category'] ?>" data-name="<?= $row['bouquet_name'] ?>">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/flowers/<?= $row['bouquet_image'] ?>" alt="">
                                        </div>
                                        <div class="dish-rating">
                                            <?= $row['bouquet_ratings'] ?>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title"><?= $row['bouquet_name'] ?></h3>
                                            <p><?= $row['bouquet_description'] ?></p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b><?= $row['bouquet_type'] ?></b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <form action="" class="form-submit">
                                    
                                                <ul>
                                                    <li>
                                                        <b>Rp <?= number_format($row['bouquet_price']) ?></b>
                                                    </li>
                                                    <li>
                                                        <button class="dish-add-btn addItemBtn">
                                                            <i class="fa-regular fa-plus"></i>
                                                        </button>
                                                    </li>
                                                </ul>

                                                <div class="row p-2 mt-3">
                                                <div class="col-md-6 py-1 pl-4">
                                                    <b>Quantity : </b>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="number" class="form-control pqty" value="1">
                                                </div>
                                                </div>
                                                <input type="hidden" class="pid" value="<?= $row['bouquet_id'] ?>">
                                                <input type="hidden" class="pname" value="<?= $row['bouquet_name'] ?>">
                                                <input type="hidden" class="pprice" value="<?= $row['bouquet_price'] ?>">
                                                <input type="hidden" class="pimage" value="<?= $row['bouquet_image'] ?>">
                                                <input type="hidden" class="pcode" value="<?= $row['bouquet_code'] ?>">

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section style = "background-image: url(assets/images/blog-pattern-bg.png);"
            class="testimonials section bg-pink" id="review">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sec-title text-center mb-5">
                                    <p class="sec-sub-title mb-3">What they say</p>
                                    <h2 class="h2-title">What our customers <span>say about us</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="testimonials-img">
                                    <img src="assets/images/testimonials-img.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="testimonials-box">
                                            <div class="testimonial-box-top">
                                                <div class="testimonials-box-img back-img"
                                                    style="background-image: url(assets/images/testimonials/t1.png);">
                                                </div>
                                                <div class="star-rating-wp">
                                                    <div class="star-rating">
                                                        <span class="star-rating__fill" style="width:85%"></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="testimonials-box-text">
                                                <h3 class="h3-title">
                                                    Kim Haeun
                                                </h3>
                                                <p>Bloom & Bliss offers a good variety of modern and affordable bouquets.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="testimonials-box">
                                            <div class="testimonial-box-top">
                                                <div class="testimonials-box-img back-img"
                                                    style="background-image: url(assets/images/testimonials/t2.png);">
                                                </div>
                                                <div class="star-rating-wp">
                                                    <div class="star-rating">
                                                        <span class="star-rating__fill" style="width:80%"></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="testimonials-box-text">
                                                <h3 class="h3-title">
                                                    Nichols Jordan
                                                </h3>
                                                <p>It would be nice to see the final bouquet in delivery confirmation email.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="testimonials-box">
                                            <div class="testimonial-box-top">
                                                <div class="testimonials-box-img back-img"
                                                    style="background-image: url(assets/images/testimonials/t3.png);">
                                                </div>
                                                <div class="star-rating-wp">
                                                    <div class="star-rating">
                                                        <span class="star-rating__fill" style="width:89%"></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="testimonials-box-text">
                                                <h3 class="h3-title">
                                                    Nara Asyah
                                                </h3>
                                                <p>Everything is perfect, easy, hassle-free, and beautiful bouquet! Very happy.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="testimonials-box">
                                            <div class="testimonial-box-top">
                                                <div class="testimonials-box-img back-img"
                                                    style="background-image: url(assets/images/testimonials/t4.png);">
                                                </div>
                                                <div class="star-rating-wp">
                                                    <div class="star-rating">
                                                        <span class="star-rating__fill" style="width:100%"></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="testimonials-box-text">
                                                <h3 class="h3-title">
                                                    Shen Yu Wi
                                                </h3>
                                                <p>The flowers were lovely, fresh and delivered on time with no hassle.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- footer starts  -->
            <footer class="site-footer" id="contact">
                <div class="top-footer section">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="footer-flex-box">
                                <div class="footer-info">
                                    <div class="footer-logo">
                                        <a href="index.php">
                                            <img src="logo.png" widhth="100"  height="100" alt="">
                                        </a>
                                    </div>
                                    <p>Bloom & Bliss is here to cater to your floral needs, 
                                        ensuring quick and easy flower delivery through our 
                                        network of partner florists in Jakarta.
                                    </p>
                                    <div class="social-icon">
                                        <ul>
                                            <li>
                                                <a href="https://www.instagram.com/gunadarma">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.github.com/koojennie">
                                                    <i class="fa-brands fa-github"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.youtube.com/@ZB1_official">
                                                    <i class="fa-brands fa-youtube"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="footer-table-info">
                                    <h3 class="h3-title">Open Hours</h3>
                                    <ul>
                                        <li><i class="fa-regular fa-clock"></i> Mon-Fri : 9am - 22pm</li>
                                        <li><i class="fa-regular fa-clock"></i> Sat-Sun : 9am - 17pm</li>
                                    </ul>
                                </div>
                                <div class="footer-menu">
                                    <h3 class="h3-title">Links</h3>
                                    <ul>
                                        <li><a href="#home" class="footer-active-menu">Home</a></li>
                                        <li><a href="#about">About</a></li>
                                        <li><a href="#catalouge">Catalouge</a></li>
                                        <li><a href="#review">Review</a></li>
                                        <li><a href="#contact">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer> 
        </div>
    </div>

    <!-- jquery  -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>

    <!-- fontawesome  -->
    <script src="assets/js/font-awesome.min.js"></script>

    <!-- swiper slider  -->
    <script src="assets/js/swiper-bundle.min.js"></script>

    <!-- mixitup -- filter  -->
    <script src="assets/js/jquery.mixitup.min.js"></script>

    <!-- fancy box  -->
    <script src="assets/js/jquery.fancybox.min.js"></script>

    <!-- parallax  -->
    <script src="assets/js/parallax.min.js"></script>

    <!-- gsap  -->
    <script src="assets/js/gsap.min.js"></script>

    <!-- scroll trigger  -->
    <script src="assets/js/ScrollTrigger.min.js"></script>
    <!-- scroll to plugin  -->
    <script src="assets/js/ScrollToPlugin.min.js"></script>
    <!-- rellax  -->
    <!-- <script src="assets/js/rellax.min.js"></script> -->
    <!-- <script src="assets/js/rellax-custom.js"></script> -->
    <!-- smooth scroll  -->
    <script src="assets/js/smooth-scroll.js"></script>
    <!-- custom js  -->
    <script src="main.js"></script>

    <!-- js library tanpa diubah, dari CDN -->
    <!-- jQuery library -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script> -->

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            // Send product details in the server
            $(".addItemBtn").click(function(e) {
            e.preventDefault();
            var $form = $(this).closest(".form-submit");
            var pid = $form.find(".pid").val();
            var pname = $form.find(".pname").val();
            var pprice = $form.find(".pprice").val();
            var pimage = $form.find(".pimage").val();
            var pcode = $form.find(".pcode").val();

            var pqty = $form.find(".pqty").val();

            $.ajax({
                url: 'action.php',
                method: 'post',
                data: {
                pid: pid,
                pname: pname,
                pprice: pprice,
                pqty: pqty,
                pimage: pimage,
                pcode: pcode
                },
                success: function(response) {
                $("#message").html(response);
                load_cart_item_number();
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
