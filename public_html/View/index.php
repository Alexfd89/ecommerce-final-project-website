<?php
require_once('../../includes/initialize.php');



include_layout_template('header.php'); 
?>

<!--======================================CAROUSEL==============================================================-->
<div id="carouselExampleIndicators" class="carousel slide d-none d-xl-block" data-ride="carousel">
<ol class="carousel-indicators">
  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
</ol>
<div class="carousel-inner">
  <div class="carousel-item active">
    <img class="" src="../images/bpi.jpg" style="height: 400px; width: 100%;">
  </div>
  <div class="carousel-item">
    <img class="" src="../images/dy.png" style="height: 400px; width: 100%;">
  </div>
  <div class="carousel-item">
    <img class="" src="../images/sy.jpg" style="height: 400px; width: 100%;">
  </div>
</div>
<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  <span class="sr-only">Next</span>
</a>
</div>


  <div class=" text-center pt-5 pb-3" style="font-family: 'Assistant', sans-serif;">
    <div class="container">
    <h2 class="text-info font-weight-bold">WE ARE THE WORLD'S LARGEST ONLINE FITNESS STORE AND A LOT MORE</h2><br>
    <p class="">We are fitShop.com. Your transformation is our passion. We are your personal trainer, your nutritionist, your supplement expert, your lifting partner, your support group. We provide the technology, tools, and products you need to burn fat, build muscle, and become your best self.</p>
    <button class="btn btn-info"><a class="text-white" href="/PowerMass/public/view/store.php">VIEW STORE</a></button>
    </div>
  </div>
<!--======================================ITEMS==============================================================-->
<hr>
  <div class="container pt-4 pb-5">
    <h3 class="text-center mb-5 text-info" style="font-family: 'Assistant', sans-serif;">LAST ADDED ITEMS</h3>
      <div class="d-flex justify-content-between flex-wrap">
          <?php $sql = Item::find_by_sql("SELECT * from items order by item_id desc LIMIT 4"); while($row = mysqli_fetch_array($sql))
          {
              ?>
          <div class="card text-center border-info last-items " style="width:220px; height:100%;">
              <a href="item_details.php?id=<?php echo $row['item_id']; ?>">
                  <img class="card-img-top mt-2 " src="<?php echo '../images'.DS.$row['filename'];?>" style="width:120px; height:175px;" alt="Card image">
              </a>
              <div class="card-body p-0">
                  <h6 class="card-title mt-1 mb-0"><?php echo $row['name'];?></h6>
                  <h7 class="card-text" style="color:grey; font-size:14px;"><?php echo $row['brand_name'];?></h7>
                  <p class="card-text mb-1"><?php echo 'Price: $ '.$row['price'];?></p>
                  <a href="item_details.php?id=<?php echo $row['item_id']; ?>" class="btn btn-info btn-block p-1 m-0">VIEW PRODUCT</a>
              </div>
          </div>

          <?php } ?>
      </div>
  </div>

<?php 
include_layout_template('footer.php'); ?>
