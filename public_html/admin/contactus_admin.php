<?php
require_once('../../includes/initialize.php');
include_layout_template('header.php');

?>

<div class="container mt-4 pb-5">
    <h1>Messages</h1>
        <div id="accordion">
            <?php 
            $count = 0;
            $messages = Contact::find_all();
            while($row = mysqli_fetch_array($messages)){ ?>
            <div class="card">
                <div class="card-header row bg-dark" onclick="isReaded(<?php echo $row['contact_id'];?>);">
                    <a class="card-link col-md-10 text-white" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $count;?>">
                        <?php echo $row['time'] . ' | From: '.$row['contact_email'];?>
                        <?php if($row['is_read'] == 0){ ?>
                            <span class="badge badge-danger badge-pill msg_new">New</span>
                        <?php } ?>
                    </a>
                    <div class="col-md-2">
                        <form class="message">
                            <input type="hidden" name="message_delete" value="<?php echo $row['contact_id'];?>">
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </div>
                </div>
                <div id="collapse<?php echo $count;?>" class="collapse">
                    <div class="card-body text-center">
                        <h4><?php echo $row['subject'];?></h4>
                        <p><?php echo $row['message'];?></p>
                    </div>
                </div>
            </div>
            <?php $count++; } ?>
        </div>
</div>

<script>
    function isReaded(id)
    {
        data = "&id= "+ id;
        console.log(data);
        $.ajax({
            type: "POST",
            url: "../controller/updateMsgStatus.php",
            data: data
        })
        .done(function(response){
            console.log(response);
            if(response > 0)
            {
                $("#msg_count").html(response);
            }
            else
            {
                $("#msg_count").remove();
            }
        })
    };
</script>


<?php include_layout_template('footer.php'); ?>
