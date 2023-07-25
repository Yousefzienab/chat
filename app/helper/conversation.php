<?php
function getConversation($user_id, $con){
    $sql = "SELECT * FROM conversetion WHERE user_1=? OR user_2=? ORDER BY id DESC";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ss', $user_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->num_rows;

    if ($count > 0) {
    
        $conversations = $result->fetch_all(MYSQLI_ASSOC);
        $user_data=[];
         foreach ($conversations as $conversation) {
            if ($conversation['user_1'] == $user_id) {
                $sql2 = "SELECT * FROM users WHERE id=?";
                $stmt2 = $con->prepare($sql2);
                $stmt2->bind_param('s', $conversation['user_2']);
                $stmt2->execute(); // execute the prepared statement
            $result2 = $stmt2->get_result(); // get the result set
            } else {
                $sql2 = "SELECT * FROM users WHERE id=?";
                $stmt2 = $con->prepare($sql2);
                $stmt2->bind_param('s', $conversation['user_1']);
                $stmt2->execute(); // execute the prepared statement
            $result2 = $stmt2->get_result(); // get the result set
            }
            
            $AllConversations = $result2->fetch_assoc();
            array_push($user_data,$AllConversations);
         }
     return $user_data;
    } else {
        $conversations=[];
        return $conversations;
    }
}