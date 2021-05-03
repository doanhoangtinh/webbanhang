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
        <?php if ($_SESSION["chucvu"] == "QTV") : ?>
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
                        <h4 style="text-align: center;">DANH SÁCH THÔNG TIN CÁC KHÁCH HÀNG</h4>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-warning alert-dismissible " role="alert" style="text-align: center;">
            <strong>Tài khoản của bạn bị giới hạn quyền truy cập!</strong> <span> chức năng này chỉ dùng cho Quản Trị Viên!</span>
                <a href="kiem-duyet-don-hang.php?action=trang-chu" class="btn-close"  aria-label="Close"></a>
            </div>
        <?php endif ?>
    <?php else : ?>
        <?php echo "<script>location.replace('dang-nhap.php')</script>"; ?>
    <?php endif; ?>

</body>

</html>