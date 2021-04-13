
 <!-- Header -->

 <nav class="navbar navbar-expand-lg shadow p-3 mb-3  rounded" style="background-color: #00483d;">
     <div class="container">
         <a class="navbar-brand" href="#" style="text-shadow: 1px 0px 2px rgb(0, 0, 0); font-weight: bold;color: rgb(251, 255, 2); font-style: italic;">Điện máy VÀNG</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <i class="fas fa-bars" style="background-color: white;"></i>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                 <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="#">Trang chủ</a>
                 </li>
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                         Sản phẩm
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                         <li><a class="dropdown-item" href="#">Action</a></li>
                         <li><a class="dropdown-item" href="#">Another action</a></li>
                         <li>
                             <hr class="dropdown-divider">
                         </li>
                         <li><a class="dropdown-item" href="#">Something else here</a></li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                 </li>
             </ul>
             <form class="d-flex" style="padding-right: 10px;">
                 <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                 <button class="btn " style="color: #00483d; background-color: white;border: 1px solid;" type="submit">Search</button>
             </form>

             <?php if (isset($_SESSION["taiKhoan"])) : ?>
                <span style="color: white;">Chào, <?=$_SESSION["tenKhachHang"]?></span>
             <?php endif; ?>

             <!-- <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Giỏ hàng</a> -->
         </div>
     </div>
 </nav>

 <!-- End header -->