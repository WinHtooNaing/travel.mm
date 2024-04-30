<?php
include './header.php'
?>

<?php

if (!empty($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$numOfrecs = 3;
$offset = ($pageno - 1) *  $numOfrecs;

if (empty($_POST['search']) && empty($_COOKIE['search'])) {
  $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id!=2 ORDER BY id DESC");
  $stmt->execute();
  $rawResult = $stmt->fetchAll();

  $total_pages = ceil(count($rawResult) / $numOfrecs);


  $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id!=2 ORDER BY id DESC LIMIT $offset,$numOfrecs");
  $stmt->execute();
  $result = $stmt->fetchAll();
} else {

  $searchKey = isset($_POST['search']) ? $_POST['search'] : (isset($_COOKIE['search']) ? $_COOKIE['search'] : '');

  // $searchKey = $_POST['search'] ? $_POST['search'] : $_COOKIE['search'] ; ရေးမရဘူး ဖြစ်နေတယ်
  $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id!=2 and title LIKE '%$searchKey%' ORDER BY id DESC");

  $stmt->execute();
  $rawResult = $stmt->fetchAll();

  $total_pages = ceil(count($rawResult) / $numOfrecs);


  $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id!=2 and title LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfrecs");
  $stmt->execute();
  $result = $stmt->fetchAll();
}

?>
<section class="section">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="title">
            <h2> Home</h2>
          </div>
        </div>
        <!-- end col -->
        <div class="col-md-6">
          <div class="breadcrumb-wrapper">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="#0">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Home
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
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
          <div class="icon purple">
            <i class="lni lni-package"></i>
          </div>
          <div class="content">
            <h6 class="mb-10">Total Your Post</h6>
            <?php
            $stmtAdminPost = $pdo->prepare("SELECT * FROM posts WHERE user_id = 2  ");
            $stmtAdminPost->execute();
            $resultAdminPost = $stmtAdminPost->fetchAll();
            $l = 0;
            foreach ($resultAdminPost as $value) {
              $l++;
            }
            ?>
            <h3 class="text-bold mb-10"><?php echo $l; ?></h3>

          </div>
        </div>
        <!-- End Icon Cart -->
      </div>
      <!-- End Col -->
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
          <div class="icon success">
            <i class="lni lni-popup"></i>
          </div>
          <div class="content">
            <h6 class="mb-10">Total User Posts</h6>
            <?php
            $stmtUserPost = $pdo->prepare("SELECT * FROM posts WHERE user_id != 2 ");
            $stmtUserPost->execute();
            $resultUserPost = $stmtUserPost->fetchAll();
            $k = 0;

            foreach ($resultUserPost as $value) {
              $k++;
            }
            ?>
            <h3 class="text-bold mb-10"><?php echo $k; ?></h3>

          </div>
        </div>
        <!-- End Icon Cart -->
      </div>
      <!-- End Col -->
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
          <div class="icon primary">
            <i class="lni lni-credit-cards"></i>
          </div>
          <div class="content">
            <h6 class="mb-10">Total Reports</h6>
            <?php
            $stmtReport = $pdo->prepare("SELECT * FROM reports  ");
            $stmtReport->execute();
            $resultReport = $stmtReport->fetchAll();
            $j = 0;
            foreach ($resultReport as $value) {
              $j++;
            }
            ?>
            <h3 class="text-bold mb-10"><?php echo $j ?></h3>

          </div>
        </div>
        <!-- End Icon Cart -->
      </div>
      <!-- End Col -->
      <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
          <div class="icon orange">
            <i class="lni lni-user"></i>
          </div>
          <div class="content">
            <h6 class="mb-10">Total User</h6>
            <?php
            $stmtUser = $pdo->prepare("SELECT * FROM users WHERE role=0");
            $stmtUser->execute();
            $resultUser = $stmtUser->fetchAll();
            $i = 0;
            foreach ($resultUser as $value) {
              $i++;
            }
            ?>
            <h3 class="text-bold mb-10"><?php echo $i; ?></h3>

          </div>
        </div>
        <!-- End Icon Cart -->
      </div>
      <!-- End Col -->
    </div>
    <!-- End Row -->

    <div class="row">

      <!-- End Col -->
      <div class="col-lg-12">
        <div class="card-style mb-30">
          <div class="title d-flex flex-wrap justify-content-between align-items-center">
            <div class="left">
              <h6 class="text-medium mb-30">All Users Posts</h6>
            </div>
            <div class="right col-lg-4">
              <form action="index.php" method="post" >
                <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                <div class="input-group input-group-sm ">
                  <input name="search" type="search" class="form-control form-control-navbar" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- End Title -->
          <div class="table-responsive">
            <table class="table top-selling-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>
                    <h6 class="text-sm text-medium">User Name</h6>
                  </th>
                  <th class="min-width" style="width:50%">
                    <h6 class="text-sm text-medium">Post Title</h6>
                  </th>
                  <th class="min-width">
                    <h6 class="text-sm text-medium">Created_at</h6>
                  </th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  if($result){
                    $no=1;
                    foreach($result as $value){
                      ?>
                      <tr>
                  <td>
                    <?php echo $no ?>
                  </td>
                  <td>
                    <p class="text-sm">
                    <?php
                            $user_id = $value['user_id'];
                            $stmt1 = $pdo->prepare("SELECT username FROM users WHERE id = $user_id ");
                            $stmt1->execute();
                            $result1 = $stmt1->fetchAll();
                            ?>
                            <?php echo $result1[0]['username'] ?>
                    </p>
                  </td>
                  <td>
                    <p class="text-sm"><?php echo $value['title'] ?></p>
                  </td>

                  <td>
                    <p class="text-sm"><?php echo date('d/m/Y', strtotime($value['created_at'])) ?></p>
                  </td>
                  <td>
                    <div class="action justify-content-end">
                      <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="lni lni-more-alt"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                        <li class="dropdown-item">
                          <a href="delete-user-post.php?id=<?php echo $value['id'] ?>" class="text-gray" onclick="return confirm(`Are you sure you want to delete this user's post`)" type="button">Remove</a>
                        </li>

                      </ul>
                    </div>
                  </td>
                </tr>
                      <?php
                    $no++;
                    }
                  }
                ?>

              </tbody>
            </table>
            <!-- End Table -->
            <nav aria-label="Page navigation example" style="float:right">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                  <li class="page-item <?php if ($pageno <= 1) {
                                          echo 'disabled';
                                        } ?>">
                    <a class="page-link" href="<?php if ($pageno <= 1) {
                                                  echo '#';
                                                } else {
                                                  echo "?pageno=" . ($pageno - 1);
                                                } ?>">Previous</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
                  <li class="page-item <?php if ($pageno >= $total_pages) {
                                          echo 'disabled';
                                        } ?>">
                    <a class="page-link" href="<?php if ($pageno >= $total_pages) {
                                                  echo '#';
                                                } else {
                                                  echo "?pageno=" . ($pageno + 1);
                                                } ?>">Next</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages ?>">Last</a></li>
                </ul>
              </nav>
          </div>
        </div>
      </div>
      <!-- End Col -->
    </div>
    <!-- End Row -->

    <div class="row">
      <div class="col-lg-12">
        <div class="card-style calendar-card mb-30">
          <div id="calendar-mini"></div>
        </div>
      </div>
      <!-- End Col -->

      <!-- End Col -->
    </div>
    <!-- End Row -->
  </div>
  <!-- end container -->
</section>

<?php
include './footer.php'
?>