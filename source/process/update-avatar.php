<?php
    require_once('../db/db.php');
    if(empty($_POST['avatar'])) {
        die("Nhân viên không thể thiếu thông tin");
    }
    $email = $_POST['email'];
    $avatar = 'images/' . $_POST['avatar'];
    echo $email;
    echo $avatar;
    
    $sql = "UPDATE `nhanvien` SET `avatar` = ? WHERE email =?";
    $stm = $conn->prepare($sql);
    
    $stm->bind_param("ss", $avatar, $email);
    if (!$stm->execute()) {
        die('Cannot insert' . $stm->error);
    }
    header("Location: ../index.php");
?>