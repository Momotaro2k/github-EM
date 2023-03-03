<!-- ok -->
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Xin nghỉ phép</title>
      <?php
        session_start();
        require_once('../db/db.php');

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
    </head>
  <body>
    <?php
    $firstName = $data['firstName'];
    $lastName = $data['lastName'];
    $email = $email;
    ?>
    <div class="container-fluid">
      <div id="inner">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 border my-5 p-4 rounded mx-3 bg-white">
                <h3 class="text-center text-secondary mt-2 mb-3 mb-3">Đơn xin nghỉ phép</h3>
                <form
                onsubmit="return validateDayOff()"; method="post" action="../process/apply-dayoff-process.php" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">First name</label>
                            <input readonly value="<?= $firstName?>" name="firstname" class="form-control" type="text" placeholder="First name" id="firstname">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Last name</label>
                            <input readonly value="<?= $lastName?>" name="lastname" class="form-control" type="text" placeholder="Last name" id="lastname">
                            <div class="invalid-tooltip">Last name is required</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input readonly value="<?= $email?>" name="email" class="form-control" type="email" placeholder="Email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="reason">Lý do</label>
                        <input oninput="clearMessage()"; value="" name="reason" required class="form-control" type="text" id="reason">
                        <div class="invalid-feedback">Password is not valid.</div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="start">Ngày bắt đầu</label>
                            <input onclick="clearMessage()"; value="" name="start" required class="form-control" type="date" placeholder="" id="start">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="end">Ngày kết thúc</label>
                            <input onclick="clearMessage()"; value="" name="end" required class="form-control" type="date" placeholder="" id="end">
                            <div class="invalid-tooltip">Last name is required</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <p id="errorMsg">
                        <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        ?>
                        </p>
                        <button type="submit" class="btn btn-success px-5 mt-3 mr-2">Gửi đơn</button>
                        <button type="reset" id="reset" class="btn btn-outline-success px-5 mt-3">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
