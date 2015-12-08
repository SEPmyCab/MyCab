<br>

<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="index.php/Admin_controller">Administration</a></li>
  <li><a href="index.php/driver_controller">Driver Details</a></li>
  <li><a href="index.php/driver_controller/edit/<?php echo $nic ?>">Edit Driver Details</a></li>
  
</ol>

<h2 align="center" style="color: darkblue">Edit Driver Details</h2><br>

<?php  echo form_open('driver_controller/update');?>

<div class="box box-primary" style="margin-left: 100px" >
<div class="container" >
<br>

    <div class = "form-group">
    <label style="width:150px;" for="nic" >NIC   </label>
    <input type="text" name="txtnic" value="<?php echo $nic ?>"  class = "form-control" style = "width: 25%" readonly="true" /><br>
    </div>

    <div class = "form-group">
    <label style="width:150px;" for="mail">Email </label>
    <input type="email" name="txtmail" value="<?php echo $email ?>" class = "form-control" style = "width: 25%" required="true" readonly="true"
           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title=" Ex: ab2@gmail.com"/><br>
    </div>

    <div class = "form-group">
    <label style="width:150px;" for="certif">Certification   </label>
        
    <?php
    
    if($certif=='NOT CERTIFIED')
    {
      echo '<input type="radio" name="txtcertif" value="NOT CERTIFIED" checked="true"> NOT CERTIFIED  &nbsp;&nbsp;';
      echo '<input type="radio" name="txtcertif" value="CERTIFIED" > CERTIFIED ';
    }
    else 
    {
        echo '<input type="radio" name="txtcertif" value="CERTIFIED" checked="true"> CERTIFIED  &nbsp;&nbsp;';
        echo '<input type="radio" name="txtcertif" value="NOT CERTIFIED" > NOT CERTIFIED '; 
    }
    
    ?>
    <br>
    <br>
    </div>

    <div class = "form-group">
    <label style="width:150px;" for="status">Blocked Status   </label>
        
    <?php
    
    if($status=='ALLOWED')
    {
      echo '<input type="radio" name="txtstat" value="ALLOWED" checked="true"> ALLOWED  &nbsp;&nbsp;'; 
      echo '<input type="radio" name="txtstat" value="BLOCKED" > BLOCKED ';
    }
    else 
    {
        echo '<input type="radio" name="txtstat" value="BLOCKED" checked="true"> BLOCKED  &nbsp;&nbsp;';
        echo '<input type="radio" name="txtstat" value="ALLOWED" > ALLOWED '; 
    }
    
    ?>
    <br>
    </div>
    
<br>

    <input type="submit" value="Update" name="btnsubmit" class = "btn btn-primary" />

</div>
</div>
    
<?php echo form_close(); ?>


