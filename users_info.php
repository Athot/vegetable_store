<?php

@include 'config.php';

session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search Page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css_page/style1.css">
   <link rel="stylesheet" href="css_page/search.css">

</head>
<body>
   
<?php @include 'heading.php'; ?>

<section class="search-form">
  
   <div class="account-box">
      <table border="1" cellpadding="10" cellspacing="0">
         <tr>
            <th>Field</th>
            <th>Details</th>
         </tr>
         <tr>
            <td>Username</td>
            <td><?php echo $_SESSION['user_name']; ?></td>
         </tr>
         <tr>
            <td>Email</td>
            <td><?php echo $_SESSION['user_email']; ?></td>
         </tr>
         <tr>
            <td>User Type</td>
            <td><?php echo  $_SESSION['user_type']; ?></td>
         </tr>

        
      </table>
      <br>
      <a href="logout.php" class="delete-btn btn-danger" style="padding:10px; border-radius:5px">Logout</a>
   </div>
</section>

<?php @include 'footing.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
