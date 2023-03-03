<?php
    session_start();
    require_once('../db/db.php');
    $email = $_GET['email'];
    $pwd = '123456';
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
    $activated = 0;
    //Reset mật khẩu
    $sql = "UPDATE `nhanvien` SET `pwd`=?, `activated`= ? WHERE email = ?";
    $stm = $conn->prepare($sql);
    
    $stm->bind_param("sis",$hashed_password, $activated, $email);
    if(!$stm->execute()) {
        die ("Lỗi" . $stm->error);
    }
    header("Location: ../view-employee.php");
?>