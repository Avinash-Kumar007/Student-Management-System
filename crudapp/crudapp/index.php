
<?php
include "config/config.php"
?>
<?php
if((isset($_POST['submit'])))

{
 $fullname = mysqli_real_escape_string($con,trim($_POST['fullname']));
 $username = mysqli_real_escape_string($con,trim($_POST['username']));
 $email = mysqli_real_escape_string($con,trim($_POST['email']));
$password = mysqli_real_escape_string($con,trim($_POST['password']));

$fullname_valid = $username_valid = $email_valid = $password_valid = false;


// check fullname 
if(!empty($fullname))
{
  if(strlen($fullname) >2 && strlen($fullname)<26)
   {
    if(!preg_match('/[^a-zA-Z\s]/', $fullname))
    {
      // test result 
$fullname_valid = true;
echo "fullname submited. <br>";
}
else {
  /* invalid char */ echo "fullname should contain alphabets only. <br>";
} }
else {
  /* invalid char length */ echo "fullname should contain 3 to 25 letters only. <br>";
} }
else {
  /* blank input box */ echo "fullname can not be blank. <br>";
}

// check username 
if(!empty($username))
{
  if(strlen($username) >2 && strlen($username)<16)
   {
    if(!preg_match('/[^a-zA-Z\d_.]/', $username))
    {

      $check_dublicate_username = "SELECT username FROM users WHERE username = '$username'";
      $result = mysqli_query($con, $check_dublicate_username);
      $count=mysqli_num_rows($result);
      if($count>0)
      {
        echo "username already available, try another<br>";
      }
      else{
        $username_valid = true;
        echo "username submited. <br>";
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
 
// check email 
if(!empty($email))
{
  if(filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   
    // test result 
    $email_valid = true;
    echo "Email submited. <br>";
} else {
 /* invalid email */ echo $email." is an invalid email. <br>";
} }
else {
  /* blank input */ echo "Email can not be blanK. <br>";
} 

// check password 
if(!empty($password))
{
  if(strlen($password)>=6 && strlen($password)<=16)
  {
    $password_valid = true;
    $password = md5($password);
    echo "password is submited <br>";
  }
else{ /* invalid length*/ echo "password length must be 7 to 15 characters. <br>";
}
}
else {
  /* blank input */ echo "password can not be blanK. <br>";
} 
if($fullname_valid && $username_valid && $email_valid && $password_valid) {

 $query ="INSERT INTO users(fullname,username,email,password) VALUES('$fullname','$username', '$email','$password')";

$fire = mysqli_query($con, $query);
if($fire) echo "data submitted to Database <br>";
header("Location:index.php");
} }
?>


<?php
if(isset($_GET['del']))
{
$id = $_GET['del'];
  $query ="DELETE FROM users WHERE id = $id";
  $fire = mysqli_query($con,$query);
if($fire) echo "data deleted from database";
header("Location:index.php");

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
    <!-- <?php
echo "this is TechnoVibes";

    ?> -->

<div class="container">
  <div class="row">
    <div class="col-lg-4"><h3>sign in</h3>
    <form name="signup" id="signup" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
  
  <div class="form-group">
<label for="fullname">Full name:</label>
<input name="fullname" id="fullname" type="text" class="form-control" placeholder="fullname" required >
</div>

<div class="form-group">
<label for="username">Username:</label>
<input name="username" id="username" type="text" class="form-control" placeholder="username"  required  >
</div>

<div class="form-group">
<label for="email">Email:</label>
<input name="email" id="email" type="email" class="form-control" placeholder="email"    >
</div>

<div class="form-group">
<label for="password">Password:</label>
<input name="password" id="password" type="password" class="form-control" placeholder="password"  required  >
</div>

<div class="form-group">
<button name="submit" id="submit"  class="btn btn-primary btn-block">Sign Up</button> 
</div>
</form>
  </div>


   <div class="col-8"><h3>Users detail</h3>
   <table class="table table-striped">
  <thead>
    <tr>
      
      <th>fullname</th>
      <th>username</th>
      <th>email</th>
      
    </tr>
  </thead>
  <tbody>

  <?php 

 $query = "SELECT * FROM users";
 $fire = mysqli_query($con,$query);

 if(mysqli_num_rows($fire)>0)
 {
   while($user=mysqli_fetch_assoc($fire))
   {?>

   
   
   <tr>
      <td><?php echo $user['fullname']?></td>
      <td><?php echo $user['username']?></td>
      <td><?php echo $user['email']?></td>
      <td>
       <a class="btn btn-sm btn-danger" href="<?php $_SERVER['PHP_SELF'] ?> ? del=<?php echo $user['id']?>"> delete</a></td>
     <td><a class="btn btn-sm btn-warning" href="update.php?upd=<?php echo $user['id'] ?>">update</a></td>
    </tr>
    <?php 
  } 
 }
 else { ?>
 <tr><td colspan="3" class="text-center">
   <h2>data Unavailable !!</h2>
 </td></tr>
 <?php } ?>
  </tbody>
</table>
  </div>
       </div>
    </div>
</body>
</html>