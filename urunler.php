<?php
include 'Ayarlar/ayar.php';

if (isset($_GET['dil'])) {
    $dil = $_GET['dil'];
    $dil_page = $_GET['dil'];
} else {
    $dil = 'tr';
    $dil_page = 'tr';
}


try {
    // PDO hata modunu ayarla
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL sorgusunu hazırla ve çalıştır
    $contents = $conn->prepare("SELECT * FROM index_page WHERE dil = :dil");
    $contents->execute(['dil' => $dil]);

    // Sonucu al
    $contents = $contents->fetchAll(PDO::FETCH_ASSOC);

    // Sonucun boş olup olmadığını kontrol et
    if (!$contents) {
        die("İçerik bulunamadı.");
    }
} catch (PDOException $e) {
    die("Veritabanı hatası: " . $e->getMessage());
}

try {
    // PDO hata modunu ayarla
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL sorgusunu hazırla ve çalıştır
    $urunler = $conn->prepare("SELECT * FROM urunler WHERE dil = :dil");
    $urunler->execute(['dil' => $dil]);

    // Sonucu al
    $urunler = $urunler->fetchAll(PDO::FETCH_ASSOC);

    // Sonucun boş olup olmadığını kontrol et
    if (!$urunler) {
        die("İçerik bulunamadı.");
    }
} catch (PDOException $e) {
    die("Veritabanı hatası: " . $e->getMessage());
}

try {
    // PDO hata modunu ayarla
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL sorgusunu hazırla ve çalıştır
    $kategoriler = $conn->prepare("SELECT * FROM kategoriler WHERE dil = :dil");
    $kategoriler->execute(['dil' => $dil]);

    // Sonucu al
    $kategoriler = $kategoriler->fetchAll(PDO::FETCH_ASSOC);

    // Sonucun boş olup olmadığını kontrol et
    if (!$kategoriler) {
        die("İçerik bulunamadı.");
    }
} catch (PDOException $e) {
    die("Veritabanı hatası: " . $e->getMessage());
}

try {
    // PDO hata modunu ayarla
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL sorgusunu hazırla ve çalıştır
    $icindekiler = $conn->prepare("SELECT * FROM icindekiler WHERE dil = :dil");
    $icindekiler->execute(['dil' => $dil]);

    // Sonucu al
    $icindekiler = $icindekiler->fetchAll(PDO::FETCH_ASSOC);

    // Sonucun boş olup olmadığını kontrol et
    if (!$icindekiler) {
        die("İçerik bulunamadı.");
    }
} catch (PDOException $e) {
    die("Veritabanı hatası: " . $e->getMessage());
}


try {
    // PDO hata modunu ayarla
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL sorgusunu hazırla ve çalıştır
    $diller = $conn->prepare("SELECT * FROM diller");
    $diller->execute();

    // Sonucu al
    $diller = $diller->fetchAll(PDO::FETCH_ASSOC);

    // Sonucun boş olup olmadığını kontrol et
    if (!$diller) {
        die("İçerik bulunamadı.");
    }
} catch (PDOException $e) {
    die("Veritabanı hatası: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M4F74E2MHD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-M4F74E2MHD');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <title>N'Fest</title>

</head>
<style type="text/css">

</style>

<body class="bg">
    <nav class="navbar navbar-expand-lg bg">
        <div class="container-fluid d-flex w-100" style="overflow: ;">
            <div class="py-3 ms-5" id="navbar-mobile">
                <!-- Mobile arama butonu -->
                <a class="onlinemagazabuton mobile" href="https://nfestfood.com/"><i class="ri-corner-up-right-double-fill"></i>Online <br>İşlemler</a>
                <!-- Mobile arama butonu -->
                <a class="" href="index.php">
                    <img src="assets/img/NFESTLOGO.png" alt="" width="150px" style="object-fit: contain;"></a>
                <div class="hamburger flex-column align-items-left justify-content-center" style="display: flex;">
                    <div class="bar1"></div>
                    <div class="bar2" style="width:27px;"></div>
                    <div class="bar3" style="width:18px;"></div>
                </div>

            </div>
            <?php
            $navbar1 = array_filter($contents, function ($row) {
                return $row['type'] === 'navbar1';
            });
            $navbar1 = reset($navbar1);

            $navbar2 = array_filter($contents, function ($row) {
                return $row['type'] === 'navbar2';
            });
            $navbar2 = reset($navbar2);

            $navbar3 = array_filter($contents, function ($row) {
                return $row['type'] === 'navbar3';
            });
            $navbar3 = reset($navbar3);

            $navbar4 = array_filter($contents, function ($row) {
                return $row['type'] === 'navbar4';
            });
            $navbar4 = reset($navbar4);
            ?>
            <div class="collapse navbar-collapse mx-auto" id="navbarSupportedContent"
                style="flex-basis: unset !important; flex-grow: unset !important;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold text-black" href="index.php?dil=<?php echo $dil; ?>"><?php echo $navbar1['content']; ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold text-black" href="urunler.php?dil=<?php echo $dil; ?>"><?php echo $navbar2['content']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold text-black" href="hakkimizda.php?dil=<?php echo $dil; ?>"><?php echo $navbar3['content']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold text-black" href="iletisim.php?dil=<?php echo $dil; ?>"><?php echo $navbar4['content']; ?></a>
                    </li>
                </ul>

            </div>

            <div class="search-bar me-5">
                <div class="searchmobile">
                    <a class="onlinemagazabuton" href="https://nfestfood.com/"><i class="ri-corner-up-right-double-fill"></i> Online İşlemler</a>
                    <!--
                    <input type="text" class="py-1 px-4 rounded-5" placeholder="">
                    <button type="submit" style="position: absolute;" class="fw-semibold"><i class="ri-search-line"></i></button> -->
                </div>
            </div>

            <div class="dilayar me-5">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="true">
                        <img src="assets/img/turkeyflag.png" alt="Türkçe" style="width: 20px; height: 20px;">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        <?php foreach ($diller as $dils) { ?>
                            <li>
                                <a class="dropdown-item" href="index.php?dil=<?php echo $dils['dil']; ?>">
                                    <img src="assets/img/<?php echo $dils['bayrak']; ?>" style="width: 20px; height: 20px;">
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <!-- Mobile arama ayar -->
            <div class="arama">
                <div class="aramaover">

                    <div class="sidebararama " style="width: 60%;">
                        <div class="d-flex align-items-center " style="height: 12%;"><span
                                class="aramakapat fw-bold fs-1 p-3"><i class="ri-close-line"></i></span>
                        </div>
                        <div class="kapsayici d-flex align-items-center mx-auto">
                            <input type="text" class="py-1 px-2 rounded-5" placeholder="...">
                            <button type="submit" class="fw-semibold"><i
                                    class="ri-search-line"></i></button>
                        </div>
                        <div class="logo mt-auto">
                            <a class="" href="index.php">
                                <img src="assets/img/NFESTLOGO.png" alt="" width="100%" class="p-5"></a>
                        </div>

                    </div>
                    <div class="sagkapsayici"></div>
                </div>
            </div>
            <!-- Mobile arama ayar -->

            <div class="sidebar-con">
                <div class="overlay">
                </div>

                <div class="sidebar w-75 flex-column" style="display: flex;">
                    <div class="d-flex align-items-center " style="height: 12%;"><span
                            class="close-btn fw-bold fs-1 p-3"><i class="ri-close-line"></i></span>
                    </div>
                    <div class="h-50 d-flex flex-column justify-content-around align-items-start">
                        <a href="index.php?dil=<?php echo $dil ?>" class="page px-3 text-start text-decoration-none text-black">
                            <h3><?php echo $navbar1['content'] ?></h3>
                        </a>
                        <a href="urunler.php?dil=<?php echo $dil ?>" class="page px-3 text-start text-decoration-none text-black">
                            <h3><?php echo $navbar2['content'] ?></h3>
                        </a>

                        <a href="hakkimizda.php?dil=<?php echo $dil ?>" class="page px-3 text-start text-decoration-none text-black">
                            <h3><?php echo $navbar3['content'] ?></h3>
                        </a>
                        <a href="iletisim.php?dil=<?php echo $dil ?>" class="page px-3 text-start text-decoration-none text-black">
                            <h3><?php echo $navbar4['content'] ?></h3>
                        </a>
                    </div>
                    <div class="mobilebayrak">
                        <?php foreach ($diller as $dils) { ?>
                            <a class="dropdown-item" href="index.php?dil=<?php echo $dils['dil'] ?>">
                                <img src="assets/img/<?php echo $dils['bayrak'] ?>" alt="Türkçe" style="width: 40px; height: 40px;">
                            </a>
                        <?php } ?>
                    </div>
                    <img src="assets/img/NFESTLOGO.png" alt="" class="p-5 mt-auto">
                </div>

            </div>

        </div>
    </nav>

    <?php
    $urun = array_filter($contents, function ($row) {
        return $row['type'] === 'urun_text';
    });
    $urun = reset($urun);
    ?>


    <section class="icindekiler mt-3 mb-4">
        <div class="container-fluid">
            <h1 class="text-yesil text-center fw-bold mb-5 pb-3"> <?php echo $urun['content'] ?></h1>
        </div>
    </section>


    <section id="urunleryeni" class="mobilkapali">
        <div class="container my-4">
            <!-- Nav Tabs -->
            <ul class="nav nav-tabs" id="productTabs">
                <!-- Tüm ürünler navtabs kalktı !-->
                <?php foreach ($kategoriler as $kategori) { ?>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-<?php echo $kategori['id']; ?>" data-bs-toggle="tab" href="#kategori-<?php echo $kategori['id']; ?>">
                            <?php echo $kategori['title']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-4">
                <!-- Ürün Kategorileri -->
                <?php foreach ($kategoriler as $kategori) {
                    $index = 0;
                ?>
                    <div class="tab-pane fade" id="kategori-<?php echo $kategori['id']; ?>">
                        <div class="d-flex flex-wrap justify-content-center">
                            <?php foreach ($urunler as $urun) {
                                if ($urun['kategori'] == $kategori['id']) {
                                    $index++;
                            ?>
                                    <div class="product-item" onclick="openSlideshow('<?php echo $kategori['id']; ?>', <?php echo $index; ?>)">
                                        <img class="rounded-3" src="assets/img/<?php echo $urun['image']; ?>" alt="<?php echo $urun['name']; ?>">
                                        <h5><?php echo $urun['name']; ?></h5>
                                    </div>
                            <?php
                                }
                            } ?>
                        </div>




                        <!-- Slideshow -->
                        <div id="slideshow-<?php echo $kategori['id']; ?>" class="slideshow-container">
                            <!-- Slideshow içeriği -->
                            <?php foreach ($icindekiler as $icin) {
                                if ($icin['kategori_id'] == $kategori['id']) {
                            ?>
                                    <img src="assets/img/<?php echo $icin['image']; ?>" alt="<?php echo $icin['name'] . ' ' . $index; ?>">
                            <?php
                                }
                            } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Meyveli Barlar -->


        <!-- Jöleli Barlar -->


        </div>
        </div>
    </section>

    <section id="urunleryeni" class="mobilacik">
        <div class="container mt-4">
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs justify-content-center" id="productTabs">
                <?php foreach ($kategoriler as $row) { ?>
                    <li class="nav-item">
                        <a class="nav-link" id="<?php echo $row['id'] ?>-tab" data-bs-toggle="tab" href="#<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a>
                    </li>
                <?php } ?>
            </ul>

            <!-- Tab Panes -->
            <div class="tab-content mt-3">
                <?php foreach ($kategoriler as $kategori_rows) { ?>
                    <div class="tab-pane fade" id="<?php echo $kategori_rows['id'] ?>">
                        <div class="owl-carousel owl-theme">
                            <?php foreach ($urunler as $urun_rows) {
                                if ($urun_rows['kategori'] == $kategori_rows['id']) {
                            ?>
                                    <div class="slider-item">
                                        <img src="assets/img/<?php echo $urun_rows['image'] ?>" class="rounded-4" style="aspect-ratio: 1/1; object-fit: cover;">
                                        <h5>Yüksek Proteinli Bar Kakaolu</h5>
                                        <?php foreach ($icindekiler as $icindekiler_row) {
                                            if ($icindekiler_row['urun_id'] == $urun_rows['id']) {
                                        ?>
                                                <img src="assets/img/<?php echo $icindekiler_row['image'] ?>">
                                        <?php }
                                        } ?>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                <?php
                } ?>
            </div>
        </div>

    </section>

    <!--
<section id="productsmobile " class="py-5">
   <div class="container-fluid p-5 m-3 mobile">
  
    <li>
    <ul class="nav nav-tabs" id="productTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="all-products-tab" data-bs-toggle="tab" href="#all-products" role="tab" aria-controls="all-products" aria-selected="true">Tüm Ürünler</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="featured-products-tab" data-bs-toggle="tab" href="#featured-products" role="tab" aria-controls="featured-products" aria-selected="false">Öne Çıkanlar</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="nut-products-tab" data-bs-toggle="tab" href="#nut-products" role="tab" aria-controls="nut-products" aria-selected="false">Fındıklı Ürünler</a>
        </li>
    </ul>
</li>
   
    <div class="tab-content" id="productTabContent">
        
        <div class="tab-pane fade show active" id="all-products" role="tabpanel" aria-labelledby="all-products-tab">
            <div id="carouselAllProducts" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/img/flour-hazelnuts-two-d.png" class="d-block w-100" alt="Fıstıklı, Kakaolu Meyve Bar">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/top-view-pistachio-w.png" class="d-block w-100" alt="Antep Fıstıklı, Kakaolu Meyve bar">
                    </div>
                 
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselAllProducts" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselAllProducts" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        
        <div class="tab-pane fade" id="featured-products" role="tabpanel" aria-labelledby="featured-products-tab">
            <div id="carouselFeaturedProducts" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/img/top-view-pistachio-with-copy-space (1).jpg" class="d-block w-100" alt="Fıstıklı, Kakaolu Meyve Bar">
                    </div>
                    
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselFeaturedProducts" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselFeaturedProducts" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

       
        <div class="tab-pane fade" id="nut-products" role="tabpanel" aria-labelledby="nut-products-tab">
            <div id="carouselNutProducts" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/img/top-view-pistachio-with-copy-space (1).jpg" class="d-block w-100" alt="Fıstıklı, Kakaolu Meyve Bar">
                    </div>
                   
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselNutProducts" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselNutProducts" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
</section>
-->
    <footer class="footer mt-auto pt-3 ">
        <div class="container-fluid ">
            <div class="row text  pb-3">
                <div class="col-lg-4 d-flex   justify-content-around  mt-3">
                    <a class="" href="index.php">
                        <img src="assets/img/NFESTLOGO.png" class="w-50 mobilefooterlogo" alt=""></a>
                </div>
                <div class="col-lg-2  d-flex flex-column justify-content-around fw-semibold">
                    <a href="index.php?dil=<?php echo $dil; ?>" class="text-black text-decoration-none"><?php echo $navbar1['content']; ?></a>
                    <a href="hakkimizda.php?dil=<?php echo $dil; ?>" class="text-black text-decoration-none"><?php echo $navbar3['content']; ?></a>
                    <a href="iletisim.php?dil=<?php echo $dil; ?>" class="text-black text-decoration-none"><?php echo $navbar4['content']; ?></a>
                </div>
                <?php
                $footer1 = array_filter($contents, function ($row) {
                    return $row['type'] === 'footer1';
                });
                $footer1 = reset($footer1);

                $footer2 = array_filter($contents, function ($row) {
                    return $row['type'] === 'footer2';
                });
                $footer2 = reset($footer2);

                $mail = array_filter($contents, function ($row) {
                    return $row['type'] === 'mail';
                });
                $mail = reset($mail);

                $adres = array_filter($contents, function ($row) {
                    return $row['type'] === 'adres';
                });
                $adres = reset($adres);
                ?>
                <div class="col-lg-3  d-flex flex-column justify-content-around fw-semibold">
                    <a href="#" class="text-black text-decoration-none"><?php echo $footer1['content']; ?></a>
                    <a href="#" class="text-black text-decoration-none"><?php echo $footer2['content']; ?></a>
                    <a href="#" class="text-white text-decoration-none" style="visibility: hidden;">a</a>
                </div>
                <div class="col-lg-3 d-flex flex-column justify-content-around fw-semibold mt-3">
                    <a href="mailto:info@nfestfood.com.tr" class="text-black text-decoration-none"><i
                            class="ri-mail-line me-2"></i><?php echo $mail['content']; ?></a>
                    <a href="#" class="text-black text-decoration-none mt-2"><i class="ri-map-pin-line me-2"></i><?php echo $adres['content']; ?></a>
                    <div class="col-lg-12 text-center fw-semibold sosyalicon ">
                        <a href="https://www.instagram.com/nfestfood/" class="text-black text-decoration-none"><i class="ri-instagram-line"></i></a>
                        <a href="https://www.linkedin.com/company/n%E2%80%99fest-food/" class="text-black text-decoration-none"><i class="ri-linkedin-fill"
                                style="scale: 3;"></i></a>
                    </div>

                </div>

            </div>
            <div class="row bg">
                <div class="col-12 text-center">
                    <p class="mb-0 py-3">&copy; 2024 N'fest . All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script type="text/javascript">
        let slideIntervals = {};


        function openSlideshow(tabId, index) {
            const slideshows = document.querySelectorAll('.slideshow-container');
            slideshows.forEach(slideshow => slideshow.style.display = 'none'); // Diğer slaytları gizle

            const currentSlideshow = document.getElementById(`slideshow-${tabId}`);
            currentSlideshow.style.display = 'block'; // Seçilen slaytı göster

            const slideshowImages = currentSlideshow.querySelectorAll('img');
            slideshowImages.forEach((img, i) => img.style.display = i === index ? 'block' : 'none');

            clearInterval(slideIntervals[tabId]);


            startSlideshow(currentSlideshow, tabId);
        }


        function startSlideshow(slideshowElement, tabId) {
            let index = 0;
            const images = slideshowElement.querySelectorAll('img');
            slideIntervals[tabId] = setInterval(() => {
                images.forEach((img, i) => img.style.display = i === index ? 'block' : 'none');
                index = (index + 1) % images.length;
            }, 4000);
        }
    </script>
    <script>
        $(document).ready(function() {
            // Initialize Owl Carousel
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 6000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });

            // Adjust Owl Carousel on tab change
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function() {
                $('.owl-carousel').trigger('refresh.owl.carousel');
            });
        });
    </script>
</body>

</html>