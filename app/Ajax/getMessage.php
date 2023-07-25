<?php
SESSION_START();

if(isset($_SESSION['user_name'])){

 if (isset($_POST['id_2'])) {
  
include '../db_connection.php';

        $id_1= $_SESSION['user_id'];
        $id_2= $_POST['id_2'];
        $opened=0;
        $sql="SELECT * FROM chats WHERE to_id=? AND from_id=? ORDER BY chat_id ASC";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $id_1, $id_2);
        $result=$stmt->execute();
        $result = $stmt->get_result();
        $count = $result->num_rows;
        if($count > 0){
            $chats= $result->fetch_all(MYSQLI_ASSOC);
            foreach ($chats as $chat) {
                if ($chat['opened'] == 0) {
                    $opened= 1;
                    $chat_id = $chat['chat_id'];
                    $sql2="UPDATE chats SET opened=? WHERE chat_id=?";
                    $stmt2 = $con->prepare($sql2);
                    $stmt2->bind_param("ss", $opened, $chat_id);
                    $result2=$stmt2->execute();
                    ?>
                    <p class="ltext border rounded p-2 mb-1"><?= $chat['message']?>
                       <small class="d-block"><?= $chat['created_at']?></small>
                    </p>

                    <?php
                }
            }
        }
 }
}else{
    header("Location: ../../index.php");
    exit;
}