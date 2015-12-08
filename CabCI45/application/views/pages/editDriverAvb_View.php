<?php
    $id = $this->uri->segment(3);
?>
        
<br>

<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="index.php/Admin_controller">Administration</a></li>
  <li><a href="index.php/driver_controller">Driver Details</a></li>
  <li><a href="index.php/driver_controller/editAvb/<?php echo $id ?>">Edit Driver Availability Details</a></li>
  
</ol>

<h3 align="center" style="color: darkblue">Edit Driver Availability Details</h3><br>

<?php  echo form_open('driver_controller/updateAvb');?>

<div class="box box-primary" style="margin-left: 100px" >
<div class="container" >
<br>

        <div class="input-group">
            <label style="width:94px;" for="nic" >Driver's NIC</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-credit-card"></span>
            </span>
            <input type="text" class="form-control" id="nic" name="nic" value="<?php echo $nic ?>" readonly="true" style = "width: 250px">
        </div>    
                  
        <br><br>

        <label style="float:left; margin-left: 27%;" for="to_from" >From</label> 
        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To</label><br><br>
        
        <br>
        <div class="input-group" style="float:left;">
            <div class="input-group input-medium date date-picker">
            <label style="width:240px;" for="date_time" >Monday</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="from_time1" name="from_time1" value="<?php echo $mf;?>" style = "width: 120px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="to_time1" name="to_time1" value="<?php echo $mt;?>" style = "width: 120px">
            </div>
        </div>
        
        <br><br><br>
        <div class="input-group" style="float:left;">
            <div class="input-group input-medium date date-picker">
            <label style="width:240px;" for="date_time" >Tuesday</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="from_time2" name="from_time2" value="<?php echo $tf;?>" style = "width: 120px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="to_time2" name="to_time2" value="<?php echo $tt;?>" style = "width: 120px">
            </div>
        </div>
        
        <br><br><br>
        <div class="input-group" style="float:left;">
            <div class="input-group input-medium date date-picker">
            <label style="width:240px;" for="date_time" >Wednesday</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="from_time3" name="from_time3" value="<?php echo $wf;?>" style = "width: 120px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="to_time3" name="to_time3" value="<?php echo $wt;?>" style = "width: 120px">
            </div>
        </div>
        
        <br><br><br>
        <div class="input-group" style="float:left;">
            <div class="input-group input-medium date date-picker">
            <label style="width:240px;" for="date_time" >Thursday</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="from_time4" name="from_time4" value="<?php echo $thf;?>" style = "width: 120px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="to_time4" name="to_time4" value="<?php echo $tht;?>" style = "width: 120px">
            </div>
        </div>
        
        <br><br><br>
        <div class="input-group" style="float:left;">
            <div class="input-group input-medium date date-picker">
            <label style="width:240px;" for="date_time" >Friday</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="from_time5" name="from_time5" value="<?php echo $ff;?>" style = "width: 120px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="to_time5" name="to_time5" value="<?php echo $ft;?>" style = "width: 120px">
            </div>
        </div>
        
        <br><br><br>
        <div class="input-group" style="float:left;">
            <div class="input-group input-medium date date-picker">
            <label style="width:240px;" for="date_time" >Saturday</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="from_time6" name="from_time6" value="<?php echo $sf;?>" style = "width: 120px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="to_time6" name="to_time6" value="<?php echo $st;?>" style = "width: 120px">
            </div>
        </div>
        
        <br><br><br>
        <div class="input-group" style="float:left;">
            <div class="input-group input-medium date date-picker">
            <label style="width:240px;" for="date_time" >Sunday</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="from_time7" name="from_time7" value="<?php echo $suf;?>" style = "width: 120px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            <input type="time" class="form-control" id="to_time7" name="to_time7" value="<?php echo $sut;?>" style = "width: 120px">
            </div>
        </div>
        
        <input type="hidden" id="id" name="id" value="<?php echo $nic  ?>"/><br>
        
        <br><br>
        <input type="submit" id="btnUpdate" name ="btnUpdate" value="Update Availability Details"  class="btn btn-primary"
                    onclick="return confirm('Confirm availability details ?');" />
        <br><br>

</div>
</div>
    
<?php echo form_close(); ?>


