<?php
    require_once('../db/db.php');
    // maCV auto increase & file default null nên không cần khai báo
    $tenCV = $_POST['tenCV'];
    $maNV = $_POST['maNV'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $mota = $_POST['mota'];
    $mark = 0;
    $status = 'New';
    //Lấy phòng ban của nhân viên
    $sql = "SELECT * FROM `nhanvien` WHERE `email` = ?";
    $stm = $conn->prepare($sql);
    
    $stm->bind_param("s", $maNV);
    if (!$stm->execute()) {
        die('Cannot insert' . $stm->error);
    }
    $result = $stm->get_result();
    $data = $result->fetch_assoc();
    $phongBan = $data['phongBan'];

    //Check xem có thiếu thông tin không
    if(empty($tenCV) || empty($maNV) ||empty($start) || empty($end) || empty($mota)) {
        die('Nhân viên bị thiếu thông tin');
    }
    //Tạo account
    $sql = "INSERT INTO `congviec`(`tenCV`, `maNV`, `phongBan`, `start`, `end`, `mota`, `mark`, `status`) values(?, ?, ?, ?, ?, ?, ?, ?)";
    $stm = $conn->prepare($sql);
    
    $stm->bind_param("ssssssis", $tenCV, $maNV, $phongBan, $start, $end, $mota, $mark, $status);
    if (!$stm->execute()) {
        die('Cannot insert' . $stm->error);
    }
    header('Location: ../nhanvien/view-project.php');
    exit();
?>