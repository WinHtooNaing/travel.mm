<?php
include 'header.php';

   if($_POST){
      if(empty($_POST['username']) || empty($_POST['title']) || empty($_POST['description'])){
         if(empty($_POST['title'])){
            $titleError = "Title must be required";
            $titleErrorColor = "1px solid red";
         }
         if(empty($_POST['description'])){
            $descriptionError = "Description must be required";
            $descriptionErrorColor = "1px solid red";
         }
      }else{
         $username = $_POST['username'];
         $title = $_POST['title'];
         $description = $_POST['description'];

         $stmt = $pdo -> prepare("INSERT INTO reports(username,title,description) VALUES (:username,:title,:description)");
                $result = $stmt->execute(
                    array(':username' => $username,':title' => $title,':description' => $description )
                );
                if($result){
                    echo "<script>alert('successfully Reported Added');window.location.href='contact.php';</script>";
                }
      }
   }

?>
<section class="section">
   <div class="container-fluid">
      <div class="title-wrapper pt-30">
         <div class="row align-items-center container">
            <div class="col-md-6 ">
               <div class="title">
                  <h2 style="text-align: center;">Contact Us</h2>
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
                           Contact us
                        </li>
                     </ol>
                  </nav>
               </div>
            </div>
            <!-- end col -->
         </div>
         <!-- end row -->
      </div>
      <div class="row">
         <div class="col-lg-8 container">
            <div class="card-style settings-card-2 mb-30">
               <div class="title mb-30 d-flex justify-content-between align-items-center">
                  <h6>Write A Report for our website</h6>
                  <button class="border-0 bg-transparent">
                     <i class="lni lni-pencil-alt"></i>
                  </button>
               </div>
               <form action="contact.php" method="post">
                  <?php 
                     if(!empty($_SESSION['username'])){
                        ?>
                        <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>">
                        <?php 
                     }else{
                        ?>
                        <input type="hidden" name="username" value="Anonimus" >
                        <?php
                     }
                  ?>
                            <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">

                  <div class="row">
                     <div class="col-12">
                        <div class="input-style-1">
                           <label>Title</label>
                           <input type="text" placeholder="Title" name="title"/>
                        </div>
                     </div>
                     <div class="col-12">
                        <div class="input-style-1">
                           <label>Description</label>
                           <textarea placeholder="Description" rows="6" name="description"></textarea>
                        </div>
                     </div>
                     <div class="col-12">
                        <button class="main-btn primary-btn btn-hover" type="submit">
                           Write
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
</section>

<?php
include 'footer.php'
?>