<!-- ok -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="./style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Quản lý phòng ban</title>
</head>

<body>

	<?php
      session_start();
      require_once('./db/db.php');
      //Check tài khoản đã đăng nhập chưa
      if (!isset($_SESSION['email'])) {
        header('Location: ./login.php');
        exit();
      }
      $email = $_SESSION['email'];
      $sql = "SELECT * FROM `nhanvien` WHERE email = ?";
      $stm = $conn->prepare($sql);
      $stm->bind_param("s", $email);
      if (!$stm->execute()) {
          die('Không tìm thấy' . $stm->error);
      }
      $result = $stm->get_result();
      $data = $result->fetch_assoc();
      $sql = "SELECT * from `nhanvien` WHERE `email` = ?";
      $stm = $conn->prepare($sql);
      $stm->bind_param("s", $email);
      if (!$stm->execute()) {
          die('Không tìm thấy' . $stm->error);
      }
      $result = $stm->get_result();
      $data = $result->fetch_assoc();
      //Check có phải admin không
      if($data['userName'] != "admin") {
        header("Location: ./index.php");
        exit();
      } 
      //Check tài khoản đã kích hoạt chưa
      if(!$data['activated'] == 1) {
        header("Location: ./process/activate.php");
        exit();
      }
      //Check có phải admin không
      if($data['userName'] != "admin") {
        header('Location: ./login.php');
        exit();
      }
	    else {
        require_once('./nav/admin-nav.php');
	    }
      //Lấy danh sách phòng ban từ bảng PHONGBAN
      $sql = "SELECT * FROM `phongban`";
      $stm = $conn->prepare($sql);
      if (!$stm->execute()) {
          die('Không tìm thấy' . $stm->error);
      }
      $result = $stm->get_result();
    ?>
    <div class="container-fluid">
      <div id="inner" class="table-responsive text-center">
        <table class="table-bordered bg-white">
            <thead>
              <tr>
                <td>STT</td>
                <td>Tên phòng ban</td>
                <td>Mô tả</td>
                <td colspan="3">Tùy chỉnh</td>
              </tr>
            </thead>
            <tbody>
              <?php
                $n = 1;
                while ($data = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>$n</td>";
                  echo "<td>".$data['tenPB']."</td>";
                  echo "<td>".$data['mota']."</td>";
                  
                  echo "<td><a href=\"./department-details.php?tenPB=$data[tenPB]\">Xem</a></td>";
                  echo "<td><a href=\"./department-edit.php?tenPB=$data[tenPB]\">Sửa</a></td>";
                  echo "<td><a href=\"./process/delete-department.php?tenPB=$data[tenPB]\" onClick=\"return confirmDelete()\";>Xóa</a></td>";
                  $n++;
                }
              ?>
              <tr><td colspan="6"><a href="./department-add.php"><button class="btn btn-primary">Thêm phòng ban</button></a></td></tr>
            </tbody>
        </table>
            
      </div>
      <div id="footer"></div>
    </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="./main.js"></script> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
</body>

</html>