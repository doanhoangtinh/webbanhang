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
    <nav class="navbar rounded sticky-top" style="background-color: #00483d;">
        <div class="container">
            <a class="navbar-brand" href="#" style="text-shadow: 1px 0px 2px rgb(0, 0, 0); font-weight: bold;color: rgb(251, 255, 2); font-style: italic;">Điện máy VÀNG</a>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn bg-light" type="submit">Search</button>
            </form>
        </div>

    </nav>
    <!-- End header -->

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
                <!-- Trang chu loai hang hoa -->
                <div id="trangchuhanghoa" style="display: block;">
                    <div>
                        <h4 style="text-align: center;">DANH SÁCH CÁC LOẠI HÀNG HÓA</h4>
                    </div>

                    <?php
                    $sql = "SELECT * FROM loaihanghoa";
                    $result = $conn->query($sql);
                    ?>


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
                                <?php foreach ($result as $item) : ?>
                                    <tr>
                                        <td><?= $item["MaLoaiHang"] ?></td>
                                        <td><?= $item['TenLoaiHang'] ?></td>
                                        <td>
                                            <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `lsp_ma` -->
                                            <a href="edit.php?lsp_ma=<?= $loaisanpham['lsp_ma'] ?>" class="btn btn-warning">
                                                <span data-feather="edit"></span> Sửa
                                            </a>

                                            <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `lsp_ma` -->
                                            <a href="delete.php?lsp_ma=<?= $loaisanpham['lsp_ma'] ?>" class="btn btn-danger">
                                                <span data-feather="delete"></span> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <div>
                        <button class="btn" style="background-color: #fbff02; color: black;font-weight: bold;" onclick="xuLyHienThi('themhanghoa','trangchuhanghoa');">Thêm loại hàng hóa</button>
                    </div>

                    <div class="container">

                    </div>
                </div>
                <!-- End trang chu hang hoa -->

                <!-- Them loai hang hoa -->
                <div id="themhanghoa" style="display: none;">
                    <div>
                        <h4 style="text-align: center;">THÊM LOẠI HÀNG HÓA</h4>
                    </div>

                    <div class="mb-1 container">
                        <button class="btn" style="background-color: #fbff02; color: black;font-weight: bold;" onclick="xuLyHienThi('trangchuhanghoa','themhanghoa');">Quay lại</button>
                    </div>

                    <div class="container">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="txtThemTenLoaiHang" class="form-label">Tên loại hàng hóa</label>
                                <input type="text" class="form-control" id="txtThemTenLoaiHang" name="txtThemTenLoaiHang">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success form-control" name="btnThemLoaiHangHoa">Thêm loại hàng hóa</button>
                            </div>
                        </form>
                    </div>
                </div>


                <?php
                if (isset($_POST["btnThemLoaiHangHoa"])) {
                    $sql = "INSERT INTO `quanlydathang`.`loaihanghoa` (`TenLoaiHang`) 
                    VALUES ('$_POST[txtThemTenLoaiHang]');
                    ";
                    $conn->query($sql);

                    echo '<script type="text/javascript">alert("Thêm loại hàng hóa thành công!")</script>';
                    echo "<script>location.replace('quan-ly-loai-hang-hoa.php')</script>";
                }
                ?>

                <!-- End them hang hoa -->

                <!-- Sua hang hoa -->
                <div id="suahanghoa" style="display: none;">
                    <div>
                        <h4 style="text-align: center;">SỬA HÀNG HÓA</h4>
                    </div>
                    <div class="container">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Tên hàng hóa</label>
                            <input type="text" class="form-control" placeholder="Example input placeholder">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Quy cách</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Giá</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Số lượng hàng</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Ghi chú</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Loại hàng</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-success form-control">Thêm hàng hóa</button>
                        </div>
                    </div>
                </div>
                <!-- End sua hang hoa -->

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
<?php
ob_flush();
?>