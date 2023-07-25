<?php
if(isset($_POST['name'])&isset($_POST['user_name'])&isset($_POST['pass'])){
$name=$_POST['name'];
$user_name=$_POST['user_name'];
$pass=$_POST['pass'];
$data='name'.$name.'&user_name'.$user_name;
include("../db_connection.php");
if(empty($name)){
    $em="Name is required";
    header("Location:../../signup.php?error=$em&$data");
    exit;
}
else if(empty($user_name)){
    $em="User name is required";
    header("Location:../../signup.php?error=$em&$data");
    exit;
}
else if(empty($pass)){
    $em="password is required";
    header("Location:../../signup.php?error=$em&$data");
    exit;
}
else{
    $sql="SELECT user_name FROM users WHERE user_name=?";
    $stmt=$con->prepare($sql);
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $stmt->store_result();  
    if($stmt->num_rows()> 0){
       $em="the username ($user_name) is token";
       header("Location:../../signup.php?error=$em&$data");
       $stmt->close();
    }
    else{
        if(isset($_FILES['pp'])){
        $img_name=$_FILES['pp'] ['name'];
        $tmp_name=$_FILES['pp'] ['tmp_name'];
        $error=$_FILES['pp'] ['error'];
         
        if($error===0){
          $img_ex= pathinfo($img_name,PATHINFO_EXTENSION);
          $img_ex_lc=strtolower($img_ex);
          $allowed_ex=array("jpg","jpeg","png");
          if(in_array($img_ex_lc,$allowed_ex)){
           $new_img_name=$user_name. '.' . $img_ex_lc;
           $img_upload_path= '../../upload/'.$new_img_name;
           move_uploaded_file($tmp_name,$img_upload_path);
          }
          else{
            $em="You can't upload file of this type";
            header("Location:../../signup.php?error=$em&$data");
            exit();
          }
        }
    }

    $pass=password_hash($pass,PASSWORD_DEFAULT);
    if(isset($new_img_name)){
        $sql = "INSERT INTO users (name,user_name,password,`p-p`) VALUES (?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssss", $name, $user_name, $pass, $new_img_name);
        $stmt->execute();
    }else{
        $sql = "INSERT INTO users (name,user_name,password) VALUES (?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $name, $user_name, $pass);
        $stmt->execute();
    }
    $sm="Acount created successfuly";
    header("Location:../../index.php?succss=$sm");
    exit;
}
}
}
else{
    header("Location:../../signup.php");
    exit; 
}