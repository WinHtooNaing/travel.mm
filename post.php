<?php
include 'header.php';
?>

<?php

if (!empty($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$numOfrecs = 6;
$offset = ($pageno - 1) *  $numOfrecs;

if (empty($_POST['search']) && empty($_COOKIE['search'])) {
  $stmt = $pdo->prepare("SELECT * FROM posts  ORDER BY created_at DESC");
  $stmt->execute();
  $rawResult = $stmt->fetchAll();

  $total_pages = ceil(count($rawResult) / $numOfrecs);


  $stmt = $pdo->prepare("SELECT * FROM posts  ORDER BY created_at DESC LIMIT $offset,$numOfrecs");
  $stmt->execute();
  $result = $stmt->fetchAll();
} else {

  $searchKey = isset($_POST['search']) ? $_POST['search'] : (isset($_COOKIE['search']) ? $_COOKIE['search'] : '');

  // $searchKey = $_POST['search'] ? $_POST['search'] : $_COOKIE['search'] ; ရေးမရဘူး ဖြစ်နေတယ်
  $stmt = $pdo->prepare("SELECT * FROM posts WHERE  title LIKE '%$searchKey%' ORDER BY created_at DESC");

  $stmt->execute();
  $rawResult = $stmt->fetchAll();

  $total_pages = ceil(count($rawResult) / $numOfrecs);


  $stmt = $pdo->prepare("SELECT * FROM posts WHERE  title LIKE '%$searchKey%' ORDER BY created_at DESC LIMIT $offset,$numOfrecs");
  $stmt->execute();
  $result = $stmt->fetchAll();
}

?>

<section class="card-components">
   <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-md-6">
                  <div class="title">
                     <h2>All Posts</h2>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="breadcrumb-wrapper">
                     <div class="header" style="padding:0;border-radius:8px">
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
         <!-- end row -->
      </div>
      <!-- ========== title-wrapper end ========== -->

      <!-- ========== cards-styles start ========== -->
      <div class="cards-styles">
         <!-- ========= card-style-1 start ========= -->
         <div class="row">
            <?php
            if ($result) {
               foreach ($result as $value) {
            ?>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                     <div class="card-style-1 mb-30">
                        <div class="card-meta">
                           <div class="image" style="width: 50px;height:50px;max-width:100%">
                              <?php
                              $id = $value['user_id'];
                              $stmtUser = $pdo->prepare("SELECT * FROM users WHERE id=$id");
                              $stmtUser->execute();
                              $resultUser = $stmtUser->fetchAll();
                              ?>
                              <img src="admin/assets/images/user_image/<?php echo $resultUser[0]['image']  ?>" alt="" style="object-fit: cover;" />
                           </div>
                           <div class="text">
                              <p class="text-sm text-medium">
                                 Posted by :
                                 <a href="#0">

                                    <?php
                                    if (!empty($resultUser)) {
                                       if (empty($_SESSION['logged_in'])) {
                                          if ($resultUser[0]['username'] == "Win Htoo Naing") {
                                    ?>
                                             Admin

                                    <?php } else {
                                             echo $resultUser[0]['username'];
                                          }
                                       }else{
                                          if ($resultUser[0]['username'] == "Win Htoo Naing") {
                                             ?>
                                                      Admin
         
                                             <?php }else if($resultUser[0]['username'] == $_SESSION['username']){
                                                ?>
                                                You
                                                <?php
                                             
                                             }
                                              else {
                                                      echo $resultUser[0]['username'];
                                                   }
                                       }
                                    } ?>
                                 </a>
                              </p>
                           </div>

                        </div>
                        <div class="card-image">
                           <a href="post-detail.php?id=<?php echo $value['id'] ?>">
                              <img src="admin/assets/images/post_image/<?php echo $value['image1'] ?>" alt="" height="250px" style="object-fit: cover;" />
                           </a>
                        </div>
                        <div class="card-content">
                           <h4><a href="post-detail.php?id=<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a></h4>
                           <p class="text-sm text-medium">date - <?php echo date('d/m/Y', strtotime($value['created_at'])) ?></p>
                           <hr>
                           <p>
                              <?php echo substr($value['description1'],0,160) ?> ... <a href="post-detail.php?id=<?php echo $value['id'] ?>">see more</a>
                           </p>
                        </div>
                     </div>
                     <!-- end card-->
                  </div>
            <?php
               }
            }
            ?>
         </div>
         <!-- end row -->
        
      </div>
      <!-- ========== cards-styles end ========== -->
      
             
   </div>
   <nav aria-label="Page navigation example" style="display: flex;justify-content:end" >
                <ul class="pagination">
               
                  <li class="page-item" style="margin-right:0"><a class="page-link" href="?pageno=1">First</a></li>
                  <li class="page-item <?php if ($pageno <= 1) {
                                          echo 'disabled';
                                        } ?>" style="margin-right:0">
                    <a class="page-link" href="<?php if ($pageno <= 1) {
                                                  echo '#';
                                                } else {
                                                  echo "?pageno=" . ($pageno - 1);
                                                } ?>">Previous</a>
                  </li>
                  <li class="page-item" style="margin-right:0"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
                  <li class="page-item <?php if ($pageno >= $total_pages) {
                                          echo 'disabled';
                                        } ?>" style="margin-right:0">
                    <a class="page-link" href="<?php if ($pageno >= $total_pages) {
                                                  echo '#';
                                                } else {
                                                  echo "?pageno=" . ($pageno + 1);
                                                } ?>">Next</a>
                  </li>
                  <li class="page-item" style="margin-right:0"><a class="page-link" href="?pageno=<?php echo $total_pages ?>">Last</a></li>
                </ul>
              </nav><br><br><br>
</section>
<?php
include 'footer.php'
?>