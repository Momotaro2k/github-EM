<?php
    session_start();
    require_once('../db/db.php');
    // error_reporting(0);
    // ini_set('display_errors', 0);
    if(empty($_POST['reason']) || empty($_POST['start']) || empty($_POST['end'])) {
        die('Thiếu thông tin');
    }
    $email = $_POST['email'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $reason = $_POST['reason'];
    $status = 'Waiting';
    
    $diff = abs(strtotime($end) - strtotime($start));
    $total = floor($diff/ (60*60*24));
    
    $sql = "SELECT `phongBan`, `chucVu` FROM `nhanvien` WHERE `email` = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("s", $email);
    if (!$stm->execute()) {
        die('Cannot select' . $stm->error);
    }
    $result = $stm->get_result();
    $data = $result->fetch_assoc();
    
    $phongBan = $data['phongBan'];
    $chucVu = $data['chucVu'];

    $sql = "INSERT INTO `nghiphep`(`email`, `phongBan`, `chucVu`,`total`, `start`, `end`, `reason`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stm = $conn->prepare($sql);
    
    $stm->bind_param("ssssssss", $email, $phongBan, $chucVu, $total, $start, $end, $reason, $status);
    if (!$stm->execute()) {
        die('Cannot insert' . $stm->error);
    }
    header("Location: ../nhanvien/history-dayoff.php");
?>

