<!-- ok -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Home Page</title>
</head>

<body>

	<?php
      session_start();
      require_once('../db/db.php');
      //Check tài khoản đã đăng nhập chưa
      if (!isset($_SESSION['email'])) {
        header('Location: ./login.php');
        exit();
      }
      $email = $_SESSION['email'];
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
        
    </div>
      <div id="footer"></div>
    </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="../main.js"></script> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
</body>

</html>