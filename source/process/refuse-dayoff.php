<?php
    require_once("../db/db.php");
    //Check giá trị có rỗng không
    if(empty($_GET['maNP'])) {
        die('Không có thông tin');
    }
    $maNP = $_GET['maNP'];
    $status = 'Refused';
    //Từ chối
    $sql = "UPDATE `nghiphep` SET `status` = ? WHERE `maNP` =?";
    $stm = $conn->prepare($sql);
    
    $stm->bind_param("ss", $status, $maNP);
    if (!$stm->execute()) {
        die('Cannot insert' . $stm->error);
    }

    header("Location:../view-dayoff.php");
?>