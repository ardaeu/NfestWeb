<?php
include("../Ayarlar/ayar.php");
ob_start();
session_start();

$email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
$sifre = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

if (($email != "") and ($sifre != "")) {
    $KontrolSorgusu = $conn->prepare("SELECT * FROM admin WHERE mail = ? AND password = ?");
    $KontrolSorgusu->execute([$email, $sifre]);
    $KullaniciSayisi = $KontrolSorgusu->rowCount();
    $KullaniciKaydi = $KontrolSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($KullaniciSayisi > 0) {
        $_SESSION["mail"] = $email;
        header("Location:../admin/index.php");
        exit();
    } else {
        // Hata mesajını sadece ekrana yazdır, yönlendirme yapma
        echo '<script>
        alert("Giriş başarısız kullanıcı adı veya şifre hatalı!");
        window.location.href = "#";
    </script>';
    }
} else {
    // Hata mesajını sadece ekrana yazdır, yönlendirme yapma
    echo '<script>
    alert("Giriş başarısız kullanıcı adı veya şifre hatalı!");
    window.location.href = "#";
</script>';
}

// Burada textboxların, radioların veri taşıyıp taşımadığını kontrol ediyoruz.
// Eğer buraya gelindiğinde bir hata varsa, o zaman yönlendirme yapabilirsiniz.
header("Location:index.php");
exit();
