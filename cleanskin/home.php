<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="icon" type="image/png" sizes="32x32" href="images/logo-cleanskin.ico">
   
   
   <link rel="stylesheet" href="css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-1.jpg" alt="">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3>Moisturizer Terbaru</h3>
            <a href="shop.php" class="btn">Beli Sekarang</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-2.png" alt="">
         </div>
         <div class="content">
            <span>diskon hingga 50%</span>
            <h3>Serum terbaru</h3>
            <a href="shop.php" class="btn">Beli Sekarang</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-3.png" alt="">
         </div>
         <div class="content">
         <span>diskon hingga 50%</span>
            <h3>Cream Terbaru</h3>
            <a href="shop.php" class="btn">Beli Sekarang</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">berbelanja berdasarkan kategori</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="shop.php?shop=KulitNormal" class="swiper-slide slide">
      <img src="images/dry-skin2.png" alt="">
      <h3>Kulit Normal</h3>
   </a>

   <a href="shop.php?shop=KulitKering" class="swiper-slide slide">
      <img src="images/dry-skin.png" alt="">
      <h3>Kulit Kering</h3>
   </a>

   <a href="shop.php?shop=KulitBerminyak" class="swiper-slide slide">
      <img src="images/dry-skin3.png" alt="">
      <h3>Kulit Berminyak</h3>
   </a>

   <a href="shop.php?shop=KulitKombinasi" class="swiper-slide slide">
      <img src="images/dry-skin4.png" alt="">
      <h3>Kulit Kombinasi</h3>
   </a>

   <a href="shop.php?shop=KulitSensitif" class="swiper-slide slide">
      <img src="images/dry-skin5.png" alt="">
      <h3>Kulit Sensitif</h3>
   </a>
   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading">Produk Skincare</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
      <div class="price"><span>Rp</span><?= number_format($fetch_product['price'], 3, ',', '.'); ?>,-</div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Tambahkan Ke keranjang" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">belum ada produk yang ditambahkan!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>