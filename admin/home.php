<?php include('header.php') ?>

<section class="section">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2> HOme Img </h2>
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
                                    home
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
                if (empty($_FILES['image'])) {
                    $imageError = "Image can be required";
                } else {
                    $id = 1;

                    $file = 'assets/images/home_logo/' . ($_FILES['image']['name']);
                    $imageType = pathinfo($file, PATHINFO_EXTENSION);
                  

                    if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg' ) {
                        echo "<script>alert('Image must be png,jpg,jpeg')</script>";
                    } else {
                        $image = $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'], $file);

                        $stmt = $pdo->prepare("UPDATE home SET  image='$image' WHERE id='$id' ");
                        $result = $stmt->execute();
                        if ($result) {
                            echo "<script>alert('successfully Updated');window.location.href='home.php';</script>";
                            //header('Location: index.php');
                        };
                    };
                }
            }

            ?>

            <div class="col-lg-12">
                <div class="card-style settings-card-2 mb-30">
                    <div class="title mb-30 d-flex justify-content-between align-items-center">
                        <h6>Edit Home Page Image</h6>
                        <button class="border-0 bg-transparent">
                            <i class="lni lni-pencil-alt"></i>
                        </button>
                    </div>
                    <form action="home.php" method="post" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">

                        <div class="row">

                            <div class="col-xxl-4">
                                <div class="input-style-1">
                                    <label><?php echo empty($imageError) ? '<p>Image</p>' : '<p style="color:red">Image can be required</p>' ?></label>
                                    <input type="file" name="image" value="" />
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

<?php include('footer.php') ?>