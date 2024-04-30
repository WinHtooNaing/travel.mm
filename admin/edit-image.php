<?php
include 'header.php';


$stmt = $pdo->prepare("SELECT * FROM photo WHERE  id=" . $_GET['id']);
$stmt->execute();
$result = $stmt->fetchAll();

?>

<?php

if ($_POST) {
    if (
        empty($_POST['title']) ||empty($_FILES['image'])
    ) {
        if (empty($_POST['title'])) {
            $titleError = "Title must be required";
            $titleErrorColor = "1px solid red";
        };
        
        if (empty($_FILES['image'])) {
            $image2Error = "Image must be required";
            $image2ErrorColor = "1px solid red";
        };
    } else {
        $id = $_POST['id'];
        $title = $_POST['title'];
        if ($_FILES['image']['name'] != null ) {
            $file = 'assets/images/photo/' . ($_FILES['image']['name']);
            $imageType = pathinfo($file, PATHINFO_EXTENSION);

            if (
                $imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg' 
            ) {
                echo "<script>alert('Image must be png,jpg,jpeg')</script>";
            } else {
                $image = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $file);

                $stmtUpdate = $pdo->prepare("UPDATE photo SET title='$title',image='$image' WHERE id='$id' ");
                $resultUpdate = $stmtUpdate->execute();
                if ($resultUpdate) {
                    echo "<script>alert('successfully Updated');window.location.href='image.php';</script>";
                    //header('Location: index.php');
                };
            };
        }else {
            $stmtUpdate = $pdo->prepare("UPDATE photo SET title='$title' WHERE id='$id' ");
            $resultUpdate = $stmtUpdate->execute();
            if ($resultUpdate) {
                echo "<script>alert('successfully Updated');window.location.href='image.php';</script>";
                //header('Location: index.php');
            };
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
                        <form action="" method="post" enctype="multipart/form-data">
                            <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                            <input name="id" type="hidden" value="<?php echo $result[0]['id'] ?>">
                            <h6 class="mb-25">Edit Photo</h6>
                            <div class="input-style-1">
                                <label>Title</label>
                                <input type="text" placeholder="title" value="<?php echo $result[0]['title'] ?>" name="title" />
                            </div>
                            
                            <div class="input-style-1">
                                <label>Image</label>
                                <img src="assets/images/photo/<?php echo $result[0]['image'] ?>" alt="" width="100" height="100"><br>
                                <input type="file" name="image" />
                            </div>
                            <div class="input-style-1" style="display:flex;justify-content:space-between">
                                <a href="image.php" class="main-btn warning-btn btn-hover">Back</a>
                                <button type="submit" class="main-btn primary-btn btn-hover">Update</button>
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