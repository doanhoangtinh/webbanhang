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
            
        </div>
    <?php else : ?>
        <?php echo "<script>location.replace('dang-nhap.php')</script>"; ?>
    <?php endif; ?>

</body>

</html>