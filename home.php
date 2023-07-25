<?php
session_start();
if(isset($_SESSION['user_name'])){
    include("app/db_connection.php");

    include("app/helper/user.php");
    include("app/helper/conversation.php");
    include("app/helper/timeAgo.php");
    include("app/helper/last_chat.php"); 
    $user = getUser($_SESSION['user_name'], $con);
    
    $conversations= getConversation($user['id'], $con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat_App</title>
    <link rel="stylesheet" href="bootstrap-5.0.2/dist/css/bootstrap.min.css.map">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="image/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="p-2 w-400 rounded shadow">
        <div>
            <div class="d-flex mb-3 p-3 bg-light justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="upload/<?=$user['p-p']?>" alt="" class="w-25 rounded-circul">
                    <h3 class="fs-xs m-2"><?=$user['name']?></h3>
                </div>
                <a href="logout.php" class="btn btn-dark">Logout</a>
            </div>
            <div class="input-group mb-3">
               <input type="text" placeholder="search..." id="searchText" class="form-control">
               <button class="btn btn-primary" id="searchBtn">
               <i class="fa fa-search"></i>
               </button>
            </div>
            <ul id="chatList" class="list-group min-vh-50 overflow-auto">
                <?php 
                if(!empty($conversations)){?> 
                <?php
                foreach($conversations as $conversation){
                 ?>
                <li class="list-group-item">
                    <a href="chat.php?user=<?=$conversation['user_name']?>" class="d-flex justify-content-between align-items-center p-2">
                        <div class="d-flex align-items-lg-center">
                            <img src="upload/<?=$conversation['p-p']?>" alt="" class="w-10 rounded-circle">
                            <h3 class="fs-xs m-2"><?=$conversation['name']?><br>
                            <small>
                                <?php 
                                echo lastChat($_SESSION['user_id'], $conversation['id'], $con);
                                ?>
                            </small>
                        </h3>
                        </div>
                        <?php 
                        if(lastseen($conversation['lastseen']) == 'Active'){?>
                        <div title="online">
                            <div class="online"></div>
                        </div>
                        <?php }?>
                    </a>
                </li>
                <?php }?>
                <?php } else{?>
                    <div class="alert alert-info text-center">
                    <i class="fa fa-comment d-block fs-big"></i>
                    No messages 
                    </div>
                <?php }?>
            </ul>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
 
       // search
$("#searchText").on("input", function(){
    var searchText = $(this).val();
    if (searchText == "") return;
    $.post('app/Ajax/search.php', {
        key: searchText
    }, function(data, status){
        $("#chatList").html(data);
    });
});

// search btn
$("#searchBtn").on("click", function(){
    var searchText = $("#searchText"). val();
    if (searchText == "") return;
    $.post('app/Ajax/search.php', {
        key: searchText
    }, function(data, status){
        $("#chatList").html(data);
    });
});

        let lastSeenUpdate = function(){
            $.get("app/Ajax/update_last_seen.php");
    }
    lastSeenUpdate();

    setInterval(lastSeenUpdate, 100000);

  });
    </script>
</body>
</html>

<?php
}else{
    header("Location:index.php");
    exit();
}
?>