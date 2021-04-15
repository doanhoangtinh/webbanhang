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
    <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script> -->

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
        <?php include 'header.php'; ?>
        <!-- End header -->

        <!-- Mo ket noi toi mysql -->
        <?php include '../dbconnection.php'; ?>
        <!-- End mo ket noi toi mysql -->

        <div class="container mt-3">
            <div class="row" style="height: 500px;">
                <!-- Sidebar -->
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
                <!-- End sidebar -->
                <div class="col-md-9 shadow p-3 mb-5 bg-body rounded">
                    <?php if ((!empty($_GET["action"])) && ($_GET["action"] == "trang-chu")) : ?>
                        <?php
                        $sqlGetAllHangHoa = "SELECT * FROM hanghoa";
                        $resultGetAllHangHoa = $conn->query($sqlGetAllHangHoa);
                        ?>
                        <!-- Trang chu hang hoa -->
                        <div>
                            <div>
                                <h4 style="text-align: center;">DANH SÁCH CÁC HÀNG HÓA</h4>
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
                                            <th scope="col">Mã hàng hóa</th>
                                            <th scope="col">Tên hàng hóa</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Số lượng hàng</th>
                                            <th scope="col">Mã loại hàng</th>
                                            <th scope="col">Ảnh sản phẩm</th>
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

                    <?php if ((!empty($_GET["action"])) && ($_GET["action"] == "them-hang-hoa")) : ?>
                        <!-- Them hang hoa -->
                        <div>
                            <div>
                                <h4 style="text-align: center;">THÊM HÀNG HÓA</h4>
                            </div>
                            <div class="mb-1 container">
                                <button class="btn" style="background-color: #fbff02; color: black;font-weight: bold;" onclick="xuLyHienThi('trangchuhanghoa','themhanghoa');">Quay lại</button>
                            </div>
                            <div class="container">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="txtThemTenHang" class="form-label">Tên hàng hóa</label>
                                        <input type="text" required maxlength="79" class="form-control" id="txtThemTenHang" name="txtThemTenHang">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtThemQuyCach" class="form-label">Quy cách</label>
                                        <input type="text" maxlength="79" class="form-control" id="txtThemQuyCach" name="txtThemQuyCach">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtThemGia" class="form-label">Giá</label>
                                        <input type="text" required class="form-control" id="txtThemGia" name="txtThemGia">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtThemSoLuong" class="form-label">Số lượng hàng</label>
                                        <input type="number" min="0" required class="form-control" id="txtThemSoLuong" name="txtThemSoLuong">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtThemGhiChu" class="form-label">Ghi chú</label>
                                        <textarea name="txtThemGhiChu" id="txtThemGhiChu" cols="30" rows="20">
                                    </textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtThemLoaiHang" class="form-label">Loại hàng</label>
                                        <select class="form-select" name="txtThemLoaiHang" aria-label="Default select example">
                                            <?php
                                            $sqlGetLoaiHangHoa = "SELECT * FROM loaihanghoa";
                                            $resultGetLoaiHangHoa = $conn->query($sqlGetLoaiHangHoa);
                                            ?>
                                            <?php foreach ($resultGetLoaiHangHoa as $item) : ?>
                                                <option value=<?= $item["MaLoaiHang"] ?>><?= $item["TenLoaiHang"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fileThemHinhAnh" class="form-label">Hình ảnh</label>
                                        <input type="file" required class="form-control" name="fileThemHinhAnh" id="fileThemHinhAnh" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success form-control" name="btnThemHangHoa">Thêm hàng hóa</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Xu ly PHP them hang hoa -->
                        <?php
                        if (isset($_POST["btnThemHangHoa"])) {
                            $target_dir = "../uploads/";
                            $target_file = $target_dir . basename($_FILES["fileThemHinhAnh"]["name"]);
                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                            $fileName = basename($_FILES["fileThemHinhAnh"]["name"]);
                            move_uploaded_file($_FILES["fileThemHinhAnh"]["tmp_name"], $target_file);

                            $themTenHang = $_POST["txtThemTenHang"];
                            $themQuyCach = $_POST["txtThemQuyCach"];
                            $themSoLuong = $_POST["txtThemSoLuong"];
                            $themGia = $_POST["txtThemGia"];
                            $themGhiChu = $_POST["txtThemGhiChu"];
                            $themLoaiHang = $_POST["txtThemLoaiHang"];
                            $sqlThemHangHoa = <<<EOT
                        "INSERT INTO `quanlydathang`.`hanghoa` 
                        (`TenHH`, `QuyCach`, `SoLuongHang`,`Gia`, `GhiChu`, `MaLoaiHang`, `AnhSanPham`) 
                        VALUES ('$txtThemTenHang' , '$themQuyCach', '$themSoLuong','$themGia', '$themGhiChu', '$themLoaiHang', '$fileName');
EOT;
                            if ($conn->query($sqlThemHangHoa)) {
                                echo '<script type="text/javascript">alert("Thêm hàng hóa thành công!")</script>';
                                echo "<script>location.replace('quan-ly-hang-hoa.php')</script>";
                            } else {
                                echo '<script type="text/javascript">alert("Thêm hàng hóa thất bại!")</script>';
                            }
                        }
                        ?>
                        <!-- End xu ly PHP them hang hoa -->
                        <!-- End them hang hoa -->
                    <?php endif ?>

                    <?php if ((!empty($_GET["action"])) && ($_GET["action"] == "sua-hang-hoa") && (!empty($_GET["id"]))) : ?>
                        <?php
                        $masohanghoa = $_GET["id"];
                        $sqlGetHangHoaById = "SELECT * FROM hanghoa WHERE MSHH = $masohanghoa";
                        $resultGetHangHoaById = $conn->query($sqlGetHangHoaById);
                        $hangHoa = $resultGetHangHoaById->fetch_assoc();
                        ?>
                        <!-- Sua hang hoa -->
                        <div id="suahanghoa" style="display: block;">
                            <div>
                                <h4 style="text-align: center;">SỬA HÀNG HÓA</h4>
                            </div>
                            <div class="container">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" id="txtMaHangHoa" name="txtSuaMaHangHoa" value="<?= $hangHoa["MSHH"] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtSuaTenHang" class="form-label">Tên hàng hóa</label>
                                        <input type="text" required class="form-control" id="txtSuaTenHang" name="txtSuaTenHang" value="<?= $hangHoa["TenHH"] ?>">
                                    </div>
                                    <div class=" mb-3">
                                        <label for="txtSuaQuyCach" class="form-label">Quy cách</label>
                                        <input type="text" class="form-control" id="txtSuaQuyCach" name="txtSuaQuyCach" value="<?= $hangHoa["QuyCach"] ?>">
                                    </div>
                                    <div class=" mb-3">
                                        <label for="txtSuaGia" class="form-label">Giá</label>
                                        <input type="text" required class="form-control" id="txtSuaGia" name="txtSuaGia" value="<?= $hangHoa["Gia"] ?>">
                                    </div>
                                    <div class=" mb-3">
                                        <label for="txtSuaSoLuong" class="form-label">Số lượng hàng</label>
                                        <input type="number" required min="0" class="form-control" id="txtSuaSoLuong" name="txtSuaSoLuong" value="<?= $hangHoa["SoLuongHang"] ?>">
                                    </div>
                                    <div class=" mb-3">
                                        <label for="txtSuaGhiChu" class="form-label">Ghi chú</label>
                                        <textarea name="txtSuaGhiChu" id="txtSuaGhiChu" cols="30" rows="20">
                                        <?= $hangHoa["GhiChu"] ?>
                                    </textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtSuaLoaiHang" class="form-label">Loại hàng</label>
                                        <select class="form-select" name="txtSuaLoaiHang" aria-label="Default select example">
                                            <?php
                                            $sqlGetLoaiHangHoa = "SELECT * FROM loaihanghoa";
                                            $resultGetLoaiHangHoa = $conn->query($sqlGetLoaiHangHoa);
                                            ?>
                                            <?php foreach ($resultGetLoaiHangHoa as $item) : ?>
                                                <option value="<?= $item["MaLoaiHang"] ?>"><?= $item["TenLoaiHang"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fileSuaHinhAnh" class="form-label">Hình ảnh</label>
                                        <input type="file" class="form-control" name="fileSuaHinhAnh" id="fileSuaHinhAnh" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success form-control" name="btnSuaHangHoa">Sửa hàng hóa</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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

        <script>
            CKEDITOR.replace('txtSuaGhiChu');
            CKEDITOR.replace('txtThemGhiChu');
        </script>


    <?php else : ?>
        <?php echo "<script>location.replace('dang-nhap.php')</script>"; ?>
    <?php endif; ?>


</body>

</html>
<?php
ob_flush();
?>