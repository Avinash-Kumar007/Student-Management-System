<?php

define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DBNAME","phpapp");

$con = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DBNAME) or die("you are not connected");

// if($con)
// {
//     echo "you are connnected.";
// }
?>