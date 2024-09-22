<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

    if(mysqli_num_rows($select_message) > 0){
        $message[] = 'message sent already!';
    }else{
        mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
        $message[] = 'message sent successfully!';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link href="css_page/style1.css" rel="stylesheet" />

</head>
<body>
   
<?php @include 'heading.php'; ?>


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
            <form action="" method = "POST">
              <div>
                <input type="text" placeholder="Name" name = "name" required/>
              </div>
              <div>
                <input type="email" name="email" placeholder="Email" required/>
              </div>
              <div>
                <input type="text" name="number" placeholder="Phone" />
              </div>
              <div>
                <input type="text" class="message-box" placeholder="Message" name="message"/>
              </div>
              <div class="d-flex">
              <button type="submit" name="send" class="btn">Send Message </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

<?php @include 'footing.php'; ?>

<script src="js/script.js"></script>

</body>
</html>