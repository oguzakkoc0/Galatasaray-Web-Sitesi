<?php
include("baglanti.php");

$parola_err = $username_err = "";

if (isset($_POST["giris"])) {

    // Kullanıcı adı doğrulama
    if (empty($_POST["kullaniciadi"])) {
        $username_err = "Kullanıcı adı boş bırakılamaz.";
    } else {
        $username = $_POST["kullaniciadi"];
    }

    // Parola doğrulama
    if (empty($_POST['parola'])) {
        $parola_err = "Parola boş geçilemez";
    } else {
        $parola = $_POST["parola"];
    }

    // Diğer doğrulama kontrollerini yaptıktan sonra kaydı yap
    if (empty($username_err) && empty($parola_err)) {
        $secim = "SELECT * FROM kullanici WHERE kullaniciadi = '$username'";
        $calistir = mysqli_query($baglanti, $secim);
        $kayitsayisi = mysqli_num_rows($calistir);

        if ($kayitsayisi > 0) {
            $ilgilikayit = mysqli_fetch_assoc($calistir);
            $hashlisifre = $ilgilikayit["parola"];
            
            if (password_verify($parola, $hashlisifre)) {
                session_start();
                $_SESSION["kullaniciadi"] = $ilgilikayit["kullaniciadi"];
                $_SESSION["email"] = $ilgilikayit["email"];
                header("location: profile.php");
                exit();
            } else {
                $error_message = "Parola Yanlış";
            }
        } else {
            $error_message = "Kullanıcı Adı Yanlış";
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
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv"
        crossorigin="anonymous">

    <title>Üye Giriş</title>
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
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kullanıcı Adı</label>
                    <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                        id="exampleInputEmail1" name="kullaniciadi">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?php echo $username_err; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Parola</label>
                    <input type="password"
                        class="form-control <?php echo (!empty($parola_err)) ? 'is-invalid' : ''; ?>"
                        id="exampleInputPassword1" name="parola">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?php echo $parola_err; ?>
                    </div>
                </div>
                <button type="submit" name="giris" class="btn btn-primary">Giriş Yap</button>
            </form>
            <div class="mt-3">
                <p>Hesabınız yok mu? <a href="kayit.php" style="text-decoration:none">Kayıt Ol</a></p>
            </div>
            <?php
            if (isset($error_message)) {
                echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
            }
            ?>
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
</body>

</html>
