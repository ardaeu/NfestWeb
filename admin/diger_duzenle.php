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

    $footer1 = array_filter($contents, function ($row) {
        return $row['type'] === 'footer1';
    });
    $footer1 = reset($footer1);
    $footer1 = $footer1['content'];

    $footer2 = array_filter($contents, function ($row) {
        return $row['type'] === 'footer2';
    });
    $footer2 = reset($footer2);
    $footer2 = $footer2['content'];

    if (isset($_POST['footer1']) || isset($_POST['tel'])) {
        if (isset($_POST['footer1']) && !empty($_POST['footer1'])) {
            $footer1 = nl2br($_POST['footer1']);

            $sql = $conn->prepare("DELETE FROM index_page WHERE type = 'footer1' AND dil = :dil");
            $sql->bindParam(':dil', $dil, PDO::PARAM_STR);
            $sql->execute();

            $sql = $conn->prepare("INSERT INTO index_page (content, type, dil) VALUES (:content, 'footer1' , :dil)");
            $sql->bindParam(':content', $footer1, PDO::PARAM_STR);
            $sql->bindParam(':dil', $dil, PDO::PARAM_STR);
            $sql->execute();
        }
        if (isset($_POST['footer2']) && !empty($_POST['footer2'])) {
            $footer2 = nl2br($_POST['footer2']);

            $sql = $conn->prepare("DELETE FROM index_page WHERE type = 'footer2' AND dil = :dil");
            $sql->bindParam(':dil', $dil, PDO::PARAM_STR);
            $sql->execute();

            $sql = $conn->prepare("INSERT INTO index_page (content, type, dil) VALUES (:content, 'footer2' , :dil)");
            $sql->bindParam(':content', $footer2, PDO::PARAM_STR);
            $sql->bindParam(':dil', $dil, PDO::PARAM_STR);
            $sql->execute();
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
                                                    <h1 class="m-0">Diğer Bilgileri Düzenle</h1>
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
                                                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                                                            <div class="col-md-12 mb-3">
                                                                <label for="footer1" class="form-label fw-bold"><?php echo $footer1; ?>:</label>
                                                                <input name="footer1" class="form-control form-control-sm" type="text" placeholder="">
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="footer2" class="form-label fw-bold"><?php echo $footer2; ?>:</label>
                                                                <input name="footer2" class="form-control form-control-sm" type="text" placeholder="">
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