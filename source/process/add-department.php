<?php
    require_once('../db/db.php');
    $maPB = $_POST['maPB'];
    $tenPB = $_POST['tenPB'];
    $mota = $_POST['mota'];
    
    //Check xem có thiếu thông tin không
    if(empty($maPB) || empty($tenPB) ||empty($mota)) {
        die('Phòng ban bị thiếu thông tin');
    }
    //Lấy dữ liệu từ bảng PHONGBAN
    $sql = "SELECT * FROM `phongban` WHERE maPB = ? AND tenPB = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("ss", $maPB, $tenPB);
    if (!$stm->execute()) {
        die('Không tìm thấy' . $stm->error);
    }

    $result = $stm->get_result();
    $data = $result->fetch_assoc();
    //Check phòng ban này có trong db chưa?
    if(mysqli_num_rows($result) == 1) {
        die('Phòng ban đã tồn tại');
    }
    else {
        //Tạo phòng ban
        $sql = "INSERT INTO phongban(maPB, tenPB, mota) values(?, ?, ?)";
        $stm = $conn->prepare($sql);
        
        $stm->bind_param("sss", $maPB, $tenPB, $mota);
        if (!$stm->execute()) {
            echo('Cannot insert' . $stm->error);
            header('Location: ../view-department.php');
        }
        header('Location: ../view-department.php');
        exit();
    }
?>