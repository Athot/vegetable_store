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
   <!-- <link rel="stylesheet" href="css_page/style1.css"> -->
   <!-- <link rel="stylesheet" href="css_page/search.css"> -->

</head>
<body>
   
<?php @include 'admin_heading.php'; ?>

<section class="search-form">
  
   <div class="account-box">
      <table border="1" cellpadding="10" cellspacing="0">
         <tr>
            <th>Field</th>
            <th>Details</th>
         </tr>
         <tr>
            <td>Username</td>
            <td><?php echo $_SESSION['admin_name']; ?></td>
         </tr>
         <tr>
            <td>Email</td>
            <td><?php echo $_SESSION['admin_email']; ?></td>
         </tr>
     

        
      </table>
      
   </div>
</section>


<script src="js/script.js"></script>

</body>
</html>
