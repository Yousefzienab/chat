<?php
function getUser($user_name,$con){
    $sql="SELECT * FROM users WHERE user_name=?";
    $stmt=$con->prepare($sql);
    $stmt->bind_param('s', $user_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->num_rows;

    if($count == 1){
        $user = $result->fetch_assoc();
        return $user;
    }else{
        $user=[];
        return $user;
    }
}
?>