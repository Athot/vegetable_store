<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_wishlist'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   
   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_wishlist_numbers) > 0){
       $message[] = 'already added to wishlist';
   }elseif(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{
       mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')")
       or die('query failed');
       $message[] = 'product added to wishlist';
   }

}

if(isset($_POST['add_to_cart'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{

       $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

       if(mysqli_num_rows($check_wishlist_numbers) > 0){
           mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
       }

       mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart';
   }

}

?>
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

    <title>Giftos</title>

    <!-- slider stylesheet -->
    <link
      rel="stylesheet"`
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css_page/bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="css_page/style1.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css_page/responsive.css" rel="stylesheet" />
  </head>

  <body>
    <?php include "heading.php"?>



      <!-- end header section -->
      <!-- slider section -->

      <section class="slider_section">
        <div class="slider_container">
          <div
            id="carouselExampleIndicators"
            class="carousel slide"
            data-ride="carousel"
          >
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-7">
                      <div class="detail-box">
                        <h1>
                          Welcome to our vegetable store 
                          
                          <div style="font-size : 5rem;"><?php echo $_SESSION['user_name'];?>
                          </div>
                          
                        </h1>
                        <p>"At our store, we ensure that every vegetable you buy is harvested fresh from local farms. Our commitment to organic farming guarantees that you're getting vegetables free from harmful chemicals, rich in nutrients, and packed with flavor. From crisp greens to hearty root vegetables, experience the true taste of nature with every purchase."</p>
                        <a href="contact.php"> Contact Us </a>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="img-box">
                        <img src="images/f3.png" alt="" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-7">
                      <div class="detail-box">
                        <h1>
                        Your one-stop shop for healthy, locally sourced vegetables
                        </h1>
                        <p>
                        "We take pride in being your trusted destination for fresh, locally sourced vegetables. By working directly with nearby farms, we ensure that every product on our shelves is of the highest quality and delivered fresh. Whether you're preparing a nutritious meal for your family or stocking up on daily essentials, our wide variety of seasonal vegetables is just what you need for a healthy lifestyle."
                        </p>
                        <a href=""> Contact Us </a>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="img-box">
                        <img src="images/f5.png" alt="" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-7">
                      <div class="detail-box">
                        <h1>
                        Eat fresh, live healthy explore a world of fresh vegetables at unbeatable prices.
                        </h1>
                        <p>
                        "At our vegetable store, we believe that healthy eating starts with fresh ingredients. That's why we offer an extensive range of vegetables at prices that won’t break the bank. Whether you're cooking up a storm or simply adding greens to your diet, our fresh produce ensures that you and your family can enjoy a nutritious, balanced meal every day, without compromising on quality or affordability."
                        </p>
                        <a href=""> Contact Us </a>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="img-box">
                        <img src="images/f6.png" alt="" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel_btn-box">
              <a
                class="carousel-control-prev"
                href="#carouselExampleIndicators"
                role="button"
                data-slide="prev"
              >
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
              </a>
              <img src="images1/line.png" alt="" />
              <a
                class="carousel-control-next"
                href="#carouselExampleIndicators"
                role="button"
                data-slide="next"
              >
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
      </section>

      <!-- end slider section -->
    </div>
    <!-- end hero area -->

    <!-- shop section -->

    <section class="shop_section layout_padding">
      <div class="container">
        <div class="heading_container heading_center">
          <h2>Latest Products</h2>
        </div>

        <div class="row">
          
        <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <!-- start the product column -->
      <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box">

      <form action="" method="POST">
      <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>">
     
      <div class="img-box">  
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt=""> 
         </div>
         </a>

         <div class="detail-boxs">
          <h6>₹<?php echo $fetch_products['price']; ?>/-</h6>
          <h6>Name - <?php echo $fetch_products['name']; ?></h6>
        </div>
     
         <!-- Optional buttons displayed in line-by-line format -->
        <div class="button-box">
          <input type="number" name="product_quantity" value="1" min="0" class="qty mb-2">
          <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
          <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
          <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
          <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
          <input type="submit" value="Add to Wishlist" name="add_to_wishlist" class="option-btn btn-block mb-2">
          <input type="submit" value="Add to Cart" name="add_to_cart" class="btn btn-block btn-primary">
        </div>
      </form>
      </div>
     
          
     </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>



   </div>

      
         
        <div class="btn-box">
          <a href="shop.php"> View All Products </a>
        </div>
      </div>
    </section>
   
      </div>
    </section>

    <!-- end shop section -->

    <!-- saving section -->

    <section class="saving_section">
      <div class="box mb-5">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="img-box">
                <img src="images1/veg_back.png" alt="" />
              </div>
            </div>
            <div class="col-lg-6">
              <div class="detail-box">
                <div class="heading_container">
                  <h2>
                   Go and Shop on your <br />
                    favourite veggies
                  </h2>
                </div>
                <p>
  Discover incredible deals on our latest fresh vegetable arrivals. From farm-to-table freshness to unbeatable prices, we bring you the best quality produce at savings you can’t resist. Shop now and stock up on your favorite veggies, handpicked just for you!
</p>
                <div class="btn-box">
                  <a href="shop.php" class="btn1"> Buy Now </a>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

   

    <!-- end gift section -->

    <!-- contact section -->

    <section class="contact_section">
      <div class="container px-0">
        <div class="heading_container">
          <h2 class="">Contact Us</h2>
        </div>
      </div>
      <div class="container container-bg">
        <div class="row">
          <div class="col-lg-7 col-md-6 px-0">
            <div class="map_container">
              <div class="map-responsive">
                <iframe
                  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Eiffel+Tower+Paris+France"
                  width="600"
                  height="300"
                  frameborder="0"
                  style="border: 0; width: 100%; height: 100%"
                  allowfullscreen
                ></iframe>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 px-0">
            <form action="#">
              <div>
                <input type="text" placeholder="Name" />
              </div>
              <div>
                <input type="email" placeholder="Email" />
              </div>
              <div>
                <input type="text" placeholder="Phone" />
              </div>
              <div>
                <input type="text" class="message-box" placeholder="Message" />
              </div>
              <div class="d-flex">
                <button>SEND</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- end contact section -->

    <!-- client section -->
    
    <!-- end client section -->

    <!-- info section -->

   
<?php @include 'footing.php'; ?>

<script src="js/script.js"></script>

    <!-- end info section -->
  </body>
</html>
