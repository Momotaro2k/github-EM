<!-- ok -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Chi tiết công việc</title>
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
      $chucVu = $data['chucVu'];
      //Check tài khoản đã kích hoạt chưa
      if(!$data['activated'] == 1) {
        header("Location: ./process/activate.php");
        exit();
      }
      if($data['chucVu'] == 'Trưởng Phòng') {
          require_once('./nav/truongphong-nav.php');
      }
      else {
          require_once('./nav/nhanvien-nav.php');
      }
      //Lấy thông tin công việc này
      $maCV = $_GET['maCV'];

      $sql = "SELECT * FROM `congviec` WHERE `maCV` = ?";
      $stm = $conn->prepare($sql);
      
      $stm->bind_param("s", $maCV);
      if (!$stm->execute()) {
          die('Cannot insert' . $stm->error);
      }      
      $result = $stm->get_result();
      $data = $result->fetch_assoc();
      
      $tenCV = $data['tenCV'];
      $maNV = $data['maNV'];
      $start = $data['start'];
      $end = $data['end'];
      $mota = $data['mota'];
      $status = $data['status'];
      $file = $data['file'];
    ?>
</head>
<body>
    <div class="container-fluid">
    <div id="inner">
      <div class="row">
        <div class="col-md-8 col-lg-5 my-5 mx-2 mx-sm-auto border rounded px-3 py-3 bg-white">
          <h5 class="text-center mb-1">Chi tiết công việc</h5>
          <form onsubmit="return confirm()"; method="POST" action="../process/status-project.php">
            <div class="form-group">
              <label for="maCV">Mã công việc</label>
              <input
                readonly
                type="text"
                value="<?=$maCV?>"
                name="maCV"
                id="maCV"
                class="form-control"
                />
            </div>
            <div class="form-group">
              <label for="tenCV">Tên công việc</label>
              <input
                readonly
                type="text"
                value="<?=$tenCV?>"
                name="tenCV"
                id="tenCV"
                class="form-control"
                placeholder="Tên công việc"
              />
            </div>
            <div class="form-group">
              <label for="maNV">Nhân viên</label>
              <input
                readonly
                type="text"
                value="<?=$maNV?>"
                name="maNV"
                id="maNV"
                class="form-control"
                placeholder="Nhân viên"
              />
            </div>
            <div class="form-group">
              <label for="mota">Mô tả</label>
              <input
                readonly
                type="text"
                value="<?=$mota?>"
                name="mota"
                id="mota"
                class="form-control"
                placeholder="Mô tả"
                />
              </div>
              <div class="form-group form-row">
                <div class="form-group col-md-6">
                    <label for="start">Ngày bắt đầu</label>
                    <input readonly value="<?=$start?>" name="start" class="form-control" type="date" placeholder="Ngày bắt đầu" id="start">
                </div>
                <div class="form-group col-md-6">
                    <label for="end">Ngày kết thúc`</label>
                    <input readonly value="<?=$end?>" name="end" class="form-control" type="date" placeholder="Ngày kết thúc" id="end">
                </div>
              </div>
              <?php
              //Trưởng phòng chỉ được download file
              if($chucVu == 'Trưởng Phòng') {
                ?>
                  <div class="form-group">
                    <label for="file">File</label> <br>
                    <?php
                    if($data['file'] != '') {
                      ?>
                      <a class="form-control w-25" href="../process/download.php?file=<?=$file?>"><?=$file?></a><?php
                    }?>
                  </div>
                <?php
              }
              //Nhân viên được upload
              else {
                ?>
                <div class="form-group">
                  <label for="file">File</label>
                  <?php 
                    if($data['status'] != 'Complete' && $data['status'] != 'New' && $data['status'] != 'Waiting') {
                      ?>
                        <input
                    type="file"
                    value=""
                    name="file"
                    id="file"
                    class="form-control"
                    placeholder="Tệp đính kèm"
                    />
                      <?php
                    }
                  ?>
                </div>
                <?php if($data['file'] != '') {
                  ?>
                    <div class="form-group">
                      <a class="form-control w-25" href="../process/download.php?file=<?=$file?>"><?=$file?></a>
                    </div>
                  <?php
                } ?>
                <?php
              } 
              ?>
              <div class="form-group">
              <label for="status">Tiến độ</label>
              <input
                readonly
                type="text"
                value="<?=$status?>"
                name="status"
                id="status"
                class="form-control"
                />
              </div>
            <p id="errorMsg">
            </p>
            <?php
              //New
              if($data['status'] == "New") {
                //New && Trưởng phòng
                if($chucVu == 'Trưởng Phòng') {
                ?><button onclick="return confirmDelete()"; name="btn" value="cancel" class="btn btn-danger px-5 mr-2">Hủy công việc</button><?php
                }
                //New && Nhân viên
                else {
                  ?><button onclick="return confirmStart()"; name="btn" value="start" class="btn btn-primary px-5 mr-2">Bắt đầu</button><?php
                }
              }
              //IP, Waiting, Rejected, Complete
              else {
                // IP, Waiting, Rejected, Complete && Trưởng phòng
                if($chucVu == 'Trưởng Phòng') {
                  if($status == 'Waiting') {
                  ?><button onclick="return confirmDelete()"; name="btn" value="accept" class="btn btn-success px-5 mr-2">Chấp nhận</button><?php
                  ?><button onclick="return confirmDelete()"; name="btn" value="reject" class="btn btn-outline-success px-5 mr-2">Từ chối</button><?php
                  }
                  }
                //IP, Waiting, Rejected, Complete && Nhân viên
                else {
                  //IP, Rejected && Nhân viên
                  if($status != 'Complete' && $status != 'Waiting') {
                  ?><button onclick="return confirmStart()"; name="btn" value="submit" class="btn btn-primary px-5 mr-2">Gửi</button><?php
                  }
                }
              }
            ?>
            </form>
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