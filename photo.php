<?php
include 'header.php';

$stmt = $pdo->prepare("SELECT * FROM photo");
$stmt->execute();
$result = $stmt->fetchAll();
?>
<style>
    .photo-image:hover{
        transform: scale(0.9);
        transition: 1s ease;
        cursor: pointer;
        box-shadow: 0 32px 75px rgba(68, 77, 136, 0.2);
        }
</style>
<h1 style="text-align:center;padding:50px 0;font-size:3rem;font-family:fantasy">Photos</h1>
<div class="row" style="width:80%;margin-left:10%">
    <?php
    foreach($result as $value) {
    ?>
        <div class="col-lg-6 container">
            <div class="card-style-2 mb-30" style="background:#fff">
                <img src="admin/assets/images/photo/<?php echo $value['image'] ?>" alt="" style="width: 100%;height:280px;object-fit:cover;border-radius:5px" class="photo-image">
                <h4 style="padding-top:10px"><?php echo $value['title'] ?></h4>
            </div>
        </div>
    <?php
    }
    ?>

</div>

<?php
include 'footer.php';
?>