<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style>
        a {
            color: white;
        }


        .div1 {
            background: red;
        }

        .div2 {
            background: yellow;
        }

        .div3 {
            background: green;
        }
    </style>
</head>

<body>


    <!-- Header -->
    <?php include 'header.php' ?>
    <!-- End header -->

    <!-- Mo ket noi toi mysql -->
    <?php include 'dbconnection.php'; ?>
    <!-- End mo ket noi toi mysql -->

    <div class="container">

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6" aria-label="Slide 7"></button>

            </div>
            <div class="carousel-inner " style=" border-radius: 20px">
                <div class="carousel-item active">
                    <img src="images/tl_hinh4.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/mg_hinh3.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/tl_hinh2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/mg_hinh1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/tl_hinh1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/mg_hinh2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/tl_hinh3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>

    <div class="container mt-3 mb-5" style="width: 100%;">
        <div class="row">
            <?php
            if (isset($_GET["maloai"])) {
                $maloai = $_GET["maloai"];
                $sqlGetAllHangHoaByLoai = "SELECT * FROM hanghoa WHERE MaLoaiHang = '$maloai'";
                $resultGetAllHangHoaByLoai = $conn->query($sqlGetAllHangHoaByLoai);
            }
            ?>
            <?php foreach ($resultGetAllHangHoaByLoai as $item) : ?>
                <div class="col-md-3 mb-3">
                    <div class="card" style="width: 18rem; height: 25rem;">
                        <div style="height: 200px;">
                            <img src="uploads/<?= $item["AnhSanPham"] ?>" class="img-fluid" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" style="color: red;"><?= number_format($item["Gia"], 2) ?> <u>đ</u></h5>
                            <div style="height: 80px;">
                                <h6 class="card-title"><?= $item["TenHH"] ?></h6>
                            </div>
                            <a href="chi-tiet-san-pham.php?id=<?= $item["MSHH"] ?>" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>