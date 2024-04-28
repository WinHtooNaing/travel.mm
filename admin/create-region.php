
<?php 
include 'header.php'
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
  if($_POST){
  
    if(empty($_POST['name'])  ){
      
        $nameError = "Region Name can be required";
        $nameErrorColor = "1px solid red";
      
  }else{
      
        $name = $_POST['name'];
        $stmt = $pdo -> prepare("INSERT INTO region(name) VALUES (:name)");
        $result = $stmt->execute(
            array(':name' => $name)
        );
        if($result){
            echo "<script>alert('successfully added');window.location.href='region-category.php';</script>";
        }
    }
  }
?>




          <form action="create-region.php" method="post">
          <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
          <div class="card-style mb-30">
                  <h6 class="mb-25">Create Region</h6>
                  <div class="input-style-1">
                  <label><?php echo empty($nameError) ? '<p>Region</p>' : '<p style="color:red">Region Name must be required</p>' ?></label>
                            <input type="text" placeholder="Region" name="name" style='border:<?php echo $nameErrorColor ?>'/>
                  </div>
                  <div class="input-style-1" style="display:flex;justify-content:space-between">
                        <a href="region-category.php" class="main-btn warning-btn btn-hover">Back</a>
                        <button type="submit" class="main-btn primary-btn btn-hover">Create</button>
                        </div>
                </div>
          </form>
         
        </div>
        <!-- end container -->
      </section>
<?php 
include 'footer.php'
?>