<?php

function getChats($id_1, $id_2, $con)
{
    $sql= "SELECT * FROM chats WHERE (from_id= ? AND to_id= ?)
           OR (to_id= ? AND from_id= ?) ORDER  BY chat_id ASC";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $id_1, $id_2, $id_1, $id_2);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->num_rows;   

    if ($count > 0) {
        $chats= $result->fetch_all(MYSQLI_ASSOC);
        return $chats;
    }else{
        $chats=[];
        return $chats;
    }
    }