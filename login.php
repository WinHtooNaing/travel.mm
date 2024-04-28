<?php

session_start();

require './config/config.php';
require './config/common.php';

if ($_POST) {
  if (empty($_POST['email']) || empty($_POST['password'])){
    if (empty($_POST['email'])) {
      $emailError = "Email can be required";
      $emailErrorColor = "1px solid red";
  }

  if (empty($_POST['password'])) {
      $passwordError = "Password can be required";
      $passwordErrorColor = "1px solid red";

  }
  }else{

 
	$email = $_POST['email'];
	$password = $_POST['password'];
  
	$stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
	$stmt->execute(
			array(':email'=>$email)
	);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
  
	if ($user && $user["role"] == 1) {
		if (password_verify($password,$user['password'])) {
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['password'] = $user['password'];
			$_SESSION['image'] = $user['image'];
			$_SESSION['role'] = $user['role'];
			$_SESSION['logged_in'] = time();

			echo "<script>alert('Login Success! ');window.location.href='admin/index.php';</script>";
		}
	}else if($user && $user["role"] == 0){
    if (password_verify($password,$user['password'])) {
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['password'] = $user['password'];
			$_SESSION['image'] = $user['image'];
			$_SESSION['role'] = $user['role'];
			$_SESSION['logged_in'] = time();

			echo "<script>alert('Login Success! ');window.location.href='index.php';</script>";
		}
  }
}

	 echo "<script>alert('Incorrect Credentials');</script>";
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
                    <h1 class="text-primary mb-10">Welcome Back</h1>
                    <p class="text-medium">
                      Sign in to your Existing account to continue
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
                  <h6 class="mb-15">Sign In Form</h6>
                  <p class="text-sm mb-25">
                    Start creating the best possible user experience for you.
                  </p>
                  <form action="login.php" method="post">
                  <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                    <div class="row">
                      <div class="col-12">
                        <div class="input-style-1">
                          <label><?php echo empty($emailError) ? '<p>Email</p>' :  '<p style="color:red">Email must be required !</p>'?></label>
                          <input type="email" placeholder="Email" name="email" style='border:<?php echo $emailErrorColor ?>'/>
                        </div>
                      </div>
                      <!-- end col -->
                      <div class="col-12">
                        <div class="input-style-1">
                          <label><?php echo empty($passwordError) ? '<p>Password</p>' :  '<p style="color:red">Password must be required !</p>'?></label>
                          <input type="password" placeholder="Password" name="password" style='border:<?php echo $passwordErrorColor ?>'/>
                        </div>
                      </div>
                      <!-- end col -->
                      <div class="col-xxl-6 col-lg-12 col-md-6">
                        <div class="form-check checkbox-style mb-30">
                          <input class="form-check-input" type="checkbox" value="" id="checkbox-remember" />
                          <label class="form-check-label" for="checkbox-remember">
                            Remember me next time</label>
                        </div>
                      </div>
                      <!-- end col -->
                      
                      <!-- end col -->
                      <div class="col-12">
                        <div class="button-group d-flex justify-content-center flex-wrap">
                          <button class="main-btn primary-btn btn-hover w-100 text-center" type="submit">
                            Sign In
                          </button>
                        </div>
                      </div>
                    </div>
                    <!-- end row -->
                  </form>
                  <div class="singup-option pt-40">
                    
                    
                  <p class="text-sm text-medium text-dark text-center">
                      Don’t have any account yet?
                      <a href="register.php">Create an account</a>
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