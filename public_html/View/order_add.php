<?php 
require_once('../../includes/initialize.php');

//authenticate
if(!$session->is_logged_in())
redirect_to('login.php');

//find user details
$res = User::find_by_id($_SESSION['user_id']);
$user = mysqli_fetch_array($res);

//getting accsess from credit card company that payment done succsessfully
$is_payment_confirmed = true;

if(isset($_POST['submit']))
{
    if($is_payment_confirmed)
    {
        //Create new cart row
        $cart = new Cart($user['user_id']);
        $cart->create();

        //Create new cart_items rows
        $cart_items = new Cart_items();
        $cart_items->cart_id = $cart->cart_id;
        foreach($_SESSION['shopping_cart'] as $keys => $values)
        {
            $cart_items->item_id = $values['item_id'];
            $cart_items->item_price = $values['item_price'];
            $cart_items->quantity = $values['item_quantity'];
            $cart_items->total = $values['item_price'] * $values['item_quantity'];
            $cart_items->create();

            //update item quantity
            Item::update_item_quantity($values['item_id'],$values['item_quantity']);
        }

        $order = new Order();

        $order->user_id = $user['user_id'];
        $order->cart_id = $cart->cart_id;
        $order->order_date = date('d/m/Y');
        $order->user_name = ucwords($_POST['first_name'].' '.$_POST['last_name']);
        $order->ship_address = $_POST['ship_address'];
        $order->ship_city = $_POST['ship_city'];
        $order->ship_postal_code = $_POST['ship_postal_code'];
        $order->ship_country = $_POST['ship_country'];
        $order->ship_phone = $_POST['ship_phone'];
        $order->total_price = $cart->get_total();
        $order->credit_card = sha1($_POST['credit_card']);

        $order->create();
        redirect_to('order_confirm.php?id='.$order->order_id);
    }
}
include_layout_template('header.php');
?>

<div class="container">
    <div class="card mt-2">
        <div class="card-header h6 bg-dark text-white">
            Shipping Details
        </div>
        <div class="card-block p-5">
            <form action="order_add.php" method="POST">
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label for="fname" class="font-weight-bold col-4 col-form-label">First Name</label>
                        <div class="">
                            <input type="text" class="form-control" id="fname" name="first_name" value="<?php echo $user['first_name'];?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="font-weight-bold col-4 col-form-label">Last Name</label>
                        <div class="">
                            <input type="text" class="form-control" id="lname" name="last_name" value="<?php echo $user['last_name'];?>"/>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label for="ship_address" class="font-weight-bold col-4 col-form-label">Address</label>
                        <div class="">
                            <input type="text" class="form-control" id="ship_address" name="ship_address" value="<?php echo $user['ship_address'];?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ship_address" class="font-weight-bold col-4 col-form-label">City</label>
                        <div class="">
                            <input type="text" class="form-control" id="ship_city" name="ship_city" value="<?php echo $user['ship_city'];?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label for="ship_country" class="font-weight-bold col-4 col-form-label">Country</label>
                        <div class="">
                            <input type="text" class="form-control" id="ship_country" name="ship_country" value="<?php echo $user['ship_country'];?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ship_postal_code" class="font-weight-bold col-4 col-form-label">Postal Code</label>
                        <div class="">
                            <input type="text" class="form-control" id="ship_postal_code" name="ship_postal_code" value="<?php echo $user['ship_postal_code'];?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ship_phone" class="font-weight-bold col-4 col-form-label">Phone</label>
                        <div class="">
                            <input type="text" class="form-control" id="ship_phone" name="ship_phone"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="card">
        <div class="card-header h6 bg-dark text-white">
            Payment Details
        </div>
        <div class="card-block p-5">
            <div class="row">
            <div class="col-3"></div>
                <div class="col-3">
                <div class="form-group row">
                    <img id="img" src="../images/cards.png" style="width:165px; height:35px;">  
                </div>
                    <div class="form-group row">
                        <div class="">
                            <input type="text" placeholder="Credit Card Number" class="form-control" id="credit_card" name="credit_card"/>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group row">
                        <div class="">
                            <input type="text" placeholder="CVV" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="">
                            <input type="text" placeholder="Card Holder Name" class="form-control"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="submit" class="btn btn-block btn-info mb-5" name="submit" value="Order Confirm"/> 
    </form>
</div>


<?php include_layout_template('footer.php'); ?>
