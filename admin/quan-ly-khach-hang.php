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
                    <li><a href="kiem-duyet-don-hang.php?action=trang-chu">Kiểm duyệt đơn hàng</a></li>
                            <li><a href="quan-ly-nhan-vien.php?action=trang-chu">Quản lý nhân viên</a></li>
                            <li><a href="quan-ly-hang-hoa.php?action=trang-chu">Quản lý hàng hóa</a></li>
                            <li><a href="quan-ly-loai-hang-hoa.php?action=trang-chu">Quản lý loại hàng hóa</a></li>
                            <li><a href="quan-ly-khach-hang.php?action=trang-chu">Quản lý khách hàng</a></li>
                            <li><a href="quan-ly-dia-chi.php?action=trang-chu">Quản lý địa chỉ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 shadow p-3 mb-5 bg-body rounded">

            </div>
        </div>
    </div>

</body>

</html>