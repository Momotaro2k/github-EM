<!-- ok -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="./style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Chi tiết phòng ban</title>
    <?php
      session_start();
      require_once('./db/db.php');
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
        header('Location: ./index.php');
        exit();
      }
	    else {
        require_once('./nav/admin-nav.php');
	    }
      //Lấy danh sách nhân viên từ bảng NHANVIEN trùng với tên phòng ban đã chọn
      $tenPB = $_GET['tenPB']; 
    
      $sql = "SELECT * FROM `nhanvien` WHERE phongBan = ?";
      $stm = $conn->prepare($sql);
      
      $stm->bind_param("s", $tenPB);
      if (!$stm->execute()) {
          die('Cannot insert' . $stm->error);
      }      
      $result = $stm->get_result();
    ?>
</head>

<body>
    <div class="container-fluid">
      <div id="inner" class="table-responsive text-center">
        <table class="table-bordered bg-white">
            <thead>
                <tr>
                  <td colspan="7"><h3><?=$tenPB?></h3></td>
                </tr>
              <tr>
                <td>STT</td>
                <td>Username</td>
                <td>Firstname</td>
                <td>Lastname</td>
                <td>Email</td>
                <td>Chức vụ</td>
                <td>Bổ nhiệm trưởng phòng</td>
              </tr>
            </thead>
            <tbody>
              <?php
                $n = 1;
                while ($data = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>$n</td>";
                  echo "<td>".$data['userName']."</td>";
                  echo "<td>".$data['firstName']."</td>";
                  echo "<td>".$data['lastName']."</td>";
                  echo "<td>".$data['email']."</td>";
                  echo "<td>".$data['chucVu']."</td>";
                  
                  echo "<td><a onclick=\"return confirmManager()\"; href=\"./process/manager-department.php?email=$data[email]&tenPB=$data[phongBan]\">Chọn</a></td>";
                  $n++;
                }
              ?>
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