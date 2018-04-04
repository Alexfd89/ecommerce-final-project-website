<?php 
require_once('../../includes/initialize.php');

if(isset($_GET['category']))
$rows = Item::find_by_category($_GET['category']);
else
$rows = Item::find_all();

include_layout_template('header.php');
?>

<div class="container">
    <div id="uaua">
        <div class="d-flex justify-content-between align-content-around flex-wrap ">
            <?php while($row = mysqli_fetch_array($rows))
            {
                ?>

            <div class="card text-center border-info m-2" style="width:220px; height:100%;">
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
</div>

<?php include_layout_template('footer.php'); ?>
