<?php
include 'config.php';

if(isset($_POST['submit'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
   $user_type = $_POST['user_type'];

   if($pass != $cpass){
      $message[] = 'confirm password not matched';
   } else {
      // Hash the password using a secure algorithm
      $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
      
      // Check the length of the hashed password
      $password_length = strlen($hashed_password);
      if($password_length > 255){ // Adjust the value based on your column's maximum length
         $message[] = 'Password is too long';
      } else {
         $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die(mysqli_error($conn));
         if(mysqli_num_rows($select_users) > 0){
            $message[] = 'User already exists!';
         } else {
            $insert_query = "INSERT INTO `users` (name, email, password, user_type) VALUES ('$name', '$email', '$hashed_password', '$user_type')";
            $result = mysqli_query($conn, $insert_query) or die(mysqli_error($conn));
            if($result){
               $message[] = 'Registered successfully!';
               header('location:login.php');
               exit();
            } else {
               $message[] = 'Registration failed. Please try again later.';
            }
         }
      }
   }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">

</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="POST">
      <h3>register now</h3>
      <input type="text" name="name" placeholder="enter your name" required class="box">
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
      
      <select name="user_type" class="box">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>
