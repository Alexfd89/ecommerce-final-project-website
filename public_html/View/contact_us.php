<?php
require_once('../../includes/initialize.php');
include_layout_template('header.php');
?>

<div class="container pb-5">
    <div class="row pt-4">
        <div class="col-md-6">
            <form id="contact">
                <div class="form-group">
                    <label for="email_contact" class="font-weight-bold">Email</label>
                    <input type="text" class="form-control" id="email_contact" name="email_contact"/>
                </div>
                <div class="form-group">
                    <label for="subject" class="font-weight-bold">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject"/>
                </div>
                <div class="form-group">
                    <label for="message" class="font-weight-bold">Message</label>
                    <textarea type="text" rows="5" class="form-control" id="message" name="message"></textarea>
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="SEND">
            </form>
        </div>
        <div class="col-md-6">
            <div class="center">
                <div><i class="material-icons icon-color">email</i> alexfd89@gmail.com</div>
                <div><i class="material-icons icon-color">phone</i> (+972) 547 613 747</div>
                <div><i class="material-icons icon-color">location_on</i> Frishman 29, Tel-Aviv Israel</div>
            </div>
            <div id="map"> </div>
        </div>
    </div>
</div>
<script>
function initMap() {
    var myLatLng = {lat: 32.08, lng: 34.77};
  
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: myLatLng
    });
  
    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
    });
  }
</script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJklveu-IwZLCj8iwPwN30dR4Xkf-ZDoQ&callback=initMap" type="text/javascript"></script>

<?php include_layout_template('footer.php'); ?>

<style>
    body{
        background-image: url("../images/mp.gif");
    }
</style>
