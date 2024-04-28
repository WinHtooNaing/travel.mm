<?php
include 'header.php';

$stmt = $pdo->prepare("SELECT * FROM region WHERE  id=" . $_GET['id']);
$stmt->execute();
$result = $stmt->fetchAll();

?>
<section class="table-components">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="title">
            <h2>Categories</h2>
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
                  Categories
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

    <?php
    if ($_POST) {
      if (empty($_POST['name'])) {
        $nameError = 'Name must be required';
        $nameErrorColor = "1px solid red";
      } else {
        $id = $_POST['id'];
        $name = $_POST['name'];

        $stmt = $pdo->prepare("UPDATE region SET name='$name'  WHERE id='$id' ");
        $result = $stmt->execute();
        if ($result) {
          echo "<script>alert('successfully Updated');window.location.href='region-category.php';</script>";
        };
      }
    }
    ?>

    <form action="" method="post">
      <input name="id" type="hidden" value="<?php echo $result[0]['id'] ?>">
      <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
      <div class="card-style mb-30">
        <h6 class="mb-25">Edit Region</h6>
        <div class="input-style-1">
          <label>Region</label>
          <input type="text" placeholder="Region" value="<?php echo $result[0]['name']; ?>" name="name" />
        </div>
        <div class="input-style-1" style="display:flex;justify-content:space-between">
          <a href="region-category.php" class="main-btn warning-btn btn-hover">Back</a>
          <button type="submit" class="main-btn primary-btn btn-hover">Update</button>
        </div>
      </div>
    </form>

  </div>
  <!-- end container -->
</section>
<?php
include 'footer.php'
?>