<?php
include 'Ayarlar/ayar.php';

if (isset($_POST['urun_id'])) {
    $urunId = $_POST['urun_id'];

    // Ürünü veritabanından çek
    $urunQuery = "SELECT * FROM urunler WHERE id = ?";
    $stmt = $conn->prepare($urunQuery);
    $stmt->bind_param("i", $urunId);
    $stmt->execute();
    $urunResult = $stmt->get_result();
    
    if ($urunResult->num_rows > 0) {
        $urun = $urunResult->fetch_assoc();
        
        // Ürün slaytlarını çek
        $slideQuery = "SELECT * FROM icindekiler WHERE urun_id = ?";
        $stmt = $conn->prepare($slideQuery);
        $stmt->bind_param("i", $urunId);
        $stmt->execute();
        $slideResult = $stmt->get_result();
        
        $slides = [];
        while ($slide = $slideResult->fetch_assoc()) {
            $slides[] = $slide['image'];
        }

        // Ürün detaylarını ve slaytları döndür
        echo json_encode([
            'urun' => $urun,
            'slides' => $slides
        ]);
    } else {
        echo json_encode(['error' => 'Ürün bulunamadı.']);
    }
}
?>
