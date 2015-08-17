<br>
<b><a href="index.php/Admin_controller" style="float: right;" >Back to Main Page</a></b>

<?php  echo form_open('driver_controller/update');?>

<div class="container" >
<br>

    <div class = "form-group">
    <label style="width:150px;" for="nic" >NIC   </label>
    <input type="text" name="txtnic" value="<?php echo $nic ?>"  class = "form-control" style = "width: 25%" readonly="true" /><br>
    </div>

    <div class = "form-group">
    <label style="width:150px;" for="mail">Email </label>
    <input type="email" name="txtmail" value="<?php echo $email ?>" class = "form-control" style = "width: 25%" required="true" 
           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title=" Ex: ab2@gmail.com"/><br>
    </div>

    <div class = "form-group">
    <label style="width:150px;" for="phone">Phone No </label>
    <input type="tel" name="txtphone" value="<?php echo $phone ?>" class = "form-control" style = "width: 25%" required="true" pattern="[07][12678][0-9]{8}" 
           onkeypress='return event.charCode >= 48 && event.charCode <= 57' title="Enter only 10 numbers starting from 07.. (0772305287)"/><br>
    </div>

    <div class = "form-group">
    <label style="width:150px;" for="certif">Certification   </label>
        
    <?php
    
    if($certif=='NOT CERTIFIED')
    {
      echo '<input type="radio" name="txtcertif" value="NOT CERTIFIED" checked="true"> NOT CERTIFIED '; 
      echo '<input type="radio" name="txtcertif" value="CERTIFIED" > CERTIFIED ';
    }
    else 
    {
        echo '<input type="radio" name="txtcertif" value="CERTIFIED" checked="true"> CERTIFIED ';
        echo '<input type="radio" name="txtcertif" value="NOT CERTIFIED" > NOT CERTIFIED '; 
    }
    
    ?>
    <br>
    </div>

    <div class = "form-group">
    <label style="width:150px;" for="status">Blocked Status   </label>
        
    <?php
    
    if($status=='ALLOWED')
    {
      echo '<input type="radio" name="txtstat" value="ALLOWED" checked="true"> ALLOWED '; 
      echo '<input type="radio" name="txtstat" value="BLOCKED" > BLOCKED ';
    }
    else 
    {
        echo '<input type="radio" name="txtstat" value="BLOCKED" checked="true"> BLOCKED ';
        echo '<input type="radio" name="txtstat" value="ALLOWED" > ALLOWED '; 
    }
    
    ?>
    <br>
    </div>
    
<br>

    <input type="submit" value="Update" name="btnsubmit" class = "btn btn-primary" />

</div>
    
<?php echo form_close(); ?>


