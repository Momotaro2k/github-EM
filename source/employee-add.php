<!-- ok -->
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="./style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Thêm nhân viên</title>
      <?php
        session_start();
        require_once('./db/db.php');
        //Check tài khoản đã đăng nhập chưa
        if (!isset($_SESSION['email'])) {
          header('Location: ./login.php');
          exit();
        }
        //Check có phải admin không
        $email = $_SESSION['email'];
        $sql = "SELECT * from `nhanvien` WHERE email = ?";
        $stm = $conn->prepare($sql);
        $stm->bind_param("s", $email);
        if (!$stm->execute()) {
            die('Không tìm thấy' . $stm->error);
        }
        $result = $stm->get_result();
        $data = $result->fetch_assoc();
        require_once('./nav/admin-nav.php');
        if($data['userName'] != "admin") {
          header("Location: ./index.php");
          exit();
        }
        $sql = "SELECT * from `phongban`";
        $stm = $conn->prepare($sql);
        // $stm->bind_param("ss", $phongBan, $truongPhong);
        if (!$stm->execute()) {
          die('Cannot select' . $stm->error);
        }
        $result = $stm->get_result();
      ?>
    </head>
  <body>
    <div class="container-fluid">
        
      <div id="inner">
      <div class="row">
        <div class="col-md-8 col-lg-5 my-5 mx-2 mx-sm-auto border rounded px-3 py-3 bg-white">
          <h5 class="text-center mb-1">Đăng ký tài khoản</h5>
          <form onsubmit="return validateEmployeeAdd()"; method="post" action="./process/add-employee.php">
            <div class="form-group">
              <label for="username">Username</label>
              <input
                type="text"
                value=""
                name="username"
                id="username"
                class="form-control"
                placeholder="Username"
              />
            </div>
            <div class="form-group form-row">
              <div class="form-group col-md-6">
                  <label for="firstname">First name</label>
                  <input value="" name="firstname" class="form-control" type="text" placeholder="Firstname" id="firstname">
              </div>
              <div class="form-group col-md-6">
                  <label for="lastname">Last name</label>
                  <input value="" name="lastname" class="form-control" type="text" placeholder="Lastname" id="lastname">
              </div>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                value=""
                name="email"
                id="email"
                class="form-control"
                placeholder="Email"
              />
            </div>
            <div class="form-group">
              <legend id="phongban" class="col-form-label">Phòng ban</legend>
              <select name="phongban" id="phongban" class="form-control">
                  <?php
                    while($data = $result->fetch_assoc()){
                      ?>
                      <option value="<?=$data['tenPB']?>"><?=$data['tenPB']?></option>
                      <?php
                    }
                  ?>
              </select>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Chức vụ</legend>
              <div class="custom-control custom-control-inline custom-radio">
                <input
                  checked="checked"
                  value="Nhân Viên"
                  name="chucvu"
                  type="radio"
                  class="custom-control-input"
                  id="nhanvien"
                />
                <label class="custom-control-label" for="nhanvien"
                  >Nhân Viên</label
                >
              </div>
            </div>
            <p id="errorMsg">
            
            </p>
            <button onclick="return confirmEmployeeAdd()"; class="btn btn-success px-5 mr-2">Đăng ký</button>
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
