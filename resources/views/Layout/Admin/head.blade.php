<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carbon - Admin Template</title>
    <link rel="stylesheet" href="{{asset('/js/admin/index/vendor/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('/js/admin/index/vendor/font-awesome/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/admin/index/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/page.css')}}">
</head>
<body>
<div class="page-wrapper">
    <nav class="navbar page-header">
        <a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto">
            <i class="fa fa-bars"></i>
        </a>
        <a class="navbar-brand" href="#">
            <img src="{{asset('/images/admin/index/logo.png')}}" alt="logo">
        </a>
        <a href="#" class="btn btn-link sidebar-toggle d-md-down-none">
            <i class="fa fa-bars"></i>
        </a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item d-md-down-none">
                <a href="#">
                    <i class="fa fa-bell"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
            </li>
            <li class="nav-item d-md-down-none">
                <a href="#">
                    <i class="fa fa-envelope-open"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('/images/admin/index/avatar-1.png')}}" class="avatar avatar-sm" alt="logo">
                    <span class="small ml-1 d-md-down-none">{{$name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header">Account</div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-user"></i> Profile
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-envelope"></i> Messages
                    </a>
                    <div class="dropdown-header">Settings</div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-bell"></i> Notifications
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-wrench"></i>个人设置
                    </a>
                    <a href="/login/logout" class="dropdown-item">
                        <i class="fa fa-lock"></i>退出
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="main-container">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <?php foreach($menu as $mk=>$mv){ ?>
                        <li class="nav-title"><?php echo $mk;?></li>
                        <?php foreach($mv as $mvk=>$mvv){ ?>
                            <li class="nav-item <?php echo $mvv['class']?>">
                                <a href="<?php echo $mvv['href']?>" class="nav-link <?php echo $mvv['nav-link']?>">
                                    <i class="icon <?php echo $mvv['icon']?>"></i><?php echo $mvv['name']?><?php echo $mvv['nav-link']?'<i class="fa fa-caret-left"></i>':''; ?>
                                </a>
                                <?php if(!empty($mvv['child'])){ ?>
                                    <ul class="nav-dropdown-items">
                                        <?php foreach($mvv['child'] as $mvvk=>$mvvv){ ?>
                                            <li class="nav-item">
                                                <a href="<?php echo $mvvv['href']?>" class="nav-link">
                                                    <i class="icon <?php echo $mvvv['icon']?>"></i><?php echo $mvvv['name']?>
                                                </a>
                                            </li>
                                        <?php }?>
                                    </ul>
                                <?php }?>
                            </li>
                        <?php }?>
                    <?php } ?>
                </ul>
            </nav>
        </div>
