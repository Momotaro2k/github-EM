<?php
    require_once('../db/db.php');
    if(empty($_POST['maPB'] || empty($_POST['tenPB'] || empty($_POST['mota'])))) {
        die("Phòng ban không thể thiếu thông tin");
    }
    $maPB = $_POST['maPB'];
    $tenPB = $_POST['tenPB'];
    $mota = $_POST['mota'];
    
    $sql = "UPDATE `phongban` SET `maPB`=?, `tenPB`= ?, `mota`=? WHERE `maPB` =?";
    $stm = $conn->prepare($sql);
    
    $stm->bind_param("ssss", $maPB, $tenPB, $mota, $maPB);
    if (!$stm->execute()) {
        die('Cannot insert' . $stm->error);
    }
    header("Location: ../view-department.php");
?>