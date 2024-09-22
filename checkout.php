<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
// Debugging session value
echo 'User ID: ' . $user_id . '<br>';

if(!isset($user_id)){
   header('location:login.php');
   exit;
}

// Debugging POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo 'Form submitted!<br>';
    var_dump($_POST); // Output POST data for debugging
}

if (isset($_POST['order'])) {
    echo "ccoco"; // This should print if the form is submitted and 'order' is set
    echo "Hello world";

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
    $placed_on = date('Y-m-d');

    $cart_total = 0;
    $cart_products = []; // Initializing as an empty array

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);
    $payment_status = 'pending'; // Set a default payment status

    // Query to check if an identical order already exists
    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed select * from orders');

    if ($cart_total == 0) {
        $message[] = 'your cart is empty!';
    } elseif (mysqli_num_rows($order_query) > 0) {
        $message[] = 'order placed already!';
    } else {
        // Insert new order with all required fields, including payment_status
        $insert_query = "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on, payment_status) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on', '$payment_status')";
        
        if (mysqli_query($conn, $insert_query)) {
            $message[] = 'order placed successfully!';
            
            // Clear the cart after placing the order
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed cart');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }

    // Update product quantities after order is placed
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        $product_query = "SELECT quantity FROM products WHERE id='$product_id'";
        $product_query_run = mysqli_query($conn, $product_query);
        $productData = mysqli_fetch_array($product_query_run);
        $currentQty = $productData['quantity'];

        // Assuming you subtract 1 unit per item
        $new_qty = $currentQty - 1;

        $updateQty_query = "UPDATE products SET quantity='$new_qty' WHERE id='$product_id'";
        mysqli_query($conn, $updateQty_query) or die('Failed to update product quantity');
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css_page/style1.css">
   <link rel="stylesheet" href="css_page/checkout.css">


</head>
<body>
   
<?php @include 'heading.php'; ?>

<div class="heading_container heading_center">
            <h2>Order your Item</h2>
        </div>
<section class="display-order">
    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
    ?>    
    
    <?php
        }
        }else{
            echo '<p class="empty">your cart is empty</p>';
        }
    ?>
    <div class="grand-total">grand total : <span>₹<?php echo $grand_total; ?>/-</span></div>
</section>

<section class="checkout">
    <form action="" method="POST">

        <h3>place your order</h3>

        <div class="flex2">
            <div class="inputBox">
                <span>your name :</span>
                <input type="text" name="name" placeholder="enter your name" required>
            </div>
            <div class="inputBox">
                <span>your number :</span>
                <input type="number" name="number" min="0" placeholder="enter your number" required>
            </div>
            <div class="inputBox">
                <span>your email :</span>
                <input type="email" name="email" placeholder="enter your email" required>
            </div>
            <div class="inputBox">
                <span>payment method :</span>
                <select name="method" required>
                    <option value="cash on delivery">Cash on Delivery</option>
                    <option value="credit card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="paytm">Paytm</option>
                </select>
            </div>
            <div class="inputBox">
                <span>address1 :</span>
                <input type="text" name="flat" placeholder="e.g. flat no." required>
            </div>
            <div class="inputBox">
                <span>address2 :</span>
                <input type="text" name="street" placeholder="e.g.  street name" required>
            </div>
            <div class="inputBox">
                <span>city :</span>
                <input type="text" name="city" placeholder="e.g. Laitumkhrah" required>
            </div>
            <div class="inputBox">
                <span>state :</span>
                <input type="text" name="state" placeholder="e.g. Meghalaya" required>
            </div>
            <div class="inputBox">
                <span>country :</span>
                <input type="text" name="country" placeholder="e.g. India" required>
            </div>
            <div class="inputBox">
                <span>pin code :</span>
                <input type="number" min="0" name="pin_code" placeholder="e.g. 793003" required>
            </div>
        </div>

        <!-- Credit card info (Hidden by default) -->
        <div id="credit-card-info" class="credit-card-info">
            <div class="inputBox">
                <span>Card Number:</span>
                <input type="text" name="card_number" placeholder="Enter card number">
            </div>
            <div class="inputBox">
                <span>Expiry Date:</span>
                <input type="text" name="expiry_date" placeholder="MM/YY">
            </div>
            <div class="inputBox">
                <span>CVV:</span>
                <input type="text" name="cvv" placeholder="Enter CVV">
            </div>
        </div>

        <!-- PayPal info (Hidden by default) -->
        <div id="paypal-info" class="paypal-info">
            <div class="inputBox">
                <span>PayPal Email:</span>
                <input type="email" name="paypal_email" placeholder="Enter PayPal email">
            </div>
        </div>

        <input type="submit" name="order" value="order now" class="btn">

    </form>
</section>


<?php @include 'footing.php'; ?>

<script src="js/script.js"></script>

</body>
</html>