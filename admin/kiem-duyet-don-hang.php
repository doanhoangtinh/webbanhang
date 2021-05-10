<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ Admin</title>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">

    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;

        }

        li a {
            display: block;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
        }

        /* Change the link color on hover */
        li a:hover {
            background-color: #555;
            color: white;
        }
    </style>
</head>

<body>

    <?php if (isset($_SESSION["msnv"])) : ?>

        <!-- Header -->
        <?php include 'header.php' ?>
        <!-- End header -->
        <!-- Mo ket noi toi mysql -->
        <?php include '../dbconnection.php'; ?>
        <!-- End mo ket noi toi mysql -->
        <div class="container mt-3">
            <div class="row container" style="height: 500px;">
                <div class="col-md-3">
                    <div class="shadow p-3 mb-3" style="background-color: #00483d; border-radius: 10px;">
                        <h5 style="color: white;text-align: center;">DANH MỤC</h5>
                    </div>
                    <div class="shadow p-3 mb-5" style="background-color: #00483d; border-radius: 10px;">
                        <ul>
                            <li><a href="kiem-duyet-don-hang.php?action=trang-chu">Kiểm duyệt đơn hàng</a></li>
                            <li><a href="quan-ly-nhan-vien.php?action=trang-chu">Quản lý nhân viên</a></li>
                            <li><a href="quan-ly-hang-hoa.php?action=trang-chu">Quản lý hàng hóa</a></li>
                            <li><a href="quan-ly-loai-hang-hoa.php?action=trang-chu">Quản lý loại hàng hóa</a></li>
                            <li><a href="quan-ly-khach-hang.php?action=trang-chu">Quản lý khách hàng</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 shadow p-3 mb-5 bg-body rounded">
                    <?php if ((!empty($_GET["action"])) && ($_GET["action"] == "trang-chu")) : ?>
                        <?php
                        $sqlGetAllDatHang = "SELECT * FROM dathang";
                        $resultGetAllDatHang = $conn->query($sqlGetAllDatHang);
                        ?>
                        <!-- Trang chu kiem duyet hang hoa -->
                        <div>
                            <div>
                                <h4 style="text-align: center;">DANH SÁCH CÁC ĐƠN ĐẶT HÀNG</h4>
                            </div>
                            <!-- <div>
                                <a href="quan-ly-hang-hoa.php?action=them-hang-hoa" class="btn" style="background-color: #fbff02; color: black;font-weight: bold;">
                                    Thêm hàng hóa
                                </a>
                            </div> -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã số đơn hàng</th>
                                            <th scope="col">Ngày đặt hàng</th>
                                            <th scope="col">Ngày giao hàng</th>
                                            <th scope="col">Trạng thái đơn hàng</th>
                                            <th scope="col">Mã số khách hàng</th>
                                            <th scope="col">Nhân viên duyệt đơn hàng</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($resultGetAllDatHang as $item) : ?>
                                            <tr>
                                                <th scope='row'><?= $item["SoDonDH"] ?></th>
                                                <td><?= $item["NgayDH"] ?></td>
                                                <td><?= $item["NgayGH"] ?></td>
                                                <td><?= $item["TrangThai"] ?></td>
                                                <td><?= $item["MSKH"] ?></td>
                                                <td><?= $item["MSNV"] ?></td>
                                                <td>
                                                    <div>
                                                        <a href="kiem-duyet-don-hang.php?action=duyet-don-hang&id=<?= $item['SoDonDH'] ?>" class="btn btn-warning mb-1" style="width: 150px;">
                                                            <span data-feather="edit"></span> Duyệt đơn hàng
                                                        </a>
                                                        <a href="kiem-duyet-don-hang.php?action=chi-tiet-don-hang&id=<?= $item['SoDonDH'] ?>" class="btn btn-success" style="width: 150px;">
                                                            <span data-feather="edit"></span> Xem chi tiết
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End trang chu hang hoa -->
                    <?php endif ?>



                    <?php if ((!empty($_GET["action"])) && ($_GET["action"] == "duyet-don-hang") && (!empty($_GET["id"]))) : ?>
                        <?php
                        $masodonhang = $_GET["id"];
                        $sqlGetDonHangById = "SELECT * FROM dathang WHERE SoDonDH = $masodonhang";
                        $resultGetDonHangById = $conn->query($sqlGetDonHangById);
                        $donhang = $resultGetDonHangById->fetch_assoc();
                        ?>
                        <!-- Sua hang hoa -->
                        <div>
                            <div>
                                <h4 style="text-align: center;">KIỂM DUYỆT ĐƠN HÀNG</h4>
                            </div>
                            <div class="container">
                                <form action="" method="post" onsubmit="return checkNgayGiaoHang();">
                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" id="txtMaSoDonHang" name="txtMaSoDonHang" value="<?= $donhang["SoDonDH"] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtTrangThaiDonHang" class="form-label">Trạng thái đơn hàng</label>

                                        <select name="txtTrangThaiDonHang" class="form-select" aria-label="Default select example">
                                            <option value="Đã được duyệt" selected>Đã được duyệt</option>
                                        </select>

                                        <!-- <input type="text" required class="form-control" maxlength="79" id="txtTrangThaiDonHang" name="txtTrangThaiDonHang"> -->
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtNgayGiaoHang" class="form-label">Ngày giao hàng</label>
                                        <input type="date" class="form-control" maxlength="79" id="txtNgayGiaoHang" name="txtNgayGiaoHang">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success form-control" name="btnDuyetDonHang">Duyệt đơn hàng</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Xu ly PHP sua hang hoa -->
                        <?php
                        if (isset($_POST["btnDuyetDonHang"])) {
                            $txtMaSoDonHang = $_POST["txtMaSoDonHang"];
                            $txtTrangThaiDonHang = $_POST["txtTrangThaiDonHang"];
                            $txtNgayGiaoHang = date_create($_POST["txtNgayGiaoHang"]);
                            $ngaygh = date_format($txtNgayGiaoHang, "Y-m-d");
                            $msnv = $_SESSION["msnv"];
                            $sqlDuyetDonHang = <<<EOT
                        UPDATE `quanlydathang`.`dathang` 
                        SET `NgayGH` = '$ngaygh',
                            `TrangThai` = '$txtTrangThaiDonHang',
                            `MSNV` = $msnv
                        WHERE (`SoDonDH` = '$txtMaSoDonHang');
EOT;
                            if ($conn->query($sqlDuyetDonHang)) {
                                echo '<script type="text/javascript">alert("Duyệt đơn hàng thành công!")</script>';
                                echo "<script>location.replace('kiem-duyet-don-hang.php?action=trang-chu')</script>";
                            } else {
                                echo '<script type="text/javascript">alert("Duyệt đơn hàng thất bại!")</script>';
                            }
                        }
                        ?>
                        <!-- End xu ly PHP sua hang hoa -->
                        <!-- End sua hang hoa -->
                    <?php endif ?>



                    <?php if ((!empty($_GET["action"])) && ($_GET["action"] == "chi-tiet-don-hang") && (!empty($_GET["id"]))) : ?>
                        <?php
                        $sodon = $_GET["id"];
                        $sqlGetChiTietDatHangBySoDonDH = <<<EOT
                        SELECT * FROM chitietdathang as a, hanghoa as b, dathang as c, khachhang as d, nhanvien as e 
                        WHERE a.MSHH = b.MSHH
                        AND a.SoDonDH = c.SoDonDH
                        AND c.MSKH = d.MSKH
                        AND c.MSNV = e.MSNV
                        AND a.SoDonDH = '$sodon';
EOT;
                        $resultsqlGetChiTietDatHangBySoDonDH = $conn->query($sqlGetChiTietDatHangBySoDonDH);
                        $thongtin = $resultsqlGetChiTietDatHangBySoDonDH->fetch_assoc();
                        ?>
                        <!-- Trang chu kiem duyet hang hoa -->
                        <div>
                            <div>
                                <h4 style="text-align: center;">Chi tiết đặt hàng</h4>
                            </div>
                            <div style="margin-left: 8px;">
                                <h6>Mã số khách hàng: <span style="color: red; font-style: italic;"><?=$thongtin["MSKH"]?></span> </h6>
                                <h6>Tên khách hàng: <span style="color: red; font-style: italic;"><?=$thongtin["HoTenKH"]?></span> </h6>
                                <h6>Địa chỉ: <span style="color: red; font-style: italic;"><?=$thongtin["DiaChi"]?></span> </h6>
                                <h6>Số điện thoại: <span style="color: red; font-style: italic;"><?=$thongtin["SoDienThoai"]?></span> </h6>
                                <h6>Email: <span style="color: red; font-style: italic;"><?=$thongtin["Email"]?></span> </h6>
                                <h6>Ngày đặt hàng: <span style="color: red; font-style: italic;"><?=$thongtin["NgayDH"]?></span> </h6>
                                <h6>Ngày giao hàng: <span style="color: red; font-style: italic;"><?=$thongtin["NgayGH"]?></span> </h6>
                                <h6>Trạng thái hiện tại: <span style="color: red; font-style: italic;"><?=$thongtin["TrangThai"]?></span> </h6>
                                <h6>Nhân viên duyệt đơn hàng: <span style="color: red; font-style: italic;"><?=$thongtin["HoTenNV"]?></span> </h6>

                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã số đơn hàng</th>
                                            <th scope="col">Tên hàng hóa</th>
                                            <th scope="col">Giá hàng hóa</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($resultsqlGetChiTietDatHangBySoDonDH as $item) : ?>
                                            <tr>
                                                <th scope='row'><?= $item["SoDonDH"] ?></th>
                                                <td><?= $item["TenHH"] ?></td>
                                                <td><?= number_format($item["Gia"], 2) ?></td>
                                                <td><?= $item["SoLuong"] ?></td>
                                                <td><?= number_format($item["GiaDatHang"], 2) ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- End trang chu hang hoa -->
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php else : ?>
        <?php echo "<script>location.replace('dang-nhap.php')</script>"; ?>
    <?php endif; ?>
    <script>
        function checkNgayGiaoHang() {
            var dateGH = new Date(document.getElementById('txtNgayGiaoHang').value);
            var currentDate = new Date();

            if (dateGH.getTime() > currentDate.getTime()) {
                var confirmdialog = confirm("Bạn chắc chắn muốn duyệt đơn hàng!");
                if (confirmdialog == true) {
                    return true;
                } else {
                    return false;
                }
            } else {
                alert("Vui lòng chọn ngày giao hàng lớn hơn ngày duyệt!");
                return false;
            }
        }
    </script>
</body>

</html>