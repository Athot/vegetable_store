<!DOCTYPE html>
<html>
  <head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images1/favicon.png" type="image/x-icon" />

    <title>Vegetable stores</title>

    <!-- slider stylesheet -->
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css_page/bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="css_page/heading2.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css_page/responsive.css" rel="stylesheet" />
  </head>

  <body>
    <!-- <div class="hero_area"> -->
      <!-- header section strats -->
      <header class="header_section">
        <nav>
         <div class="flex">
            <a href="home.php" class="logo">
                  <img src="./images1/logos.png" class="logo"/>
              </a>
              <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="home.php">
            <!-- <span> Giftos </span> -->
          </a>
   
            <!-- navbar button to show while displaying in smaller screen -->
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class=""></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="home.php"
                  >Home <span class="sr-only">(current)</span></a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php"> Contact </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shop.php"> Shop </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="orders.php">Order </a>
              </li>
            </ul>
      


            </div>


            
              <!-- user cards -->
            
              <?php
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed whistlist');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php" class="nav-link"><i class="fa fa-heart "></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>




            <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>

              <a href="cart.php" class="nav-link">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i><span>(<?php echo $cart_num_rows; ?>)</span>
              </a>
              <a href="search_item.php" class="nav-link"> 
                <i class="fa fa-search" aria-hidden="true"></i>
              </a>


              
            <div class="user_option">
              <a href="users_info.php" class="nav-link">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span><?php $_SESSION['user_name']?></span>
              </a>
          </div>
         
          <div>
          <a href="logout.php" class="delete-btn btn-danger" style="padding:10px; border-radius:5px">Logout</a>
          </div>
          </div>
        </nav>
      </div>
</nav>
      </header>
</body>
</html>
