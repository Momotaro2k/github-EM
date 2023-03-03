
<DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="./style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Đổi mật khẩu</title>
</head>
<body>
<?php
    session_start();
    $email = $_SESSION['email'];
    require_once('./db/db.php');
    //Check tài khoản đã đăng nhập chưa
    if (!isset($_SESSION['email'])) {
        header('Location: ./login.php');
        exit();
    }
    $sql = "SELECT * FROM `nhanvien` WHERE email = ?";

    $stm = $conn->prepare($sql);
    $stm->bind_param("s", $email);
    if (!$stm->execute()) {
        die('Cannot select' . $stm->error);
    }
    $result = $stm->get_result();
    $data = $result->fetch_assoc();
    //Check có phải admin không
    if($data['userName'] != "admin") {
      header("Location: ./index.php");
      exit();
    }

    $pwd = '';
    $pwd_confirm = '';

    if(isset($_POST['update'])) {
        $pwd = $_POST['pwd'];
        $pwd_confirm = $_POST['pwd-confirm'];
        $result = mysqli_query($conn, "select pwd, activated from nhanvien WHERE email = '$email'");
        $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
        $old_pwd = $data['pwd'];
        
        if(empty($_POST['old_pwd'])) {
            $error = 'Vui lòng nhập mật khẩu cũ';
        }
        else if(empty($pwd)) {
            $error = 'Vui lòng nhập mật khẩu mới';
        }
        else if(empty($pwd_confirm)) {
            $error = 'Vui lòng xác nhận mật khẩu mới';
        }
        //Nếu pwd mới = pwd cũ
        else if(password_verify($pwd, $old_pwd)) {
            $error = 'Mật khẩu mới phải khác mật khẩu cũ';
        }
        //Nếu nhập pwd cũ sai
        else if(!password_verify($_POST['old_pwd'], $old_pwd)) {
            $error = "Mật khẩu cũ không khớp";
        }
        else if(strlen($pwd) < 6) {
            $error = "Mật khẩu cần ít nhất 6 ký tự";
        }
        else if($pwd != $pwd_confirm) {
            $error = "Mật khẩu không trùng khớp";
        }
        else if($pwd == $pwd_confirm){
            $sql = "UPDATE `nhanvien` SET `pwd`='$hashed_password', `activated`= 1 WHERE email = '$email'";
            mysqli_query($conn, $sql);
             echo ("<SCRIPT LANGUAGE='JavaScript'>
            //       window.alert('Mật khẩu đã được thay đổi')</SCRIPT>"); 
            header("Location: ./process/logout-password.php");
            exit();
        }
    }
?>
<div class="container-fluid">
    <?php
        require_once('./nav/admin-nav.php');
    ?>
    <div id="inner">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 mt-3">
                <form onsubmit="return confirmUpdate()"; method="post" action="./change-password.php" class="border rounded w-100 mb-5 mx-auto px-3 pt-3 bg-light">
                    <div class="form-group">
                        <h3 class="text-center text-secondary">Thay đổi mật khẩu</h3>
                        <label for="email">Email</label>
                        <input readonly value="<?= $_SESSION['email'] ?>" name="email" id="email" type="text" class="form-control" placeholder="Email address">
                    </div>
                    <div class="form-group">
                        <label for="old_pwd">Mật khẩu cũ</label>
                        <input  value="" name="old_pwd" required class="form-control" type="password" placeholder="Nhập vào mật khẩu cũ" id="old_pwd">
                        <div class="invalid-feedback">Password is not valid.</div>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mật khẩu mới</label>
                        <input  value="" name="pwd" required class="form-control" type="password" placeholder="Nhập vào mật khẩu mới" id="pass">
                        <div class="invalid-feedback">Password is not valid.</div>
                    </div>
                    <div class="form-group">
                        <label for="pwd2">Xác nhận lại mật khẩu</label>
                        <input value="" name="pwd-confirm" required class="form-control" type="password" placeholder="Nhập vào mật khẩu mới" id="pass2">
                        <div class="invalid-feedback">Password is not valid.</div>
                    </div>
                    <div class="form-group">
                        <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        ?>
                        <button name='update' class="btn btn-success px-5">Thay đổi mật khẩu</button>          
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="footer"></div>
    
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="./main.js"></script> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
</body>
</html>
