
<div class="container">
    <div class="row">
        <div id="layout-account"  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="userbox">
                <div class="header-account clearfix">
                    <!-- <i class="fa fa-key"></i> -->
                    <h2>Thay đổi thông tin tài khoản</h2>
                </div>
                <?php 
                    $user_model = new User();
                    $user = $_SESSION['user'];
                ?>
                <form accept-charset='UTF-8' action="" id='create_customer' method='post'>
                    <input name='form_type' type='hidden' value='create_customer'>
                    <input name='utf8' type='hidden' value='✓'>
                    
                    <div class="clearfix large_form">
                        <label for="username" class="icon-field">Tài khoản</label>
                        <input style="background: #dddddd;" readonly type="text" value="<?php echo $_SESSION['user']['username']; ?>" name="username" id="username" placeholder="Username" class="text" />
                    </div>


                    <div class="clearfix large_form">
                        <label for="password" class="icon-field">Mật khẩu cũ</label>
                        <input required type="password" value="" name="password" id="password" placeholder="Mật khẩu cũ" class="text" size="16" />
                    </div>

                    <div class="clearfix large_form">
                        <label for="new_password" class="icon-field">Mật khẩu</label>
                        <input required type="password" value="" name="new_password" id="new_password" placeholder="Mật khẩu mới" class="text" size="16" />
                    </div>

                    <div id="first_name" class="clearfix large_form">
                        <label for="first_name" class="label icon-field">Họ</label>
                        <input required type="text" value="<?php echo $_SESSION['user']['first_name']; ?>" name="first_name" class="text" size="30" />
                    </div>
                    <div id="last_name" class="clearfix large_form">
                        <label for="last_name" class="label icon-field">Tên</label>
                        <input required type="text" value="<?php echo $_SESSION['user']['last_name']; ?>" name="last_name" placeholder="Tên" class="text" size="30" />
                    </div>

                    <div class="clearfix large_form">
                        <label for="phone" class="icon-field">Số điện thoại</label>
                        <input required type="text" value="<?php echo $_SESSION['user']['phone']; ?>" name="phone" id="phone" placeholder="Phone" class="text" />
                    </div>
                    <div class="clearfix large_form">
                        <label for="address" class="icon-field">Địa chỉ</label>
                        <input required type="text" value="<?php echo $_SESSION['user']['address']; ?>" name="address" id="address" placeholder="Address" class="text" />
                    </div>

                    <div id="email" class="clearfix large_form">
                        <label for="email" class="label icon-field">Đia chỉ email</label>
                        <input required type="email" value="<?php echo $_SESSION['user']['email']; ?>" placeholder="Email" name="email" class="text" size="30" />
                    </div>

                    <div class="action_bottom">
                        <input class="btn" type="submit" name="edit" value="Thay đổi" />
                    </div>
                    <div class="req_pass">
                        <a class="come-back" href="index.php">Quay về</a>
                    </div>



            </div>

        </div>

    </div>
</div>