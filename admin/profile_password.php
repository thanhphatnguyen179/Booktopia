<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Thay đổi mật khẩu</h4>
                    </div>
                </div>
            </div>

            <!-- Change Password Form -->
            <form action="./functions/canhan/profile_change_password.php" method="POST" onsubmit="return validatePassword()">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="old_password">Mật khẩu cũ</label>
                            <input type="password" class="form-control" name="old_password" id="old_password" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="new_password">Mật khẩu mới</label>
                            <input type="password" class="form-control" name="new_password" id="new_password" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                            <span id="passwordError" style="color:red;"></span>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Cập nhật mật khẩu</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
// JavaScript function to validate password
function validatePassword() {
    var oldPassword = document.getElementById('old_password').value;
    var newPassword = document.getElementById('new_password').value;
    var confirmPassword = document.getElementById('confirm_password').value;
    var passwordError = document.getElementById('passwordError');

    // Check if the new password and confirm password match
    if (newPassword !== confirmPassword) {
        passwordError.textContent = "Mật khẩu mới và xác nhận mật khẩu không khớp.";
        return false;  // Prevent form submission
    }

    // Check if the new password is different from the old password
    if (oldPassword === newPassword) {
        passwordError.textContent = "Mật khẩu mới không được giống mật khẩu cũ.";
        return false;  // Prevent form submission
    }

    passwordError.textContent = "";  // Clear error message
    return true;  // Allow form submission
}
</script>

</body>
</html>
