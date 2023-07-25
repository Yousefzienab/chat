<?php
session_start();
if(isset($_POST['user_name']) & isset($_POST['pass'])){
    
    $user_name = $_POST['user_name'];
    $pass = $_POST['pass'];
    $data = '&user_name'.$user_name;
    include("../db_connection.php");
    if(empty($user_name)){
        $em = "User name is required";
        header("Location:../../index.php?error=$em&$data");
        exit;
    } else if(empty($pass)){
        $em = "Password is required";
        header("Location:../../index.php?error=$em&$data");
        exit;
    } else {
        $sql = "SELECT * FROM users WHERE user_name=? ";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $user_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->num_rows;
        if($count == 1){
            $user = $result->fetch_assoc();
            if($user['user_name'] === $user_name){
                if(password_verify($pass, $user['password'])){
                    $_SESSION['user_name']=$user['user_name'];
                    $_SESSION['name']=$user['name'];
                    $_SESSION['user_id']=$user['id'];
                   header("Location:../../home.php");
                } else {
                    $em = "Incorrect username or password";
                    header("Location:../../index.php?error=$em&$data");
                    exit;
                }
            } else {
                $em = "Incorrect username or password";
                header("Location:../../index.php?error=$em&$data");
                exit;
            } 
        }
        $stmt->close();
    }
    $con->close();
} else {
    header("Location:../../signup.php");
    exit; 
}