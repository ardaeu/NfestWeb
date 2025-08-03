<?php
include("../Ayarlar/ayar.php");
session_start();

if (!isset($_SESSION['mail'])) {
    echo '<script>
        alert("Lütfen giriş yapınız.");
        window.location.href = "../admin_giris/index.php";
    </script>';
    exit(); // Yönlendirme sonrasında kodun çalışmasını durdurun
}

$sql = $conn->prepare("SELECT power FROM admin WHERE mail = ?");
$sql->execute([$_SESSION['mail']]);
$power = $sql->fetch(PDO::FETCH_ASSOC);

if ($power === false || $power['power'] < 2) {
    echo '<script>
        alert("Bu sayfaya erişmek için yeterli yetkiniz yok.");
        window.location.href = "index.php";
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
                                <div class="content-wrapper">
                                    <!-- Content Header (Page header) -->
                                    <div class="content-header">
                                        <div class="container-fluid">
                                            <div class="row mb-2">
                                                <div class="col-sm-6">
                                                    <h1 class="m-0">Hakkımızda Bilgilerini Düzenle</h1>
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
                                                <div class="card-body">
                                                    <div class="header-preview" style="padding-bottom: 25px; ">
                                                        <h2>Hakkımızda</h2>
                                                        <div class="img">
                                                            <img src="image/About-ins.png" style="width: 100%;" alt="">
                                                        </div>
                                                    </div>
                                                    <p>Bu bölümdeki bilgiler Hakkımızda ve Anasayfa sayfalarında görüntülenir.</p>
                                                    <h3>Genel Bilgiler</h3>
                                                    <form role="form" action="about_update.php" method="POST" enctype="multipart/form-data">
                                                        <div class="col-md-12 mb-3">
                                                            <label for="about_img1" class="form-label fw-bold">Görsel 1 (Yatay)</label>
                                                            <input name="about_img1" class="form-control form-control-sm" type="file">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="about_img2" class="form-label fw-bold">Görsel 2 (Dikey)</label>
                                                            <input name="about_img2" class="form-control form-control-sm" type="file" placeholder="">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="about_title" class="form-label fw-bold">Başlık</label>
                                                            <input name="about_title" class="form-control form-control-sm" type="text" placeholder="">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="about_text" class="form-label fw-bold">İçerik</label>
                                                            <textarea style="height: 10vh;" name="about_text" class="form-control form-control-sm" id="content" placeholder=""></textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="anasayfa_title" class="form-label fw-bold">Anasayfada Görüntülenecek Başlık</label>
                                                            <input name="anasayfa_title" class="form-control form-control-sm" type="text" placeholder="">
                                                        </div>

                                                        <h3 style="padding-top: 25px;">Liste</h3>

                                                        <div class="col-md-12 mb-3">
                                                            <label for="about_icon1" class="form-label fw-bold">Icon 1</label>
                                                            <input name="about_icon1" class="form-control form-control-sm" type="file">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="about_liste1" class="form-label fw-bold">Liste 1</label>
                                                            <input name="about_liste1" class="form-control form-control-sm" type="text" placeholder="">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="about_icon2" class="form-label fw-bold">Icon 2</label>
                                                            <input name="about_icon2" class="form-control form-control-sm" type="file">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="about_liste2" class="form-label fw-bold">Liste 2</label>
                                                            <input name="about_liste2" class="form-control form-control-sm" type="text" placeholder="">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="about_icon3" class="form-label fw-bold">Icon 3</label>
                                                            <input name="about_icon3" class="form-control form-control-sm" type="file">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="about_liste3" class="form-label fw-bold">Liste 3</label>
                                                            <input name="about_liste3" class="form-control form-control-sm" type="text" placeholder="">
                                                        </div>
                                                        <div class="row d-flex justify-content-end mr-3">
                                                            <input type="submit" name="submit" class="btn btn-primary" value="Kaydet">
                                                        </div>
                                                    </form>
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