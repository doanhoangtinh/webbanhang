<nav class="navbar rounded sticky-top" style="background-color: #00483d;">
    <div class="container">
        <a class="navbar-brand" href="#" style="text-shadow: 1px 0px 2px rgb(0, 0, 0); font-weight: bold;color: rgb(251, 255, 2); font-style: italic;">Điện máy VÀNG</a>
        <?php if (isset($_SESSION["msnv"])) : ?>
            <div class="d-flex">
                <form action="" method="post">
                    <button class="btn" style="color: white; text-decoration: none;">Chào, <?= $_SESSION["tennhanvien"] ?></a>
                        <button class="btn" style="color: white; text-decoration: none;" name="btnDangXuat">Đăng xuất</a>
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
</nav>