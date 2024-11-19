
<?php ob_start(); ?>





<?php include('includes/db.php'); ?>
<?php include('includes/header.php'); ?>



<div class="main-wrapper">
<?php include('includes/nav_bar.php'); ?>

<div class="contact-main-page">
            <div class="container">
                <a href="https://maps.app.goo.gl/iksVoGCkXvCZLJ3eA">
                    <img src="assets/images/map.png" alt="Map">
                </a>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                        <div class="contact-page-side-content">
                            <h3 class="contact-page-title">Liên hệ với chúng tôi</h3>
                            <p class="contact-page-message">Hãy liên hệ với chúng tôi thông qua thông tin dưới đây. Chúng tôi sẽ hỗ trợ bạn sớm nhất có thể.</p>
                            <div class="single-contact-block">
                                <h4><i class="fa fa-fax"></i> Địa chỉ</h4>
                                <p>Khu II, Đ. 3 Tháng 2, Xuân Khánh, Ninh Kiều, Cần Thơ, Việt Nam</p>
                            </div>
                            <div class="single-contact-block">
                                <h4><i class="fa fa-phone"></i> Điện thoại</h4>
                                <p>Mobile: 0949 445 708</p>
                                <p>Hotline: 0292 3831 530</p>
                            </div>
                            <div class="single-contact-block last-child">
                                <h4><i class="fa fa-envelope-o"></i> Email</h4>
                                <p>yasuohasagi369@gmail.com</p>
                                <p>support@cit.ctu.edu.vn</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                        <div class="contact-form-content">
                            <h3 class="contact-page-title">Gửi đến chúng tôi thông điệp của bạn</h3>
                            <div class="contact-form">
                                <form id="contact-form" action="http://hasthemes.com/file/mail.php" method="post">
                                    <div class="form-group">
                                        <label>Quý danh của bạn <span class="required">*</span></label>
                                        <input type="text" name="con_name" id="con_name" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Email <span class="required">*</span></label>
                                        <input type="email" name="con_email" id="con_email" required="">
                                    </div>
                                    
                                    <div class="form-group form-group-2">
                                        <label>Lời nhắn</label>
                                        <textarea name="con_message" id="con_message"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" value="submit" id="submit" class="alsita-contact-form_btn" name="submit">gửi</button>
                                    </div>
                                </form>
                            </div>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



<?php include('includes/project-count-area.php') ?>




<?php include('includes/new_arrival.php'); ?>


</div>

<?php include('includes/footer.php'); ?>

<?php ob_end_flush(); ?>