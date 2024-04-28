<?php
include 'header.php';
?>

<?php

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id=" . $_GET['id']);
$stmt->execute();
$result = $stmt->fetchAll();


$user_id = $result[0]['user_id'];
$region_id = $result[0]['region_id'];

$stmtUser = $pdo->prepare("SELECT * FROM users WHERE id=$user_id");
$stmtUser->execute();
$resultUser = $stmtUser->fetchAll();

$stmtRegionId = $pdo->prepare("SELECT * FROM region WHERE id=$region_id");
$stmtRegionId->execute();
$resulRegionId = $stmtRegionId->fetchAll();
?>

<section class="card-components">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <div class="card-style-4 mb-30">
                        <br>
                        <div class="row">
                            <div class="col-lg-10">
                                <h1><?php echo $result[0]['title'] ?></h1>
                            </div>
                            <div class="col-lg-2">
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
                                            } else {
                                                if ($resultUser[0]['username'] == "Win Htoo Naing") {
                                                ?>
                                                    Admin

                                                <?php } else if ($resultUser[0]['username'] == $_SESSION['username']) {
                                                ?>
                                                    You
                                        <?php

                                                } else {
                                                    echo $resultUser[0]['username'];
                                                }
                                            }
                                        } ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="image">
                                    <img src="admin/post_image/<?php echo $result[0]['image1'] ?>" alt="" style="width: 80%;height:300px;object-fit:cover;margin-left:10%;border-radius: 20px;margin-bottom:20px">
                                    <img src="admin/post_image/<?php echo $result[0]['image2'] ?>" alt="" style="width: 80%;height:300px;object-fit:cover;margin-left:10%;border-radius: 20px;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="about" style="width: 90%;margin-left:5%">
                                    <p style="line-height:30px">
                                        <?php echo $result[0]['description1'] ?>
                                    </p>
                                    <p style="line-height:30px">
                                        <?php echo $result[0]['description2'] ?>
                                    </p>

                                </div>
                            </div>
                            

                        </div>
                        
                        <br><br>
                        <div class="row">
                            <div class="col-lg-10">
                                <p>place -  <?php echo $resulRegionId[0]['name']; ?> - <?php echo $result[0]['city'] ?></p>
                            </div>
                            <div class="col-lg-2">
                                <p>posted date - <?php echo date('d/m/Y', strtotime($result[0]['created_at'])) ?></p>
                            </div>


                        </div>

                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->


            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>