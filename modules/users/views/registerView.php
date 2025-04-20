<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>
    <link href="public/reset.css" rel="stylesheet" type="text/css"/>
    <link href="public/register.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div class="wrapper">
        <div id="wp-form-register">
            <h1 id="head-form">ĐĂNG KÝ TÀI KHOẢN</h1>
            <form id="form-register" action="" method="POST">
                
                <label for="fullname">Họ và tên</label>
                <input type="text" name="fullname" id="fullname" placeholder="Họ tên" value="<?php echo set_value('fullname'); ?>">
                <?php echo form_error('fullname'); ?>

                <label for="display_name">Tên hiển thị</label>
                <input type="text" name="display_name" id="display_name" placeholder="Tên hiển thị" value="<?php echo set_value('display_name'); ?>">
                <?php echo form_error('display_name'); ?>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
                <?php echo form_error('email'); ?>

                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" id="username" placeholder="Tên đăng nhập" value="<?php echo set_value('username'); ?>">
                <?php echo form_error('username'); ?>

                <label for="password">Mật khẩu</label>
                <input type="password" name="password" id="password" placeholder="Mật khẩu">
                <?php echo form_error('password'); ?>

                <label for="confirm_password">Xác nhận mật khẩu</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Nhập lại mật khẩu">
                <?php echo form_error('confirm_password'); ?>

                <input type="submit" id="btn-register" name="btn-register" value="Đăng ký">
                <?php echo form_error('success'); ?>
                <div class="login-link">
                    <a href="dang-nhap.html">Đã có tài khoản? Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
