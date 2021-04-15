<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điện máy VÀNG</title>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>

    <!-- Header -->
    <?php include 'header.php' ?>
    <!-- End header -->

    <!-- Mo ket noi toi mysql -->
    <?php include 'dbconnection.php'; ?>
    <!-- End mo ket noi toi mysql -->

    <div class="mt-5">
        <div id="dangnhap">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 rounded shadow">
                        <div class="card-body">
                            <h2>Đăng nhập</h2>
                            <p style="font-weight: 500;">Nhập thông tin tài khoản</p>
                            <form action="" method="post">
                                <div class="mb-3">
                                    <input class="form-control" type="text" name="txtTaiKhoanDangNhap" placeholder="Tên đăng nhập">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="password" name="txtMatKhauDangNhap" placeholder="Mật khẩu">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4" name="btnDangNhap">Đăng nhập</button>
                                    </div>
                                    <div class="col-6">
                                        <a class="nav-link" onclick="xuLyHienThi('dangky','dangnhap');">Đăng ký tài khoản</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <?php
                        if (isset($_POST["btnDangNhap"])) {
                            $taiKhoanDangNhap = $_POST["txtTaiKhoanDangNhap"];
                            $matKhauDangNhap = $_POST["txtMatKhauDangNhap"];
                            $sql = "SELECT * FROM khachhang WHERE TaiKhoan = '$taiKhoanDangNhap';";
                            $result = $conn->query($sql);
                            $khachHang = $result->fetch_assoc();
                            if ($khachHang["MatKhau"] == $matKhauDangNhap) {
                                $_SESSION["mskh"] = $khachHang["MSKH"];
                                $_SESSION["tenkhachhang"] = $khachHang["HoTenKH"];
                                echo "<script>location.replace('index.php')</script>";

                            } else {
                                echo '<script type="text/javascript">alert("Tài khoản hoặc mật khẩu không chính xác!")</script>';
                                echo "<script>location.replace('dang-nhap.php')</script>";
                            }

                            // echo '<script type="text/javascript">alert("Đăng ký tài khoản thành công!")</script>';
                            
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="dangky" style="display: none;">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-4 rounded shadow">
                        <div class="card-body">
                            <h2>Đăng ký</h2>
                            <p>Nhập thông tin đăng ký</p>
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="txtHoTenKH" class="form-label">Họ tên</label>
                                    <input type="text" class="form-control" id="txtHoTenKH" name="txtHoTenKH">
                                </div>
                                <div class="mb-3">
                                    <label for="txtDiaChiKH" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="txtDiaChiKH" name="txtDiaChiKH">
                                </div>
                                <div class="mb-3">
                                    <label for="txtEmail" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="txtEmail" name="txtEmail">
                                </div>
                                <div class="mb-3">
                                    <label for="txtSDT" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="txtSDT" name="txtSDT">
                                </div>
                                <div class="mb-3">
                                    <label for="txtTaiKhoan" class="form-label">Tài khoản</label>
                                    <input type="text" class="form-control" id="txtTaiKhoan" name="txtTaiKhoan">
                                </div>
                                <div class="mb-3">
                                    <label for="txtMatKhau" class="form-label">Mật khẩu</label>
                                    <input type="text" class="form-control" id="txtMatKhau" name="txtMatKhau">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success form-control" name="btnDangKy">Đăng ký</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                    if (isset($_POST["btnDangKy"])) {
                        $hoTenKH = $_POST["txtHoTenKH"];
                        $diaChi = $_POST["txtDiaChiKH"];
                        $email = $_POST["txtEmail"];
                        $sdt = $_POST["txtSDT"];
                        $taiKhoan = $_POST["txtTaiKhoan"];
                        $matKhau = $_POST["txtMatKhau"];
                        $sql =  "INSERT INTO `quanlydathang`.`khachhang` (`HoTenKH`, `DiaChi`, `SoDienThoai`, `Email`, `TaiKhoan`, `MatKhau`) 
                VALUES ('$hoTenKH', '$diaChi', '$sdt', '$email', '$taiKhoan', '$matKhau');";
                        $conn->query($sql);

                        echo '<script type="text/javascript">alert("Đăng ký tài khoản thành công!")</script>';
                        echo "<script>location.replace('index.php')</script>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <script>
        function xuLyHienThi(idHienThi, idBlock) {
            document.getElementById(idBlock).style.display = "none";
            document.getElementById(idHienThi).style.display = "block";
        }
    </script>
</body>

</html>