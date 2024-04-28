<?php

include 'header.php';


// if (isset($_POST['search']) && !empty($_POST['search'])) {
//   setcookie('search', $_POST['search'], time() + (86400 * 30), "/");
// }
//  else {
//   if (empty($_GET['pageno'])) {
//     unset($_COOKIE['search']);
//     setcookie('search', null, -1, '/');
//   }
// }
?>

<?php
$user_id = $_SESSION['user_id'];

if (!empty($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$numOfrecs = 3;
$offset = ($pageno - 1) *  $numOfrecs;

if (empty($_POST['search']) && empty($_COOKIE['search'])) {
  $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id=$user_id ORDER BY id DESC");
  $stmt->execute();
  $rawResult = $stmt->fetchAll();

  $total_pages = ceil(count($rawResult) / $numOfrecs);


  $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id=$user_id ORDER BY id DESC LIMIT $offset,$numOfrecs");
  $stmt->execute();
  $result = $stmt->fetchAll();
} else {

  $searchKey = isset($_POST['search']) ? $_POST['search'] : (isset($_COOKIE['search']) ? $_COOKIE['search'] : '');

  // $searchKey = $_POST['search'] ? $_POST['search'] : $_COOKIE['search'] ; ရေးမရဘူး ဖြစ်နေတယ်
  $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id=$user_id and title LIKE '%$searchKey%' ORDER BY id DESC");

  $stmt->execute();
  $rawResult = $stmt->fetchAll();

  $total_pages = ceil(count($rawResult) / $numOfrecs);


  $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id=$user_id and title LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfrecs");
  $stmt->execute();
  $result = $stmt->fetchAll();
}

?>

<section class="table-components">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="title">
            <h2>Posts</h2>


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
                  Story
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Posts
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

    <!-- ========== tables-wrapper start ========== -->
    <div class="tables-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="card-style mb-30">
            <div class="title d-flex flex-wrap justify-content-start align-items-center">
              <div class="left">
                <a href="create-post.php" class="main-btn success-btn btn-hover " style="width:100px;height:40px">Create Post</a>
              </div>
              <div class="right" style="margin-left:30%">
                <div class="col-md-12">
                  <div class="breadcrumb-wrapper">
                    <div class="header" style="padding:0;border-radius:8px;border:1px solid transparent">
                      <div class="header-left">
                        <div class="header-search d-none d-md-flex">
                          <form action="post.php" method="post">
                            <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                            <input type="text" placeholder="Search..." style="background:#fff" name="search" />
                            <button type="submit"><i class="lni lni-search-alt"></i></button>
                          </form>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="table-wrapper table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>
                      <h6>No</h6>
                    </th>
                    <th class="lead-email">
                      <h6 style="margin-left:20%">Title</h6>
                    </th>
                    <th>
                      <h6>Region</h6>
                    </th>
                    <th>
                      <h6>City</h6>
                    </th>
                    <th>
                      <h6>created_at</h6>
                    </th>
                    <th>
                      <h6>Action</h6>
                    </th>
                  </tr>
                  <!-- end table row-->
                </thead>
                <tbody>

                  <?php
                  if ($result) {
                    $i = 1;
                    foreach ($result as $data) {

                  ?>
                      <tr>
                        <td class="min-width">
                          <p><?php echo $i; ?></p>
                        </td>
                        <td class="min-width">
                          <p><a href="#0" style="margin-left:10%"><?php echo $data['title'] ?></a></p>
                        </td>
                        <td class="min-width">
                          <p>
                            <?php
                            $id = $data['region_id'];
                            $stmt1 = $pdo->prepare("SELECT name FROM region WHERE id = $id ");
                            $stmt1->execute();
                            $result1 = $stmt1->fetchAll();
                            ?>
                            <?php echo $result1[0]['name'] ?>
                          </p>
                        </td>
                        <td class="min-width">
                          <p><?php echo $data['city'] ?></p>
                        </td>
                        <td class="min-width">
                          <p><?php echo date('d/m/Y', strtotime($data['created_at'])) ?></p>
                        </td>
                        <td>
                          <div class="action">
                            <button class="text-primary">
                              <a href="edit-post.php?id=<?php echo $data['id'] ?>">
                                <i class="lni lni-pencil"></i>
                              </a>

                            </button>
                            <a href="delete-post.php?id=<?php echo $data['id'] ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this item')">
                              <i class="lni lni-trash-can"></i>
                            </a>


                          </div>
                        </td>
                      </tr>
                  <?php
                      $i++;
                    }
                  } ?>


                  <!-- end table row -->

                </tbody>
              </table>
              <!-- end table -->
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
          <!-- end card -->
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->


    </div>
    <!-- ========== tables-wrapper end ========== -->
  </div>
  <!-- end container -->
</section>
<?php
include 'footer.php';
?>