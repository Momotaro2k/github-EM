<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="./style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Login</title>
</head>
  <body>
    <?php
      session_start();
      error_reporting(0);
      ini_set('display_errors', 0);
      $error = $_SESSION['error'];

      if (isset($_SESSION['email'])) {
        header('Location: ./index.php');
        exit();
      }
    ?>
    <div class="container">
      <label class="logo"><strong>Employee</strong> Management</label>
      <form onsubmit="return validateForm()"; class="login-form" method="post" action="./process/validate.php">
        <div class="form-content">
          <p class="login-text">Sign in here</p>
          <div class="input-box">
            <div class="email">
              <label>Email:</label>
              <input onkeydown="return clearMessage()"; id="email" type="email" placeholder="Email" name="email" value="" />
              <br />
            </div>
            <div class="pwd">
              <label>Password:</label>
              <input
              onkeydown="return clearMessage()";
              id="pwd"
                type="password"
                placeholder="Password"
                name="pwd"
                value=""
              />
            </div>
          </div>
          <p id="errorMsg"><?= $error ?></p>
          <button class="button">Đăng nhập</button>
        </div>
      </form>
    </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="./main.js"></script> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
  </body>
</html>
