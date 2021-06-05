<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>

    <!-- Header -->
    <?php include 'header.php' ?>
    <!-- End header -->

    <!-- Mo ket noi toi mysql -->
    <?php include '../dbconnection.php'; ?>
    <!-- End mo ket noi toi mysql -->

    <div class="mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 rounded shadow">
                    <div class="card-body">
                        <h2>Đăng nhập</h2>
                        <p style="font-weight: 500;">Nhập thông tin tài khoản</p>
                        <form action="" method="post">
                            <div class="mb-3">
                                <input class="form-control" required type="text" name="txtTaiKhoanDangNhap" placeholder="Tên đăng nhập">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" required type="password" name="txtMatKhauDangNhap" placeholder="Mật khẩu">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-success px-4" name="btnDangNhap">Đăng nhập</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php
                    if (isset($_POST["btnDangNhap"])) {
                        $taiKhoanDangNhap = $_POST["txtTaiKhoanDangNhap"];
                        $matKhauDangNhap = $_POST["txtMatKhauDangNhap"];
                        $sql = "SELECT * FROM nhanvien WHERE TaiKhoan = '$taiKhoanDangNhap';";
                        $result = $conn->query($sql);
                        $nhanvien = $result->fetch_assoc();
                        if ($nhanvien["MatKhau"] == $matKhauDangNhap) {
                            // $_SESSION["taikhoan"] = $taiKhoanDangNhap;
                            // $_SESSION["matkhau"] = $matKhauDangNhap;
                            $_SESSION["chucvu"] = $nhanvien["ChucVu"];
                            $_SESSION["msnv"] = $nhanvien["MSNV"];
                            $_SESSION["tennhanvien"] = $nhanvien["HoTenNV"];
                            echo "<script>location.replace('kiem-duyet-don-hang.php?action=trang-chu')</script>";

                        } else {
                            echo '<script type="text/javascript">alert("Tài khoản hoặc mật khẩu không chính xác!")</script>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>