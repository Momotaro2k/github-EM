<?php
    require_once('../db/db.php');
    if(empty($_GET['email'])) {
        die("Thiếu thông tin");
    }
    $newMng = $_GET['email'];
    $phongBan = $_GET['tenPB'];
    //Lấy thông tin nhân viên được chọn
    $sql = "SELECT * FROM `nhanvien` WHERE email =? AND `phongBan` = ?";
    $stm = $conn->prepare($sql);
    
    $stm->bind_param("ss", $newMng, $phongBan);
    if (!$stm->execute()) {
        die('Cannot insert' . $stm->error);
    }
    $result = $stm->get_result();
    $data = $result->fetch_assoc();
    //Nếu là trưởng phòng thì dừng
    if($data['chucVu'] == 'Trưởng Phòng'){
        echo "đã là trưởng phòng";
        header("Location: ../department-details.php?tenPB=$phongBan");
    }
    //Nếu không
    else {
        //Tìm trưởng phòng cũ
        $truongPhong = "Trưởng Phòng";
        $nhanVien = "Nhân Viên";
        $sql = "SELECT * FROM `nhanvien` WHERE `phongBan` = ? AND `chucVu` = ?";
        $stm = $conn->prepare($sql);
    
        $stm->bind_param("ss", $phongBan, $truongPhong);
        if (!$stm->execute()) {
            die('Cannot find' . $stm->error);
        }
        //Gán trưởng phòng cũ
        $result = $stm->get_result();
        $data = $result->fetch_assoc();
        $oldMng = $data['email'];
        print_r($data);
        //Chuyển chức vụ thành nhân viên
        $sql = "UPDATE `nhanvien` SET `chucVu` = ? WHERE `email` = ? AND `phongBan` = ?";
        $stm = $conn->prepare($sql);
    
        $stm->bind_param("sss", $nhanVien, $oldMng, $phongBan);
        if (!$stm->execute()) {
            die('Cannot update' . $stm->error);
        }
        //Update trưởng phòng mới
        $sql = "UPDATE `nhanvien` SET `chucVu` = ? WHERE `email` = ? AND `phongBan` = ?";
        $stm = $conn->prepare($sql);
    
        $stm->bind_param("sss", $truongPhong, $newMng, $phongBan);
        if (!$stm->execute()) {
            die('Cannot update' . $stm->error);
        }
        header("Location: ../department-details.php?tenPB=$phongBan");
    }
    // $sql = "UPDATE `nhanvien` SET `avatar` = ? WHERE email =?";
    // $stm = $conn->prepare($sql);
    
    // $stm->bind_param("ss", $avatar, $email);
    // if (!$stm->execute()) {
    //     die('Cannot insert' . $stm->error);
    // }
    // 
?>