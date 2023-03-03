<!-- ok -->
<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Đổi ảnh đại diện</title>
</head>
<body>
<?php
    session_start();
    $email = $_SESSION['email'];
    require_once('../db/db.php');
    //Check tài khoản đã đăng nhập chưa
    if (!isset($_SESSION['email'])) {
        header('Location: ./login.php');
        exit();
    }
    $sql = "SELECT * from `nhanvien` WHERE email = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("s", $email);
    if (!$stm->execute()) {
        die('Không tìm thấy' . $stm->error);
    }
    $result = $stm->get_result();
    $data = $result->fetch_assoc();
    if($data['chucVu'] == 'Trưởng Phòng') {
        require_once('./nav/truongphong-nav.php');
    }
    else {
      require_once('./nav/nhanvien-nav.php');
    }
?>
    <div class="container-fluid">    
        <div id="inner">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 mt-5 mb-3">
                <form onsubmit="return validateAvatar()"; method="post" action="../process/update-avatar.php" class="border rounded w-100 mb-5 mx-auto px-3 pt-3 bg-light">
                        <div class="form-group">
                        <h3 class="text-center text-secondary ">Đổi ảnh đại diện</h3>
                        <label for="email">Email</label>
                        <input readonly value="<?= $_SESSION['email'] ?>" name="email" id="email" type="text" class="form-control" placeholder="Email address">
                    </div>    
                    <div class="form-group">
                        <input class="form-control" id="avatar" type="file" placeholder="file" name="avatar">
                    </div>
                    <div class="form-group">
                        <p id="errorMsg">
                            <?php
                                if (!empty($error)) {
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                            ?>
                        </p>
                        <button onclick="confirmAvatar()"; name='update' class="btn btn-success px-5">Đổi ảnh đại diện</button>          
                    </div>
                </form>
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
