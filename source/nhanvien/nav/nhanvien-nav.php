<div id="header">
      <?php
        require_once('../db/db.php');
        //Check tài khoản đã đăng nhập chưa
        if (!isset($_SESSION['email'])) {
          header('Location: ./login.php');
          exit();
        }
        $email = $_SESSION['email'];
        $sql = "SELECT * from `nhanvien` WHERE email = '$email'";
        $stm->bind_param("s", $email);
        if (!$stm->execute()) {
            die('Không tìm thấy' . $stm->error);
        }

        $result = $stm->get_result();
        $data = $result->fetch_assoc();
        $avatar = $data['avatar'];
        //Check tài khoản đã kích hoạt chưa
        if(!$data['activated'] == 1) {
          header("Location: ./process/activate.php");
          exit();
        }
      ?>
      <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="./index.php">Employee Management</a>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <div class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">Công việc</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="./myproject.php">Danh sách công việc</a>
                </div>
            </div>
            <div class="nav-item dropdown">
              <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">Nghỉ phép</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="./apply-dayoff.php">Xin nghỉ phép</a>
                <a class="dropdown-item" href="./history-dayoff.php">Lịch sử nghỉ phép</a>
                </div>
            </div>
          </ul>
        </div>
        <div class="navbar-nav ml-auto">
        <div class="nav-item dropdown">
    				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"><img src="../<?= $avatar ?>" class="avatar" alt="Avatar" style="width: 40px; height: 40px; border-radius: 30px;"> <?= $_SESSION['name']?><b class="caret"></b></a>
    				<div class="dropdown-menu">
    					<a href="./myprofile.php" class="dropdown-item">My Profile</a>
    					<a href="./change-password.php" class="dropdown-item">Đổi mật khẩu</a>
    					<div class="dropdown-divider"></div>
    					<a class="dropdown-item" href="../logout.php">Đăng xuất</a>
    				</div>
    			</div>
    		</div>
      </nav>
    </div>