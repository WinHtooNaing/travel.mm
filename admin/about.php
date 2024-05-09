<?php
include 'header.php';
?>

<section class="section">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2> About </h2>
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
                                    about
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

        <div class="row">
            <?php

            if ($_POST) {
                if (empty($_POST['description']) || empty($_FILES['image1']) || empty($_FILES['image2']) ) {
                    if (empty($_POST['description'])) {
                        $descriptionError = "Description can be required";
                        $descriptionErrorColor = "1px solid red";
                    }
                    if (empty($_FILES['image1'])) {
                        $imageError = "Image1 can be required";
                        $imageErrorColor = "1px solid red";

                    }
                    if (empty($_FILES['image2'])) {
                        $imageError = "Image2 can be required";
                        $imageErrorColor = "1px solid red";

                    }
                } else {
                    $id = 1;
                    $description = $_POST['description'];

                    $file1 = 'assets/images/about_image/' . ($_FILES['image1']['name']);
                    $imageType1 = pathinfo($file1, PATHINFO_EXTENSION);
                    $file2 = 'assets/images/about_image/' . ($_FILES['image2']['name']);
                    $imageType2 = pathinfo($file2, PATHINFO_EXTENSION);

                    if ($imageType1 != 'png' && $imageType1 != 'jpg' && $imageType1 != 'jpeg' &&
                    $imageType2 != 'png' && $imageType2 != 'jpg' && $imageType2 != 'jpeg') {
                        echo "<script>alert('Image must be png,jpg,jpeg')</script>";
                    } else {
                        $image1 = $_FILES['image1']['name'];
                        move_uploaded_file($_FILES['image1']['tmp_name'], $file1);
                        $image2 = $_FILES['image2']['name'];
                        move_uploaded_file($_FILES['image2']['tmp_name'], $file2);

                        $stmt = $pdo->prepare("UPDATE about SET description='$description',image1='$image1', image2='$image2' WHERE id='$id' ");
                        $result = $stmt->execute();
                        if ($result) {
                            echo "<script>alert('successfully Updated');window.location.href='about.php';</script>";
                            //header('Location: index.php');
                        };
                    };
                }
            }

            ?>

            <div class="col-lg-12">
                <div class="card-style settings-card-2 mb-30">
                    <div class="title mb-30 d-flex justify-content-between align-items-center">
                        <h6>Edit About Page</h6>
                        <button class="border-0 bg-transparent">
                            <i class="lni lni-pencil-alt"></i>
                        </button>
                    </div>
                    <form action="about.php" method="post" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">

                        <div class="row">
                        <div class="input-style-1">
                            <label><?php echo empty($descriptionError) ? '<p>Description</p>' : '<p style="color:red">Description must be required</p>' ?></label>
                                <textarea placeholder="Description" rows="5" name="description" style='border:<?php echo $descriptionErrorColor ?>'></textarea>
                            </div>
                            <div class="col-xxl-4">
                                <div class="input-style-1">
                                <label><?php echo empty($image1Error) ? '<p>Image1</p>' : '<p style="color:red">Image1 can be required</p>' ?></label>
                                    <input type="file" name="image1" value=""/>
                                </div>
                            </div>
                            <div class="col-xxl-4">
                                <div class="input-style-1">
                                <label><?php echo empty($image2Error) ? '<p>Image2</p>' : '<p style="color:red">Image2 can be required</p>' ?></label>
                                    <input type="file" name="image2" value=""/>
                                </div>
                            </div>



                            <div class="col-12">
                                <button class="main-btn primary-btn btn-hover" type="submit">
                                    Update 
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
    <!-- end container -->
</section>

<?php
include 'footer.php';
?>