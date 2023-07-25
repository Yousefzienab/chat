<?php
SESSION_START();

if(isset($_SESSION['user_name'])){
include '../db_connection.php';
$id= $_SESSION['user_id'];
$sql="UPDATE users SET lastseen = NOW() WHERE id= ?";
$stmt= $con -> prepare($sql);
$stmt->execute([$id]);

}else{
    header("Location: ../../index.php");
    exit;
}