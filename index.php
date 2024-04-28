<?php
include 'header.php';

$stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id='2' ");
$stmt->execute();
$result = $stmt->fetchAll();
?>

<div style="width:100%;height:600px">
    <img src="about_image/group.jpg" alt="" style="width:100%;height:100%;object-fit:cover">
<h1 style="position: relative;top:-50%;color:white;font-size:5rem;text-align:center;font-family:fantasy">Travel To Myanmar</h1>
</div>
<h1 style="padding-top:70px;text-align:center">Related Posts</h1>
<section class="card-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <?php if ($result) {
                        foreach ($result as $value) { ?>
                            <div class="card-style-4 mb-30">
                                <div class="col-lg-12">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <img src="admin/post_image/<?php echo $value['image1'] ?>" alt="" style="width:90%;height:350px;object-fit:cover;border-radius:20px;margin-top:30px">
                                                </div>
                                                <div class="col-lg-6">
                                                    <img src="admin/post_image/<?php echo $value['image2'] ?>" alt="" style="width:90%;height:350px;object-fit:cover;border-radius:20px;margin-top:50px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="about" style="width: 90%;margin-left:5%">
                                            <h2 style="padding:50px 0 30px 0;"><?php echo $value['title'] ?></h2>
                                                <p style="line-height:30px">
                                                    <?php echo substr($value['description1'],0,600)?> ...
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