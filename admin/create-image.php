<?php
include 'header.php';

$stmt = $pdo->prepare("SELECT * FROM region;");
$stmt->execute();
$result = $stmt->fetchAll();
?>

<?php 
    if($_POST){
        if(empty($_POST['title']) ||  empty($_FILES['image']) ){
            if(empty($_POST['title'])){
                $titleError = "Title must be required";
                $titleErrorColor = "1px solid red";
            };
            
            if(empty($_FILES['image'])){
                $imageError = "Image must be required";
                $imageErrorColor = "1px solid red";
            };
        }else{
            $file = 'assets/images/photo/'.($_FILES['image']['name']);
            $imageType = pathinfo($file,PATHINFO_EXTENSION);
            if($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg'){
                echo "<script>alert('Image must be png,jpg,jpeg')</script>";
            }else {
                $title = $_POST['title'];
                $image = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],$file);
        
                $stmt = $pdo -> prepare("INSERT INTO photo(title,image) VALUES (:title,:image)");
                $result = $stmt->execute(
                    array(':title' => $title,':image' => $image )
                );
                if($result){
                    echo "<script>alert('successfully added');window.location.href='image.php';</script>";
                }
            }
        }
    }
?>


<section class="tab-components">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Photos</h2>
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
                                    Photos
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

        <!-- ========== form-elements-wrapper start ========== -->
        <div class="form-elements-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!-- input style start -->
                    <div class="card-style mb-30">
                        <h6 class="mb-25">Create A Photo</h6>
                        <form action="create-image.php" method="post" enctype="multipart/form-data">
                            <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                           
                            <div class="input-style-1">
                            <label><?php echo empty($titleError) ? '<p>Title</p>' : '<p style="color:red">Title must be required</p>' ?></label>
                                <input type="text" placeholder="title" name="title" style='border:<?php echo $titleErrorColor ?>'/>
                            </div>
                            
                            <div class="input-style-1">
                            <label><?php echo empty($imageError) ? '<p>Image</p>' : '<p style="color:red">Image must be required</p>' ?></label>
                                <input type="file" name="image" style='border:<?php echo $imageErrorColor ?>'/>
                            </div>
                            <div class="input-style-1" style="display:flex;justify-content:space-between">
                                <a href="image.php" class="main-btn warning-btn btn-hover">Back</a>
                                <button type="submit" class="main-btn primary-btn btn-hover">Create</button>
                            </div>
                        </form>


                    </div>
                </div>
                <!-- end card -->

            </div>
            <!-- end col -->

            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== form-elements-wrapper end ========== -->
    </div>
    <!-- end container -->
</section>
<?php
include 'footer.php'
?>