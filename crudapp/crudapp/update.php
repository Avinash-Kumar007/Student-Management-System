
<?php
include "config/config.php"
?>

<?php
if(isset($_GET['upd']))
{
$id = $_GET['upd'];
$query = "SELECT * from users WHERE id=$id";
$fire = mysqli_query($con,$query);
$user = mysqli_fetch_assoc($fire);
// echo $user['fullname'];
}
?>

<!-- update  -->
<?php

if(isset($_POST['update']))

{
$fullname = $_POST['fullname'];
$username = mysqli_real_escape_string($con,trim($_POST['username']));
$email = $_POST['email'];
$password = md5($_POST['password']);


$fullname_valid = $username_valid = $email_valid = $password_valid = false;


// check username 
if(!empty($username))
{
  if(strlen($username) >2 && strlen($username)<16)
   {
    if(!preg_match('/[^a-zA-Z\d_.]/', $username))
    {
$check_dublicate_username= "SELECT username FROM users WHERE username = '$username'";
      $result = mysqli_query($con,$check_dublicate_username );
      $cout = mysqli_num_rows($result);
      if($cout>0)
      {
        echo "username already available !! PLEASE TRY ANOTHER <br>";
      }
      else
      {
        $username_valid = true;
        echo "";
      }
      // test result 

     
}
else {
  /* invalid char */ echo "username should contain alphabets only. <br>";
} }
else {
  /* invalid char length */ echo "username should contain 3 to 15 letters only. <br>";
} }
else {
  /* blank input box */ echo "username can not be blank. <br>";
}
 
$query= "UPDATE users SET fullname= '$fullname', username='$username', email='$email', password='$password' WHERE id=$id";
$fire = mysqli_query($con, $query);

if($fire)
echo "DATA UPDATED SUCCESSFULLY !! <br> click on main menu to visit main page";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
   
<div class="container">
  <div class="row">
    <div class="col-lg-12">
    <div class="col-lg-4"><h3>update user detail</h3>
    <form name="signup" id="signup" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
  
  <div class="form-group">
<label for="fullname">Full name:</label>
<input value= "<?php echo $user['fullname']?>" name="fullname" id="fullname" type="text" class="form-control" placeholder="fullname" >
</div>

<div class="form-group">
<label for="username">Username:</label>
<input   value= "<?php echo $user['username']?>"  name="username" id="username" type="text" class="form-control" placeholder="username" >
</div>

<div class="form-group">
<label for="email">Email:</label>
<input  value= "<?php echo $user['email']?>"  name="email" id="email" type="email" class="form-control" placeholder="email" >
</div>

<div class="form-group">
<label for="password">Password:</label>
<input name="password" id="password" type="password" class="form-control" placeholder="Enter new password" >
</div>

<div class="form-group">
<button name="update" id="update"  class="btn btn-primary btn-block">update</button> 
</div>
<div class="form-group">
<button formaction="index.php"  class="btn btn-primary btn-block">main menu</button>
</div>
</form>
  </div>
  </div>
       </div>
    </div>
</body>
</html>