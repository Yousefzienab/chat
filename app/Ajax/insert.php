<?php
SESSION_START();

if(isset($_SESSION['user_name'])){

 if (isset($_POST['message']) && isset($_POST['to_id'])) {
  
include '../db_connection.php';
  $message= $_POST['message'];
  $to_id= $_POST['to_id'];
  $from_id= $_SESSION['user_id'];


  $sql="INSERT INTO chats (from_id, to_id, message) VALUE (?, ?, ?)";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("sss", $from_id, $to_id, $message);
  $result=$stmt->execute();
 
  if($result){
    $sql2="SELECT * FROM conversetion WHERE (user_1= ? AND user_2= ?) OR (user_2= ? AND user_1= ?)";
    $stmt2 = $con->prepare($sql2);
    $stmt2->bind_param("ssss", $from_id, $to_id, $from_id, $to_id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $count2 = $result2->num_rows;
    define('TIMEZONE','Africa/Addis_Ababa');
    date_default_timezone_set(TIMEZONE); 
    
    $time= date("h:i:s a");

    if ($count2 == 0) {
        $sql3="INSERT INTO conversetion (user_1, user_2) VALUE (?, ?)";
        $stmt3 = $con->prepare($sql3);
        $stmt3->bind_param("ss", $from_id, $to_id);
        $stmt3->execute();
    }
    ?>

    <p class="rtext align-self-end border rounded p-2 mb-1"><?= $message?>
        <small class="d-block"><?= $time?></small>
    </p>

 <?php }
 }
}else{
    header("Location: ../../index.php");
    exit;
}