<br>

<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
        <?php
            if ($this->session->userdata("logged_in") == TRUE && $this->session->userdata['logged_in']['email']=='a@gmail.com') {
        ?>
        <li><a href="index.php/Admin_controller">Administration</a></li>
        <?php } ?>
  <li><a href="index.php/comments_controller/loaddata">Feedback</a></li>
</ol>

<?php  echo form_open('comments_controller/addComments');?> 

    <h2 align="center"  style="color: darkblue">Report Drivers - Passenger's Feedback</h2><br>
    <div class="box box-primary" style="margin-left: 100px" >
    <div class="container" >
   
    <div class = "form-group" hidden="true">
        <label style="width:200px;">Passenger's Email</label>
        <?php
            if ($this->session->userdata("logged_in") == TRUE ) {
        ?>
        <input type="text" name="txtmail" value="<?php echo $this->session->userdata['logged_in']['email']; ?>"  class = "form-control" style = "width: 25%" readonly="true" /><br>
        <?php } ?>
    </div>
        
    <h5>Feedback On     :</h5> <br>
    
    <div class = "form-group">
        <label style="width:200px;">Driver's Name</label>                          
                  
        <select name="dname" class="form-control" style="width: 250px" required="true">
            <option value="">---------------Select---------------</option>
            
            <?php foreach($names as $name) { ?>
            <option value="<?php echo $name->full_name; ?>"><?php echo $name->full_name; ?></option>;
            <?php } ?>
        </select>
    </div>

    <div class = "form-group">     
        <label style="width:200px;">Comments</label>
        <textarea id="txtcomment" name = "txtcomment" class="form-control" required="true" style = "width: 250px"></textarea>
    </div>

    <div class = "form-group"> 
        <label style="width:200px;">Report Driver</label>
            <input type="radio" id="txtblock" name="txtblock" value="Block" required="true" > Block &nbsp;&nbsp;
            <input type="radio" id="txtblock" name="txtblock" value="Allow" > Allow
    </div>
    <br>

    <input type="submit" id="btnpost" name = "btnpost" value="Post" class="btn btn-primary" />

    </div>
    </div>

<?php echo form_close(); ?>