<?php
    require_once("../db/db.php");
    //Check giá trị có rỗng không
    if(empty($_POST['maCV'])) {
        die('Không có thông tin');
    }

    $maCV =  $_POST['maCV'];
    $btn = $_POST['btn'];
    $file = '';
    //Có file
    if(!empty($_POST['file'])) {
        $file = $_POST['file'];
        //Check file name
        $fileExt = explode('.', $file);
        $fileCheck = strtolower(end($fileExt));
        $fileName = array('exe' , 'sh');
        if(in_array($fileCheck, $fileName)) {
            header("Location:../nhanvien/myproject.php");
        }
        else if($_FILES['$file']['size'] > 1000000) {
            echo "file quá lớn";
            header("Location:../nhanvien/myproject.php");
        }
        if($btn == 'start') {
            $status = 'In Progress';
        }
        else if($btn == 'submit') {
            $status = 'Waiting';
        }
        else if($btn == 'reject') {
            $status = 'Rejected';
        }
        else if($btn == 'accept') {
            $status = 'Complete';
        }
        else if($btn == 'cancel') {
            $status = 'Canceled';
        }
        // Update tiến độ
        $sql = "UPDATE `congviec` SET `status` = ?, `file` = ? WHERE `maCV` = ?";
        $stm = $conn->prepare($sql);
        
        $stm->bind_param("sss", $status, $file, $maCV);
        if (!$stm->execute()) {
            die('Cannot insert' . $stm->error);
        }
        if($btn == 'reject' || $btn == 'accept' || $btn == 'cancel') {
            header("Location:../nhanvien/view-project.php");
        }
        else {
            header("Location:../nhanvien/myproject.php");
        }
    }
    //Không có file
    else {
        // Check button để set status
        if($btn == 'start') {
            $status = 'In Progress';
        }
        else if($btn == 'submit') {
            $status = 'Waiting';
        }
        else if($btn == 'reject') {
            $status = 'Rejected';
        }
        else if($btn == 'accept') {
            $status = 'Complete';
        }
        else if($btn == 'cancel') {
            $status = 'Canceled';
        }
        // Update tiến độ
        $sql = "UPDATE `congviec` SET `status` = ? WHERE `maCV` = ?";
        $stm = $conn->prepare($sql);
        
        $stm->bind_param("ss", $status, $maCV);
        if (!$stm->execute()) {
            die('Cannot insert' . $stm->error);
        }
        if($btn == 'reject' || $btn == 'accept' || $btn == 'cancel') {
            header("Location:../nhanvien/view-project.php");
        }
        else {
            header("Location:../nhanvien/myproject.php");
        }
    }
    
    
?>