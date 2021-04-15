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
                        $sqlGetAllNhanVien = "SELECT * FROM nhanvien";
                        $resultGetAllNhanVien = $conn->query($sqlGetAllNhanVien);
                        ?>
                        <!-- Trang chu nhan vien -->
                        <div>
                            <div>
                                <h4 style="text-align: center;">DANH SÁCH CÁC NHÂN VIÊN</h4>
                            </div>
                            <div>
                                <a href="quan-ly-nhan-vien.php?action=them-nhan-vien" class="btn" style="background-color: #fbff02; color: black;font-weight: bold;">
                                    Thêm nhân viên
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã số nhân viên</th>
                                            <th scope="col">Họ tên nhân viên</th>
                                            <th scope="col">Chức vụ</th>
                                            <th scope="col">Địa chỉ</th>
                                            <th scope="col">Số điện thoại</th>
                                            <th scope="col">Tài khoản</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($resultGetAllNhanVien as $item) : ?>
                                            <tr>
                                                <th scope='row'><?= $item["MSNV"] ?></th>
                                                <td><?= $item["HoTenNV"] ?></td>
                                                <td><?= $item["ChucVu"] ?></td>
                                                <td><?= $item["DiaChi"] ?></td>
                                                <td><?= $item["SoDienThoai"] ?></td>


                                                <td>
                                                    <a href="quan-ly-nhan-vien.php?action=sua-nhan-vien&id=<?= $item['MSNV'] ?>" class="btn btn-warning">
                                                        <span data-feather="edit"></span> Sửa
                                                    </a>

                                                    <form action="" method="post" style="display: inline-flex;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                        <input type="hidden" class="form-control" id="txtXoaMaNhanVien" name="txtXoaMaNhanVien" value="<?= $item["MSNV"] ?>">
                                                        <button type="submit" class="btn btn-danger" name="btnXoaNhanVien">Xóa</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End trang chu nhan vien -->
                    <?php endif ?>

                    <?php if ((!empty($_GET["action"])) && ($_GET["action"] == "them-nhan-vien")) : ?>
                        <!-- Them nhan vien -->
                        <div>
                            <div>
                                <h4 style="text-align: center;">THÊM NHÂN VIÊN</h4>
                            </div>
                            <div class="mb-1 container">
                                <button class="btn" style="background-color: #fbff02; color: black;font-weight: bold;" onclick="xuLyHienThi('trangchuhanghoa','themhanghoa');">Quay lại</button>
                            </div>
                            <div class="container">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="txtThemTenNhanVien" class="form-label">Tên nhân viên</label>
                                        <input type="text" required maxlength="79" class="form-control" id="txtThemTenNhanVien" name="txtThemTenNhanVien">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtThemChucVu" class="form-label">Chức vụ</label>
                                        <input type="text" maxlength="79" class="form-control" id="txtThemChucVu" name="txtThemChucVu">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtThemDiaChi" class="form-label">Địa chỉ</label>
                                        <input type="text" required class="form-control" id="txtThemDiaChi" name="txtThemDiaChi">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtThemSoDienThoai" class="form-label">Số điện thoại</label>
                                        <input type="text" required class="form-control" id="txtThemSoDienThoai" name="txtThemSoDienThoai">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtThemTaiKhoan" class="form-label">Tài khoản</label>
                                        <input type="text" required class="form-control" id="txtThemTaiKhoan" name="txtThemTaiKhoan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtThemMatKhau" class="form-label">Mật khẩu</label>
                                        <input type="text" required class="form-control" id="txtThemMatKhau" name="txtThemMatKhau">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success form-control" name="btnThemNhanVien">Thêm nhân viên</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Xu ly PHP them nhan vien -->
                        <?php
                        if (isset($_POST["btnThemNhanVien"])) {
                            $themTenNhanVien = $_POST["txtThemTenNhanVien"];
                            $themChucVu = $_POST["txtThemChucVu"];
                            $themDiaChi = $_POST["txtThemDiaChi"];
                            $themSoDienThoai = $_POST["txtThemSoDienThoai"];
                            $themTaiKhoan = $_POST["txtThemTaiKhoan"];
                            $themMatKhau = $_POST["txtThemMatKhau"];
                            $sqlThemNhanVien = <<<EOT
                        INSERT INTO `quanlydathang`.`nhanvien` 
                        (`HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `TaiKhoan`, `MatKhau`) 
                        VALUES ('$themTenNhanVien' , '$themChucVu', '$themDiaChi','$themSoDienThoai', '$themTaiKhoan', '$themMatKhau');
EOT;
                            if ($conn->query($sqlThemNhanVien)) {
                                echo '<script type="text/javascript">alert("Thêm nhân viên thành công!")</script>';
                                echo "<script>location.replace('quan-ly-nhan-vien.php?action=trang-chu')</script>";
                            } else {
                                echo mysqli_error($conn);
                                echo '<script type="text/javascript">alert("Thêm nhân viên thất bại!")</script>';
                            }
                        }
                        ?>
                        <!-- End xu ly PHP them nhan vien -->
                        <!-- End them nhan vien -->
                    <?php endif ?>

                    <?php if ((!empty($_GET["action"])) && ($_GET["action"] == "sua-nhan-vien") && (!empty($_GET["id"]))) : ?>
                        <?php
                        $masonhanvien = $_GET["id"];
                        $sqlGetNhanVienById = "SELECT * FROM nhanvien WHERE MSNV = $masonhanvien";
                        $resultsqlGetNhanVienById = $conn->query($sqlGetNhanVienById);
                        $nhanvien = $resultsqlGetNhanVienById->fetch_assoc();
                        ?>
                        <!-- Sua hang hoa -->
                        <div id="suahanghoa" style="display: block;">
                            <div>
                                <h4 style="text-align: center;">SỬA NHÂN VIÊN</h4>
                            </div>
                            <div class="container">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input type="text" required class="form-control" id="txtSuaMaNhanVien" name="txtSuaMaNhanVien" value="<?= $nhanvien["MSNV"] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtSuaTenNhanVien" class="form-label">Tên nhân viên</label>
                                        <input type="text" required maxlength="79" value="<?= $nhanvien["HoTenNV"] ?>" class="form-control" id="txtSuaTenNhanVien" name="txtSuaTenNhanVien">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtSuaChucVu" class="form-label">Chức vụ</label>
                                        <input type="text" maxlength="79" value="<?= $nhanvien["ChucVu"] ?>" class="form-control" id="txtSuaChucVu" name="txtSuaChucVu">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtSuaDiaChi" class="form-label">Địa chỉ</label>
                                        <input type="text" required class="form-control" value="<?= $nhanvien["DiaChi"] ?>" id="txtSuaDiaChi" name="txtSuaDiaChi">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtSuaSoDienThoai" class="form-label">Số điện thoại</label>
                                        <input type="text" required class="form-control" value="<?= $nhanvien["SoDienThoai"] ?>" id="txtSuaSoDienThoai" name="txtSuaSoDienThoai">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtSuaTaiKhoan" class="form-label">Tài khoản</label>
                                        <input type="text" required class="form-control" value="<?= $nhanvien["TaiKhoan"] ?>" id="txtSuaTaiKhoan" name="txtSuaTaiKhoan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtSuaMatKhau" class="form-label">Mật khẩu</label>
                                        <input type="text" required class="form-control" value="<?= $nhanvien["MatKhau"] ?>" id="txtSuaMatKhau" name="txtSuaMatKhau">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success form-control" name="btnSuaNhanVien">Sửa nhân viên</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Xu ly PHP sua hang hoa -->
                        <?php
                        if (isset($_POST["btnSuaNhanVien"])) {
                            $suaMaNhanVien = $_POST["txtSuaMaNhanVien"];
                            $suaTenNhanVien = $_POST["txtSuaTenNhanVien"];
                            $suaChucVu = $_POST["txtSuaChucVu"];
                            $suaDiaChi = $_POST["txtSuaDiaChi"];
                            $suaSoDienThoai = $_POST["txtSuaSoDienThoai"];
                            $suaTaiKhoan = $_POST["txtSuaTaiKhoan"];
                            $suaMatKhau = $_POST["txtSuaMatKhau"];
                            $sqlSuaNhanVien = <<<EOT
                        UPDATE `quanlydathang`.`nhanvien` 
                        SET `HoTenNV` = '$suaTenNhanVien', 
                            `ChucVu` = '$suaChucVu', 
                            `DiaChi` = '$suaDiaChi', 
                            `SoDienThoai` = '$suaSoDienThoai', 
                            `TaiKhoan` = '$suaTaiKhoan', 
                            `MatKhau` = '$suaMatKhau' 
                        WHERE (`MSNV` = '$suaMaNhanVien');

EOT;
                            if ($conn->query($sqlSuaNhanVien)) {
                                echo '<script type="text/javascript">alert("Sửa nhân viên thành công!")</script>';
                                echo "<script>location.replace('quan-ly-nhan-vien.php?action=trang-chu')</script>";
                            } else {
                                echo '<script type="text/javascript">alert("Sửa nhân viên thất bại!")</script>';
                            }
                        }
                        ?>
                        <!-- End xu ly PHP sua hang hoa -->

                        <!-- End sua hang hoa -->
                    <?php endif ?>

                    <!-- Xu ly PHP xoa loai hang hoa -->
                    <?php
                    if (isset($_POST["btnXoaNhanVien"])) {
                        $xoaMaNhanVien = $_POST["txtXoaMaNhanVien"];
                        $sqlXoaNhanVien = <<<EOT
                        DELETE FROM `quanlydathang`.`nhanvien` 
                        WHERE (`MSNV` = '$xoaMaNhanVien');
EOT;
                        if ($conn->query($sqlXoaNhanVien)) {
                            echo '<script type="text/javascript">alert("Xóa nhân viên thành công!")</script>';
                            echo "<script>location.replace('quan-ly-nhan-vien.php?action=trang-chu')</script>";
                        } else {
                            echo '<script type="text/javascript">alert("Xóa nhân viên thất bại!")</script>';
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