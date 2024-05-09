<?php

session_start();
require 'config/config.php';
require 'config/common.php';
if (!empty($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header("Location: admin/index.php");
    } else {
        header("Location: index.php");
    }
}



?>

<?php
$link = $_SERVER['PHP_SELF'];
$link_array = explode('/', $link);
$page = end($link_array);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>travel.com.mm</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="admin/assets/css/lineicons.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="admin/assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="admin/assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="admin/assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="admin/assets/css/main.css" />
    <style>
        ul {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-right: 10%;
        }

        ul li {
            display: flex;
            flex-direction: row;
            margin-right: 5%;

        }

        ul li a:hover {
            background: #365CF5;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        ul li .active {
            background: #365CF5;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        ul li i {
            padding-right: 10px;
        }

        ul li a {
            display: flex;
        }

        .photo-image:hover {
            transition: ease-in-out 2s;
        }
    </style>

</head>

<body>

    <div class="row">
        <div class="col-12">
            <div class="card-style" style="display:flex;justify-content:space-between;width:100%;padding:20px 10% 20px 10%;">
                <div class="header-left d-flex align-items-center">
                    <div class="navbar-logo">
                        <a href="index.php">
                            <!-- <img src="assets/images/logo/logo.svg" alt="logo" /> -->
                            <h2 style="font-size:2rem;font-family:fantasy;padding:10px 0;color:#365CF5;">Travel.mm</h2>
                        </a>
                    </div>
                </div>
                <ul class="icons">
                    <li class="trigger Free">
                        <a href="index.php" class="<?php echo $page == 'index.php' ? 'active' : '' ?>"><i class="lni lni-home"></i><span>Home</span></a>
                    </li>
                    <li class="trigger Free">
                        <a href="post.php" class="<?php echo $page == 'post.php' ? 'active' : '' ?>"><i class="lni lni-popup"></i><span>Posts</span></a>
                    </li>
                    <li class="trigger Free">
                        <a href="about.php" class="<?php echo $page == 'about.php' ? 'active' : '' ?>"><i class="lni lni-wallet"></i><span>About</span></a>
                    </li>
                    <li class="trigger Free">

                        <a href="contact.php" class="<?php echo $page == 'contact.php' ? 'active' : '' ?>"><i class="lni lni-tag"></i><span>Contact</span></a>
                    </li>
                    <li class="trigger Free">
                        <a href="photo.php" class="<?php echo $page == 'photo.php' ? 'active' : '' ?>"><i class="lni lni-image"></i><span>Photo</span></a>
                    </li>
                    <li class="trigger Free">
                        <?php if (empty($_SESSION['logged_in']) && empty($_SESSION['username'])) { ?>


                            <a href="login.php"><i class="lni lni-enter"></i><span>Login</span></a>



                        <?php } else { ?>
                            <div class="header" style="padding:0">
                                <div class="header-right">
                                    <!-- profile start -->
                                    <div class="profile-box ml-15">
                                        <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="profile-info">
                                                <div class="info">
                                                    <div class="image">
                                                        <img src="admin/assets/images/user_image/<?php echo $_SESSION['image'] ?>" alt="" style="height: 100%;object-fit:cover" />
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-500" style="color:#365CF5;"><?php echo $_SESSION['username'] ?></h6>
                                                        <p>user</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                            <li>
                                                <div class="author-info flex items-center !p-1">
                                                    <div class="image">
                                                        <img src="admin/assets/images/user_image/<?php echo $_SESSION['image'] ?>" alt="image">
                                                    </div>
                                                    <div class="content">
                                                        <h4 class="text-sm"><?php echo $_SESSION['username'] ?></h4>
                                                        <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs" style="font-size: 10px;" href="#"><?php echo $_SESSION['email'] ?></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="user-post.php">
                                                    <i class="lni lni-support"></i> Your Post
                                                </a>
                                            </li>
                                            <li>
                                                <a href="profile.php">
                                                    <i class="lni lni-user"></i> View Profile
                                                </a>
                                            </li>

                                            <li class="divider"></li>
                                            <li>
                                                <a href="user-logout.php"> <i class="lni lni-exit"></i> Sign Out </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- profile end -->
                                <?php  } ?>
                                </div>
                            </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>