<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

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
   
<?php @include 'admin_heading.php'; ?>

<section class="shop_section layout_padding">

<div class="heading_container heading_center">
            <h2>Admin Dashboard</h2>
        </div>

   <div class="table-container">
      <table class="dashboard-table">
         <thead>
            <tr>
               <th>Total Pendings</th>
               <th>Completed Payments</th>
               <th>Orders Placed</th>
               <th>Done Selling</th>
               <th>Normal Users</th>
               <th>Admin Users</th>
               <th>Total Accounts</th>
               <th>New Messages</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  <?php
                     $total_pendings = 0;
                     $select_pendings = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
                     while($fetch_pendings = mysqli_fetch_assoc($select_pendings)){
                        $total_pendings += $fetch_pendings['total_price'];
                     };
                     echo '₹'.$total_pendings.'/-';
                  ?>
               </td>
               <td>
                  <?php
                     $total_completes = 0;
                     $select_completes = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
                     while($fetch_completes = mysqli_fetch_assoc($select_completes)){
                        $total_completes += $fetch_completes['total_price'];
                     };
                     echo '₹'.$total_completes.'/-';
                  ?>
               </td>
               <td>
                  <?php
                     $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                     $number_of_orders = mysqli_num_rows($select_orders);
                     echo $number_of_orders;
                  ?>
               </td>
               <td>
                  <?php
                     $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                     $number_of_products = mysqli_num_rows($select_products);
                     echo $number_of_products;
                  ?>
               </td>
               <td>
                  <?php
                     $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                     $number_of_users = mysqli_num_rows($select_users);
                     echo $number_of_users;
                  ?>
               </td>
               <td>
                  <?php
                     $select_admin = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                     $number_of_admin = mysqli_num_rows($select_admin);
                     echo $number_of_admin;
                  ?>
               </td>
               <td>
                  <?php
                     $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                     $number_of_account = mysqli_num_rows($select_account);
                     echo $number_of_account;
                  ?>
               </td>
               <td>
                  <?php
                     $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                     $number_of_messages = mysqli_num_rows($select_messages);
                     echo $number_of_messages;
                  ?>
               </td>
            </tr>
         </tbody>
      </table>
   </div>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>
