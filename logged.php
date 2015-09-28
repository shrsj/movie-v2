<?php

$servername = "localhost";				
$username = "root";                     //  Login user id 
$password = "";                         //   Login password
$dbname = "movies";                   // Your database name

session_start();
$message=" Welcome!!!";
if(count($_POST)>0) {
$conn = mysql_connect($servername,$username,$password );
mysql_select_db($dbname,$conn);
$result = mysql_query("SELECT * FROM userlogin WHERE email='" . $_POST["email"] . "' and pass = '". $_POST["pass"]."'");
$row  = mysql_fetch_array($result);
if(is_array($row)) {
$_SESSION["user_id"] = $row[userid];
$_SESSION["user_name"] = $row[fname];
} else {
$message = "Invalid Username or Password!";
}
}
if(isset($_SESSION["user_id"])) {
header("Location: http://movies.sj/V2.0/logd.php");
}
?>