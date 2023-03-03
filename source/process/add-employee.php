<?php
    require_once('../db/db.php');

    $userName = $_POST['username'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $pwd = '123456';
    $phongBan = $_POST['phongban'];
    $chucVu = $_POST['chucvu'];
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
    $avatar = 'images/hacker.png';
    //Check xem có thiếu thông tin không
    if(empty($userName) || empty($firstName) ||empty($lastName) || empty($email) || 
    empty($pwd) || empty($phongBan) || empty($chucVu)) {
        die('Nhân viên bị thiếu thông tin');
    }
    //Lấy dữ liệu từ bảng NHANVIEN
    $sql = "SELECT * FROM `nhanvien` WHERE email = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("s", $email);
    if (!$stm->execute()) {
        die('Không tìm thấy' . $stm->error);
    }

    $result = $stm->get_result();
    $data = $result->fetch_assoc();
    //Check tài khoản có trong db chưa?
    if(mysqli_num_rows($result) == 1) {
        header('Location: ../employee-add.php');
    }
    else {
        //Tạo account
        $sql = "insert into nhanvien(userName, firstName, lastName, email, pwd, phongBan, chucVu, avatar) values(?, ?, ?, ?, ?, ?, ?, ?)";
        $stm = $conn->prepare($sql);
        
        $stm->bind_param("ssssssss", $userName, $firstName, $lastName, $email, $hashed_password, $phongBan, $chucVu, $avatar);
        if (!$stm->execute()) {
            die('Cannot insert' . $stm->error);
        }
        header('Location: ../index.php');
        exit();
    }
?>