<?php
include 'header.php'
?>

<?php

if (empty($_POST['search']) && empty($_COOKIE['search'])) {
  $stmt = $pdo->prepare("SELECT * FROM photo ORDER BY id DESC");
  $stmt->execute();
  $result = $stmt->fetchAll();
} else {
  $searchKey = isset($_POST['search']) ? $_POST['search'] : (isset($_COOKIE['search']) ? $_COOKIE['search'] : '');

  // $searchKey = $_POST['search'] ? $_POST['search'] : $_COOKIE['search'] ; ရေးမရဘူး ဖြစ်နေတယ်
  $stmt = $pdo->prepare("SELECT * FROM photo WHERE title LIKE '%$searchKey%' ORDER BY id DESC");
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
            <h2>Photo</h2>
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
                  photo
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
            <div class="title d-flex flex-wrap justify-content-between align-items-center">
              <div class="left">
                <!-- <h6 class="mb-10">Posts Data</h6> -->
                <!-- <p class="text-sm mb-20">
                    For basic styling—light padding and only horizontal
                    dividers—use the class table.
                  </p> -->
                <a href="create-image.php" class="main-btn success-btn btn-hover " style="width:100px;height:40px">Create Photo</a>
              </div>

            </div>
            <div class="table-wrapper table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>
                      <h6>NO</h6>
                    </th>
                    <th class="lead-info">
                      <h6>Title</h6>
                    </th>
                    <th>
                      <h6>Created_at</h6>
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
                    foreach ($result as $value) {
                  ?>
                      <tr>
                        <td>
                          <p><?php echo $i; ?></p>
                        </td>
                        <td class="min-width">
                          <p><a href="#0"><?php echo $value['title'] ?></a></p>
                        </td>
                        <td>
                          <p><?php echo date('d/m/Y', strtotime($value['created_at'])) ?></p>
                        </td>
                        <td>
                          <div class="action">
                            <button class="text-primary">
                              <a href="edit-image.php?id=<?php echo $value['id'] ?>">
                                <i class="lni lni-pencil"></i>
                              </a>

                            </button>
                            <a href="delete-image.php?id=<?php echo $value['id'] ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this item')">
                              <i class="lni lni-trash-can"></i>
                            </a>


                          </div>
                        </td>
                      </tr>
                  <?php
                      $i++;
                    }
                  }
                  ?>

                  <!-- end table row -->

                </tbody>
              </table>
              <!-- end table -->
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
include 'footer.php'
?>