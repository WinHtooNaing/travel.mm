<?php
include 'header.php';

$stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id='2' ORDER BY created_at ");
$stmt->execute();
$result = $stmt->fetchAll();

$result_arr = [];
foreach ($result as $key => $value) {
    $result_arr[$key] = $value;
}

?>

<div style="width:100%;height:600px">
<?php
    $stmtLogo = $pdo->prepare("SELECT * FROM home WHERE id='1';");
    $stmtLogo->execute();
    $resultLogo = $stmtLogo->fetchAll()
?>
    <img src="admin/assets/images/home_logo/<?php echo $resultLogo[0]['image'] ?>" alt="" style="width:100%;height:100%;object-fit:cover">
    <h1 style="position: relative;top:-50%;color:#365CF5;font-size:5rem;text-align:center;font-family:fantasy;background: #fff;width:56%;margin-left:21%">Travel To Myanmar</h1>
</div>
<h1 style="padding-top:70px;text-align:center">Related Posts</h1>
<section class="card-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <?php if ($result) {
                        foreach ($result as $value) { ?>
                            <div class=" mb-30" style="width:90%;margin-left:5%">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <img src="admin/assets/images/post_image/<?php echo $value['image1'] ?>" alt="" style="width:100%;height:400px;object-fit:cover;border-radius:20px;margin-top:30px">
                                                </div>
                                                <div class="col-lg-6">
                                                    <img src="admin/assets/images/post_image/<?php echo $value['image2'] ?>" alt="" style="width:100%;height:400px;object-fit:cover;border-radius:20px;margin-top:70px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="about" style="width: 90%;margin-left:5%">
                                                <h2 style="padding:50px 0 30px 0;"><?php echo $value['title'] ?></h2>
                                                <p style="line-height:30px">
                                                    <?php echo substr($value['description1'], 0, 600) ?> ...
                                                    <a href="post-detail.php?id=<?php echo $value['id'] ?>">see more</a>
                                                </p>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>



<?php
include 'footer.php'
?>