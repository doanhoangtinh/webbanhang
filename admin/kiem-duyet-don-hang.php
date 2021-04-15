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
        <div class="container mt-3">
            <div class="row container" style="height: 500px;">
                <div class="col-md-3">
                    <div class="shadow p-3 mb-3" style="background-color: #00483d; border-radius: 10px;">
                        <h5 style="color: white;text-align: center;">DANH MỤC</h5>
                    </div>
                    <div class="shadow p-3 mb-5" style="background-color: #00483d; border-radius: 10px;">
                        <ul>
                            <li><a href="kiem-duyet-don-hang.php">Kiểm duyệt đơn hàng</a></li>
                            <li><a href="quan-ly-nhan-vien.php">Quản lý nhân viên</a></li>
                            <li><a href="quan-ly-hang-hoa.php">Quản lý hàng hóa</a></li>
                            <li><a href="quan-ly-loai-hang-hoa.php">Quản lý loại hàng hóa</a></li>
                            <li><a href="quan-ly-khach-hang.php">Quản lý khách hàng</a></li>
                            <li><a href="quan-ly-dia-chi.php">Quản lý địa chỉ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 shadow p-3 mb-5 bg-body rounded">
                    <?php if ((!empty($_GET["action"])) && ($_GET["action"] == "trang-chu")) : ?>
                        <?php
                        $sqlGetAllHangHoa = "SELECT * FROM hanghoa";
                        $resultGetAllHangHoa = $conn->query($sqlGetAllHangHoa);
                        ?>
                        <!-- Trang chu kiem duyet hang hoa -->
                        <div>
                            <div>
                                <h4 style="text-align: center;">DANH SÁCH CÁC ĐƠN ĐẶT HÀNG</h4>
                            </div>
                            <div>
                                <a href="quan-ly-hang-hoa.php?action=them-hang-hoa" class="btn" style="background-color: #fbff02; color: black;font-weight: bold;">
                                    Thêm hàng hóa
                                </a>
                            </div>
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
 
                                        <?php foreach ($resultGetAllHangHoa as $item) : ?>
                                            <tr>
                                                <th scope='row'><?= $item["MSHH"] ?></th>
                                                <td><?= $item["TenHH"] ?></td>
                                                <td><?= $item["Gia"] ?></td>
                                                <td><?= $item["SoLuongHang"] ?></td>
                                                <td><?= $item["MaLoaiHang"] ?></td>
                                                <td><img src='../uploads/<?= $item["AnhSanPham"] ?>' style='width: 50px; height: 50px;'></td>
                                                <td>
                                                    <a href="quan-ly-hang-hoa.php?action=sua-hang-hoa&id=<?= $item['MSHH'] ?>" class="btn btn-warning">
                                                        <span data-feather="edit"></span> Sửa
                                                    </a>

                                                    <form action="" method="post" style="display: inline-flex;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                        <input type="hidden" class="form-control" id="txtXoaMaLoaiHang" name="txtXoaMaHangHoa" value="<?= $item["MSHH"] ?>">
                                                        <button type="submit" class="btn btn-danger" name="btnXoaHangHoa">Xóa</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End trang chu hang hoa -->
                    <?php endif ?>

                    

                    <?php if ((!empty($_GET["action"])) && ($_GET["action"] == "sua-hang-hoa") && (!empty($_GET["id"]))) : ?>
                        <?php
                        $masohanghoa = $_GET["id"];
                        $sqlGetHangHoaById = "SELECT * FROM hanghoa WHERE MSHH = $masohanghoa";
                        $resultGetHangHoaById = $conn->query($sqlGetHangHoaById);
                        $hangHoa = $resultGetHangHoaById->fetch_assoc();
                        ?>
                        <!-- Sua hang hoa -->
                        <!-- Xu ly PHP sua hang hoa -->
                        <?php
                        if (isset($_POST["btnSuaHangHoa"])) {
                            if ($_FILES["fileSuaHinhAnh"]["size"] == 0) {
                                $suaTenHang = $_POST["txtSuaTenHang"];
                                $suaQuyCach = $_POST["txtSuaQuyCach"];
                                $suaSoLuong = $_POST["txtSuaSoLuong"];
                                $suaGia = $_POST["txtSuaGia"];
                                $suaGhiChu = $_POST["txtSuaGhiChu"];
                                $suaMaHangHoa = $_POST["txtSuaMaHangHoa"];
                                $suaMaLoaiHang = $_POST["txtSuaLoaiHang"];
                                $sqlCapNhatHangHoa = <<<EOT
                            UPDATE `quanlydathang`.`hanghoa` 
                            SET `TenHH` = '$suaTenHang', 
                                `QuyCach` = '$suaQuyCach',
                                `Gia` = '$suaGia', 
                                `GhiChu` = '$suaGhiChu',
                                `SoLuongHang` = '$suaSoLuong',
                                `MaLoaiHang` ='$suaMaLoaiHang'
                            WHERE (`MSHH` = '$suaMaHangHoa');
EOT;
                                if ($conn->query($sqlCapNhatHangHoa)) {
                                    echo '<script type="text/javascript">alert("Sửa hàng hóa thành công!")</script>';
                                    echo "<script>location.replace('quan-ly-hang-hoa.php?action=trang-chu')</script>";
                                } else {
                                    echo mysqli_error($conn);
                                    echo '<script type="text/javascript">alert("Sửa hàng hóa thất bại!")</script>';
                                }
                            } else {

                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["fileSuaHinhAnh"]["name"]);
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $fileName = basename($_FILES["fileSuaHinhAnh"]["name"]);
                                move_uploaded_file($_FILES["fileSuaHinhAnh"]["tmp_name"], $target_file);
                                $suaTenHang = $_POST["txtSuaTenHang"];
                                $suaQuyCach = $_POST["txtSuaQuyCach"];
                                $suaSoLuong = $_POST["txtSuaSoLuong"];
                                $suaGia = $_POST["txtSuaGia"];
                                $suaGhiChu = $_POST["txtSuaGhiChu"];
                                $suaMaHangHoa = $_POST["txtSuaMaHangHoa"];
                                $suaMaLoaiHang = $_POST["txtSuaLoaiHang"];
                                $sqlCapNhatHangHoa = <<<EOT
                            UPDATE `quanlydathang`.`hanghoa` 
                            SET `TenHH` = '$suaTenHang', 
                                `QuyCach` = '$suaQuyCach',
                                `Gia` = '$suaGia', 
                                `GhiChu` = '$suaGhiChu',
                                `SoLuongHang` = '$suaSoLuong', 
                                `AnhSanPham` = '$fileName',
                                `MaLoaiHang` ='$suaMaLoaiHang'
                            WHERE (`MSHH` = '$suaMaHangHoa');                            
EOT;
                                if ($conn->query($sqlCapNhatHangHoa)) {
                                    echo '<script type="text/javascript">alert("Sửa hàng hóa thành công!")</script>';
                                    echo "<script>location.replace('quan-ly-hang-hoa.php?action=trang-chu')</script>";
                                } else {
                                    echo '<script type="text/javascript">alert("Sửa hàng hóa thất bại!")</script>';
                                }
                            }
                        }
                        ?>
                        <!-- End xu ly PHP sua hang hoa -->
                        <!-- End sua hang hoa -->
                    <?php endif ?>

                    <!-- Xu ly PHP xoa loai hang hoa -->
                    <?php
                    if (isset($_POST["btnXoaHangHoa"])) {
                        $xoaMaSoHangHoa = $_POST["txtXoaMaHangHoa"];
                        $sqlXoaHangHoa = <<<EOT
                        DELETE FROM `quanlydathang`.`hanghoa` 
                        WHERE (`MSHH` = '$xoaMaSoHangHoa');
EOT;
                        if ($conn->query($sqlXoaHangHoa)) {
                            echo '<script type="text/javascript">alert("Xóa hàng hóa thành công!")</script>';
                            echo "<script>location.replace('quan-ly-hang-hoa.php?action=trang-chu')</script>";
                        } else {
                            echo '<script type="text/javascript">alert("Xóa hàng hóa thất bại!")</script>';
                        }
                    }
                    ?>
                    <!-- End xu ly PHP xoa loai hang hoa -->
                </div>
            </div>
        </div>
    <?php else : ?>
        <?php echo "<script>location.replace('dang-nhap.php')</script>"; ?>
    <?php endif; ?>
</body>

</html>