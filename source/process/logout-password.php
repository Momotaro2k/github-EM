<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
    <title>Đăng xuất</title>  
  </head>
  <body onload="countLogout();">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mt-5 mx-auto p-3 border rounded bg-white">
            <h4>Đổi mật khẩu thành công</h4>
            <p>Vui lòng đăng nhập lại</p>
            <p>Nhấn <a href="../login.php">vào đây</a> để trở về trang đăng nhập, hoặc trang web sẽ tự động chuyển hướng sau <span id="counter" class="text-danger">5</span> giây nữa.</p>
            <a class="btn btn-success px-5" href="../login.php">Đăng nhập</a>
          </div>
        </div>
      </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="../main.js"></script> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
  </body>
</html>
