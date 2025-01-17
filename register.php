<?php
    include "function.php";

    if(isset($_POST['tambahuser'])) {
        $iduser = $_POST['iduser'];
        $namauser = $_POST['namauser'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($koneksi) {
            $tambahuser = mysqli_query($koneksi, "INSERT INTO user (namauser, username, password) VALUES
                ('$namauser', '$username', '$password' )");

            if($tambahuser) {
                echo '<script>
                    alert("Berhasil! Silahkan login '.$namauser.'");
                    window.location.href="login.php";
                  </script>';
            } else {
                echo '<script>
                    alert("Gagal membuat akun!");
                    window.location.href="register.php";
                  </script>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Toko Serbaguna - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-warning">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
                            </div>
                            <form class="user" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user mb-3"
                                        id="InputName" name="namauser" placeholder="Isi Nama Lengkap"
                                        required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="username" class="form-control form-control-user"
                                        id="InputUsername" name="username" placeholder="Isi Username"
                                        required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                        id="InputPassword" name="password" placeholder="Isi Password"
                                        required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block"
                                name="tambahuser"> Buat Akun
                                </button>
                                <input type="hidden" name="iduser" value="<?=$iduser;?>">
                                <hr>
                            </form>
                            <div class="text-center">
                                <a class="small" href="login.php">Sudah punya akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>