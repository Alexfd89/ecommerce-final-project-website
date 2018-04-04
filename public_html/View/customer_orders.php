<?php
require_once('../../includes/initialize.php');
include_layout_template('header.php');

$orders = Order::find_by_sql("SELECT order_id, order_date, user_name, total_price, ship_address, ship_city, ship_country, ship_postal_code, cart_id from orders WHERE user_id = ".$_SESSION['user_id'] . " order by order_id desc"); 
?>
<h1 class="text-center bg-info text-white p-5">MY ORDERS HISTORY</h1>
<div class="container">   
<?php while($row = mysqli_fetch_array($orders)){ ?>

    <div class="card mt-2 pb-5">
        <div class="card-header h6 bg-dark text-white">
        Order #<?php echo $row['order_id'];?>
        </div>
        <div class="card-block p-lg-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Paied</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row['order_date'];?></td>
                        <td><?php echo $row['user_name'];?></td>
                        <td><?php echo $row['ship_city']. ' '.$row['ship_address']. ' ,'.$row['ship_postal_code'] . ' ,'.$row['ship_country']; ?></td>
                        <td>$<?php echo $row['total_price'];?></td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>
                    <td></td>
                    <td>Item</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    </tr>
                </thead>
                <tbody>
                <?php $item_id = Order::find_by_sql("SELECT * from cart_items WHERE cart_id =".$row['cart_id']); ?>
                <?php while($vav = mysqli_fetch_array($item_id)){ ?>
                <?php $item = Item::find_by_id($vav['item_id']) ?>
                <?php while($col = mysqli_fetch_array($item)){ ?>
                    <tr>
                        <td><img src="../images/<?php echo $col['filename']?>" style="width:50px; height:70px;" alt="Item Image"></td>
                        <td><?php echo $col['name'] ?></td>
                        <td><?php echo $vav['quantity'] ?></td>
                        <td>$<?php echo $vav['item_price'] ?></td>
                    </tr>   
                <?php } ?>
            <?php } ?>
                </tbody>
            </table>    
        </div>
    </div> 
            
<?php } ?>
</div>

<?php include_layout_template('footer.php'); ?>
