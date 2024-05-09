<?php
include 'header.php';

$stmt = $pdo->prepare('SELECT * FROM about WHERE id=1');
$stmt->execute();
$result = $stmt->fetchAll();

?>
<section class="card-components">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row">
        <div class="col-xl-12 col-lg-12">
          <div class="card-style-4 mb-30">
            <!-- image header start  -->
            <div class="row">
              <div class="col-lg-10 container">
                <div class="row" style="margin-top:50px">
                  <div class="col-lg-4">
                    <img src="admin/assets/images/about_image/<?php echo $result[0]['image1'] ?>" alt="" style="width:100%;border-radius:20px;object-fit:cover;height:250px">
                  </div>
                  <div class="col-lg-8">
                    <img src="admin/assets/images/about_image/<?php echo $result[0]['image2'] ?>" alt="" style="width:90%;margin-left:10%;border-radius:20px;object-fit:cover;height:300px">
                  </div>
                </div>
              </div>
            </div>
            <br><br>
            <div class="row">
              <div class="col-lg-10 container">
                <div class="card-style-4 mb-30" style="background:#f1f5f9">
                  <h1 style="text-align:center;margin:30px 0 30px 0">Travel.mm</h1>
                  <p style="line-height:30px;margin-bottom:30px">
                    <?php echo $result[0]['description'] ?>

                  </p>
                  <p><a href="about-me.php">Learn about me</a></p>
                </div>
              </div>

            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- <section class="card-components">
        <div class="container-fluid">
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-12">
                <div class="title">
                  <h2 style="text-align: center;">How To Start Your Live Stream</h2>
                </div>
              </div>
              
            </div>
          </div>
          
          <div class="cards-styles">
           
            <div class="row">
              <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card-style-1 mb-30">
                  <div class="card-meta" >
                     <div style="border:1px solid gray;border-radius:50%;padding:10px">
                     <i class="lni lni-code-alt" style="font-size:30px"></i>
                     </div>
                  </div>
                  <div class="card-content">
                    <h4><a href="#0"> Card Title here </a></h4>
                    <p>
                      With supporting text below as a natural lead-in to
                      additional content. consectetur adipiscing elit. Integer
                      posuere erat a ante.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card-style-1 mb-30">
                  <div class="card-meta" >
                     <div style="border:1px solid gray;border-radius:50%;padding:10px">
                     <i class="lni lni-code-alt" style="font-size:30px"></i>
                     </div>
                  </div>
                  <div class="card-content">
                    <h4><a href="#0"> Card Title here </a></h4>
                    <p>
                      With supporting text below as a natural lead-in to
                      additional content. consectetur adipiscing elit. Integer
                      posuere erat a ante.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card-style-1 mb-30">
                  <div class="card-meta" >
                     <div style="border:1px solid gray;border-radius:50%;padding:10px">
                     <i class="lni lni-code-alt" style="font-size:30px"></i>
                     </div>
                  </div>
                  <div class="card-content">
                    <h4><a href="#0"> Card Title here </a></h4>
                    <p>
                      With supporting text below as a natural lead-in to
                      additional content. consectetur adipiscing elit. Integer
                      posuere erat a ante.
                    </p>
                  </div>
                </div>
              </div>
              
            </div>
            
          </div>
         
        </div>
      </section> -->



<?php
include 'footer.php'
?>