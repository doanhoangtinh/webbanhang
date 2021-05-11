<?php
ob_start();
session_start();
?>
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

        <?php if ($_SESSION["chucvu"] == "QTV") : ?>
            <!-- Mo ket noi toi mysql -->
            <?php include '../dbconnection.php'; ?>
            <!-- End mo ket noi toi mysql -->

            <div class="container mt-3">
                <div class="row" style="height: 500px;">
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
                            $sqlGetAllLoaiHangHoa = "SELECT * FROM loaihanghoa";
                            $resultGetAllLoaiHangHoa = $conn->query($sqlGetAllLoaiHangHoa);
                            ?>
                            <!-- Trang chu loai hang hoa -->
                            <div>
                                <div>
                                    <h4 style="text-align: center;">DANH SÁCH CÁC LOẠI HÀNG HÓA</h4>
                                </div>
                                <div>
                                    <a href="quan-ly-loai-hang-hoa.php?action=them-loai-hang-hoa" class="btn" style="background-color: #fbff02; color: black;font-weight: bold;">
                                        Thêm loại hàng hóa
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Mã loại hàng hóa</th>
                                                <th scope="col">Tên loại hàng hóa</th>
                                                <th scope="col">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($resultGetAllLoaiHangHoa as $item) : ?>
                                                <tr>
                                                    <td><?= $item["MaLoaiHang"] ?></td>
                                                    <td><?= $item["TenLoaiHang"] ?></td>
                                                    <td>
                                                        <a href="quan-ly-loai-hang-hoa.php?action=sua-loai-hang-hoa&id=<?= $item["MaLoaiHang"] ?>" class="btn btn-warning">
                                                            Sửa
                                                        </a>
                                                        <form action="" method="post" style="display: inline-flex;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                            <input type="hidden" class="form-control" id="txtXoaMaLoaiHang" name="txtXoaMaLoaiHang" value="<?= $item["MaLoaiHang"] ?>">
                                                            <button type="submit" class="btn btn-danger" name="btnXoaLoaiHangHoa">Xóa</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End trang chu loai hang hoa -->
                        <?php endif ?>

                        <?php if ((!empty($_GET["action"])) && ($_GET["action"] == "them-loai-hang-hoa")) : ?>
                            <!-- Them loai hang hoa -->
                            <div>
                                <div>
                                    <h4 style="text-align: center;">THÊM LOẠI HÀNG HÓA</h4>
                                </div>
                                <div class="mb-1 container">
                                    <a class="btn" href="quan-ly-loai-hang-hoa.php?action=trang-chu" style="background-color: #fbff02; color: black;font-weight: bold;">Quay lại</a>
                                </div>
                                <div class="container">
                                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return confirm('Bạn có chắc chắn muốn thêm?');">
                                        <div class="mb-3">
                                            <label for="txtThemTenLoaiHang" class="form-label">Tên loại hàng hóa</label>
                                            <input type="text" class="form-control" id="txtThemTenLoaiHang" name="txtThemTenLoaiHang" maxlength="79">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-success form-control" name="btnThemLoaiHangHoa">Thêm loại hàng hóa</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Xu ly PHP them loai hang hoa -->
                            <?php
                            if (isset($_POST["btnThemLoaiHangHoa"])) {
                                $txtThemTenLoaiHang = $_POST["txtThemTenLoaiHang"];
                                $sqlThemLoaiHangHoa = "INSERT INTO loaihanghoa (TenLoaiHang) VALUES ('$txtThemTenLoaiHang');";
                                if ($conn->query($sqlThemLoaiHangHoa)) {
                                    echo '<script type="text/javascript">alert("Thêm loại hàng hóa thành công!")</script>';
                                    echo "<script>location.replace('quan-ly-loai-hang-hoa.php?action=trang-chu')</script>";
                                } else {
                                    echo '<script type="text/javascript">alert("Thêm loại hàng hóa thất bại!")</script>';
                                }
                            }
                            ?>
                            <!-- End xu ly PHP them loai hang hoa -->
                            <!-- End them hang hoa -->
                        <?php endif ?>

                        <?php if ((!empty($_GET["action"])) && ($_GET["action"] == "sua-loai-hang-hoa") && (!empty($_GET["id"]))) : ?>
                            <?php
                            $maloaihang = $_GET["id"];
                            $sqlGetLoaiHangHoaById = "SELECT * FROM loaihanghoa WHERE MaLoaiHang = '$maloaihang'";
                            $resultGetLoaiHangHoaById = $conn->query($sqlGetLoaiHangHoaById);
                            $loaiHangHoa = $resultGetLoaiHangHoaById->fetch_assoc();
                            ?>
                            <!-- Sua loai hang hoa -->
                            <div>
                                <div>
                                    <h4 style="text-align: center;">SỬA LOẠI HÀNG HÓA</h4>
                                </div>
                                <div class="mb-1 container">
                                    <a class="btn" href="quan-ly-loai-hang-hoa.php?action=trang-chu" style="background-color: #fbff02; color: black;font-weight: bold;">Quay lại</a>
                                </div>
                                <div class="container">
                                    <form action="" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn sửa?');">
                                        <div class="mb-3">
                                            <input type="hidden" class="form-control" id="txtSuaMaLoaiHang" name="txtSuaMaLoaiHang" value="<?= $loaiHangHoa["MaLoaiHang"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="txtSuaTenLoaiHang" class="form-label">Tên loại hàng hóa</label>
                                            <input type="text" class="form-control" maxlength="79" id="txtSuaTenLoaiHang" name="txtSuaTenLoaiHang" value="<?= $loaiHangHoa["TenLoaiHang"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-success form-control" name="btnSuaLoaiHangHoa">Sửa loại hàng hóa</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Xu ly PHP sua loai hang hoa -->
                            <?php
                            if (isset($_POST["btnSuaLoaiHangHoa"])) {
                                $txtSuaMaLoaiHang = $_POST["txtSuaMaLoaiHang"];
                                $txtSuaTenLoaiHang = $_POST["txtSuaTenLoaiHang"];
                                $sqlSuaLoaiHangHoa = <<<EOT
                        UPDATE loaihanghoa 
                        SET TenLoaiHang = '$txtSuaTenLoaiHang' 
                        WHERE MaLoaiHang = '$txtSuaMaLoaiHang';
EOT;
                                if ($conn->query($sqlSuaLoaiHangHoa)) {
                                    echo '<script type="text/javascript">alert("Sửa loại hàng hóa thành công!")</script>';
                                    echo "<script>location.replace('quan-ly-loai-hang-hoa.php?action=trang-chu')</script>";
                                } else {
                                    echo '<script type="text/javascript">alert("Sửa loại hàng hóa thất bại!")</script>';
                                }
                            }
                            ?>
                            <!-- End xu ly PHP sua loai hang hoa -->

                            <!-- End sua loai hang hoa -->
                        <?php endif ?>

                        <!-- Xu ly PHP xoa loai hang hoa -->
                        <?php
                        if (isset($_POST["btnXoaLoaiHangHoa"])) {
                            $txtXoaMaLoaiHang = $_POST["txtXoaMaLoaiHang"];
                            $sqlXoaLoaiHangHoa = <<<EOT
                        DELETE FROM loaihanghoa 
                        WHERE MaLoaiHang = '$txtXoaMaLoaiHang';
EOT;
                            if ($conn->query($sqlXoaLoaiHangHoa)) {
                                echo '<script type="text/javascript">alert("Xóa loại hàng hóa thành công!")</script>';
                                echo "<script>location.replace('quan-ly-loai-hang-hoa.php?action=trang-chu')</script>";
                            } else {
                                echo '<script type="text/javascript">alert("Xóa loại hàng hóa thất bại!")</script>';
                            }
                        }
                        ?>
                        <!-- End xu ly PHP xoa loai hang hoa -->
                    </div>
                </div>
            </div>

        <?php else : ?>
            <div class="alert alert-warning alert-dismissible " role="alert" style="text-align: center;">
            <strong>Tài khoản của bạn bị giới hạn quyền truy cập!</strong> <span> chức năng này chỉ dùng cho Quản Trị Viên!</span>
                <a href="kiem-duyet-don-hang.php?action=trang-chu" class="btn-close"  aria-label="Close"></a>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <?php echo "<script>location.replace('dang-nhap.php')</script>"; ?>
    <?php endif; ?>


</body>

</html>
<?php
ob_flush();
?>