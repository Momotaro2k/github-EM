<?php
    session_start();
    require_once('../db/db.php');

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $sql = "SELECT * FROM `nhanvien` WHERE email = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("s", $email);
    if (!$stm->execute()) {
        die('Không tìm thấy' . $stm->error);
    }

    $result = $stm->get_result();
    $data = $result->fetch_assoc();
    //Check tài khoản có trong db không?
    if(mysqli_num_rows($result) == 1){
        $hashed_password = $data['pwd'];
        //Nếu mật khẩu không đúng
        if(!password_verify($pwd, $hashed_password)) {
            $_SESSION['error'] = 'Sai mật khẩu';
            header("Location: ../login.php");
        }
        //Nếu mật khẩu đúng
        else{
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $data['firstName'] . ' ' . $data['lastName'];
            //Nếu tài khoản đã kích hoạt thì cho phép đăng nhập
            if($data['activated'] == 1) {
                //echo ("logged in");
                header("Location: ../index.php");
            }
            //Nếu chưa kích hoạt thì đi kích hoạt
            else {
                header("Location: ./activate.php");
            }
        }
    }
    else {
        $_SESSION['error'] = 'Sai email hoặc mật khẩu';
        header("Location: ../login.php");
    }
    
?>