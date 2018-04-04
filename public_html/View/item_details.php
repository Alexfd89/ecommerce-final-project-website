<?php
require_once('../../includes/initialize.php');

$rows = Item::find_by_id($_GET['id']);
$row = mysqli_fetch_array($rows);

include_layout_template('header.php'); 
?>


<div class="container mt-5 mb-5">
    <div class="row d-flex">
        <div class="col-md-4">
            <img src="<?php echo '../images' . DS . $row['filename']; ?>" style="width:220px; height:310px;"/>
        </div>
        <div class="col-md-8 flex-column">
            <a href="store.php" style="text-decoration:none;"><?php echo $row['brand_name'];?></a>
            <h1><?php echo $row['name'];?></h1>
            <p><?php echo $row['description'];?></p>
            <div class="justify-content-end">
            <h6>Price: $<?php echo $row['price'];?></h6>
                <form id="cart_add" >
                        <?php if($row['quantity'] > 0){ ?>
                        Quantity: <select class="form-control" id="qnt" name="quantity" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'  style="width: 80px;">
                        <?php for($i = 1; $i < $row['quantity']+1; $i++){ 
                            
                            echo '<option>'.$i.'</option>';

                         } }
                         else{
                            echo "<img src='../images/stock.jpg' alt='out_of_stock' style='width: 190px;'>";
                         }
                         ?>
                        </select>
                        <input type="hidden" id="item_price" name="hidden_price" value="<?php echo $row['price'] ;?>" /> 
                        <input type="hidden" name="hidden_name" value="<?php echo $row['name'] ;?>" /> 
                        <input type="hidden" name="hidden_filename" value="<?php echo $row['filename'] ;?>" /> 
                        <input type="hidden" id="qnt_check" name="hidden_quantity" value="<?php echo $row['quantity'] ;?>" /> 
                        <input type="hidden" name="item_id" value="<?php echo $row['item_id'] ;?>" /> 
                    <br>
                    <?php if($row['quantity'] > 0){ ?>
                    <input type="submit" name="add_to_cart" class="btn btn-info" value="Add to Cart" />
                    <?php } ?>
                </form> 
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('footer.php'); ?>
