<?php
    require_once("../db/db.php");
    //Check giá trị có rỗng không
    if(empty($_GET['email'])) {
        die('Không có thông tin');
    }
    $email = $_GET['email'];
    //Xóa nhân viên
    $sql = "DELETE FROM nhanvien WHERE email = ?";
    $stm = $conn->prepare($sql);
    
    $stm->bind_param("s", $email);
    if(!$stm->execute()) {
        die ("Lỗi" . $stm->error);
    }

    header("Location:../view-employee.php");
?>