<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

// Redirect to login if the user is not logged in
if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

// Delete a specific item from the cart
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
    exit();
}

// Delete all items from the cart for the logged-in user
if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
    exit();
}

// Update the quantity of an item in the cart
if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'Cart quantity updated!';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css_page/style1.css">
</head>
<body>
   
<?php @include 'heading.php'; ?>


<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Products Added</h2>
        </div>

        <div class="row">
        <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        
        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
        ?>
            <!-- Start the product column -->
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="box">
                    <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Delete this from cart?');"></a>
                    <a href="view_page.php?pid=<?php echo $fetch_cart['pid']; ?>">
                        <div class="img-box"> 
                            <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="" class="image">
                        </div>
                    </a>
                    
                    <div class="detail-boxs">
                        <h6>Name : <?php echo $fetch_cart['name']; ?></h6>
                        <h6>₹<?php echo $fetch_cart['price']; ?>/-</h6>
                    </div>
                    
                    <div class="button-box">
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
                            <input type="number" min="1" value="<?php echo $fetch_cart['quantity']; ?>" name="cart_quantity" class="qty mb-2" style="width: 100%;">

                            <input type="submit" value="Update" class="btn btn-block btn-primary mb-2" name="update_quantity">
                        </form>
                        <h6>Sub-total: <span>₹<?php echo $sub_total; ?>/-</span></h6>
                    </div>
                </div>
            </div>
        <?php
                $grand_total += $sub_total;
            }
        } else {
            echo '<p class="empty">Your cart is empty</p>';
        }
        ?>
        </div>

        <div class="cart-actions-container">
        <div class="more-btn">
        <div class="cart-total">
            <p>Grand Total: <span>₹<?php echo $grand_total; ?>/-</span></p>    
        </div>
        <div class="action-buttons">
        <a href="shop.php" class="option-btn">Continue Shopping</a>
        <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
    </div>

<div class="more-btn">
            <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('Delete all from cart?');">Delete All</a>
    </div>
        </div>


    

     
    </div>
    </div>
</section>

<?php @include 'footing.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
