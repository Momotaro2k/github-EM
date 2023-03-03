<!-- ok -->
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="./style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Sửa thông tin giám đốc</title>
      <?php
        session_start();
        require_once('./db/db.php');

        $email = $_SESSION['email'];
        $sql = "SELECT * from `nhanvien` WHERE email = ?";
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
        
      ?>
    </head>
  <body>
    <?php
    $sql = "SELECT * FROM `nhanvien` WHERE email = ?";

    $stm = $conn->prepare($sql);
    $stm->bind_param("s", $email);
    if (!$stm->execute()) {
        die('Không tìm thấy' . $stm->error);
    }
    $result = $stm->get_result();
    $data = $result->fetch_assoc();

    $userName = $data['userName'];
    $firstName = $data['firstName'];
    $lastName = $data['lastName'];
    $email = $email;
    $pwd = '';
    $phongBan = $data['phongBan'];
    $chucVu = $data['chucVu'];
    ?>
    <div class="container-fluid">
      <?php
        require_once('./nav/admin-nav.php');
      ?>
      <div id="inner">
        <div class="row">
          <div class="col-md-8 col-lg-5 my-5 mx-2 mx-sm-auto border rounded px-3 py-3 bg-white">
            <h5 class="text-center mb-1">Sửa thông tin giám đốc</h5>
            <form onsubmit="return validateInformationChange()"; method="post" action="./process/update-employee.php">
              <div class="form-group">
                <label for="username">Username</label>
                <input
                  readonly
                  type="text"
                  value="<?= $userName ?>"
                  name="username"
                  id="username"
                  class="form-control"
                  placeholder="Username"
                />
              </div>
              <div class="form-group">
                <label for="firstname">Firstname</label>
                <input
                  type="text"
                  value="<?= $firstName ?>"
                  name="firstname"
                  id="firstname"
                  class="form-control"
                  placeholder="Firstname"
                />
              </div>
              <div class="form-group">
                <label for="lastname">Lastname</label>
                <input
                  type="text"
                  value="<?= $lastName ?>"
                  name="lastname"
                  id="lastname"
                  class="form-control"
                  placeholder="Lastname"
                />
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
                  placeholder="Your name"
                />
              </div>

              <div class="form-group">
                <label for="pwd">Password</label>
                <input
                  readonly
                  type="password"
                  value="<?= $pwd ?>"
                  name="pwd"
                  id="pwd"
                  class="form-control"
                  placeholder="Password"
                />
              </div>        
              <p id="errorMsg">
              <?php
                  if (!empty($error)) {
                      echo "<div class='alert alert-danger'>$error</div>";
                  }
              ?>
              </p>
              <button onclick="return confirmUpdate()"; class="btn btn-success px-5 mr-2">Sửa thông tin</button>
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
