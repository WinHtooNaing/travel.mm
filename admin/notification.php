<?php
include 'header.php';

$stmt = $pdo->prepare("SELECT * FROM reports ORDER BY read_as Asc");
$stmt->execute();
$result = $stmt->fetchAll();
?>


<div class="notification-wrapper">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>User Reports</h2>
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
                                <li class="breadcrumb-item active" aria-current="page">
                                    reports
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

        <div class="card-style">
            <?php
            if ($result) {
                foreach ($result as $value) {
            ?>
                    <div class="single-notification <?php echo $value['read_as'] == 0 ? "" : "readed" ?>">

                        <div class="notification">
                            <div class="image warning-bg">
                                <span><?php echo substr($value['title'], 0, 1) ?></span>
                            </div>
                            <a href="#0" class="content">
                                <h6><?php echo $value['title'] ?></h6>
                                <p class="text-sm text-gray">
                                    <?php echo $value['description'] ?>
                                </p>

                                <span class="text-sm text-medium text-gray"><?php echo date('d/m/Y', strtotime($value['created_at'])) ?></span><br>
                                <span class="text-sm text-medium text-gray"> written by : <?php echo $value['username'] ?></span>

                            </a>
                        </div>
                        <div class="action">
                            <button class="delete-btn">
                               <a href="delete-noti.php?id=<?php echo $value['id'] ?>" onclick="return confirm('Are you sure you want to delete this report')"> <i class="lni lni-trash-can"></i></a>
                            </button>
                            <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="lni lni-more-alt"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction" style="display: <?php echo $value['read_as'] == 1 ? 'none' : '' ?>">
                                <li class="dropdown-item">
                                    <a href="read_as.php?id=<?php echo $value['id'] ?>" class="text-gray">Mark as Read</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
            <?php
                }
            }else{
                ?>
                <p>No Reports</p>
                <?php
            }
            ?>

            

        </div>
    </div>
    <!-- end container -->
</div>


<?php
include 'footer.php'
?>