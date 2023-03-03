<!-- ok -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>My Project</title>
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
      
      //Check tài khoản đã kích hoạt chưa
      if(!$data['activated'] == 1) {
        header("Location: ./process/activate.php");
        exit();
      }
      //Check có phải admin không
      if($data['userName'] != "admin") {
        require_once('./nav/nhanvien-nav.php');
      }
	  else {
        require_once('./nav/admin-nav.php');
	  }
        // $phongBan = $data['phongBan'];
        $status = 'Canceled';
        // $chucVu = 'Nhân Viên';
        //Chọn ra những task thuộc phòng ban của trưởng phòng
          $sql = "SELECT * FROM `congviec` WHERE `maNV` = ? AND `status` != ?";
          $stm = $conn->prepare($sql);
          $stm->bind_param("ss", $email, $status);
          if (!$stm->execute()) {
              die('Cannot select' . $stm->error);
          }
          $result = $stm->get_result();
    ?>
    <div class="container-fluid">
            <div id="inner" class="table-responsive text-center">
              <table class="table-bordered bg-white">      
                <thead>
                  <tr>
                    <td>STT</td>
                    <td>Công việc</td>
                    <td>Nhân Viên</td>
                    <td>Tiến độ</td>
                    <td>Tùy chỉnh</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $n = 1;
                    while ($data = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>$n</td>";
                      echo "<td>".$data['tenCV']."</td>";
                      echo "<td>".$data['maNV']."</td>";
                      echo "<td>".$data['status']."</td>";
                      echo "<td><a href=\"./project-details.php?maCV=$data[maCV]\">Xem</a></td>";
                      $n++;
                    }
                  ?>
                </tbody>
              </table>
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