<?php
try {
	$conn = new PDO("mysql:host=localhost;dbname=example;charset=UTF8", "admin", "admin");
} catch (PDOException $Hata) {
	//echo "Bağlantı Hatası<br />" . $Hata->getMessage();   //bu alan kapalı çünkü site hata yaparsa kullanıcılar hata değerini görmesin
	die();
}
