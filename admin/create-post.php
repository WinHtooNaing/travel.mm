<?php
include 'header.php';

$stmt = $pdo->prepare("SELECT * FROM region;");
$stmt->execute();
$result = $stmt->fetchAll();
?>

<?php 
    if($_POST){
        if(empty($_POST['title']) || empty($_POST['region_id']) || empty($_POST['city']) || empty($_POST['description1']) || 
        empty($_FILES['image1']) || empty($_POST['description2']) || empty($_FILES['image2']) ){
            if(empty($_POST['title'])){
                $titleError = "Title must be required";
                $titleErrorColor = "1px solid red";
            };
            if(empty($_POST['region_id'])){
                $regionError = "Region name must be required";
                $regionErrorColor = "1px solid red";
            };
            if(empty($_POST['city'])){
                $cityError = "City must be required";
                $cityErrorColor = "1px solid red";
            };
            if(empty($_POST['description1'])){
                $des1Error = "Desctiption1 must be required";
                $des1ErrorColor = "1px solid red";
            };
            if(empty($_FILES['image1'])){
                $image1Error = "Image1 must be required";
                $image1ErrorColor = "1px solid red";
            };
            if(empty($_POST['description2'])){
                $des2Error = "Desctiption2 must be required";
                $des2ErrorColor = "1px solid red";
            };
            if(empty($_FILES['image2'])){
                $image2Error = "Image2 must be required";
                $image2ErrorColor = "1px solid red";
            };
        }else{
            $file1 = 'assets/images/post_image/'.($_FILES['image1']['name']);
            $file2 = 'assets/images/post_image/'.($_FILES['image2']['name']);
            $imageType1 = pathinfo($file1,PATHINFO_EXTENSION);
            $imageType2 = pathinfo($file2,PATHINFO_EXTENSION);
            if($imageType1 != 'png' && $imageType1 != 'jpg' && $imageType1 != 'jpeg' && 
            $imageType2 != 'png' && $imageType2 != 'jpg' && $imageType2 != 'jpeg'){
                echo "<script>alert('Image must be png,jpg,jpeg')</script>";
            }else {
                $title = $_POST['title'];
                $user_id = $_POST['user_id'];
                $region_id = $_POST['region_id'];
                $city = $_POST['city'];
                $description1 = $_POST['description1'];
                $description2 = $_POST['description2'];
                
        
                $image1 = $_FILES['image1']['name'];
                move_uploaded_file($_FILES['image1']['tmp_name'],$file1);
                $image2 = $_FILES['image2']['name'];
                move_uploaded_file($_FILES['image2']['tmp_name'],$file2);
        
                $stmt = $pdo -> prepare("INSERT INTO posts(title,user_id,region_id,city,description1,image1,description2,image2) VALUES (:title,:user_id,:region_id,:city,:description1,:image1,:description2,:image2)");
                $result = $stmt->execute(
                    array(':title' => $title,':user_id' => $user_id,':region_id' => $region_id,':city' => $city,':description1' => $description1,':image1' => $image1,':description2' => $description2,':image2' => $image2 )
                );
                if($result){
                    echo "<script>alert('successfully added');window.location.href='post.php';</script>";
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
                                <li class="breadcrumb-item"><a href="#0">Story</a></li>
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

        <!-- ========== form-elements-wrapper start ========== -->
        <div class="form-elements-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!-- input style start -->
                    <div class="card-style mb-30">
                        <h6 class="mb-25">Create A Post</h6>
                        <form action="create-post.php" method="post" enctype="multipart/form-data">
                            <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                            <input name="user_id" type="hidden" value="<?php echo $_SESSION['user_id']; ?>">
                            <div class="input-style-1">
                            <label><?php echo empty($titleError) ? '<p>Title</p>' : '<p style="color:red">Title must be required</p>' ?></label>
                                <input type="text" placeholder="title" name="title" style='border:<?php echo $titleErrorColor ?>'/>
                            </div>
                            <!-- end input -->
                            <div class="input-style-1 row">
                                <div class="select-style-1 col-lg-6">
                                <label><?php echo empty($regionError) ? '<p>Region</p>' : '<p style="color:red">Region must be required</p>' ?></label>
                                    <div class="select-position">
                                        <select name="region_id" style='border:<?php echo $regionErrorColor ?>'>
                                            <option value="">Select Region</option>
                                            <?php
                                            foreach ($result as $value) {
                                            ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>

                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="select-style-1 col-lg-6">
                                <label><?php echo empty($cityError) ? '<p>City</p>' : '<p style="color:red">City must be required</p>' ?></label>
                                    <input type="text" placeholder="City" name="city" style='border:<?php echo $cityErrorColor ?>'/>

                                </div>
                            </div>
                            <div class="input-style-1">
                            <label><?php echo empty($des1Error) ? '<p>Description1</p>' : '<p style="color:red">Description1 must be required</p>' ?></label>
                                <textarea placeholder="Description" rows="5" name="description1" style='border:<?php echo $des1ErrorColor ?>'></textarea>
                            </div>
                            <div class="input-style-1">
                            <label><?php echo empty($image1Error) ? '<p>Image1</p>' : '<p style="color:red">Image1 must be required</p>' ?></label>
                                <input type="file" name="image1" style='border:<?php echo $image1ErrorColor ?>'/>
                            </div>
                            <div class="input-style-1">
                            <label><?php echo empty($des2Error) ? '<p>Description2</p>' : '<p style="color:red">Description2 must be required</p>' ?></label>
                                <textarea placeholder="Description" rows="5" name="description2" style='border:<?php echo $des2ErrorColor ?>'></textarea>
                            </div>
                            <div class="input-style-1">
                            <label><?php echo empty($image2Error) ? '<p>Image2</p>' : '<p style="color:red">Image2 must be required</p>' ?></label>
                                <input type="file" name="image2" style='border:<?php echo $image2ErrorColor ?>'/>
                            </div>
                            <div class="input-style-1" style="display:flex;justify-content:space-between">
                                <a href="post.php" class="main-btn warning-btn btn-hover">Back</a>
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