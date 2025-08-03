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

$urun_id = $_GET['id'];
$urun_dil = $_GET['dil'];

$sql = $conn->prepare("SELECT * FROM urunler WHERE id = :id");
$sql->bindParam(':id', $urun_id, PDO::PARAM_STR);
$sql->execute();
$content = $sql->fetch(PDO::FETCH_ASSOC);


$urun_isim = $content['name'];
$new_img_name = $content['image'];
$urun_kategori = $content['kategori'];
$kategori_id = $content['kategori'];

$sql = $conn->prepare("SELECT * FROM kategoriler WHERE dil = :dil");
$sql->bindParam(':dil', $urun_dil, PDO::PARAM_STR);
$sql->execute();
$kategoriler = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = $conn->prepare("SELECT * FROM kategoriler WHERE id = :id");
$sql->bindParam(':id', $kategori_id, PDO::PARAM_STR);
$sql->execute();
$urun_kategori = $sql->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['kategori_yeni']) && !empty($_POST['kategori_yeni'])) {
        $urun_kategori = $_POST['kategori_yeni'];
    }
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $urun_isim = $_POST['name'];
    }

    if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
        $img = $_FILES['img'];

        $img_name = $img['name'];
        $img_tmp = $img['tmp_name'];
        $img_size = $img['size'];
        $img_error = $img['error'];

        $img_array = explode('.', $img_name);
        $img_extension = strtolower(end($img_array));

        $allowed_extensions = array('jpg', 'jpeg', 'png');

        if (in_array($img_extension, $allowed_extensions)) {
            if ($img_error === 0) {
                if ($img_size < 5000000) {
                    $new_img_name = uniqid('', true) . "." . $img_extension;
                    $img_destination = '../assets/img/' . $new_img_name;

                    move_uploaded_file($img_tmp, $img_destination);
                } else {
                    echo '<script>
                        alert("Dosya boyutu 5MB\'dan küçük olmalıdır.");
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
    }

    $sql = $conn->prepare("UPDATE urunler SET kategori = :kategori, image = :image, name = :name WHERE id = :id");
    $sql->bindParam(':kategori', $urun_kategori, PDO::PARAM_INT);
    $sql->bindParam(':image', $new_img_name, PDO::PARAM_STR);
    $sql->bindParam(':name', $urun_isim, PDO::PARAM_STR);
    $sql->bindParam(':id', $urun_id, PDO::PARAM_INT);
    $sql->execute();

    echo '<script>
                alert("Güncelleme başarılı.");
            </script>';

    header("Location:urun_sil.php");
    exit();
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
                                                    <h1 class="m-0">Ürün Güncelle</h1>
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
                                                    <form role="form" action="" method="POST" enctype="multipart/form-data" style="width: 100%; align-items: center; flex-direction: column; display: flex;">
                                                        <div class="col-md-12 mb-3" style="display: flex; flex-direction: column; align-items: center;">
                                                            <img src="../assets/img/<?php echo $content['image']; ?>" width="50%" alt="">
                                                            <p style="margin-top: 15px;">Dil: <?php echo $content['dil']; ?></p>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="name" class="form-label fw-bold">Ürün Adı: <?php echo $content['name']; ?></label>
                                                            <input name="name" class="form-control form-control-sm" type="text">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <select name="kategori_yeni" style="width: 25%; height: 32px; margin-bottom: 16px; ">
                                                                <option value="<?php echo $urun_kategori['id']; ?>"><?php echo $urun_kategori['title']; ?></option>
                                                                <?php foreach ($kategoriler as $kategori) { ?>
                                                                    <option value="<?php echo $kategori['id']; ?>"><?php echo $kategori['title'];  ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="img" class="form-label fw-bold">Ürün Görselini Değiştir:</label>
                                                            <input name="img" class="form-control form-control-sm" type="file">
                                                        </div>

                                                        <div class="row d-flex justify-content-end mr-3" style="width: 50%;">
                                                            <input type="submit" name="guncelle" class="btn btn-success" value="Güncelle">
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
</body>

</html>