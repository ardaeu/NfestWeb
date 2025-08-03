<?php
include("../Ayarlar/ayar.php");

?>

<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.php">
            <span class="logo-sm">
                <img src="assets/images/logo.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.php">
            <span class="logo-sm">
                <img src="assets/images/logo.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav" style="justify-content: center;">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item">
                    <a href="index.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Kontrol Paneli</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarExpenses" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarExpenses">
                        <i class="ri-home-4-line"></i> <span data-key="t-expenses">Anasayfa</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarExpenses">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="header_duzenle.php" class="nav-link" data-key="t-one-page">Header Düzenle</a>
                            </li>
                            <li class="nav-item">
                                <a href="header_sil.php" class="nav-link" data-key="t-one-page">Header Sil</a>
                            </li>
                            <li class="nav-item">
                                <a href="bilgi_duzenle.php" class="nav-link" data-key="t-one-page">Kısa Bilgi Düzenle</a>
                            </li>
                            <li class="nav-item">
                                <a href="grid_duzenle.php" class="nav-link" data-key="t-one-page">Grid Galeri Düzenle</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarExpenses" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarExpenses">
                        <i class="ri-shopping-bag-3-line"></i> <span data-key="t-expenses">Ürünler</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarExpenses">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="kategori_ekle.php" class="nav-link" data-key="t-one-page">Kategori Ekle</a>
                            </li>
                            <li class="nav-item">
                                <a href="kategori_sil.php" class="nav-link" data-key="t-one-page">Kategori Listesi</a>
                            </li>
                            <li class="nav-item">
                                <a href="urun_ekle.php" class="nav-link" data-key="t-one-page">Ürün Ekle</a>
                            </li>
                            <li class="nav-item">
                                <a href="urun_sil.php" class="nav-link" data-key="t-one-page">Ürün Listesi</a>
                            </li>
                            <li class="nav-item">
                                <a href="icindekiler_ekle.php" class="nav-link" data-key="t-one-page">İçindekiler Ekle</a>
                            </li>
                            <li class="nav-item">
                                <a href="icindekiler_sil.php" class="nav-link" data-key="t-one-page">İçindekiler Listesi</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="hakkimizda_duzenle.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-information-line"></i><span data-key="t-dashboards">Hakkımızda</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarExpenses" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarExpenses">
                        <i class="ri-phone-line"></i> <span data-key="t-expenses">İletişim</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarExpenses">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="iletisim_duzenle.php" class="nav-link" data-key="t-one-page">İletişim Bilgilerini Düzenle</a>
                            </li>
                            <li class="nav-item">
                                <a href="form_duzenle.php" class="nav-link" data-key="t-one-page">Form Yazılarını Düzenle</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="diger_duzenle.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-add-line"></i><span data-key="t-dashboards">Diğer</span>
                    </a>
                </li>


                <!--<li class="nav-item">
                    <a href="anasayfa_edit.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-home-4-line"></i> <span data-key="t-dashboards">Anasayfa</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="about_edit.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-information-line"></i> <span data-key="t-dashboards">Hakkımızda</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="servis_edit.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-service-line"></i> <span data-key="t-dashboards">Servisler</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="ekip_edit.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-team-line"></i> <span data-key="t-dashboards">Ekibimiz</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="yorum_edit.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-chat-3-line"></i> <span data-key="t-dashboards">Yorumlar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="etkinlik_edit.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-calendar-event-line"></i> <span data-key="t-dashboards">Etkinlikler</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="galeri_edit.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-gallery-line"></i> <span data-key="t-dashboards">Galeri</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="iletisim_edit.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-phone-line"></i> <span data-key="t-dashboards">İletişim</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="menu_edit.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-book-open-line"></i> <span data-key="t-dashboards">Menü</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="social_edit.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-links-line"></i> <span data-key="t-dashboards">Diğer Bilgiler</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin_edit.php" class="nav-link" data-key="t-analytics">
                        <i class="ri-user-settings-line"></i><span data-key="t-dashboards">Yönetici Hesaplarını Düzenle</span>
                    </a>
                </li>-->


            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>