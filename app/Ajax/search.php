<?php
SESSION_START();

if(isset($_SESSION['user_name'])){
if(isset($_POST['key'])){
    include '../db_connection.php';
$key="%{$_POST['key']}%";
$sql="SELECT * FROM users WHERE user_name LIKE ? OR `name` LIKE ?";
$stmt= $con -> prepare($sql);
$stmt->bind_param('ss', $key, $key);
$stmt->execute();
$result = $stmt->get_result();
$count = $result->num_rows;
if($count > 0){
    while($user = $result->fetch_assoc()) {
        if ($user['id'] == $_SESSION['user_id']) continue;
        ?>
        <li class="list-group-item">
        <a href="chat.php?<?=$user['user_name']?>" class="d-flex justify-content-between align-items-center p-2">
            <div class="d-flex align-items-lg-center">
                <img src="upload/<?=$user['p-p']?>" alt="" class="w-10 rounded-circle">
                <h3 class="fs-xs m-2"><?=$user['name']?></h3>
            </div> 
        </a>
        </li>
    <?php }
} else { ?>
    <div class="alert alert-info text-center">
        <i class="fa fa-user-times d-block fs-big"></i>
        The user "<?= htmlspecialchars($_POST['key'])?>"
        is not found  
    </div>
<?php
}
}

}else{
    header("Location: ../../index.php");
    exit;
}