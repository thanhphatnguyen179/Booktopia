<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="admin/assets/images/Logo.png">

    <!-- Bootstrap Css -->
    <link href="admin/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="admin/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <style>
        .authentication-bg{
            background-image: url("admin/assets/images/login-img.jpg");
        }
    </style>

</head>

<body class="auth-body-bg">
<div class="home-btn d-none d-sm-block">
<a href="index.php"><i class="mdi mdi-home-variant h2 text-white"></i></a>
</div>
<div>
<div class="container-fluid p-0">
<div class="row no-gutters">
    <div class="col-lg-4">
        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
            <div class="w-100">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div>
                            <div class="text-center">
                                <div>
                                    <a href="index.php" class="logo"><img src="admin/assets/images/Logo.png" height="50" alt="logo"></a>
                                </div>

                                <h4 class="font-size-18">Đăng ký tài khoản</h4>
                            </div>

<div class="mt-4">
    <form class="form-horizontal" action="register_handler.php" method="POST">

        <div class="form-group auth-form-group-custom mb-4">
            <i class="ri-user-2-line auti-custom-input-icon"></i>
            <label for="fullname">Họ tên</label>
            <input type="text" class="form-control" id="fullname" name="name" placeholder="Nhập họ tên" required>
        </div>

        <div class="form-group auth-form-group-custom mb-4">
            <i class="ri-phone-line auti-custom-input-icon"></i>
            <label for="userphone">Số điện thoại</label>
            <input type="tel" class="form-control" id="userphone" name="phone" placeholder="Nhập số điện thoại" required>
        </div>

        <div class="form-group auth-form-group-custom mb-4">
            <i class="ri-mail-line auti-custom-input-icon"></i>
            <label for="useremail">Email</label>
            <input type="email" class="form-control" id="useremail" name="email" placeholder="Nhập email" required>
        </div>

        <div class="form-group auth-form-group-custom mb-4">
            <i class="ri-lock-2-line auti-custom-input-icon"></i>
            <label for="userpassword">Mật khẩu</label>
            <input type="password" class="form-control" id="userpassword" name="password" placeholder="Nhập mật khẩu" required>
        </div>

        <!-- Phần radio button -->
        <div class="form-group auth-form-group-custom mb-4">
            <h4 class="font-size-18 mt-4">Tôi là: </h4>
            <div class="custom-control custom-radio mb-3">
                <input type="radio" id="roleCustomer" name="userRole" value="customer" class="custom-control-input" checked>
                <label class="custom-control-label" for="roleCustomer">Khách hàng</label>
            </div>
            <div class="custom-control custom-radio mb-4">
                <input type="radio" id="roleOrganization" name="userRole" value="organization" class="custom-control-input">
                <label class="custom-control-label" for="roleOrganization">Tổ chức</label>
            </div>
        </div>

        <div class="text-center">
            <button class="btn btn-primary w-md waves-effect waves-light" type="submit" name="register">Đăng ký</button>
        </div>

        <div class="mt-2 text-center">
            <p class="mb-0">Bằng cách đăng ký, bạn đồng ý với <a href="#" class="text-primary">Điều khoản sử dụng</a></p>
        </div>
    </form>
</div>




                            <div class="text-center">
                                <p>Đã có tài khoản ? <a href="login.php" class="font-weight-medium text-primary"> Đăng nhập</a> </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="authentication-bg">
            <div class="bg-overlay"></div>
        </div>
    </div>
</div>
</div>
</div>



<!-- JAVASCRIPT -->
<script src="admin/assets/libs/jquery/jquery.min.js"></script>
<script src="admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="admin/assets/libs/simplebar/simplebar.min.js"></script>
<script src="admin/assets/libs/node-waves/waves.min.js"></script>

<script src="admin/assets/js/app.js"></script>

</body>
</html>
