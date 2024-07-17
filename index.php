<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloom & Bliss</title>
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

<body class="body-fixed">
    <!-- start of header  -->
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
                                <li><a href="#catalog">Catalog</a></li>
                                <li><a href="#review">Review</a></li>
                                <li><a href="#contact">Contact</a></li>
                            </ul>
                        </nav>
                        <div class="header-right">
                            <a href="javascript:void(0)" class="header-btn header-cart">
                                <i class="fa-regular fa-cart-shopping"></i>
                                <span class="cart-number">0</span>
                            </a>
                            <a href="login_register.php" class="header-btn">
                                <i class="fa-regular fa-user"></i>
                            </a>
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
                                    <div class="banner-btn mt-4">
                                        <a href="login_register.php" class="sec-btn"><b>Login Here!</b></a>
                                    </div>
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

            <section class="our-menu section bg-pink repeat-img" id="catalog">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sec-title text-center mb-5">
                                    <p class="sec-sub-title mb-3">Our Catalog</p>
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
                                <!-- untuk bunga ke-1 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp wedding" data-cat="wedding" data-name="Pink Skies">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/flowers/wedding-bouquet1.png" alt="">
                                        </div>
                                        <div class="dish-rating">
                                            4.9
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">Pink Skies</h3>
                                            <p>Pink roses symbolize unconditional happiness.</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Pink Roses</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rp. 729.000</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- untuk bunga ke-2 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp wedding" data-cat="wedding" data-name="Summer Sea">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/flowers/wedding-bouquet2.png" alt="">
                                        </div>
                                        <div class="dish-rating">
                                            5
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">Summer Sea</h3>
                                            <p>All the colors give the feeling of joy and excitement.</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Many Flowers</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rp 800.000</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- untuk bunga ke-3 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp wedding" data-cat="wedding" data-name="Spring Blossom">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/flowers/wedding-bouquet3.png" alt="">
                                        </div>
                                        <div class="dish-rating">
                                            4.8
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">Spring Blossom</h3>
                                            <p>It symbolize purity, elegance, and new beginnings.</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Sunflowers, Pink Roses</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rp 750.000</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- untuk bunga ke-4 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp graduation" data-cat="graduation" data-name="Secret Garden">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/flowers/graduation-bouquet4.png" alt="">
                                        </div>
                                        <div class="dish-rating">
                                            4.9
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">Secret Garden</h3>
                                            <p>It symbolize a new journey to release our beautiful youth.</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Many Flowers</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rp 600.000</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- untuk bunga ke-5 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp graduation" data-cat="graduation" data-name="Blue Moon">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/flowers/graduation-bouquet5.png" alt="">
                                        </div>
                                        <div class="dish-rating">
                                            4.8
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">Blue Moon</h3>
                                            <p>The calming hue evokes a sense of relaxation.</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Gentiana Trifloras</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rp 500.000</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- untuk bunga ke-6 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp graduation" data-cat="graduation" data-name="Hydrangea Love">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/flowers/graduation-bouquet6.png" alt="">
                                        </div>
                                        <div class="dish-rating">
                                            5
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">Hydrangea Love</h3>
                                            <p>Associated with heartfelt emotions and gratitude.</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Hydrangeas</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rp 700.000</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- untuk bunga ke-7 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp birthday" data-cat="birthday" data-name="Valley of Lilies">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/flowers/birthday-bouquet7.png" alt="">
                                        </div>
                                        <div class="dish-rating">
                                            5
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">Valley of Lilies</h3>
                                            <p>Expressing sincere emotions & life's significant moments.</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>White Lilies, White Roses</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rp 810.000</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- untuk bunga ke-8 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp birthday" data-cat="birthday" data-name="La Vie En Rose">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/flowers/birthday-bouquet8.png" alt="">
                                        </div>
                                        <div class="dish-rating">
                                            4.9
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">La Vie En Rose</h3>
                                            <p>Are the quintessential symbol of love and passion.</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Red Roses</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rp 850.000</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- untuk bunga ke-9 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp birthday" data-cat="birthday" data-name="In Bloom">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/flowers/birthday-bouquet9.png" alt="">
                                        </div>
                                        <div class="dish-rating">
                                            4.8
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">In Bloom</h3>
                                            <p>Exudes an ethereal charm and understated elegance.</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Gypsophilas</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rp 775.000</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

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
                                        <a href="index.html">
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
                                        <li><a href="#catalog">Catalog</a></li>
                                        <li><a href="#review">Review</a></li>
                                        <li><a href="#contact">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer> 
            
            <!-- Pop-up Modal -->
            <div id="popupModal" class="modal">
                <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2>Welcome to Bloom & Bliss!</h2>
                <p>Please login to continue.</p>
                <div class="modal-buttons">
                    <button id="loginBtn">Login</button>
                    <button id="cancelBtn">Cancel</button>
                </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                var modal = document.getElementById('popupModal');
                var cartIcon = document.querySelector('.header-cart'); // Adjusted selector to match the cart icon
                var addBtn = document.querySelectorAll('.dish-add-btn');
                var closeBtn = document.querySelector('.close-btn');
                var cancelBtn = document.getElementById('cancelBtn');
                var loginBtn = document.getElementById('loginBtn');

                // Show the modal when cart icon is clicked
                cartIcon.addEventListener('click', function() {
                    window.scrollTo(0,0)
                    modal.style.display = 'block';
                });

                addBtn.forEach(function(button)  {
                    button.addEventListener('click', function() {
                        window.scrollTo(0, 0)
                        modal.style.display = 'block';
                    });
                });

                // Hide the modal when the close button or cancel button is clicked
                closeBtn.addEventListener('click', function() {
                    modal.style.display = 'none';
                });

                cancelBtn.addEventListener('click', function() {
                    modal.style.display = 'none';
                });

                // Redirect to login page when login button is clicked
                loginBtn.addEventListener('click', function() {
                    window.location.href = 'login_register.php';
                });

                // Hide the modal when clicking outside of the modal content
                window.addEventListener('click', function(event) {
                    if (event.target == modal) {
                    modal.style.display = 'none';
                    }
                });
                });
            </script>

        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if (isset($_SESSION['logout_success'])): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Logged out',
                    text: 'You have successfully logged out.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#fb6f92',
                });
                <?php unset($_SESSION['logout_success']); ?>
            <?php endif; ?>
        });
    </script>

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

</body>

</html>