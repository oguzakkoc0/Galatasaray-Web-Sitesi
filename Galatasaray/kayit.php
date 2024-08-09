<?php
include("baglanti.php");

$parola_err = $tekrar_parola_err = $email_err = $username_err = "";

if (isset($_POST["kaydet"])) {

    // Kullanıcı adı doğrulama
    if (empty($_POST["kullaniciadi"])) {
        $username_err = "Kullanıcı adı boş bırakılamaz.";
    } else if (strlen($_POST["kullaniciadi"]) < 6) {
        $username_err = "Kullanıcı adı en az 6 karakterden oluşmalıdır";
    } else if (!preg_match('/^[a-zA-Z\d_]{5,20}$/', $_POST["kullaniciadi"])) {
        $username_err = "Kullanıcı adı büyük küçük harf ve rakamdan oluşmalıdır";
    } else {
        $username = $_POST["kullaniciadi"];
    }

    // Email doğrulama
    if (empty($_POST["email"])) {
        $email_err = "Email boş bırakılamaz.";
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Geçersiz email formatı";
    } else {
        $email = $_POST["email"];
    }

    // Parola doğrulama
    if (empty($_POST['parola'])) {
        $parola_err = "Parola boş geçilemez";
    } else {
        $parola = password_hash($_POST["parola"], PASSWORD_DEFAULT);
    }

    // Parola tekrar doğrulaması
    if (empty($_POST["parolatkr"])) {
        $tekrar_parola_err = "Tekrar parolanız boş geçilemez";
    } else if ($_POST["parola"] != $_POST["parolatkr"]) {
        $tekrar_parola_err = "Parolalar eşleşmiyor";
    }

    // Diğer doğrulama kontrollerini yaptıktan sonra kaydı yap
    if (empty($username_err) && empty($email_err) && empty($parola_err) && empty($tekrar_parola_err)) {
        $ekle = "INSERT INTO kullanici (kullaniciadi,email,parola) VALUES ('$username','$email','$parola')";

        $calistirekle = mysqli_query($baglanti, $ekle);

        if ($calistirekle) {
            echo '<div class="alert alert-success" role="alert">
            Kayıt Başarılı 
          </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Kayıt Başarısız
          </div>';
        }
        mysqli_close($baglanti);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="stylee.css" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
          integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv"
          crossorigin="anonymous">

    <title>Üye Kayıt</title>
</head>
<body>
<header class="menub">
        <nav>
            <div class="logo">
                <a href="#"><img src="img/gslogo.png" alt="Logo"></a>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="index.php">Anasayfa</a></li>
                    <li><a href="stadyum.php">Stadyum</a></li>
                    <li><a href="kadro.php">Kadro</a></li>
                    <li><a href="mars.php">Marşlar</a></li>
                    <li><a href="blog.php">Blog</a></li>
                </ul>
                <a href="login.php" class="menu-button">Giriş Yap</a>
            </div>
        </nav>
    </header>
<div class="container p-5">
    <div class="card p-5">
        <form action="kayit.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control
                <?php
                if (!empty($username_err)) {
                    echo "is-invalid";
                }
                ?>
                " id="exampleInputEmail1" name="kullaniciadi">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php
                    echo $username_err;
                    ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="text" class="form-control
                <?php
                if (!empty($email_err)) {
                    echo "is-invalid";
                }
                ?>
                " id="exampleInputEmail1" name="email">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php
                    echo $email_err;
                    ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Parola</label>
                <input type="password" class="form-control
                <?php
                if (!empty($parola_err)) {
                    echo "is-invalid";
                }
                ?>
                " id="exampleInputPassword1" name="parola">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php
                    echo $parola_err;
                    ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Parola Tekrar</label>
                <input type="password" class="form-control
                <?php
                if (!empty($tekrar_parola_err)) {
                    echo "is-invalid";
                }
                ?>
                " id="exampleInputPassword1" name="parolatkr">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php
                    echo $tekrar_parola_err;
                    ?>
                </div>
            </div>
            <button type="submit" name="kaydet" class="btn btn-primary">Kaydet</button>
        </form>
    </div>
</div>
<footer>
        <div class="container">
            <p>&copy; 2023 Son Dakika Futbol - Tüm Hakları Saklıdır.</p>
        </div>
    </footer>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Z
