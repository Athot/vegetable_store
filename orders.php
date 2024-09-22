<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css_page/style1.css">

   <style>
       table {
           width: 100%;
           border-collapse: collapse;
           margin-bottom: 20px;
       }
       table, th, td {
           border: 1px solid #ddd;
       }
       th, td {
           padding: 10px;
           text-align: left;
       }
       th {
           background-color: #f4f4f4;
       }
   </style>

</head>
<body>
   
<?php @include 'heading.php'; ?>

<section class="placed-orders">
    <!-- Completed Orders -->
    <h2>Completed Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Placed On</th>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Payment Method</th>
                <th>Your Orders</th>
                <th>Total Price</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $completed_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id' AND payment_status = 'completed'") or die('query failed');
            if(mysqli_num_rows($completed_orders) > 0){
                while($fetch_orders = mysqli_fetch_assoc($completed_orders)){
            ?>
            <tr>
                <td><?php echo $fetch_orders['placed_on']; ?></td>
                <td><?php echo $fetch_orders['name']; ?></td>
                <td><?php echo $fetch_orders['number']; ?></td>
                <td><?php echo $fetch_orders['email']; ?></td>
                <td><?php echo $fetch_orders['address']; ?></td>
                <td><?php echo $fetch_orders['method']; ?></td>
                <td><?php echo $fetch_orders['total_products']; ?></td>
                <td>₹<?php echo $fetch_orders['total_price']; ?>/-</td>
                <td style="color:green;"><?php echo $fetch_orders['payment_status']; ?></td>
            </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="9">No completed orders yet!</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <!-- Pending Orders -->
    <h2>Pending Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Placed On</th>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Payment Method</th>
                <th>Your Orders</th>
                <th>Total Price</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $pending_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id' AND payment_status = 'pending'") or die('query failed');
            if(mysqli_num_rows($pending_orders) > 0){
                while($fetch_orders = mysqli_fetch_assoc($pending_orders)){
            ?>
            <tr>
                <td><?php echo $fetch_orders['placed_on']; ?></td>
                <td><?php echo $fetch_orders['name']; ?></td>
                <td><?php echo $fetch_orders['number']; ?></td>
                <td><?php echo $fetch_orders['email']; ?></td>
                <td><?php echo $fetch_orders['address']; ?></td>
                <td><?php echo $fetch_orders['method']; ?></td>
                <td><?php echo $fetch_orders['total_products']; ?></td>
                <td>₹<?php echo $fetch_orders['total_price']; ?>/-</td>
                <td style="color:tomato;"><?php echo $fetch_orders['payment_status']; ?></td>
            </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="9">No pending orders yet!</td></tr>';
            }
            ?>
        </tbody>
    </table>

</section>

<?php @include 'footing.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
