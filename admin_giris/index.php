<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&family=Lato&family=Secular+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="style.css">
    <title>NFEST Yönetim Paneli</title>
</head>

<body>






    <div class="container-fluid mt-5 mb-5 pb-5">
        <h1 class="text-center mt-5 mb-2 fw-light" style="font-size: 45px;">Giriş</h1>

        <div class="row p-5  rounded">

            <div class="col-lg-3 mx-auto    mb-5">
                <form action="adminsonuc.php" class="" method="POST">
                    <label for="email" class="form-label" style=" font-size: medium;">Kullanıcı Adı :</label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Kullanıcı Adı" required="required" data-validation-required-message="Lütfen E-mail Adresinizi Giriniz">
                    <label for="password" class="form-label mt-4 " style=" font-size: medium;">Şifre :</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Şifre" required="required" data-validation-required-message="Lütfen Şifrenizi Giriniz">
                    <div id="alert">

                    </div>
                    <button type="submit" id="buton" class="bg-dark  border-0  mt-5 mb-5 px-4 py-2" style="color: white;">Giriş yap</button>

                </form>
            </div>


        </div>
    </div>














    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="script.js"></script>



</body>

</html>