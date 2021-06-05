<!-- Header -->

<nav class="navbar navbar-expand-lg shadow p-3 mb-3  rounded sticky-top" style="background-color: #00483d;">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="text-shadow: 1px 0px 2px rgb(0, 0, 0); font-weight: bold;color: rgb(251, 255, 2); font-style: italic;">CT428 - LTWeb</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars" style="background-color: white;"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <!-- Mo ket noi toi mysql -->
                    <?php include 'dbconnection.php'; ?>
                    <!-- End mo ket noi toi mysql -->

                    <?php
                    $sqlGetAllLoaiHangHoa = "SELECT * FROM loaihanghoa";
                    $resultGetAllLoaiHangHoa = $conn->query($sqlGetAllLoaiHangHoa);
                    ?>

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sản phẩm
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ($resultGetAllLoaiHangHoa as $item) : ?>
                            <li><a class="dropdown-item" href="danh-sach-hang-hoa.php?maloai=<?= $item["MaLoaiHang"] ?>"><?= $item["TenLoaiHang"] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <?php if (isset($_SESSION["mskh"])) : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="xem-lich-su-don-hang.php">Lịch sử đơn hàng</a>
                    </li>
                <?php endif; ?>

            </ul>
            <!-- <form class="d-flex" style="padding-right: 10px;">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn " style="color: #00483d; background-color: white;border: 1px solid;" type="submit">Search</button>
            </form> -->

            <?php if (isset($_SESSION["mskh"])) : ?>
                <div class="d-flex">
                    <form action="" method="post">
                        <button class="btn" style="color: white; text-decoration: none;">Chào, <?= $_SESSION["tenkhachhang"] ?></a>
                            <button class="btn" style="color: white; text-decoration: none;" name="btnDangXuat">Đăng xuất</a>
                    </form>
                </div>
            <?php else : ?>
                <div class="d-flex">
                    <form action="" method="post">
                        <a href="dang-nhap.php" class="btn" style="color: white; text-decoration: none;" name="btnDangXuat">Đăng nhập</a>
                    </form>
                </div>
            <?php endif; ?>
            <?php
            if (isset($_POST["btnDangXuat"])) {
                session_destroy();
                echo "<script>location.replace('dang-nhap.php')</script>";
            }
            ?>
        </div>
    </div>
</nav>

<!-- End header -->