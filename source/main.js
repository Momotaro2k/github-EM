function validateForm() {
  let email = document.getElementById("email");
  let pwd = document.getElementById("pwd");
  let errorMsg = document.getElementById("errorMsg");

  if (email.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập email</div>";
    return false;
  } else if (!email.value.includes("@")) {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Thiếu @ vui lòng nhập đúng format</div>";
    return false;
  } else if (pwd.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập mật khẩu</div>";
    return false;
  } else if (pwd.value.length < 6) {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Mật khẩu cần ít nhất 6 ký tự</div>";
    return false;
  } else {
    return true;
  }
}

function clearMessage() {
  let errorMsg = document.getElementById("errorMsg");

  errorMsg.innerHTML = "";
}

function validateEmployeeAdd() {
  let userName = document.getElementById("username");
  let firstName = document.getElementById("firstname");
  let lastName = document.getElementById("lastname");
  let email = document.getElementById("email");
  let phongBan = document.getElementById("phongban");
  let error = document.getElementById("errorMsg");

  if (userName.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập username</div>";
    return false;
  } else if (firstName.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập firstname</div>";
    return false;
  } else if (lastName.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập lastname</div>";
    return false;
  } else if (email.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập email</div>";
    return false;
  } else if (!email.value.includes("@")) {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Email sai format</div>";
    return false;
  } else if (phongBan.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng chọn phòng ban</div>";
    return false;
  } else return true;
}

function confirmEmployeeAdd() {
  if (confirm("Bạn muốn thêm nhân viên?") == true) {
    return true;
  }
  return false;
}

function confirmAvatar() {
  if (confirm("Bạn muốn đổi ảnh đại diện?") == true) {
    return true;
  }
  return false;
}

function validateDepartment() {
  let maPB = document.getElementById("maPB");
  let tenPB = document.getElementById("tenPB");
  let mota = document.getElementById("mota");
  let errorMsg = document.getElementById("errorMsg");

  if (maPB.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập mã phòng ban</div>";
    return false;
  } else if (tenPB.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập tên phòng ban</div>";
    return false;
  } else if (mota.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập mô tả phòng ban</div>";
    return false;
  }
  alert("Thành công");
  return true;
}

function confirmUpdate() {
  if (confirm("Bạn có chắc với sự thay đổi này?") == true) {
    return true;
  } else return false;
}

function confirmReset() {
  if (confirm("Bạn có chắc muốn reset mật khẩu nhân viên này?") == true) {
    alert("Thành công");
    return true;
  } else return false;
}

function confirmAdd() {
  if (confirm("Bạn có chắc là muốn tạo thêm?") == true) {
    return true;
  } else return false;
}

function confirmManager() {
  if (confirm("Bạn có chắc muốn bổ nhiệm người này?") == true) {
    alert("Thành công");
    return true;
  } else return false;
}

function confirmDelete() {
  if (confirm("Bạn có chắc là muốn xóa?") == true) {
    alert("Thành công");
    return true;
  } else return false;
}

function back() {
  window.location.href = "javascript:history.go(-1)";
}

function validateProject() {
  let tenCV = document.getElementById("tenCV");
  let maNV = document.getElementById("maNV");
  let start = document.getElementById("start");
  let end = document.getElementById("end");
  let mota = document.getElementById("mota");
  let errorMsg = document.getElementById("errorMsg");

  if (tenCV.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập tên công việc</div>";
    return false;
  } else if (maNV.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập tên nhân viên</div>";
    return false;
  } else if (start.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng chọn ngày bắt đầu</div>";
    return false;
  } else if (end.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng chọn ngày kết thúc</div>";
    return false;
  } else if (mota.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng mô tả công việc</div>";
    return false;
  } else {
    return true;
  }
}

function confirmStart() {
  if (confirm("Bạn có chắc là muốn bắt đầu?") == true) {
    alert("Thành công");
    btn = 1;
    return true;
  } else return false;
}

function validateActivate() {
  let pwd = document.getElementById("pass");
  let pwd2 = document.getElementById("pass2");
  let errorMsg = document.getElementById("errorMsg");

  if (pwd.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập mật khẩu mới</div>";
    return false;
  } else if (pwd2.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng xác nhận lại mật khẩu</div>";
    return false;
  } else if (pwd.value.length < 6) {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Mật khẩu cần ít nhất 6 ký tự</div>";
    return false;
  } else if (pwd.value != pwd2.value) {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Mật khẩu không trùng khớp</div>";
    return false;
  } else {
    return true;
  }
}

function validatePassword() {
  let old_pwd = document.getElementById("old_pwd");
  let pwd = document.getElementById("pass");
  let pwd2 = document.getElementById("pass2");
  let errorMsg = document.getElementById("errorMsg");

  if (old_pwd.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập mật khẩu cũ</div>";
    return false;
  } else if (pwd.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập mật khẩu mới</div>";
    return false;
  } else if (pwd.value.length < 6) {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Mật khẩu cần ít nhất 6 ký tự</div>";
    return false;
  } else if (old_pwd.value == pwd.value) {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Mật khẩu mới phải khác mật khẩu cũ</div>";
    return false;
  } else if (pwd2.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng xác nhận lại mật khẩu</div>";
    return false;
  } else if (pwd.value != pwd2.value) {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Mật khẩu không trùng khớp</div>";
    return false;
  } else {
    alert("Đổi mật khẩu thành công");
    return true;
  }
}

function validateAvatar() {
  let avatar = document.getElementById("avatar");
  let errorMsg = document.getElementById("errorMsg");

  if (avatar.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Chưa chọn ảnh đại diện</div>";
    return false;
  } else return true;
}

function validateInformationChange() {
  let FName = document.getElementById("firstname");
  let LName = document.getElementById("lastname");
  let errorMsg = document.getElementById("errorMsg");

  if (FName.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Firstname không được trống</div>";
    return false;
  } else if (LName.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Lastname không được trống</div>";
    return false;
  } else {
    alert("Sửa thông tin thành công");
    return true;
  }
}
function validateEmployeeChange() {
  let UName = document.getElementById("username");
  let FName = document.getElementById("firstname");
  let LName = document.getElementById("lastname");
  let errorMsg = document.getElementById("errorMsg");

  if (UName.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Username không được trống</div>";
    return false;
  } else if (FName.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Firstname không được trống</div>";
    return false;
  } else if (LName.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Lastname không được trống</div>";
    return false;
  } else {
    alert("Sửa thông tin thành công");
    return true;
  }
}

function confirmRefuse() {
  if (confirm("Bạn muốn từ chối?") == true) {
    alert("Thành công");
    return true;
  } else return false;
}

function confirmAccept() {
  if (confirm("Bạn muốn chấp nhận?") == true) {
    alert("Thành công");
    return true;
  } else return false;
}

function validateDayOff() {
  let reason = document.getElementById("reason");
  let start = document.getElementById("start");
  let end = document.getElementById("end");

  if (reason.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng nhập lý do</div>";
    return false;
  } else if (start.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng chọn ngày bắt đầu</div>";
    return false;
  } else if (end.value == "") {
    errorMsg.innerHTML =
      "<div class='alert alert-danger'>Vui lòng chọn ngày kết thúc</div>";
    return false;
  } else {
    alert("Nộp đơn thành công");
    return true;
  }
}

function countLogout() {
  let duration = 5;
  let countDown = 5;
  let id = setInterval(() => {
    countDown--;
    if (countDown >= 0) {
      $("#counter").html(countDown);
    }
    if (countDown == -1) {
      clearInterval(id);
      window.location.href = "../login.php";
    }
  }, 1000);
}
