<?php
    require_once('../db/db.php');
    if(empty($_POST['username'] || empty($_POST['firstname'] || empty($_POST['lastname'])))) {
        die("Nhân viên không thể thiếu thông tin");
    }
    $email = $_POST['email'];
    $userName = $_POST['username'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    
    $sql = "UPDATE `nhanvien` SET `userName`=?, `firstName`= ?, `lastName`=? WHERE email =?";
    $stm = $conn->prepare($sql);
    
    $stm->bind_param("ssss", $userName, $firstName, $lastName, $email);
    if (!$stm->execute()) {
        die('Cannot insert' . $stm->error);
    }
    header("Location: ../view-employee.php");
?>