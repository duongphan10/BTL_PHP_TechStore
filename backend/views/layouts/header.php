<!--views/layouts/header.php-->
<?php
//do đã có dữ liệu từ chức năng đăng nhập
//nên sẽ lấy thông tin thật từ session user đã tạo
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
//die;
?>
<header class="main-header">
    <!-- Logo -->
    <a href="../index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>T</b>S</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>TechStore</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <i class="fa fa-bars"></i>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="assets/images/admin.png" class="user-image" alt="User Image">
                        <span class="hidden-xs">
                            <?php echo $_SESSION['user']['username']; ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="assets/images/admin.png" class="img-circle" alt="User Image">

                            <p>
                                <?php echo $_SESSION['user']['first_name'] .' ' . $_SESSION['user']['last_name'];?> - TechStore Manager
                                <small>Thành viên từ năm 2023</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <!-- <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Thông tin</a>
                            </div> -->
                            <div class="pull-right">
                                <a href="index.php?controller=login&action=logout"
                                   class="btn btn-default btn-flat">
                                    Sign out
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header" style="font-size: large; color: white;"><b>Thông tin quản lý</b></li>

            <li>
                <a href="index.php?controller=category&action=index">
                    <i class="fa fa-th"></i> <span>Quản lý danh mục</span>
                    <span class="pull-right-container">
                    <!--<small class="label pull-right bg-green">new</small>-->
                    </span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=product&action=index">
                    <i class="fa fa-lemon"></i> <span>Quản lý sản phẩm</span>
                    <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=slide&action=index">
                    <i class="fa fa-images"></i> <span>Quản lý banner</span>
                    <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>

                </a>

            </li>
            <li>
                <a href="index.php?controller=new&action=index">
                    <i class="fa fa-newspaper"></i> <span>Quản lý tin tức</span>
                    <span class="pull-right-container">
                    <!--<small class="label pull-right bg-green">new</small>-->
                    </span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=introduce&action=index">
                    <i class="fa fa-inbox"></i> <span>Quản lý giới thiệu</span>
                    <span class="pull-right-container">
                        <!--<small class="label pull-right bg-green">new</small>-->
                    </span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=map&action=index">
                    <i class="fa fa-map"></i> <span>Quản lý bản đồ</span>
                    <span class="pull-right-container">
                    <!--<small class="label pull-right bg-green">new</small>-->
                    </span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=order&action=index">
                    <i class="fa fa-shopping-basket"></i> <span>Quản lý đặt hàng</span>
                    <span class="pull-right-container">
                    <!--<small class="label pull-right bg-green">new</small>-->
                    </span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=orderdetail&action=index">
                    <i class="fa fa-money-check-alt"></i> <span>Quản lý thanh toán</span>
                    <span class="pull-right-container">
                    <!--<small class="label pull-right bg-green">new</small>-->
                    </span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=login&action=index">
                    <i class="fa fa-user"></i> <span>Quản lý người dùng</span>
                    <span class="pull-right-container">
                    <!--<small class="label pull-right bg-green">new</small>-->
                    </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Breadcrumd Wrapper. Contains breadcrumb -->
<!-- <div class="breadcrumb-wrap content-wrap content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
</div> -->