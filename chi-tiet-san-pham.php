<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style>
        a {
            color: white;
        }


        .div1 {
            background: red;
        }

        .div2 {
            background: yellow;
        }

        .div3 {
            background: green;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include 'header.php' ?>
    <!-- End header -->
    <!-- Mo ket noi toi mysql -->
    <?php include 'dbconnection.php'; ?>
    <!-- End mo ket noi toi mysql -->
    <div class="container">
        <div class="row">
            <?php
            $maSanPham =  $_GET["id"];
            $sql = "SELECT * FROM hanghoa WHERE MSHH = $maSanPham";
            $result = $conn->query($sql);
            $sanPham = $result->fetch_assoc();
            ?>

            <?php if ($sanPham != null) : ?>
                <div class="col-md-8 rounded shadow p-4">

                    <div class="row">
                        <div class="col-md-3">
                            <img class="img-fluid" src="uploads/<?= $sanPham["AnhSanPham"] ?>" alt="" srcset="">
                        </div>
                        <div class="col-md-9">
                            <h5><?= $sanPham["TenHH"] ?></h5>
                            <h4 style="color: #fd475a;"><span style="color: black;"> </span><?= number_format($sanPham["Gia"], 2) ?> <u>đ</u> </h5>
                                <div>
                                    <span style="font-weight: 500;">Cam kết 100% hàng chính hãng, hoàn tiền nếu phát hiện hàng giả</span>
                                </div>
                                <div>
                                    <span style="font-weight: 500;"> Hiện còn: <span style="color: red;"><?= $sanPham["SoLuongHang"] ?></span> sản phẩm</span>
                                </div>
                                <div>
                                    <span style="display: inline-block; background: #f7941e 0% 0% no-repeat padding-box;box-shadow: 0 4px 6px #00000029;border-radius: 3px; color: white;padding: 2px;">
                                        Khuyến mãi
                                    </span>
                                    <ul>
                                        <li>Giảm giá 5,000,000đ khi tham gia thu cũ đổi mới</li>
                                        <li>Trả góp 0% thẻ tín dụng</li>
                                        <li>Giảm 10% khi mua kèm điện thoại từ 2,000,000đ trở lên</li>
                                    </ul>
                                </div>
                                <span style="font-weight: 500;">Số lượng muốn mua</span>
                                <div style="margin-top: 10px;">
                                    <form action="" method="post" onsubmit="return confirm('Xác nhận đặt hàng');">
                                        <input class="form-control" type="number" name="soLuong" id="soLuong" min="1" value="1" style="width: 100px;">
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-success form-control" name="btnDatHangHoa">Đặt ngay</button>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST["btnDatHangHoa"])) { 
                                        if (isset($_SESSION["mskh"])) {
                                            $soLuong = $_POST["soLuong"];
                                            $sqlGetHangHoaById = "SELECT * FROM hanghoa WHERE MSHH = $maSanPham";
                                            $resultGetHangHoaById =  $conn->query($sqlGetHangHoaById);
                                            $hanghoa = $resultGetHangHoaById->fetch_assoc();
                                            if ($soLuong <= $hanghoa["SoLuongHang"]) {
                                                $date = date("Y-m-d h:i:s");
                                                $mskh = $_SESSION["mskh"];
                                                $sqlThemDatHang = "INSERT INTO `quanlydathang`.`dathang` (`NgayDH`, `TrangThai`, `MSKH`) VALUES ('$date', 'Chờ xét duyệt', '$mskh');";
                                                if ($conn->query($sqlThemDatHang) === true) {
                                                    $last_id = $conn->insert_id;
                                                    $thanhtien = $soLuong * $hanghoa["Gia"];
                                                    $sqlThemChiTietDatHang = "INSERT INTO `quanlydathang`.`chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`) VALUES ('$last_id', '$maSanPham', '$soLuong', '$thanhtien');
                                                    ";
                                                    if ($conn->query($sqlThemChiTietDatHang) === true) {
                                                        echo '<script type="text/javascript">alert("Đặt hàng thành công!")</script>';
                                                        echo "<script>location.replace('index.php')</script>";
                                                    } else {
                                                        echo '<script type="text/javascript">alert("Đặt hàng thất bại!")</script>';
                                                    }
                                                } else {
                                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                                }
                                            } else {
                                                echo '<script type="text/javascript">alert("Hiện chỉ còn ' . $hanghoa["SoLuongHang"] . ' sản phẩm!")</script>';
                                            }
                                        } else {
                                            echo '<script type="text/javascript">alert("Vui lòng đăng nhập để đặt hàng!")</script>';
                                            echo "<script>location.replace('dang-nhap.php')</script>";
                                        }
                                    }
                                    ?>
                                </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="rounded shadow p-4">
                        <h3>Thông tin chi tiết sản phẩm</h3>
                        <?= $sanPham["GhiChu"] ?>
                    </div>
                </div>
            <?php endif; ?>


        </div>

    </div>
</body>

</html>