<!-- ok -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="./style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Thông tin nhân viên</title>
</head>
<body>
    <?php
      session_start();
      require_once('./db/db.php');
      require_once('./nav/admin-nav.php');
      //Check tài khoản đã đăng nhập chưa
      if (!isset($_SESSION['email'])) {
        header('Location: ./login.php');
        exit();
      }
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
      if(empty($_GET['email'])) {
        die('Không có thông tin');
    }
      $email = $_GET['email'];
     //Chọn nhân viên
      $sql = "SELECT * from `nhanvien` WHERE `email` = ?";
      $stm = $conn->prepare($sql);
      $stm->bind_param("s", $email);
      if (!$stm->execute()) {
          die('Không tìm thấy' . $stm->error);
      }
      $result = $stm->get_result();
      $data = $result->fetch_assoc();
      $avatar = $data['avatar'];
      $firstName = $data['firstName'];
      $lastName = $data['lastName'];
      $email = $data['email'];
      $chucVu = $data['chucVu'];
      $phongBan = $data['phongBan'];
    ?>
    <div id="my-profile" class="container-fluid">
      <div id="inner">
        <div class="card mx-auto">
            <div class="card-header font-weight-bold font-size-lg">Thông tin nhân viên</div>
            <div class="card-body">
                <form action="">
                    <div class="avatar mb-3">
                        <img src="./<?= $avatar ?>" alt="avatar">
                    </div>
                    <div class="form-group form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname">Firstname</label>
                        <input readonly value="<?= $firstName?>" name="firstname" class="form-control" type="text" placeholder="First name" id="firstname">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname">Lastname</label>
                        <input readonly value="<?= $lastName?>" name="lastname" class="form-control" type="text" placeholder="Last name" id="lastname">
                    </div>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input
                    readonly
                    type="email"
                    value="<?= $email ?>"
                    name="email"
                    id="email"
                    class="form-control"
                  />
                </div>
                <div class="form-group">
                  <label for="phongban">Phòng ban</label>
                  <input
                    readonly
                    type="text"
                    value="<?= $phongBan ?>"
                    name="phongban"
                    id="phongban"
                    class="form-control"
                  />
                </div>
                <div class="form-group">
                  <label for="chucvu">Chức vụ</label>
                  <input
                    readonly
                    type="text"
                    value="<?= $chucVu ?>"
                    name="chucvu"
                    id="chucvu"
                    class="form-control"
                  />
                </div>
                    </form>
                </div>
            <div class="card-footer">
                <a href="./process/reset-password.php?email=<?=$data['email']?>"><button onclick="return confirmReset()"; class="btn btn-primary">Reset mật khẩu</button></a>
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