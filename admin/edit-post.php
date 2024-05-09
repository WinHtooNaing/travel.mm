<?php
include 'header.php';


$stmt = $pdo->prepare("SELECT * FROM posts WHERE  id=" . $_GET['id']);
$stmt->execute();
$result = $stmt->fetchAll();

?>

<?php

if ($_POST) {
    if (
        empty($_POST['title']) || empty($_POST['region_id']) || empty($_POST['city']) || empty($_POST['description1']) ||
        empty($_FILES['image1']) || empty($_POST['description2']) || empty($_FILES['image2'])
    ) {
        if (empty($_POST['title'])) {
            $titleError = "Title must be required";
            $titleErrorColor = "1px solid red";
        };
        if (empty($_POST['region_id'])) {
            $regionError = "Region name must be required";
            $regionErrorColor = "1px solid red";
        };
        if (empty($_POST['city'])) {
            $cityError = "City must be required";
            $cityErrorColor = "1px solid red";
        };
        if (empty($_POST['description1'])) {
            $des1Error = "Desctiption1 must be required";
            $des1ErrorColor = "1px solid red";
        };
        if (empty($_FILES['image1'])) {
            $image1Error = "Image1 must be required";
            $image1ErrorColor = "1px solid red";
        };
        if (empty($_POST['description2'])) {
            $des2Error = "Desctiption2 must be required";
            $des2ErrorColor = "1px solid red";
        };
        if (empty($_FILES['image2'])) {
            $image2Error = "Image2 must be required";
            $image2ErrorColor = "1px solid red";
        };
    } else {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $user_id = $_POST['user_id'];
        $region_id = $_POST['region_id'];
        $city = $_POST['city'];
        $description1 = $_POST['description1'];
        $description2 = $_POST['description2'];
        if ($_FILES['image1']['name'] != null && $_FILES['image2']['name'] != null) {
            $file1 = 'assets/images/post_image/' . ($_FILES['image1']['name']);
            $file2 = 'assets/images/post_image/' . ($_FILES['image2']['name']);
            $imageType1 = pathinfo($file1, PATHINFO_EXTENSION);
            $imageType2 = pathinfo($file2, PATHINFO_EXTENSION);

            if (
                $imageType1 != 'png' && $imageType1 != 'jpg' && $imageType1 != 'jpeg' &&
                $imageType2 != 'png' && $imageType2 != 'jpg' && $imageType2 != 'jpeg'
            ) {
                echo "<script>alert('Image must be png,jpg,jpeg')</script>";
            } else {
                $image1 = $_FILES['image1']['name'];
                move_uploaded_file($_FILES['image1']['tmp_name'], $file1);
                $image2 = $_FILES['image2']['name'];
                move_uploaded_file($_FILES['image2']['tmp_name'], $file2);

                $stmtUpdate = $pdo->prepare("UPDATE posts SET title='$title',user_id='$user_id',region_id ='$region_id ',city='$city',description1='$description1',image1='$image1',description2='$description2',image2='$image2' WHERE id='$id' ");
                $resultUpdate = $stmtUpdate->execute();
                if ($resultUpdate) {
                    echo "<script>alert('successfully Updated');window.location.href='post.php';</script>";
                    //header('Location: index.php');
                };
            };
        } else if ($_FILES['image1']['name'] != null && $_FILES['image2']['name'] == null) {
            $file1 = 'assets/images/post_image/' . ($_FILES['image1']['name']);
            $imageType1 = pathinfo($file1, PATHINFO_EXTENSION);

            if (
                $imageType1 != 'png' && $imageType1 != 'jpg' && $imageType1 != 'jpeg'
            ) {
                echo "<script>alert('Image must be png,jpg,jpeg')</script>";
            } else {
                $image1 = $_FILES['image1']['name'];
                move_uploaded_file($_FILES['image1']['tmp_name'], $file1);

                $stmtUpdate = $pdo->prepare("UPDATE posts SET title='$title',user_id='$user_id',region_id ='$region_id ',city='$city',description1='$description1',image1='$image1',description2='$description2' WHERE id='$id' ");
                $resultUpdate = $stmtUpdate->execute();
                if ($resultUpdate) {
                    echo "<script>alert('successfully Updated');window.location.href='post.php';</script>";
                    //header('Location: index.php');
                };
            };
        } else if ($_FILES['image1']['name'] == null && $_FILES['image2']['name'] != null) {
            $file2 = 'assets/images/post_image/' . ($_FILES['image2']['name']);
            $imageType2 = pathinfo($file2, PATHINFO_EXTENSION);

            if (
                $imageType2 != 'png' && $imageType2 != 'jpg' && $imageType2 != 'jpeg'
            ) {
                echo "<script>alert('Image must be png,jpg,jpeg')</script>";
            } else {
                $image2 = $_FILES['image2']['name'];
                move_uploaded_file($_FILES['image2']['tmp_name'], $file2);

                $stmtUpdate = $pdo->prepare("UPDATE posts SET title='$title',user_id='$user_id',region_id ='$region_id ',city='$city',description1='$description1',description2='$description2',image2='$image2' WHERE id='$id' ");
                $resultUpdate = $stmtUpdate->execute();
                if ($resultUpdate) {
                    echo "<script>alert('successfully Updated');window.location.href='post.php';</script>";
                    //header('Location: index.php');
                };
            };
        } else {
            $stmtUpdate = $pdo->prepare("UPDATE posts SET title='$title',user_id='$user_id',region_id ='$region_id ',city='$city',description1='$description1',description2='$description2' WHERE id='$id' ");
            $resultUpdate = $stmtUpdate->execute();
            if ($resultUpdate) {
                echo "<script>alert('successfully Updated');window.location.href='post.php';</script>";
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
                        <form action="" method="post" enctype="multipart/form-data">
                            <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                            <input name="id" type="hidden" value="<?php echo $result[0]['id'] ?>">
                            <input name="user_id" type="hidden" value="<?php echo $_SESSION['user_id']; ?>">
                            <h6 class="mb-25">Edit Post</h6>
                            <div class="input-style-1">
                                <label>Title</label>
                                <input type="text" placeholder="title" value="<?php echo $result[0]['title'] ?>" name="title" />
                            </div>
                            <!-- end input -->
                            <div class="input-style-1 row">
                                <div class="select-style-1 col-lg-6">
                                    <?php

                                    $catStmt = $pdo->prepare("SELECT * FROM region");
                                    $catStmt->execute();
                                    $catResult = $catStmt->fetchAll();
                                    ?>
                                    <label>Region</label>
                                    <div class="select-position">
                                        <select name="region_id">
                                            <option value="">Select Region</option>
                                            <?php foreach ($catResult as $value) { ?>
                                                <?php if ($value['id'] == $result[0]['region_id']) : ?>
                                                    <option value="<?php echo $value['id'] ?>" selected><?php echo $value['name'] ?></option>
                                                <?php else : ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                                                <?php endif ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="select-style-1 col-lg-6">
                                    <label>City</label>
                                    <input type="text" placeholder="City" value="<?php echo $result[0]['city'] ?>" name="city" />

                                </div>
                            </div>
                            <div class="input-style-1">
                                <label>Description1</label>
                                <textarea placeholder="Description" rows="5" name="description1"><?php echo $result[0]['description1'] ?></textarea>
                            </div>
                            <div class="input-style-1">
                                <label>Image1</label>
                                <img src="assets/images/post_image/<?php echo $result[0]['image1'] ?>" alt="" width="100" height="100"><br>
                                <input type="file" name="image1" />
                            </div>
                            <div class="input-style-1">
                                <label>Description2</label>
                                <textarea placeholder="Description" rows="5" name="description2"><?php echo $result[0]['description2'] ?></textarea>
                            </div>
                            <div class="input-style-1">
                                <label>Image2</label>
                                <img src="assets/images/post_image/<?php echo $result[0]['image2'] ?>" alt="" width="100" height="100"><br>
                                <input type="file" name="image2" />
                            </div>
                            <div class="input-style-1" style="display:flex;justify-content:space-between">
                                <a href="post.php" class="main-btn warning-btn btn-hover">Back</a>
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