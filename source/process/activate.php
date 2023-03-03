<!-- ok -->
<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
    <title>Kích hoạt tài khoản</title>
    <?php
    session_start();
    $email = $_SESSION['email'];
    require_once('../db/db.php');
    //Check tài khoản đã đăng nhập chưa
    if (!isset($_SESSION['email'])) {
        header('Location: ./login.php');
        exit();
    }
    //Lấy thông tin nhân viên này
    $sql = "SELECT * FROM `nhanvien` WHERE email = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("s", $email);
    if (!$stm->execute()) {
        die('Không tìm thấy' . $stm->error);
    }
    $result = $stm->get_result();
    $data = $result->fetch_assoc();
    $pwd = '';
    $pwd_confirm = '';
    //Nếu nhấn thay đổi pwd
    if(isset($_POST['update'])) {
        $pwd = $_POST['pwd'];
        $pwd_confirm = $_POST['pwd-confirm'];
        $activated = 1;
        //
        $sql = "SELECT * FROM `nhanvien` WHERE `email` = ?";
        $stm = $conn->prepare($sql);
        $stm->bind_param("s", $email);
        if (!$stm->execute()) {
            die('Không tìm thấy' . $stm->error);
        }
        $result = $stm->get_result();
        $data = $result->fetch_assoc();

        $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
        $old_pwd = $data['pwd'];
        if(password_verify($pwd, $old_pwd)) {
            $error = 'Mật khẩu phải khác mật khẩu cũ';
        }
        else {
            $sql = "UPDATE `nhanvien` SET `pwd`= ?, `activated`= ? WHERE `email` = ?";
            $stm = $conn->prepare($sql);
            $stm->bind_param("sss", $hashed_password, $activated, $email);
            if (!$stm->execute()) {
                die('Không tìm thấy' . $stm->error);
            }
            header("Location: ./logout-password.php");
            exit();
        }
    }
?>
</head>
<body>

<div class="container-fluid">
    <div id="header">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="#">Employee Management</a>
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto">
                    <li>
                        <a class="nav-link" href="../logout.php">Đăng xuất</a>
                    </li>
                </ul>
            </div>      
        </nav>
    </div>
    <div id="inner">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <h3 class="text-center text-secondary mt-5 mb-3">Vui lòng đổi mật khẩu mới</h3>
                <form onsubmit="return validateActivate()"; method="post" action="./activate.php" class="border rounded w-100 mb-5 mx-auto px-3 pt-3 bg-light">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input readonly value="<?= $_SESSION['email'] ?>" name="email" id="email" type="text" class="form-control" placeholder="Email address">
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
                        <p id="errorMsg">
                            <?php
                                if (!empty($error)) {
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                            ?>
                        </p>
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
	<script src="../main.js"></script> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
</body>
</html>
