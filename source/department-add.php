<!-- ok -->
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="./style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Thêm phòng ban</title>
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
      ?>
    </head>
  <body> 
    <div class="container-fluid">
        
      <div id="inner">
      <div class="row">
        <div class="col-md-8 col-lg-5 my-5 mx-2 mx-sm-auto border rounded px-3 py-3 bg-white">
          <h5 class="text-center mb-1">Thêm phòng ban</h5>
          <form onsubmit="return validateDepartment()"; method="post" action="./process/add-department.php">
            <div class="form-group">
              <label for="maPB">Mã phòng ban</label>
              <input
                oninput="clearMessage()";
                type="text"
                value=""
                name="maPB"
                id="maPB"
                class="form-control"
                placeholder="Mã phòng ban"
              />
            </div>
            <div class="form-group">
              <label for="email">Tên phòng ban</label>
              <input
                oninput="clearMessage()";
                type="text"
                value=""
                name="tenPB"
                id="tenPB"
                class="form-control"
                placeholder="Tên phòng ban"
              />
            </div>
            <div class="form-group">
              <label for="pwd">Mô tả</label>
              <input
                oninput="clearMessage()";
                type="text"
                value=""
                name="mota"
                id="mota"
                class="form-control"
                placeholder="Mô tả"
              />
            </div>
            
            <p id="errorMsg">
            </p>
            <button onclick="return confirmAdd()"; class="btn btn-success px-5 mr-2">Tạo phòng ban</button>
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
