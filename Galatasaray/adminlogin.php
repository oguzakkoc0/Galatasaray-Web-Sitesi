<?php
    include 'ayar.php';

    // kullanici giriş işlemleri
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        // kullanici adi şifre kontrol
        $query = $db->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
        $query->execute([$username, $password]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if($user){
            echo "Giriş başarılı!";
            header("location: admin.php");
        } else {
            echo "Kullanıcı adı veya şifre hatalı!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici Sayfası</title>
    <link rel="stylesheet" href="cssblog/normalize.css">
    <link rel="stylesheet" href="cssblog/all.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap-grid.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="cssblog/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            border-radius: 5px;
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="post" action="">
                    <label for="username">Kullanıcı Adı:</label>
                    <input type="text" name="username" required>

                    <label for="password">Şifre:</label>
                    <input type="password" name="password" required>

                    <button type="submit" name="submit">Giriş Yap</button>
                </form>
</body>
</html>