<?php
require_once('../../includes/initialize.php');

$res = Order::find_by_id($_GET['id']);
$order = mysqli_fetch_array($res);
include_layout_template('header.php');
?>

<div class="container mt-4 mb-5">
    <h4>Order #<?php echo $order['order_id'];?> Approved</h4>
    <div class="card mt-2 mx-auto">
        <div class="card-header h6 bg-dark text-white"> 
        Order Details
        </div>
        <div class="card-block p-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Paied</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#<?php echo $order['order_id'];?></td>
                        <td><?php echo $order['order_date'];?></td>
                        <td><?php echo $order['user_name'];?></td>
                        <td><?php echo $order['ship_city']. ' '.$order['ship_address']. ' ,'.$order['ship_postal_code'] . ' ,'.$order['ship_country']; ?></td>
                        <td>$<?php echo $order['total_price'];?></td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
        <?php 
        if(!empty($_SESSION['shopping_cart']))
        {
        
            foreach($_SESSION['shopping_cart'] as $keys => $values)
            {
        ?>
                <tr>
                    <td><img src="../images<?php echo DS.$values['item_filename']; ?>" style="width:40px; height:65px;" /></td>
                    <td><?php echo $values['item_name'] ?></td>
                    <td><?php echo $values['item_quantity'].' x $'.$values['item_price']; ?></td>
                </tr>
                <?php }} ?>
    </table>
        </div>
    </div>
</div>

<?php
    unset($_SESSION['shopping_cart']);
    include_layout_template('footer.php');
 ?>


