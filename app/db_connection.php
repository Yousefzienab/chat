<?php
$server="localhost";
$username="root";
$password="";
$db_name="chat_db";
$con=new mysqli($server,$username,$password,$db_name);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>