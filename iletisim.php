<? // ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>

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

?>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <title>N'Fest</title>
</head>

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
    <section class="iletisim mb-5">
        <div class="w-100 px-0"
            style="height: 30vh; background-image: url(assets/img/oranges-organic-homemade-marmalade-copy-space.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-yesil text-center fw-bold py-5"> <?php echo $navbar4['content']; ?> </h1>
                </div>
            </div>
        </div>
        <div class="container-fluid px-5 iletisimalt">


            <div class="row">
                <div class="col-lg-6">
                    <div class="w-100 h-100" style="aspect-ratio: 1/1;">
                        <iframe style="width: 100%; height: 100%;"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3014.8866648154403!2d29.173436076525384!3d40.91823082496387!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cac4667fc06ccd%3A0xa00200cfcc3c2bab!2sAnatolium%20Marmara%20Al%C4%B1%C5%9Fveri%C5%9F%20Merkezi!5e0!3m2!1str!2str!4v1725344442163!5m2!1str!2str"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <?php
                $adres = array_filter($contents, function ($row) {
                    return $row['type'] === 'adres';
                });
                $adres = reset($adres);

                $tel = array_filter($contents, function ($row) {
                    return $row['type'] === 'tel';
                });
                $tel = reset($tel);

                $mail = array_filter($contents, function ($row) {
                    return $row['type'] === 'mail';
                });
                $mail = reset($mail);
                ?>
                <div class="col-lg-6 py-2">
                    <div class="d-flex w-100 h-100 flex-column">
                        <div class="info w-100 d-flex" style="flex: 1;">
                            <div class="d-flex h-100 flex-column justify-content- " style="flex: 1;">
                                <div class="d-flex flex-row align-items-center">
                                    <i
                                        class="ri-map-pin-line  fs-1 text-center align-items-center justify-content-center"></i>
                                    <p class="mb-0 ms-2 fw-semibold">
                                        <?php echo $adres['content']; ?></p>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <i
                                        class="ri-phone-line  fs-1 text-center align-items-center justify-content-center"></i>
                                    <p class="mb-0 ms-2 fw-semibold"><?php echo $tel['content']; ?></p>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <i
                                        class="ri-mail-line  fs-1 text-center align-items-center justify-content-center"></i>
                                    <p class="mb-0 ms-2 fw-semibold"><?php echo $mail['content']; ?></p>
                                </div>

                            </div>
                    
                        </div>
                        <?php
                        $f_title = array_filter($contents, function ($row) {
                            return $row['type'] === 'f_title';
                        });
                        $f_title = reset($f_title);

                        $f_ad = array_filter($contents, function ($row) {
                            return $row['type'] === 'f_ad';
                        });
                        $f_ad = reset($f_ad);

                        $f_soyad = array_filter($contents, function ($row) {
                            return $row['type'] === 'f_soyad';
                        });
                        $f_soyad = reset($f_soyad);

                        $f_tel = array_filter($contents, function ($row) {
                            return $row['type'] === 'f_tel';
                        });
                        $f_tel = reset($f_tel);

                        $f_mail = array_filter($contents, function ($row) {
                            return $row['type'] === 'f_mail';
                        });
                        $f_mail = reset($f_mail);

                        $f_mesaj = array_filter($contents, function ($row) {
                            return $row['type'] === 'f_mesaj';
                        });
                        $f_mesaj = reset($f_mesaj);

                        $f_btn = array_filter($contents, function ($row) {
                            return $row['type'] === 'f_btn';
                        });
                        $f_btn = reset($f_btn);
                        ?>
                        <div class="w-100 d-flex flex-column" style="flex: 1;">
                            <h3 class="text-yesil fw-bold"><?php echo $f_title['content']; ?></h3>
                            <div class="form w-100 h-100 d-flex flex-column">
                                <form action="" style="all: inherit;" id="myForm" method="POST">
                                    <div class="iletisim-form-input d-flex w-100">
                                        <input name="name" type="text" placeholder="<?php echo $f_ad['content']; ?>"
                                            class="m-3 ms-0 rounded-4 px-2 py-1 w-50" style="flex: 1;" required>
                                        <input name="surname" type="text" placeholder="<?php echo $f_soyad['content']; ?>"
                                            class="m-3 me-0 rounded-4 px-2 py-1 w-50" style="flex: 1;" required>
                                    </div>
                                    <div class="iletisim-form-input d-flex w-100">
                                        <input name="tel" type="text" placeholder="<?php echo $f_tel['content']; ?>"
                                            class="m-3 ms-0 rounded-4 px-2 py-1 w-50" style="flex: 1;" required>
                                        <input name="mail" type="email" placeholder="<?php echo $f_mail['content']; ?>"
                                            class="m-3 me-0 rounded-4 py-1 px-2 w-50" style="flex: 1;" required>
                                    </div>
                                    <div class="d-flex " style="flex: 1;">
                                        <textarea name="mesaj" id="" class="h-100 w-100 my-auto rounded-4 px-2"
                                            placeholder="<?php echo $f_mesaj['content']; ?>" required></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <button type="submit" class="px-4 rounded-4 fw-semibold"><?php echo $f_btn['content']; ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $("#myForm").submit(function(e) {
                e.preventDefault(); // Formun otomatik olarak submit olmasını engeller

                // Form verilerini alın
                var formData = $("#myForm").serialize();

                // Form verilerini PHP dosyasına post edin
                $.ajax({
                    type: "POST",
                    url: "iletisim-form.php", // Verileri işleyecek PHP dosyasının yolu
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı!',
                                text: 'Mesajınız başarıyla gönderildi.',
                                showCancelButton: false,
                                confirmButtonText: 'Tamam',
                                background: '#000',
                                color: '#fff',
                                customClass: {
                                    confirmButton: 'custom-confirm-button' // Özel sınıf adı
                                }
                            });
                        } else {
                            // Başarısız olduğunda uyarı mesajını göster
                            Swal.fire({
                                icon: 'error',
                                title: 'Hata!',
                                text: response.message,
                                background: '#000',
                                color: '#fff',
                            });
                        }

                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>