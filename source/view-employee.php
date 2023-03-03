<!-- ok -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="./style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Quản lý nhân viên</title>
</head>
<body>
    <?php
      
      session_start();
      require_once('./db/db.php');
      //Check tài khoản đã đăng nhập chưa
      require_once('./nav/admin-nav.php');
      if (!isset($_SESSION['email'])) {
        header('Location: ./login.php');
        exit();
      }
      $admin = 'admin';
      //Check tài khoản đã kích hoạt chưa
      if(!$data['activated'] == 1) {
        header("Location: ./process/activate.php");
        exit();
      }
      //Check có phải admin không
      if($data['userName'] != "admin") {
        header("Location: ./index.php");
        exit();
      }
      //Lấy danh sách nhân viên từ bảng NHANVIEN
      $sql = "SELECT * from `nhanvien` WHERE `userName` != ?";
      $stm = $conn->prepare($sql);
      $stm->bind_param("s", $admin);
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
                <td>Avatar</td>
                <td>Username</td>
                <td>Email</td>
                <td>Chức Vụ</td>
                <td>Phòng Ban</td>
                <td>Tùy Chỉnh</td>
              </tr>
            </thead>
            <tbody>
              <?php
                $n = 1;
                while ($data = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>$n</td>";
                  echo "<td><img src='./".$data['avatar']."' alt='avatar' height = 60px width = 60px></td>";
                  echo "<td>".$data['userName']."</td>";
                  echo "<td>".$data['email']."</td>";
                  echo "<td>".$data['chucVu']."</td>";
                  echo "<td>".$data['phongBan']."</td>";
                  
                  echo "<td><a href=\"./employee-profile.php?email=$data[email]\">Xem</a> | <a href=\"./employee-edit.php?email=$data[email]\">Sửa</a> | <a href=\"./process/delete-employee.php?email=$data[email]\" onClick=\"return confirmDelete()\";>Xóa</a></td>";
                  $n++;
                }
              ?>
              <tr><td colspan="7"><a href="./employee-add.php"><button class="btn btn-primary">Thêm nhân viên</button></a></td></tr>
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