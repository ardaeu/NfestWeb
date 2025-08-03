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

/*
$sql = $conn->prepare("SELECT power FROM admin WHERE mail = ?");
$sql->execute([$_SESSION['mail']]);
$power = $sql->fetch(PDO::FETCH_ASSOC);

if ($power === false || $power['power'] < 2) {
    echo '<script>
        alert("Bu işlemi yapmak için yeterli yetkiniz yok.");
        window.location.href = "index.php";
    </script>';
    exit();
}
*/
$aktif = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aktif = 1;
    $etkinlik_id = $_POST['etkinlik_id'];

    $sql = $conn->prepare("SELECT COUNT(*) AS bilet_sayi FROM biletler WHERE durum = 0 AND odeme = 1 AND etkinlik_id = :etkinlik_id");
    $sql->bindParam(':etkinlik_id', $etkinlik_id, PDO::PARAM_INT);
    $sql->execute();
    $biletSayi = $sql->fetch(PDO::FETCH_ASSOC)['bilet_sayi'];


    $sql = $conn->prepare("SELECT SUM(tutar) AS toplam_tutar FROM biletler WHERE durum = 0 AND odeme = 1 AND etkinlik_id = $etkinlik_id");
    $sql->execute();
    $toplamTutar = $sql->fetch(PDO::FETCH_ASSOC)['toplam_tutar'];
}

$sql = $conn->prepare("SELECT * FROM bizim_tiyatrolar WHERE status = 1");
$sql->execute();
$etkinlikler = $sql->fetchAll(PDO::FETCH_ASSOC);


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
                                                    <h1 class="m-0">Satış Raporu</h1>
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
                                                        <select name="etkinlik_id" style="width: 25%; height: 32px; margin-bottom: 16px; " onchange="document.getElementById('etkinlikForm').submit();">
                                                            <option value="">Etkinlik Seçin</option>
                                                            <?php foreach ($etkinlikler as $etkinlik) {
                                                                if ($etkinlik['id'] == $etkinlik_id) {
                                                                    $title = $etkinlik['title'];
                                                                    $date = $etkinlik['date'];
                                                                }
                                                            ?>
                                                                <option value="<?php echo $etkinlik['id'] ?>"><?php echo $etkinlik['title'] . ' - ' . $etkinlik['date'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <?php if ($aktif == 1) { ?>
                                                            <h4>Seçili Etkinlik: <?php echo $title . ' - ' . $date; ?> </h4>
                                                            <br>
                                                            <h5>Satılan Bilet Sayısı: <?php echo $biletSayi ?></h5><br>
                                                            <h5>Satılan Biletlerin Toplam Değeri: <?php echo $toplamTutar ?>₺</h5>
                                                        <?php } ?>
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