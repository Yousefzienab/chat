<?php
session_start();
if(!isset($_SESSION['user_name'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="image/icon.png">
</head>
<body class="d-flex
justify-content-center
align-items-center
vh-100">
    <div class="w-400 p-5 shadow rounded">
    <form method="post" action="app/http/auth.php">
      <div class="d-flex justify-content-center align-items-center flex-column">
        <img src="image/icon.png" alt="" class="w-25">
      <h3 class="display-4 fs-1 text-center">LOGIN</h3>
      </div>
      <?php if(isset($_GET['error'])){ ?>
      <div class="alert alert-warning" role="alert">
 <?php echo htmlspecialchars($_GET['error']);?>
</div>
<?php }?>
      <?php if(isset($_GET['succss'])){ ?>
      <div class="alert alert-success" role="alert">
 <?php echo htmlspecialchars($_GET['succss']);?>
</div>
<?php }?>
  <div class="mb-3">
    <label class="form-label">user name</label>
    <input type="text" class="form-control" name="user_name">
  </div>
  <div class="mb-3">
    <label class="form-label">password</label>
    <input type="password" class="form-control" name="pass">
  </div>
  <button type="submit" class="btn btn-primary">LOGIN</button>
  <a href="signup.php">Signup</a>
</form>
    </div>
</body>
</html>
<?php
}else{
    header("Location:home.php");
    exit();
}
?>