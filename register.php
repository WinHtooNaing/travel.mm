<?php

session_start();

require 'config/config.php';
require 'config/common.php';


if ($_POST) {
  if (
    empty($_POST['username']) || empty($_POST['email']) || empty(($_FILES['image']))
    || empty($_POST['password']) || strlen($_POST['password']) < 4
  ) {
    if (empty($_POST['username'])) {
      $nameError = 'Name is required';
      $nameErrorColor = "1px solid red";
    }
    if (empty($_POST['email'])) {
      $emailError = 'Email is required';
      $emailErrorColor = "1px solid red";
    }
    if (empty($_FILES['image'])) {
      $imageError = 'Image is required';
      $imageErrorColor = "1px solid red";
    }
    // if (empty($_POST['image'])) {
    //   $imageError = 'Image is required';
    //   $imageErrorColor = "1px solid red";
    // }

    if (empty($_POST['password'])) {
      $passwordError = 'Password is required';
      $passwordErrorColor = "1px solid red";
    }
    if (strlen($_POST['password']) < 4) {
      $passwordStrlenError = 'Password should be 4 chars at least';
      $passwordErrorColor = "1px solid red";
    }
  } else {

    $file = 'user_image/' . ($_FILES['image']['name']);
    $imageType = pathinfo($file, PATHINFO_EXTENSION);

    if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg') {
      echo "<script>alert('Image must be png,jpg,jpeg')</script>";
    } else {

      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $image = $_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'], $file);


      $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
      $result = $stmt->execute(
        [':email' => $email]
      );
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($user) {
        echo "<script>alert('This email already exists.')</script>";
      } else {
        $stmt = $pdo->prepare("INSERT INTO users(username,email,password,image) VALUES (:username,:email,:password,:image)");

        $result = $stmt->execute(
          array(':username' => $username, ':email' => $email, ':password' => $password, ':image' => $image)
        );

        if ($result) {
          echo "<script>alert('Registration Success! You can now LogIn');window.location.href='login.php';</script>";
        }
      }
    }
  }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
  <title>Sign In | PlainAdmin Demo</title>

  <!-- ========== All CSS files linkup ========= -->
  <link rel="stylesheet" href="./admin/assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./admin/assets/css/lineicons.css" />
  <link rel="stylesheet" href="./admin/assets/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="./admin/assets/css/fullcalendar.css" />
  <link rel="stylesheet" href="./admin/assets/css/main.css" />
</head>

<body>
  <!-- ========== signin-section start ========== -->
  <section class="signin-section " style="width: 80%; margin-left:10%">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->

      <!-- ========== title-wrapper end ========== -->

      <div class="row g-0 auth-row mt-30">
        <div class="col-lg-6">
          <div class="auth-cover-wrapper bg-primary-100">
            <div class="auth-cover">
              <div class="title text-center">
                <h1 class="text-primary mb-10">Get Started</h1>
                <p class="text-medium">
                  Start creating the best possible user experience
                  <br class="d-sm-block" />
                  for you.
                </p>
              </div>
              <div class="cover-image">
                <img src="./admin/assets/images/auth/signin-image.svg" alt="" />
              </div>
              <div class="shape-image">
                <img src="./admin/assets/images/auth/shape.svg" alt="" />
              </div>
            </div>
          </div>
        </div>
        <!-- end col -->
        <div class="col-lg-6">
          <div class="signin-wrapper">
            <div class="form-wrapper">
              <h6 class="mb-15">Sign Up Form</h6>
              <p class="text-sm mb-25">
                Start creating the best possible user experience for you.
              </p>
              <form action="register.php" method="post" enctype="multipart/form-data">
                <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                <div class="row">
                  <div class="col-12">
                    <div class="input-style-1">
                    <label><?php echo empty($nameError) ? '<p>UserName</p>' : '<p style="color:red">Username can be required</p>' ?></label>
                      <input type="text" placeholder="Username" name="username"  style='border:<?php echo $nameErrorColor ?>'/>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="input-style-1">
                    <label><?php echo empty($emailError) ? '<p>Email</p>' : '<p style="color:red">Email can be required</p>' ?></label>
                      <input type="email" placeholder="Email" name="email" style='border:<?php echo $emailErrorColor ?>'/>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-12">
                    <div class="input-style-1">
                      <label>
                        <?php if(empty($passwordError) && empty($passwordStrlenError)){?>
                          <p>Password</p>
                        <?php }
                        ?>
                        <?php 
                        if(!empty($passwordError)){ ?>
                          <p style="color:red">Password can be required</p>
                        <?php }
                        ?>
                        <?php 
                        if(!empty($passwordStrlenError) ){ ?>
                          <p style="color:red">Password should be 4 chars at least</p>
                        <?php }?>
                      </label>
                      <input type="password" placeholder="Password" name="password" style='border:<?php echo $passwordErrorColor ?>' />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="input-style-1">
                    <label><?php echo empty($imageError) ? '<p>Image</p>' : '<p style="color:red">Image can be required</p>' ?></label>
                      <input type="file" name="image" style='border:<?php echo $imageErrorColor ?>'/>
                    </div>
                  </div>
                  <!-- end col -->

                  <!-- end col -->

                  <!-- end col -->
                  <div class="col-12">
                    <div class="button-group d-flex justify-content-center flex-wrap">
                      <button class="main-btn primary-btn btn-hover w-100 text-center" type="submit">
                        Sign Up
                      </button>
                    </div>
                  </div>
                </div>
                <!-- end row -->
              </form>
              <div class="singup-option pt-40">


                <p class="text-sm text-medium text-dark text-center">
                  Already have an account? <a href="login.php">Sign In</a>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->
    </div>
  </section>
  <!-- ========== signin-section end ========== -->

  <!-- ========== footer start =========== -->
  <footer class="footer mt-30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 order-last order-md-first">
          <div class="copyright text-center text-md-start">
            <p class="text-sm">
              Designed and Developed by
              <a href="https://github.com/WinHtooNaing" rel="nofollow" target="_blank">
                travel.com.mm
              </a>
            </p>
          </div>
        </div>
        <!-- end col-->
        <div class="col-md-6">
          <div class="terms d-flex justify-content-center justify-content-md-end">
            <a href="#0" class="text-sm">Term & Conditions</a>
            <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
          </div>
        </div>
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </footer>
  <!-- ========== footer end =========== -->

  <!-- ========= All Javascript files linkup ======== -->
  <script src="./admin/assets/js/bootstrap.bundle.min.js"></script>
  <script src="./admin/assets/js/Chart.min.js"></script>
  <script src="./admin/assets/js/dynamic-pie-chart.js"></script>
  <script src="./admin/assets/js/moment.min.js"></script>
  <script src="./admin/assets/js/fullcalendar.js"></script>
  <script src="./admin/assets/js/jvectormap.min.js"></script>
  <script src="./admin/assets/js/world-merc.js"></script>
  <script src="./admin/assets/js/polyfill.js"></script>
  <script src="./admin/assets/js/main.js"></script>
</body>

</html>