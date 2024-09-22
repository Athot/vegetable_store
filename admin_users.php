<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users Account</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <!-- <link rel="stylesheet" href="css/admin_style.css"> -->

   <!-- custom styles for table -->
   <style>
      table {
         width: 100%;
         border-collapse: collapse;
         margin: 20px 0;
         font-size: 1rem;
         text-align: left;
      }
      
      table, th, td {
         border: 1px solid #ddd;
         padding: 8px;
      }

      th {
         background-color: #f2f2f2;
         color: #333;
         font-weight: bold;
      }

      tr:hover {
         background-color: #f1f1f1;
      }

      .delete-btn {
         padding: 5px 10px;
         color: white;
         background-color: #f44336;
         border-radius: 5px;
         border: none;
         text-decoration: none;
         cursor: pointer;
      }

      .delete-btn:hover {
         background-color: #e53935;
      }

      .title {
         font-size: 2rem;
         margin-bottom: 20px;
         text-align: center;
         color: #333;
      }

      .empty {
         text-align: center;
         font-size: 1.2rem;
         color: #888;
      }
   </style>
</head>
<body>
   
<?php @include 'admin_heading.php'; ?>

<section class="users">

   <h1 class="title">All Account</h1>

   <table>
      <thead>
         <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>

      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         if(mysqli_num_rows($select_users) > 0){
            while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
         <tr>
            <td><?php echo $fetch_users['id']; ?></td>
            <td><?php echo $fetch_users['name']; ?></td>
            <td><?php echo $fetch_users['email']; ?></td>
            <td><span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></span></td>
            <td>
               <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">Delete</a>
            </td>
         </tr>
      <?php
            }
         } else {
            echo '<tr><td colspan="5" class="empty">No users found!</td></tr>';
         }
      ?>

      </tbody>
   </table>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>
