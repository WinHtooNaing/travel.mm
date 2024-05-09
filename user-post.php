<?php
include 'header.php';


$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id=$user_id ORDER BY id DESC");
$stmt->execute();
$result = $stmt->fetchAll();

$stmtCat = $pdo->prepare("SELECT * FROM region ");
$stmtCat->execute();
$resultCat = $stmtCat->fetchAll();
?>

<section class="table-components">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30" style="width:90%;margin-left:5%">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Your Posts</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <a href="create-user-post.php" style="float:right" class="btn btn-primary">Create A Post</a>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->

        <!-- ========== tables-wrapper start ========== -->
        <?php
        if ($result) {
            foreach ($result as $value) {
        ?>
                <div class="tables-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-style mb-30">
                                <div style="display: flex;justify-content:flex-end">
                                    <a href="edit-user-post.php?id=<?php echo $value['id'] ?>" class="btn btn-warning" style="margin-right:20px">Edit</a>
                                    <a href="delete-user-post.php?id=<?php echo $value['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this post')" >Delete</a>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <img src="admin/assets/images/post_image/<?php echo $value['image1'] ?>" alt="" style="width:100%;height:230px;object-fit:cover;border-radius:10px">
                                            </div>
                                            <div class="col-lg-6">
                                                <img src="admin/assets/images/post_image/<?php echo $value['image2'] ?>" alt="" style="width:100%;height:230px;object-fit:cover;border-radius:10px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <h2><?php echo $value['title'] ?></h2><br>
                                        <p><?php echo $value['description1'] ?></p>
                                    </div>
                                </div>
                                <p><?php echo $value['description2'] ?></p>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->


                </div>
            <?php
            }
        } else {
            ?>
            <div class="tables-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30 container col-lg-12">
                            <p style="text-align:center">No post</p><br>
                            <p style="text-align:center"><a href="create-user-post.php" class="btn btn-primary">Create your first post</a></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- ========== tables-wrapper end ========== -->
    </div>
    <!-- end container -->
</section>

<?php
include 'footer.php'
?>