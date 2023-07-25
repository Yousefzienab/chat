<?php
  function opened($id_1, $con, $chats){
    foreach ($chats as $chat) {
        if ($chat['opened']==0) {
            $opened=1;
            $chat_id=$chat['chat_id'];

            $sql="UPDATE chats SET opened=? WHERE from_id=? AND chat_id=?";
            $stmt=$con->prepare($sql);
            $stmt->bind_param("sss",$opened,$id_1,$chat_id);
            $resulte=$stmt->execute();
        }
    }
  }