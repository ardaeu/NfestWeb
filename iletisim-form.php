<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $surname = htmlspecialchars(trim($_POST['surname']));
    $tel = htmlspecialchars(trim($_POST['tel']));
    $mail = htmlspecialchars(trim($_POST['mail']));
    $mesaj = htmlspecialchars(trim($_POST['mesaj']));

    if (empty($name) || empty($surname) || empty($tel) || empty($mail) || empty($mesaj)) {
        echo json_encode(['success' => false, 'message' => 'Lütfen tüm alanları doldurunuz.']);
        exit();
    }

    // Form verilerini formatlayarak mesaj.txt dosyasına kaydet
    $file_content = "İsim: $name\nSoyisim: $surname\nTelefon: $tel\nE-posta: $mail\nMesaj: $mesaj\n\n";

    // mesaj.txt dosyasının yolunu belirtin
    $file_path = __DIR__ . '/mesaj.txt';

    try {
        // Dosyaya yazma işlemi
        file_put_contents($file_path, $file_content, FILE_APPEND | LOCK_EX);
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Dosya yazma hatası: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Geçersiz istek.']);
}
