<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ Admin</title>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">

    <style>
        a {
            color: white;
        }

        li a:hover {
            color: white;
        }
    </style>
</head>

<body>

    <?php if (isset($_SESSION["mskh"])) : ?>
        <!-- Header -->
        <?php include 'header.php' ?>
        <!-- End header -->
        <div class="container">
            <?php
            $mskh = $_SESSION["mskh"];
            $sqlGetDatHangByMSKH = <<<EOT
            SELECT * FROM chitietdathang as a, dathang as b, hanghoa as c 
            WHERE a.SoDonDH = b.SoDonDH
            AND a.MSHH = c.MSHH
            AND b.MSKH = '$mskh';
EOT;
            $resultsqlGetDatHangByMSKH = $conn->query($sqlGetDatHangByMSKH);
            // $thongtin = $resultsqlGetDatHangByMSKH->fetch_assoc();
            ?>
            <h4 style="text-align: center;">LỊCH SỬ ĐƠN HÀNG</h4>
            <div class="table-responsive">
            <table class="table ta">
                <thead>
                    <tr>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Hàng hóa</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                        <th scope="col">Ngày đặt hàng</th>
                        <th scope="col">Ngày giao hàng dự kiến</th>
                        <th scope="col">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultsqlGetDatHangByMSKH as $item) : ?>
                        <tr>
                            <th scope='row'><?= $item["SoDonDH"] ?></th>
                            <td><?= $item["TenHH"] ?></td>
                            <td><?= $item["SoLuong"] ?></td>
                            <td><?= number_format($item["GiaDatHang"]) ?></td>
                            <td><?= $item["NgayDH"] ?></td>
                            <td><?= $item["NgayGH"] ?></td>
                            <?php if ($item["TrangThai"] == "Chờ xét duyệt") : ?>
                                <td style="width: 150px;"><div style="text-align: center;background-color: red;padding: 7px;color: white;" class="rounded"><?= $item["TrangThai"] ?></div></td>
                            <?php else : ?>
                                <td  style="width: 150px;"><div style="text-align: center;background-color: green;padding: 7px;color: white;" class="rounded"><?= $item["TrangThai"] ?></div></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    <?php else : ?>
        <?php echo "<script>location.replace('dang-nhap.php')</script>"; ?>
    <?php endif; ?>

</body>

</html>