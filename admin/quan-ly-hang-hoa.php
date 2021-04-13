<?php
ob_start();
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

                <?php
                if (isset($_GET["suaSanPham"])) :
                ?>
                    <?php
                    $mshh = $_GET["suaSanPham"];
                    $sqlGetHangHoaTheoId = "SELECT * FROM hanghoa WHERE MSHH = $mshh";
                    $resultGetHangHoaTheoId = $conn->query($sqlGetHangHoaTheoId);
                    $hangHoa = $resultGetHangHoaTheoId->fetch_assoc();
                    ?>

                    <!-- Sua hang hoa -->
                    <div id="suahanghoa" style="display: block;">
                        <div>
                            <h4 style="text-align: center;">SỬA HÀNG HÓA</h4>
                        </div>
                        <div class="container">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="txtMaHangHoa" name="txtSuaMaHangHoa" value="<?= $hangHoa["MSHH"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="txtSuaTenHang" class="form-label">Tên hàng hóa</label>
                                    <input type="text" class="form-control" id="txtSuaTenHang" name="txtSuaTenHang" value="<?= $hangHoa["TenHH"] ?>">
                                </div>
                                <div class=" mb-3">
                                    <label for="txtSuaQuyCach" class="form-label">Quy cách</label>
                                    <input type="text" class="form-control" id="txtSuaQuyCach" name="txtSuaQuyCach" value="<?= $hangHoa["QuyCach"] ?>">
                                </div>
                                <div class=" mb-3">
                                    <label for="txtSuaGia" class="form-label">Giá</label>
                                    <input type="text" class="form-control" id="txtSuaGia" name="txtSuaGia" value="<?= $hangHoa["Gia"] ?>">
                                </div>
                                <div class=" mb-3">
                                    <label for="txtSuaSoLuong" class="form-label">Số lượng hàng</label>
                                    <input type="text" class="form-control" id="txtSuaSoLuong" name="txtSuaSoLuong" value="<?= $hangHoa["SoLuongHang"] ?>">
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
                                            <option value=$item[MaLoaiHang]><?= $item["TenLoaiHang"] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="fileSuaHinhAnh" class="form-label">Hình ảnh</label>
                                    <input type="file" class="form-control" name="fileSuaHinhAnh" id="fileSuaHinhAnh">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success form-control" name="btnSuaHangHoa">Sửa hàng hóa</button>
                                </div>
                            </form>


                        </div>
                    </div>
                    <!-- End sua hang hoa -->

                <?php else : ?>

                    <!-- Trang chu hang hoa -->
                    <div id="trangchuhanghoa" style="display: block;">
                        <div>
                            <h4 style="text-align: center;">DANH SÁCH CÁC HÀNG HÓA</h4>
                        </div>
                        <?php
                        $sqlGetHangHoa = "SELECT * FROM hanghoa";
                        $resultGetHangHoa = $conn->query($sqlGetHangHoa);
                        ?>
                        <div>
                            <button class="btn" style="background-color: #fbff02; color: black;font-weight: bold;" onclick="xuLyHienThi('themhanghoa','trangchuhanghoa');">Thêm hàng hóa</button>
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

                                    <?php foreach ($resultGetHangHoa as $item) : ?>
                                        <tr>
                                            <th scope='row'><?= $item["MSHH"] ?></th>
                                            <td><?= $item["TenHH"] ?></td>
                                            <td><?= $item["Gia"] ?></td>
                                            <td><?= $item["SoLuongHang"] ?></td>
                                            <td><?= $item["MaLoaiHang"] ?></td>
                                            <td><img src='../uploads/<?= $item["AnhSanPham"] ?>' style='width: 50px; height: 50px;'></td>

                                            <td>
                                                <a href="quan-ly-hang-hoa.php?suaSanPham=<?= $item['MSHH'] ?>" class="btn btn-warning">
                                                    <span data-feather="edit"></span> Sửa
                                                </a>

                                                <a href="delete.php?lsp_ma=<?= $loaisanpham['lsp_ma'] ?>" class="btn btn-danger">
                                                    <span data-feather="delete"></span> Xóa
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End trang chu hang hoa -->

                <?php endif ?>

                <!-- Them hang hoa -->
                <div id="themhanghoa" style="display: none;">
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
                                <input type="text" class="form-control" id="txtThemTenHang" name="txtThemTenHang">
                            </div>
                            <div class="mb-3">
                                <label for="txtThemQuyCach" class="form-label">Quy cách</label>
                                <input type="text" class="form-control" id="txtThemQuyCach" name="txtThemQuyCach">
                            </div>
                            <div class="mb-3">
                                <label for="txtThemGia" class="form-label">Giá</label>
                                <input type="text" class="form-control" id="txtThemGia" name="txtThemGia">
                            </div>
                            <div class="mb-3">
                                <label for="txtThemSoLuong" class="form-label">Số lượng hàng</label>
                                <input type="text" class="form-control" id="txtThemSoLuong" name="txtThemSoLuong">
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
                                <input type="file" class="form-control" name="fileThemHinhAnh" id="fileThemHinhAnh">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success form-control" name="btnThemHangHoa">Thêm hàng hóa</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End them hang hoa -->



            </div>
        </div>
    </div>

    <!-- Xử lý PHP -->
    <?php
    if (isset($_POST["btnThemHangHoa"])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["fileThemHinhAnh"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileThemHinhAnh"]["tmp_name"]);
        $fileName = basename($_FILES["fileThemHinhAnh"]["name"]);
        if ($check !== false) {
            move_uploaded_file($_FILES["fileThemHinhAnh"]["tmp_name"], $target_file);
        } else {
            echo '<script type="text/javascript">alert("Vui lòng chọn một hình ảnh")</script>';
        }

        $sql = "INSERT INTO `quanlydathang`.`hanghoa` (`TenHH`, `QuyCach`, `SoLuongHang`,`Gia`, `GhiChu`, `MaLoaiHang`, `AnhSanPham`) 
                    VALUES ('$_POST[txtThemTenHang]' , '$_POST[txtThemQuyCach]', '$_POST[txtThemSoLuong]','$_POST[txtThemGia]', '$_POST[txtThemGhiChu]', ' $_POST[txtThemLoaiHang]', '$fileName');
                    ";
        $conn->query($sql);
        echo '<script type="text/javascript">alert("Thêm hàng hóa thành công!")</script>';
        echo "<script>location.replace('quan-ly-hang-hoa.php')</script>";
    }
    ?>
    <!-- End xử lý PHP -->


    <script>
        CKEDITOR.replace('txtThemGhiChu');
        CKEDITOR.replace('txtSuaGhiChu');

        function xuLyHienThi(idHienThi, idBlock) {
            document.getElementById(idBlock).style.display = "none";
            document.getElementById(idHienThi).style.display = "block";
        }


        function suaSanPham(maHang, tenHang, quyCach, gia, soLuong, ghiChu) {
            //document.getElementById("txtSuaMaHangHoa").value = "Johnny Bravo";
            document.getElementById("txtSuaTenHang").value = "Johnny Bravo";
            document.getElementById("txtSuaQuyCach").value = "Johnny Bravo";
            document.getElementById("txtSuaGia").value = "Johnny Bravo";
            document.getElementById("txtSuaSoLuong").value = "Johnny Bravo";
            document.getElementById("txtSuaGhiChu").value = "adAAA";

            CKEDITOR.instances['txtSuaGhiChu'].setData();
        }
    </script>

</body>

</html>
<?php
ob_flush();
?>