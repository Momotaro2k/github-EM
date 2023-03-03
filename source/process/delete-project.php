<?php

    require_once("../db/db.php");
    //Check giá trị có rỗng không
    if(empty($_POST['maCV'])) {
        die('Không có thông tin');
    }
    $maCV = $_POST['maCV'];
    //Xóa công việc
    $sql = "DELETE FROM `congviec` WHERE `maCV` = ?";
    $stm = $conn->prepare($sql);
    
    $stm->bind_param("s", $maCV);
    if(!$stm->execute()) {
        die ("Lỗi" . $stm->error);
    }

    header("Location:../nhanvien/view-project.php");
?>