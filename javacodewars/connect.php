<?php
$servername ="localhost";
$username = "root";
$password = "";
$dbname = "javacodewars";

/*$servername ="sql201.epizy.com";
$username = "epiz_25917862";
$password = "z72aOyF8jmqhSbI";
$dbname = "epiz_25917862_javacodewars";*/

$dbcon = new mysqli($servername,$username,$password,$dbname);
if($dbcon->connect_error)
{
	die("Connection failed:" .$conn->connect_error);
}
mysqli_set_charset($dbcon,'utf8') ;

//echo "Connected successfully";
 ?>
