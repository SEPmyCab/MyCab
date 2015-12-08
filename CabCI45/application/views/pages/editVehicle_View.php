<br>

<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="index.php/Admin_controller">Administration</a></li>
  <li><a href="index.php/vehicle_controller">Vehicle Details</a></li>
  <li><a href="index.php/vehicle_controller/edit/<?php echo $regno; ?>">Edit Vehicle Details</a></li>
  
</ol>

<h2 align="center" style="color: darkblue">Edit Vehicle Details</h2><br>

<?php  echo form_open('vehicle_controller/update');?>

<div class="box box-primary" style="float:left; margin-left: 10%; width:40%;" >
<br>
   
    <div class="input-group">
        <label style="width:240px;" for="vNo" >Vehicle Registration No</label>
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-info-sign"></span>
        </span>
        <input type="text" id="vNo" name="vNo" value="<?php echo $regno; ?>" class="form-control" readonly="true"  style = "width: 250px">
    </div>

    <br>
    <div class = "form-group" style="width:200%;">
    <label style="width:240px;" for="ac">AC / Non AC  </label>
        
    <?php
    
    if($ac=='AC')
    {
      echo '<input type="radio" name="ac" value="AC" checked="true"> AC  &nbsp;&nbsp;'; 
      echo '<input type="radio" name="ac" value="Non AC" > Non AC ';
    }
    else 
    {
        echo '<input type="radio" name="ac" value="Non AC" checked="true"> Non AC  &nbsp;&nbsp;';
        echo '<input type="radio" name="ac" value="AC" > AC '; 
    }
    
    ?>
    </div>

    <br>
    <div class="input-group">
        <label style="width:240px;" for="fuel">Fuel Type</label>
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-info-sign"></span>
        </span>
        <select name="fuel" id="fuel" class="form-control" style = "width: 250px" required="true">
            <option value="">----Select Fuel Type----</option>
             <!--<option value="<?php echo $fuel; ?>"><?php echo $fuel; ?></option>-->
            <option>Diesel</option>
            <option>Petrol</option>
            <option>Other Fuel Type</option>
        </select>    
    </div>  

    <br>
    <div class="input-group">
        <label style="width:240px;" for="phone">Contact No </label>
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-earphone"></span>
        </span>
        <input type="tel" name="txtphone" id="txtphone" value="<?php echo $phone; ?>" class = "form-control" style = "width: 250px" required="true" pattern="[07][12678][0-9]{8}" 
               onkeypress='return event.charCode >= 48 && event.charCode <= 57' title="Enter only 10 numbers starting from 07.. (0772305287)">
    </div> 

    <br>
    <br>
    <input type="submit" value="Update" name="btnsubmit" class = "btn btn-primary" onclick="return confirm('Confirm Vehicle details ?');"/>
    <br>
    <br>

</div>
    
<?php echo form_close(); ?>

<div class="container" style="float:right; margin-left: 10%; width:30%;" >
<br>
<?php
    $photo = $this->uri->segment(4);   
    echo '<img src = "upload_img/'.$photo.'" alt="Vehicle" style="width:250px;height:160px;">';
?>
</div>
