<?php
include("../Ayarlar/ayar.php");
session_start();

if (isset($_POST['kategori_id'])) {
    $kategoriId = $_POST['kategori_id'];



    // Seçilen kategoriye ait ürünleri alalım
    $stmt = $conn->prepare("SELECT id, name FROM urunler WHERE kategori = ?");
    $stmt->execute([$kategoriId]);

    // Ürünleri JSON olarak döndürelim
    $urunler = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($urunler);
}
?>
