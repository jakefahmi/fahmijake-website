<?php

include 'config.php';

if(isset($_POST['submit'])){

   
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$new_pass'") or die('query failed');

   
      if($new_pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `users` SET password='$new_pass' WHERE email='$email'");
         $message[] = 'password changed successfully!';
         header('location:login.php');
      }
   }



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Forgot Password</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

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

   <form action="" method="post">
      <h3>Forgot Password</h3>
      
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="new_password" placeholder="enter your new password" required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
      
      <input type="submit" name="submit" value="submit" class="btn">
       <p><a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>