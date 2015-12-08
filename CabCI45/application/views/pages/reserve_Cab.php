<script 
    src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places">
</script>

<script type="text/javascript">
    
function initialize()
{
    var input1 = document.getElementById('pickup_from');
    var input2 = document.getElementById('GoingTo');
    var options = {componentRestrictions: {country: 'LK'}};
    new google.maps.places.Autocomplete(input1,options);
    new google.maps.places.Autocomplete(input2,options);
}
    google.maps.event.addDomListener(window, 'load', initialize);  

</script>
            
<html lang="en">
    <head>
    </head>
  
    <body>
    <br>
        
    <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <?php
            if ($this->session->userdata("logged_in") == TRUE && $this->session->userdata['logged_in']['email']=='a@gmail.com') {
        ?>
        <li><a href="index.php/Admin_controller">Administration</a></li>
        <?php } ?>
        <li><a href="index.php/reserve_controller">Reserve Vehicle</a></li>
    </ol>
   
    <h2 align="center" style="color: darkblue  ">Reserve Vehicles</h2><br>
    
    <?php  echo form_open('reserve_controller/addReservation');?> 
    
    <div class="box box-primary" style="float:left; margin-left: 10%; width:40%;" >
        <form id="r_form">
        <div class="input-group">
            <label style="width:240px;" for="pickupLoc" >Pickup Location</label>
            <span class="input-group-addon"><img src="assets/images/ic_marker_green.png" height="20" width="12"></span>
            <input type="text" class="form-control" id="pickup_from" name="pickup_from" placeholder="Pickup From" value="" required="true" autocomplete="on" style = "width: 250px">
        </div>
                        
        <br>
        <div class="input-group">
            <label style="width:240px;" for="dropLoc" >Drop Location</label>
            <span class="input-group-addon"><img src="assets/images/ic_marker_red.png" height="20" width="12"></span>
            <input type="text" class="form-control" id="GoingTo" name="GoingTo" placeholder="Going To" value="" required="true" autocomplete="on" style = "width: 250px">
        </div>
          
        <?php
            $date = date("Y-m-d\TH:i",time());
        ?>
        
        <br>
        <div class="input-group">
            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
												
            <label style="width:240px;" for="date_time" >Pickup Date & Time</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
            <input type="datetime-local" class="form-control" id="date_time" name="date_time" min="<?php echo $date; ?>" style = "width: 250px" required="true">
        </div></div>
                    
        <br>
        <div class="input-group">
            <label style="width:240px;" for="phone">Phone No </label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-earphone"></span>
            </span>
            <input type="tel" name="txtphone" id="txtphone" class = "form-control" style = "width: 250px" placeholder="Phone No" required="true" pattern="[07][12678][0-9]{8}" 
                   onkeypress='return event.charCode >= 48 && event.charCode <= 57' title="Enter only 10 numbers starting from 07.. (0772305287)">
        </div>
                    
        <br>
        <div class="input-group">
            <label style="width:240px;" for="type">Vehicle Type</label>
            <span class="input-group-addon"><img src="assets/images/car_icon.png" height="20" width="18"></span>
            <select name="vtype" id="vtype" class="form-control" style = "width: 250px" required="true">
                <option value="">----Select Vehicle----</option>
                <option>Car</option>
                <option>Van</option>
                <option>Three Wheeler</option>
            </select>    
        </div> 
                   
        <br>
        <div class="form-group" style="width:200%;"> 
            <label style="width:240px;" for="ac">AC / Non AC</label>
            <input type="radio" id="AC" name="AC" value="AC" required="true"> AC&nbsp;&nbsp;
            <input type="radio" id="AC" name="AC" value="Non AC" > Non AC
        </div>      
                
        <br>
        <div class="input-group">
            <label style="width:240px;" for="purpose">Purpose</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-th-list"></span>
            </span>
            <select name="purpose" id="purpose" class="form-control" style = "width: 250px" required="true">
                <option value="">----Select Purpose----</option>
                <option>Hourly rentals, full day, half day</option>
                <option>City Taxi</option>
                <option>Airport Drops and Pickups</option>
                <option>Station Drops and Pickups</option>
                <option>Outstation - Other Cities</option>
            </select>    
        </div> 
                    
        <br>
        <br>
        <input type="submit" id="btnBook" name ="btnBook" value="Reserve Vehicle"  class="btn btn-primary"
             onclick="return confirm('Confirm cab reservation details ?');" />
        <br>
        <br>
      </form>              
    </div>
    
    <?php echo form_close(); ?>

    <div class="container" style="float:right; width:30%; margin-top: 5%" >
          <br>
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
          
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <img src="assets/images/slides/r_cab2.png" alt="My Cab" width="500px" height="600px">
              </div>
              
              <div class="item">
                <img src="assets/images/slides/r_cab1.png" alt="My Cab" width="500px" height="600px">
              </div>
                
              <div class="item">
                <img src="assets/images/slides/MyCab Slide 1.jpg" alt="My Cab" width="500px" height="700px">
              </div>
 
            </div>
        </div>
            
    </div>
   
    </body>	
    
</html>
