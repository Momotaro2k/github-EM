<!-- ok -->
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Thêm công việc</title>
      <?php
        session_start();
        require_once('../db/db.php');

        //Check có phải admin không
        $email = $_SESSION['email'];
        $sql = "SELECT * from `nhanvien` WHERE `email` = ?";
        $stm = $conn->prepare($sql);
        $stm->bind_param("s", $email);
        if (!$stm->execute()) {
          die('Cannot select' . $stm->error);
        }
        $result = $stm->get_result();
        $data = $result->fetch_assoc();
        require_once('./nav/truongphong-nav.php');
        
        $phongBan = $data['phongBan'];
        $truongPhong = 'Trưởng Phòng';
        $sql = "SELECT * from `nhanvien` WHERE `phongBan` = ? AND `chucVu` != ?";
        $stm = $conn->prepare($sql);
        $stm->bind_param("ss", $phongBan, $truongPhong);
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
          <h5 class="text-center mb-1">Thêm công việc</h5>
          <form onsubmit="return validateProject()"; method="post" action="../process/add-project.php">
            <div class="form-group">
              <label for="tenCV">Tên công việc</label>
              <input
                oninput="clearMessage()";
                type="text"
                value=""
                name="tenCV"
                id="tenCV"
                class="form-control"
                placeholder="Tên công việc"
              />
            </div>
            <div class="form-group">
              <label for="maNV">Nhân viên</label> <br>
              <select name="maNV" id="maNV" class="form-control">
                <optgroup label="<?=$data['phongBan']?>" >
                  <?php
                    while($data = $result->fetch_assoc()){
                      ?>
                      <option value="<?=$data['email']?>"><?=$data['email']?></option>
                      <?php
                    }
                  ?>
                  
                </optgroup>
              </select>
            </div>
            <div class="form-group form-row">
              <div class="form-group col-md-6">
                  <label for="start">Ngày bắt đầu</label>
                  <input onclick="clearMessage()"; value="" name="start" class="form-control" type="date" placeholder="Ngày bắt đầu" id="start">
              </div>
              <div class="form-group col-md-6">
                  <label for="end">Ngày kết thúc`</label>
                  <input onclick="clearMessage()";value="" name="end" class="form-control" type="date" placeholder="Ngày kết thúc" id="end">
              </div>
            </div>
            <div class="form-group">
              <label for="mota">Mô tả</label>
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
            <button onclick="return confirmAdd()"; class="btn btn-success px-5 mr-2">Thêm công việc</button>
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
