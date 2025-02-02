<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Login </title>
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

        <!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.15/dist/sweetalert2.min.css" rel="stylesheet">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.15/dist/sweetalert2.all.min.js"></script>

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
                                                    <a href="index.php" class="logo"><img src="admin/assets/images/Logo.png" height="100" alt="logo"></a>
                                                </div>
    
                                                <h4 class="font-size-18 mt-4">Welcome Back !</h4>
                                                <p class="text-muted">Đăng nhập để tiếp tục đến với Booktopia</p>
                                            </div>

                                            <div class="p-2 mt-5">
                                                <form class="form-horizontal" action="./admin/functions/functions/login.php" method="post">
                    
                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-user-2-line auti-custom-input-icon"></i>
                                                        <label for="username">Số điện thoại</label>
                                                        <input type="text" class="form-control" id="username" placeholder="Enter phone number" name="username" required >
                                                    </div>
                            
                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                        <label for="password">Mật khẩu</label>
                                                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required >
                                                    </div>
                            
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                                        <label class="custom-control-label" for="customControlInline">Ghi nhớ cho lần đăng nhập sau</label>
                                                    </div>

                                                    <div class="mt-4 text-center">
                                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit" name="login">Đăng nhập</button>
                                                    </div>

                                                    <div class="mt-4 text-center">
                                                        <a href="auth-recoverpw.php" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Quên mật khẩu?</a>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="mt-5 text-center">
                                                <p>Chưa có tài khoản ? <a href="register.php" class="font-weight-medium text-primary"> Đăng ký </a> </p>
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
