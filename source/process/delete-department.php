<?php
    require_once("../db/db.php");
    //Check giá trị có rỗng không
    if(empty($_GET['tenPB'])) {
        die('Không có thông tin');
    }
    $tenPB = $_GET['tenPB'];
    //Xóa phòng ban
    $sql = "DELETE FROM `phongban` WHERE tenPB = ?";
    $stm = $conn->prepare($sql);
    
    $stm->bind_param("s", $tenPB);
    if(!$stm->execute()) {
        die ("Lỗi" . $stm->error);
    }

    header("Location:../view-department.php");
?>