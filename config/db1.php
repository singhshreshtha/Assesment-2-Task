<?php
//echo 'db file called'; 
$con = mysqli_connect("localhost","root","") or die("DB Server is down");
mysqli_select_db($con,"task") or die("DB not available");
?>