<?php
include 'Ayarlar/ayar.php';

if (isset($_GET['dil'])) {
    $dil = $_GET['dil'];
} else {
    $dil = 'tr';
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
    <title>N'Fest</title>
    <style type="text/css">

    </style>
</head>

<body class="bg">
    <nav class="navbar navbar-expand-lg bg">
        <div class="container-fluid d-flex w-100" style="overflow: ;">
            <div class="py-3 ms-5" id="navbar-mobile">
			    <?php if ($dil == 'tr') { ?>
				
                <!-- Mobile  butonu -->
                    <a class="onlinemagazabuton mobile" href="https://nfestfood.com/"><i class="ri-corner-up-right-double-fill"></i>Online <br>Satış</a>
					
					<?php  } ?>
                <!-- Mobile  butonu -->
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
					<?php if ($dil == 'tr') { ?>
				
                    <a class="onlinemagazabuton" href="https://nfestfood.com/"><i class="ri-corner-up-right-double-fill"></i> Online Satış</a>
                    <!--
                    <input type="text" class="py-1 px-4 rounded-5" placeholder="">
                    <button type="submit" style="position: absolute;" class="fw-semibold"><i class="ri-search-line"></i></button> -->
					
					<?php  } ?>
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

    <section id="slayt">
        <div class="container-fluid px-0 h-100">
            <div id="carouselExample" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="2000">
                <!-- Dots (Indicators) -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <div class="carousel-inner h-100">
                    <?php
                    $header_text = array_values(array_filter($contents, function ($row) {
                        return $row['type'] === 'header_text';
                    }));
                    $header_text = reset($header_text);
                    $header_btn = array_values(array_filter($contents, function ($row) {
                        return $row['type'] === 'header_btn';
                    }));
                    $header_btn = reset($header_btn);
                    $contents_header = array_values(array_filter($contents, function ($row) {
                        return $row['type'] === 'header';
                    }));
                    $is_active = true;
                    foreach ($contents_header as $header) { ?>
                        <div class="carousel-item <?php if ($is_active) {
                                                        echo 'active';
                                                        $is_active = false;
                                                    } ?> h-100">
                            <img src="assets/img/<?php echo $header['content']; ?>" class="d-block w-100"
                                alt="..." height="100%" style="object-fit: cover; object-position: center;">
                            <div
                                class="carousel-text text-white fw-bold p-4 align-items-center rounded-5 d-flex flex-column">
                                <h1><?php echo $header_text['content']; ?></h1>
                                <a href="urunler.php" class="text-decoration-none text-white fs-4 p-1 px-5 rounded-5"
                                    style="border: 1px solid white;"><?php echo $header_btn['content']; ?></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!-- Previous & Next Buttons -->
                <button class="carousel-control-prev my-auto p-3 rounded-circle" style="left: 40px;" type="button"
                    data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next my-auto p-3 rounded-circle" style="right: 40px;" type="button"
                    data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>


    <section class="info">
        <div class="container-fluid">
            <div class="row m-4">
                <div class="col-lg-7 d-flex flex-column p-5 justify-content-around ">
                    <?php
                    $info_text = array_values(array_filter($contents, function ($row) {
                        return $row['type'] === 'info_text';
                    }));
                    $info_text = reset($info_text);
                    $info_title = array_values(array_filter($contents, function ($row) {
                        return $row['type'] === 'info_title';
                    }));
                    $info_title = reset($info_title);
                    $info_btn = array_values(array_filter($contents, function ($row) {
                        return $row['type'] === 'info_btn';
                    }));
                    $info_btn = reset($info_btn);
                    $info_img = array_values(array_filter($contents, function ($row) {
                        return $row['type'] === 'info_img';
                    }));
                    $info_img = reset($info_img);
                    ?>
                    <h1 class="text-yesil"><?php echo $info_title['content'] ?></h1>
                    <p class="fw-semibold"><?php echo $info_text['content'] ?>
                    </p>
                    <a href="urunler.php" class="text-decoration-none p-2 rounded-4 fw-semibold"><?php echo $info_btn['content'] ?></a>
                </div>
                <div class="col-lg-5 p-5">
                    <img src="assets/img/<?php echo $info_img['content']; ?>" alt=""
                        style="height: 60vh; object-fit: cover; object-position: center; width: 100%;"
                        class="rounded-5">
                </div>
            </div>
        </div>
    </section>

    <?php
    $urun_title = array_values(array_filter($contents, function ($row) {
        return $row['type'] === 'urun_title';
    }));
    $urun_title = reset($urun_title);
    ?>

    <section class="mb-5">
        <div class="container-fluid">
            <h1 class="text-yesil text-center fw-bold"><?php echo $urun_title['content']; ?></h1>

            <div id="carousel2" class="carousel slide h-100">
                <div class="carousel-inner h-100">
                    <?php
                    $chunked_urunler = array_chunk($urunler, 3);
                    foreach ($chunked_urunler as $index => $urun_chunk) {
                        $active_class = $index === 0 ? 'active' : '';
                        echo '<div class="carousel-item ' . $active_class . ' h-100">';
                        echo '<div class="row">';
                        foreach ($urun_chunk as $urun) {
                            echo '<div class="col-lg-4">';
                            echo '<div class="p-4">';
                            echo '<a href="urunler.php" style="text-decoration:none; color: #000;">';
                            echo '<img src="assets/img/' . $urun['image'] . '" alt="" class="w-100 rounded-4" style="object-fit: cover; object-position: center; height: ; aspect-ratio: 1/1;">';
                            echo '</div>';
                            echo '<p class="text-center mx-auto fs-3 fw-semibold w-50 ">' . $urun['name'] . '</p></a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
                <button class="carousel-control-prev my-auto p-3 rounded-circle" style="left: 40px;" type="button"
                    data-bs-target="#carousel2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next my-auto p-3 rounded-circle"
                    style="right: 40px; bottom: 0 !important;" type="button" data-bs-target="#carousel2"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- slayt mobil -->
            <div class="carousel-mobile" style="position: relative;">
                <div id="carousel3" class="carousel slide mobil h-100" data-bs-ride="carousel">
                    <!-- Dots (Indicators) -->
                    <div class="carousel-indicators">
                        <?php foreach ($urunler as $index => $urun) {
                            $active_class = $index === 0 ? 'active' : ''; ?>
                            <button type="button" data-bs-target="#carousel3" data-bs-slide-to="<?php echo $index; ?>"
                                class="<?php echo $active_class; ?>" aria-current="true" aria-label="Slide 1"></button>
                        <?php
                        } ?>

                    </div>

                    <div class="carousel-inner h-100">
                        <?php
                        foreach ($urunler as $index => $urun) {
                            $active_class = $index === 0 ? 'active' : ''; ?>

                            <div class="carousel-item <?php echo $active_class; ?> h-100">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="p-4">
                                            <img src="assets/img/<?php echo $urun['image'] ?>" alt=""
                                                class="w-100 rounded-4 "
                                                style="object-fit: cover; object-position: bottom; height: 40vh; aspect-ratio: 1/1;">
                                        </div>
                                        <p class="text-center mx-auto fs-3 fw-semibold w-50"><?php echo $urun['name'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>


                </div>
            </div>

        </div>


        </div>
    </section>
    <?php
    $grid_link1 = array_values(array_filter($contents, function ($row) {
        return $row['type'] === 'grid-link1';
    }));
    $grid_link1 = reset($grid_link1);

    $grid_link2 = array_values(array_filter($contents, function ($row) {
        return $row['type'] === 'grid-link2';
    }));
    $grid_link2 = reset($grid_link2);

    $grid_link3 = array_values(array_filter($contents, function ($row) {
        return $row['type'] === 'grid-link3';
    }));
    $grid_link3 = reset($grid_link3);
    ?>
    <section class="grid-links mb-5 " style="padding-left: 3rem; padding-right: 3rem;">
        <div class="container-fluid">
            <div class="grid-container">

                <a href="#" class="grid-item item-a bg-yesil rounded-5"
                    style="background-image: url(assets/img/outdoor-running.jpg); position: relative; background-size: cover; background-position: center;">
                    <h4 class="text-white text-capitalize text-wrap mb-0 p-4 fw-bold"
                        style="word-break: break-all; position: absolute; bottom: 0;"><?php echo $grid_link1['content']; ?>
                    </h4>
                </a>


                <a href="#" class="grid-item item-b bg-yesil rounded-5"
                    style="background-image: url(assets/img/asdfasdasdafas.jpg); position: relative; background-repeat: no-repeat; background-size: cover; background-position: bottom;">
                    <h4 class="text-white text-capitalize text-wrap mb-0 p-3 fw-bold w-50"
                        style=" position: absolute; bottom: 0;"><?php echo $grid_link2['content']; ?>
                    </h4>
                </a>


                <a href="#" class="grid-item item-c bg-yesil rounded-5"
                    style="background-image: url(assets/img/maxresdefault.jpg); background-position: center; background-size: cover; position: relative;">
                    <h4 class="text-white text-capitalize text-wrap mb-0 p-3 fw-bold"
                        style="word-break: break-all; position: absolute; bottom: 0;"><?php echo $grid_link3['content']; ?>
                    </h4>
                </a>

            </div>
        </div>

    </section>

    <!--  <section class="bottom-sl mb-5">
        <div class="container-fluid d-flex px-0">
            <div class="d-flex w-50" style="height: 35vh;">
                <img src="assets/img/flat-lay-coffee-beans-wooden-board-with-copy-space.jpg" alt=""
                    style="width: 100%; object-fit: cover;">
            </div>
            <div class="d-flex w-50 flex-column justify-content-center p-4" style="position: relative;">
                <h2 class="text-white mb-4 fw-bold">Bunu biliyor musun?</h2>
                <p class="text-white w-75 fs-5"> Protein barlar, spor öncesi tüketildiğinde, içerdikleri kompleks
                    karbonhidratlar
                    sayesinde uzun süreli enerji sağlar. Böylece daha uzun süre performans gösterebilirsin.</p>
                <i class="ri-lightbulb-line"
                    style="position: absolute; color: white; top: 55px; right: 60px; scale: 5; rotate: -35deg;"></i>
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
                    <a href="gizlilik.php" class="text-black text-decoration-none"><?php echo $footer1['content']; ?></a>
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
</body>

</html>