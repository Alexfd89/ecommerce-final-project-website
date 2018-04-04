<?php
require_once('../../includes/initialize.php');
include_layout_template('header.php');
?>


<div class="container mt-4 pb-5">
    <h1>Orders</h1>
        <div id="accordion">
            <?php 
            $count = 0;
            $orders = Order::find_all();
            while($row = mysqli_fetch_array($orders)){ ?>
            <div class="card" onclick="updateOrderStatus(<?php echo $row['order_id'];?>);">
                <div class="card-header row bg-dark" >
                    <a class="card-link col-md-10 text-white" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $count;?>">
                        <?php echo $row['order_date'] . ' | Order ID: #'.$row['order_id']  ?>
                        <?php if($row['is_watched'] == 0){?>
                        <span class="badge badge-danger badge-pill order_ntf">New</span>
                    <?php } ?>
                    </a>
                    <div class="col-md-2">
                        <form class="order">
                            <input type="hidden" name="order_delete" value="<?php echo $row['order_id'];?>">
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </div>
                </div>
                <div id="collapse<?php echo $count;?>" class="collapse">
                    <div class="card-body">
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Address</th>
                                        <th>Postal Code</th>
                                        <th>Paied</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row['user_id'];?></td>
                                        <td><?php echo $row['user_name'];?></td>
                                        <td><?php echo $row['ship_phone'];?></td>
                                        <td><?php echo $row['ship_country'];?></td>
                                        <td><?php echo $row['ship_city'];?></td>
                                        <td><?php echo $row['ship_address'];?></td>
                                        <td><?php echo $row['ship_postal_code'];?></td>
                                        <td>$<?php echo $row['total_price'];?></td>
                                    </tr>
                                </tbody>
                        </table>
                        <br><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item Name</th>
                                    <th>Item ID</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $item_id = Order::find_by_sql("SELECT * from cart_items WHERE cart_id =".$row['cart_id']); ?>
                                    <?php while($row = mysqli_fetch_array($item_id)){ ?>
                                        <?php $item = Item::find_by_id($row['item_id']) ?>
                                        <?php while($col = mysqli_fetch_array($item)){ ?>
                                            <tr>
                                            <td><img src="../images/<?php echo $col['filename']?>" style="width:50px; height:70px;" alt="Item Image"></td>
                                            <td><?php echo $col['name'] ?></td>
                                            <td><?php echo $col['item_id'] ?></td>
                                            <td><?php echo $col['category'] ?></td>
                                            <td><?php echo $row['quantity'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                            </tbody>
                        </table>     
                    </div>
                </div>
            </div>
                <?php $count++; } ?>
        </div>
</div>

<script>
function updateOrderStatus(id)
{
    data = "&id= "+ id;
        $.ajax({
            type: "POST",
            url: "../controller/updateOrderStatus.php",
            data: data
        })
        .done(function(){
            $(".order_ntf:hover").remove();
        })
}
</script>

<?php include_layout_template('footer.php'); ?>
