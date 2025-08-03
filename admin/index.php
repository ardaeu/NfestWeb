<?php
include("../Ayarlar/ayar.php");
@session_start();
ob_start();

if (!isset($_SESSION['mail'])) {
    echo '<script>
        alert("Lütfen giriş yapınız.");
        window.location.href = "../admin_giris/index.php";
    </script>';
    exit(); // Yönlendirme sonrasında kodun çalışmasını durdurun
}


include 'layouts/session.php';
include 'layouts/main.php'; ?>

<head>

    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Dashboard')); ?>

    <!-- jsvectormap css -->
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <?php include 'layouts/head-css.php'; ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- anasayfa üstü header  -->
        <?php include 'layouts/menu.php'; ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">

                            <div class="h-100">
                                <div class="row mb-3 pb-1">
                                    <div class="col-12">
                                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                            <div class="flex-grow-1">
                                                <!--     <h4 class="fs-16 mb-1">Good Morning, Anna!</h4>
                                                    <p class="text-muted mb-0">Here's what's happening with your store
                                                        today.</p>
-->
                                            </div>
                                            <div class="mt-3 mt-lg-0">
                                                <form action="javascript:void(0);">
                                                    <div class="row g-3 mb-0 align-items-center">
                                                        <div class="col-sm-auto">
                                                            <div class="input-group">
                                                                <!--
                                                                    <input type="text" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                                    <div class="input-group-text bg-primary border-primary text-white">
                                                                        <i class="ri-calendar-2-line"></i>
                                                                    </div>
-->
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <!--
                                                            <div class="col-auto">
                                                                <button type="button" class="btn btn-soft-success"><i class="ri-add-circle-line align-middle me-1"></i>
                                                                    Add Product</button>
                                                            </div>
                                                            end col
                                                            <div class="col-auto">
                                                                <button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i class="ri-pulse-line"></i></button>
                                                            </div>
                                                            -->
                                                    </div>
                                                    <!--end row-->
                                                </form>
                                            </div>
                                        </div><!-- end card header -->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->

                                <div class="row">
                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                            Bekleyen Rezervasyon İstekleri</p>
                                                    </div>

                                                </div>

                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo $resultRes['rezervasyon_sayisi']; ?>">0</span>
                                                        </h4>
                                                        <a href="rezervasyon_istek.php" class="text-decoration-underline text-muted">Rezervasyon Sayfasına Git</a>
                                                    </div>

                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                            Okunmamış Geri Bildirimler</p>
                                                    </div>
                                                    <!-- <div class="flex-shrink-0">
                                                            <h5 class="text-danger fs-14 mb-0">
                                                                <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                                                -3.57 %
                                                            </h5>
                                                        </div> -->
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo $resultFb['fb_sayisi']; ?>">0</span></h4>
                                                        <a href="fb_edit.php" class="text-decoration-underline text-muted">Geri Bildirimler Sayfasına Git</a>
                                                    </div>

                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->
                                </div> <!-- end row-->


                                <!--    
                            <div class="overlay"></div>
                                <div class="layout-rightside">
                                    <div class="card h-100 rounded-0">
                                        <div class="card-body p-0">
                                            <div class="p-3">
                                                <h6 class="text-muted mb-0 text-uppercase">Recent Activity</h6>
                                            </div>
                                            <div data-simplebar style="max-height: 410px;" class="p-3 pt-0">
                                                <div class="acitivity-timeline acitivity-main">
                                                    <div class="acitivity-item d-flex">
                                                        <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                            <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                                                <i class="ri-shopping-cart-2-line"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1 lh-base">Purchase by James Price</h6>
                                                            <p class="text-muted mb-1">Product noise evolve smartwatch </p>
                                                            <small class="mb-0 text-muted">02:14 PM Today</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                            <div class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                                                <i class="ri-stack-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1 lh-base">Added new <span class="fw-semibold">style collection</span></h6>
                                                            <p class="text-muted mb-1">By Nesta Technologies</p>
                                                            <div class="d-inline-flex gap-2 border border-dashed p-2 mb-2">
                                                                <a href="apps-ecommerce-product-details.php" class="bg-light rounded p-1">
                                                                    <img src="assets/images/products/img-8.png" alt="" class="img-fluid d-block" />
                                                                </a>
                                                                <a href="apps-ecommerce-product-details.php" class="bg-light rounded p-1">
                                                                    <img src="assets/images/products/img-2.png" alt="" class="img-fluid d-block" />
                                                                </a>
                                                                <a href="apps-ecommerce-product-details.php" class="bg-light rounded p-1">
                                                                    <img src="assets/images/products/img-10.png" alt="" class="img-fluid d-block" />
                                                                </a>
                                                            </div>
                                                            <p class="mb-0 text-muted"><small>9:47 PM Yesterday</small></p>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1 lh-base">Natasha Carey have liked the products
                                                            </h6>
                                                            <p class="text-muted mb-1">Allow users to like products in your
                                                                WooCommerce store.</p>
                                                            <small class="mb-0 text-muted">25 Dec, 2021</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar-xs acitivity-avatar">
                                                                <div class="avatar-title rounded-circle bg-secondary">
                                                                    <i class="mdi mdi-sale fs-14"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1 lh-base">Today offers by <a href="apps-ecommerce-seller-details.php" class="link-secondary">Digitech Galaxy</a></h6>
                                                            <p class="text-muted mb-2">Offer is valid on orders of Rs.500 Or
                                                                above for selected products only.</p>
                                                            <small class="mb-0 text-muted">12 Dec, 2021</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar-xs acitivity-avatar">
                                                                <div class="avatar-title rounded-circle bg-danger-subtle text-danger">
                                                                    <i class="ri-bookmark-fill"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1 lh-base">Favoried Product</h6>
                                                            <p class="text-muted mb-2">Esther James have favorited product.
                                                            </p>
                                                            <small class="mb-0 text-muted">25 Nov, 2021</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar-xs acitivity-avatar">
                                                                <div class="avatar-title rounded-circle bg-secondary">
                                                                    <i class="mdi mdi-sale fs-14"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1 lh-base">Flash sale starting <span class="text-primary">Tomorrow.</span></h6>
                                                            <p class="text-muted mb-0">Flash sale by <a href="javascript:void(0);" class="link-secondary fw-medium">Zoetic Fashion</a></p>
                                                            <small class="mb-0 text-muted">22 Oct, 2021</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar-xs acitivity-avatar">
                                                                <div class="avatar-title rounded-circle bg-info-subtle text-info">
                                                                    <i class="ri-line-chart-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1 lh-base">Monthly sales report</h6>
                                                            <p class="text-muted mb-2"><span class="text-danger">2 days
                                                                    left</span> notification to submit the monthly sales
                                                                report. <a href="javascript:void(0);" class="link-warning text-decoration-underline">Reports
                                                                    Builder</a></p>
                                                            <small class="mb-0 text-muted">15 Oct</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1 lh-base">Frank Hook Commented</h6>
                                                            <p class="text-muted mb-2 fst-italic">" A product that has
                                                                reviews is more likable to be sold than a product. "</p>
                                                            <small class="mb-0 text-muted">26 Aug, 2021</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-3 mt-2">
                                                <h6 class="text-muted mb-3 text-uppercase">Top 10 Categories
                                                </h6>

                                                <ol class="ps-3 text-muted">
                                                    <li class="py-1">
                                                        <a href="#" class="text-muted">Mobile & Accessories <span class="float-end">(10,294)</span></a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a href="#" class="text-muted">Desktop <span class="float-end">(6,256)</span></a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a href="#" class="text-muted">Electronics <span class="float-end">(3,479)</span></a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a href="#" class="text-muted">Home & Furniture <span class="float-end">(2,275)</span></a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a href="#" class="text-muted">Grocery <span class="float-end">(1,950)</span></a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a href="#" class="text-muted">Fashion <span class="float-end">(1,582)</span></a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a href="#" class="text-muted">Appliances <span class="float-end">(1,037)</span></a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a href="#" class="text-muted">Beauty, Toys & More <span class="float-end">(924)</span></a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a href="#" class="text-muted">Food & Drinks <span class="float-end">(701)</span></a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a href="#" class="text-muted">Toys & Games <span class="float-end">(239)</span></a>
                                                    </li>
                                                </ol>
                                                <div class="mt-3 text-center">
                                                    <a href="javascript:void(0);" class="text-muted text-decoration-underline">View all Categories</a>
                                                </div>
                                            </div>
                                            <div class="p-3">
                                                <h6 class="text-muted mb-3 text-uppercase">Products Reviews</h6>
                                                
                                                <div class="swiper vertical-swiper" style="height: 250px;">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <div class="card border border-dashed shadow-none">
                                                                <div class="card-body">
                                                                    <div class="d-flex">
                                                                        <div class="flex-shrink-0 avatar-sm">
                                                                            <div class="avatar-title bg-light rounded">
                                                                                <img src="assets/images/companies/img-1.png" alt="" height="30">
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <div>
                                                                                <p class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                                    " Great product and looks great, lots of
                                                                                    features. "</p>
                                                                                <div class="fs-11 align-middle text-warning">
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-fill"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-end mb-0 text-muted">
                                                                                - by <cite title="Source Title">Force
                                                                                    Medicines</cite>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="card border border-dashed shadow-none">
                                                                <div class="card-body">
                                                                    <div class="d-flex">
                                                                        <div class="flex-shrink-0">
                                                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-sm rounded">
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <div>
                                                                                <p class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                                    " Amazing template, very easy to
                                                                                    understand and manipulate. "</p>
                                                                                <div class="fs-11 align-middle text-warning">
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-half-fill"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-end mb-0 text-muted">
                                                                                - by <cite title="Source Title">Henry
                                                                                    Baird</cite>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="card border border-dashed shadow-none">
                                                                <div class="card-body">
                                                                    <div class="d-flex">
                                                                        <div class="flex-shrink-0 avatar-sm">
                                                                            <div class="avatar-title bg-light rounded">
                                                                                <img src="assets/images/companies/img-8.png" alt="" height="30">
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <div>
                                                                                <p class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                                    "Very beautiful product and Very helpful
                                                                                    customer service."</p>
                                                                                <div class="fs-11 align-middle text-warning">
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-line"></i>
                                                                                    <i class="ri-star-line"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-end mb-0 text-muted">
                                                                                - by <cite title="Source Title">Zoetic
                                                                                    Fashion</cite>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="card border border-dashed shadow-none">
                                                                <div class="card-body">
                                                                    <div class="d-flex">
                                                                        <div class="flex-shrink-0">
                                                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-sm rounded">
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <div>
                                                                                <p class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                                    " The product is very beautiful. I like
                                                                                    it. "</p>
                                                                                <div class="fs-11 align-middle text-warning">
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-fill"></i>
                                                                                    <i class="ri-star-half-fill"></i>
                                                                                    <i class="ri-star-line"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-end mb-0 text-muted">
                                                                                - by <cite title="Source Title">Nancy
                                                                                    Martino</cite>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                                

                                            <div class="p-3">
                                                <h6 class="text-muted mb-3 text-uppercase">Customer Reviews</h6>
                                                <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <div class="fs-16 align-middle text-warning">
                                                                <i class="ri-star-fill"></i>
                                                                <i class="ri-star-fill"></i>
                                                                <i class="ri-star-fill"></i>
                                                                <i class="ri-star-fill"></i>
                                                                <i class="ri-star-half-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <h6 class="mb-0">4.5 out of 5</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="text-muted">Total <span class="fw-medium">5.50k</span>
                                                        reviews</div>
                                                </div>

                                                <div class="mt-3">
                                                    <div class="row align-items-center g-2">
                                                        <div class="col-auto">
                                                            <div class="p-1">
                                                                <h6 class="mb-0">5 star</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="p-1">
                                                                <div class="progress animated-progress progress-sm">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 50.16%" aria-valuenow="50.16" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="p-1">
                                                                <h6 class="mb-0 text-muted">2758</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   

                                                    <div class="row align-items-center g-2">
                                                        <div class="col-auto">
                                                            <div class="p-1">
                                                                <h6 class="mb-0">4 star</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="p-1">
                                                                <div class="progress animated-progress progress-sm">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 29.32%" aria-valuenow="29.32" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="p-1">
                                                                <h6 class="mb-0 text-muted">1063</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   

                                                    <div class="row align-items-center g-2">
                                                        <div class="col-auto">
                                                            <div class="p-1">
                                                                <h6 class="mb-0">3 star</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="p-1">
                                                                <div class="progress animated-progress progress-sm">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 18.12%" aria-valuenow="18.12" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="p-1">
                                                                <h6 class="mb-0 text-muted">997</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                

                                                    <div class="row align-items-center g-2">
                                                        <div class="col-auto">
                                                            <div class="p-1">
                                                                <h6 class="mb-0">2 star</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="p-1">
                                                                <div class="progress animated-progress progress-sm">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 4.98%" aria-valuenow="4.98" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="p-1">
                                                                <h6 class="mb-0 text-muted">227</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   

                                                    <div class="row align-items-center g-2">
                                                        <div class="col-auto">
                                                            <div class="p-1">
                                                                <h6 class="mb-0">1 star</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="p-1">
                                                                <div class="progress animated-progress progress-sm">
                                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 7.42%" aria-valuenow="7.42" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="p-1">
                                                                <h6 class="mb-0 text-muted">408</h6>
                                                            </div>
                                                        </div>
                                                    
                                                </div>
                                            </div>

                                            <div class="card sidebar-alert bg-light border-0 text-center mx-4 mb-0 mt-3">
                                                <div class="card-body">
                                                    <img src="assets/images/giftbox.png" alt="">
                                                    <div class="mt-4">
                                                        <h5>Invite New Seller</h5>
                                                        <p class="text-muted lh-base">Refer a new seller to us and earn $100
                                                            per refer.</p>
                                                        <button type="button" class="btn btn-primary btn-label rounded-pill"><i class="ri-mail-fill label-icon align-middle rounded-pill fs-16 me-2"></i>
                                                            Invite Now</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                -->
                            </div> <!-- end .rightbar-->

                        </div> <!-- end col -->
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'layouts/footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!--     <?php //include 'layouts/customizer.php'; 
                ?>
                                                                -->
    <?php include 'layouts/vendor-scripts.php'; ?>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!--Swiper slider js-->
    <script src="assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-ecommerce.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <audio id="notificationSound" src="assets/alerts/notification.mp3"></audio>
    <script>
        function checkForNewReservations() {
            fetch('check_reservations.php') // PHP dosyasının yolu
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success' && data.new_reservations > 0) {
                        var notificationSound = document.getElementById('notificationSound');
                        notificationSound.play();
                        alert(`Yeni ${data.new_reservations} rezervasyon yapıldı!`);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // 10 saniyede bir yeni rezervasyon kontrolü yap
        setInterval(checkForNewReservations, 10000);
    </script>

</body>

</html>