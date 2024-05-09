<?php
    include 'header.php';
    if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {

        header("Location: index.php");
      }
      if ($_SESSION['role']  != 0) {
        header("Location: login.php");
      }
?>

<section class="section">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Your Profile</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#0">Travel.mm</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    profile
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card-style settings-card-1 mb-30">
                    <div class="title mb-30 d-flex justify-content-between align-items-center">
                        <h6>Your Profile</h6>
                    </div>
                    <div class="profile-info">
                        <div class="d-flex align-items-center mb-30">
                            <div class="profile-image">
                                <img src="admin/assets/images/user_image/<?php echo $_SESSION['image'] ?>" alt="" style="height:100%;object-fit:cover" />
                                <div class="update-image">
                                    <input type="file" />
                                    <label for=""><i class="lni lni-cloud-upload"></i></label>
                                </div>
                            </div>
                            <div class="profile-meta">
                                <h5 class="text-bold text-dark mb-10"><?php echo $_SESSION['username'] ?></h5>
                                <p class="text-sm text-gray">User</p>
                            </div>
                        </div>
                        <div class="input-style-1">
                            <label>Email</label>
                            <input type="email" value="<?php echo $_SESSION['email'] ?>" disabled />
                        </div>
                        <div class="input-style-1">
                            <label>Password</label>
                            <input type="password" value="<?php echo $_SESSION['password'] ?>" disabled />
                        </div>


                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <?php

            if ($_POST) {
                if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])  || empty($_FILES['image'])) {
                    if (empty($_POST['username'])) {
                        $nameError = "Name can be required";
                        $nameErrorColor = "1px solid red";
                    }
                    if (empty($_POST['email'])) {
                        $emailError = "Email can be required";
                        $emailErrorColor = "1px solid red";
                    }

                    if (empty($_POST['password'])) {
                        $passwordError = "Password can be required";
                        $passwordErrorColor = "1px solid red";

                    }

                    if (empty($_FILES['image'])) {
                        $imageError = "Image can be required";
                        $imageErrorColor = "1px solid red";

                    }
                } else {
                    $id = $_SESSION['user_id'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    $file = 'user_image/' . ($_FILES['image']['name']);
                    $imageType = pathinfo($file, PATHINFO_EXTENSION);

                    if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg') {
                        echo "<script>alert('Image must be png,jpg,jpeg')</script>";
                    } else {
                        $image = $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'], $file);

                        $stmt = $pdo->prepare("UPDATE users SET username='$username' ,email='$email',password='$password', image='$image' WHERE id='$id' ");
                        $result = $stmt->execute();
                        if ($result) {
                            echo "<script>alert('successfully Updated');window.location.href='login.php';</script>";
                            //header('Location: index.php');
                        };
                    };
                }
            }

            ?>

            <div class="col-lg-6">
                <div class="card-style settings-card-2 mb-30">
                    <div class="title mb-30 d-flex justify-content-between align-items-center">
                        <h6>Edit Your Profile</h6>
                        <button class="border-0 bg-transparent">
                            <i class="lni lni-pencil-alt"></i>
                        </button>
                    </div>
                    <form action="profile.php" method="post" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">

                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label><?php echo empty($nameError) ? '<p>Full Name</p>' : '<p style="color:red">Name can be required</p>' ?></label>
                                    <input type="text" placeholder="Full Name" name="username" style='border:<?php echo $nameErrorColor ?>'/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-style-1">
                                <label><?php echo empty($emailError) ? '<p>Email</p>' : '<p style="color:red">Email can be required</p>' ?></label>
                                    <input type="email" placeholder="Email" name="email" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-style-1">
                                <label><?php echo empty($passwordError) ? '<p>Password</p>' : '<p style="color:red">Password can be required</p>' ?></label>
                                    <input type="password" placeholder="Password" name="password" />
                                </div>
                            </div>


                            <div class="col-xxl-4">
                                <div class="input-style-1">
                                <label><?php echo empty($imageError) ? '<p>Image</p>' : '<p style="color:red">Image can be required</p>' ?></label>
                                    <input type="file" name="image" value=""/>
                                </div>
                            </div>



                            <div class="col-12">
                                <button class="main-btn primary-btn btn-hover" type="submit">
                                    Update  Profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>

<?php
    include 'footer.php';
?>