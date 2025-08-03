<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../Ayarlar/ayar.php");
session_start();

if (!isset($_SESSION['mail'])) {
    echo '<script>
        alert("Lütfen giriş yapınız.");
        window.location.href = "../admin_giris/index.php";
    </script>';
    exit(); // Yönlendirme sonrasında kodun çalışmasını durdurun
}

$aktif = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aktif = 1;
    $dil = $_POST['dil'];

    $sql = $conn->prepare("SELECT * FROM index_page WHERE dil = :dil");
    $sql->bindParam(':dil', $dil, PDO::PARAM_STR);
    $sql->execute();
    $contents = $sql->fetchAll(PDO::FETCH_ASSOC);

    $i_text = array_filter($contents, function ($row) {
        return $row['type'] === 'info_text';
    });
    $i_text = reset($i_text);
    $i_text = $i_text['content'];

    $i_btn = array_filter($contents, function ($row) {
        return $row['type'] === 'info_btn';
    });
    $i_btn = reset($i_btn);
    $i_btn = $i_btn['content'];

    $i_title = array_filter($contents, function ($row) {
        return $row['type'] === 'info_title';
    });
    $i_title = reset($i_title);
    $i_title = $i_title['content'];

    if (isset($_POST['i_text']) || isset($_POST['i_btn']) || isset($_POST['i_title'])) {
        if (isset($_POST['i_text']) && !empty($_POST['i_text'])) {
            $i_text = nl2br($_POST['i_text']);

            $sql = $conn->prepare("DELETE FROM index_page WHERE type = 'info_text' AND dil = :dil");
            $sql->bindParam(':dil', $dil, PDO::PARAM_STR);
            $sql->execute();

            $sql = $conn->prepare("INSERT INTO index_page (content, type, dil) VALUES (:content, 'info_text' , :dil)");
            $sql->bindParam(':content', $i_text, PDO::PARAM_STR);
            $sql->bindParam(':dil', $dil, PDO::PARAM_STR);
            $sql->execute();
        }
        if (isset($_POST['i_btn']) && !empty($_POST['i_btn'])) {
            $i_btn = nl2br($_POST['i_btn']);

            $sql = $conn->prepare("DELETE FROM index_page WHERE type = 'info_btn' AND dil = :dil");
            $sql->bindParam(':dil', $dil, PDO::PARAM_STR);
            $sql->execute();

            $sql = $conn->prepare("INSERT INTO index_page (content, type, dil) VALUES (:content, 'info_btn' , :dil)");
            $sql->bindParam(':content', $i_btn, PDO::PARAM_STR);
            $sql->bindParam(':dil', $dil, PDO::PARAM_STR);
            $sql->execute();
        }
        if (isset($_POST['i_title']) && !empty($_POST['i_title'])) {
            $i_title = nl2br($_POST['i_title']);

            $sql = $conn->prepare("DELETE FROM index_page WHERE type = 'info_title' AND dil = :dil");
            $sql->bindParam(':dil', $dil, PDO::PARAM_STR);
            $sql->execute();

            $sql = $conn->prepare("INSERT INTO index_page (content, type, dil) VALUES (:content, 'info_title' , :dil)");
            $sql->bindParam(':content', $i_title, PDO::PARAM_STR);
            $sql->bindParam(':dil', $dil, PDO::PARAM_STR);
            $sql->execute();
        }
    }

    if (isset($_FILES['img'])) {
        $img = $_FILES['img'];

        if ($img['error'] == 0) {
            $img_name = $img['name'];
            $img_tmp = $img['tmp_name'];
            $img_size = $img['size'];
            $img_error = $img['error'];

            $img_array = explode('.', $img_name);
            $img_extension = strtolower(end($img_array));

            $allowed_extensions = array('jpg', 'jpeg', 'png');

            if (in_array($img_extension, $allowed_extensions)) {
                if ($img_error === 0) {
                    if ($img_size < 1000000) {
                        $new_img_name = uniqid('', true) . "." . $img_extension;
                        $img_destination = '../assets/img/' . $new_img_name;

                        move_uploaded_file($img_tmp, $img_destination);

                        $sql = $conn->prepare("DELETE FROM index_page WHERE type = 'info_img' AND dil = :dil");
                        $sql->bindParam(':dil', $dil, PDO::PARAM_STR);
                        $sql->execute();

                        $sql = $conn->prepare("INSERT INTO index_page (content, type, dil) VALUES (:content, 'header' , :dil)");
                        $sql->bindParam(':content', $new_img_name, PDO::PARAM_STR);
                        $sql->bindParam(':dil', $dil, PDO::PARAM_STR);
                        $sql->execute();
                    } else {
                        echo '<script>
                            alert("Dosya boyutu 1MB\'dan küçük olmalıdır.");
                        </script>';
                    }
                } else {
                    echo '<script>
                        alert("Dosya yüklenirken bir hata oluştu.");
                    </script>';
                }
            } else {
                echo '<script>
                    alert("Sadece JPG, JPEG ve PNG dosyaları yüklenebilir.");
                </script>';
            }
        } else {
            echo '<script>
                alert("Dosya yüklenirken bir hata oluştu.");
            </script>';
        }
    }
}

$sql = $conn->prepare("SELECT * FROM diller");
$sql->execute();
$diller = $sql->fetchAll(PDO::FETCH_ASSOC);


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
<style>
    .form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 15px;
        border: 1px dashed;
        border-radius: 10px;
        background-color: seashell;
        margin-bottom: 25px;
        width: 100%;
    }

    .image-container {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 15px;
    }

    .image {
        height: 30vh;
        max-width: 100%;
        border-radius: 15px;
    }

    .text-container {
        flex: 2;
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .row {
        display: flex;
        flex-direction: row;
        margin-bottom: 5px;
    }

    .label {
        font-weight: 700;
        margin-right: 5px;
    }

    .value {
        margin-left: 5px;
    }

    .btn-a {
        margin-top: 25px;
        width: 100%;
        max-width: 150px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 10px;
        }

        .btn {
            width: 100%;
            max-width: none;
        }
    }
</style>

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
                                <div class="content-wrapper">
                                    <!-- Content Header (Page header) -->
                                    <div class="content-header">
                                        <div class="container-fluid">
                                            <div class="row mb-2">
                                                <div class="col-sm-6">
                                                    <h1 class="m-0">Kısa Bilgi Düzenle</h1>
                                                </div><!-- /.col -->
                                            </div><!-- /.row -->
                                        </div><!-- /.container-fluid -->
                                    </div>
                                    <!-- /.content-header -->

                                    <!-- Main content -->






                                    <section class="content">
                                        <div class="container-fluid">
                                            <div class="card">

                                                <!-- /.card-header -->
                                                <div class="card-body mb-3">
                                                    <form action="" method="POST" id="etkinlikForm">
                                                        <select name="dil" style="width: 25%; height: 32px; margin-bottom: 16px; " onchange="document.getElementById('etkinlikForm').submit();">
                                                            <option value="">Dil Seçin</option>
                                                            <?php foreach ($diller as $dils) {                                                            ?>
                                                                <option value="<?php echo $dils['dil']; ?>"><?php echo $dils['dil'];  ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </form>
                                                    <?php if ($aktif == 1) { ?>
                                                        <div class="header-preview" style="padding-bottom: 25px; ">
                                                            <h2>Kısa Biilgi Fotoğraf Değiştir</h2>
                                                        </div>
                                                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                                            <div class="col-md-12 mb-3">
                                                                <label for="img" class="form-label fw-bold">Header Fotoğraf(586x590)</label>
                                                                <input name="img" class="form-control form-control-sm" type="file">
                                                            </div>
                                                            <input type="hidden" name="dil" value="<?php echo $dil; ?>">
                                                            <div class="row d-flex justify-content-end mr-3">
                                                                <input type="submit" name="submit" class="btn btn-primary" value="Kaydet">
                                                            </div>
                                                        </form>
                                                        <br>
                                                        <div class="header-preview" style="padding-bottom: 25px; ">
                                                            <h2>Kısa Bilgi Yazıları</h2>
                                                        </div>
                                                        <!--<p>Bu bölümdeki bilgiler Hakkımızda ve Anasayfa sayfalarında görüntülenir.</p>
                                                        <h3>Genel Bilgiler</h3>-->
                                                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                                            <div class="col-md-12 mb-3">
                                                                <label for="i_title" class="form-label fw-bold">Başlık(<?php echo htmlspecialchars($i_title); ?>)</label>
                                                                <textarea name="i_title" class="form-control form-control-sm" rows="3"></textarea>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="i_text" class="form-label fw-bold">Yazı(<?php echo $i_text; ?>)</label>
                                                                <textarea name="i_text" class="form-control form-control-sm" rows="3"></textarea>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="i_btn" class="form-label fw-bold">Buton(<?php echo $i_btn; ?>)</label>
                                                                <textarea name="i_btn" class="form-control form-control-sm" rows="3"></textarea>
                                                            </div>
                                                            <input type="hidden" name="dil" value="<?php echo $dil; ?>">
                                                            <div class="row d-flex justify-content-end mr-3">
                                                                <input type="submit" name="submit" class="btn btn-primary" value="Kaydet">
                                                            </div>
                                                        </form>
                                                    <?php } ?>

                                                </div>



                                            </div>
                                            <!-- /.card-body -->
                                        </div>


                                </div><!-- /.container-fluid -->

                            </div>
                            <!-- /.content -->
                        </div>
                    </div> <!-- end .h-100-->
                </div> <!-- end col -->
                <div class="col-auto layout-rightside-col">
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
                ?>-->
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
</body>

</html>