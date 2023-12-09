<h2>Thêm mới người dùng</h2>
<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="username">Nhập username</label>
        <input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>"
               class="form-control" id="username" required/>
    </div>
    <div class="form-group">
        <label for="password">Nhập password</label>
        <input type="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>"
               class="form-control" id="password" required/>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control" id="role">
            <?php
            $selected_active = '';
            $selected_disabled = '';
            if (isset($_POST['role'])) {
                switch ($_POST['role']) {
                    case 0:
                        $selected_disabled = 'selected';
                        break;
                    case 1:
                        $selected_active = 'selected';
                        break;
                }
            }
            ?>
            <option value="0" <?php echo $selected_disabled; ?>>User</option>
            <option value="1" <?php echo $selected_active ?>>Admin</option>
        </select>
    </div>
    <div class="form-group">
        <label for="first_name">Nhập First Name</label>
        <input type="text" name="first_name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>"
               class="form-control" id="first_name" required/>
    </div>

    <div class="form-group">
        <label for="last_name">Nhập Last Name</label>
        <input type="text" name="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>"
               class="form-control" id="last_name" required/>
    </div>

    <div class="form-group">
        <label for="phone">Nhập Phone</label>
        <input type="text" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>"
               class="form-control" id="phone" required/>
    </div>
    
    <div class="form-group">
        <label for="address">Nhập Address</label>
        <input type="text" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>"
               class="form-control" id="address" required/>
    </div>

    <div class="form-group">
        <label for="email">Nhập Email</label>
        <input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"
               class="form-control" id="email" required/>
    </div>

    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary"/>
        <a href="index.php?controller=product&action=index" class="btn btn-default">Back</a>
    </div>
</form>