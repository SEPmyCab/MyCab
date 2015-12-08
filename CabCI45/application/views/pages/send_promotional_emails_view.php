<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    
    <body>
        <br>

        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php/Admin_controller">Administration</a></li>
            <li><a href="index.php/passenger_controller">Promotional Emails</a></li>
        </ol>

        <h2 align="center" style="color: darkblue" >Promotional Emails</h2><br>

        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">Select Passenger(s)</div>
            <div class="panel-body">
              <p>Select the checkboxes to set email recipient(s).</p>
            </div>

            <!-- Table -->
            <table class="table table-bordered table-hover" width="100%" align = "center">
                <thead>
                    <tr>
                        <th><strong>Passenger Name</strong></th>
                        <th><strong>Email</strong></th>
                        <th><strong>Select All&nbsp;<input type="checkbox" onchange="checkAll(this)" aria-label="..."></strong></th>
                    </tr>
                </thead>

                <tbody>
                    <?php 

                        foreach($dt as $details)
                    {?>
                    
                    <tr>
                        <td><?php echo $details->FName;?>&nbsp;<?php echo $details->LName;?></td>
                        <td><?php echo $details->Email;?></td>
                        <td><input type="checkbox" name="emails" value="<?php echo $details->Email;?>" aria-label="..."></td>
                    </tr>    

             <?php 
             }?> 
                </tbody>
           </table>
        </div>
            
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">Email Setup</div>
            <div class="panel-body">
              <p><div class="alert alert-warning" role="alert">Better check your promotional email content twice before send.</div></p>
            </div>
            
            <?php  echo form_open('send_promotional_emails_controller/sendEmail');?>
            
                <!-- Content -->
                 <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Recipient(s)</span>
                        <input type="text" class="form-control" id="recipients" name="recipients" aria-describedby="basic-addon1" readonly>
                    <span class="input-group-btn">
                        <button class="btn btn-default" onclick="getRecipients()" type="button">Get Recipient(s)</button>
                    </span>
                 </div>
                <br/>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Subject</span>
                    <input type="text" class="form-control" id="subject" name="subject" aria-describedby="basic-addon1">
                </div>
                <br/>
                <br/>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Email Body</span>
                    <textarea rows="20" class="form-control" id="body" name="body"  aria-describedby="basic-addon1"></textarea>
                </div>
                <h4><span class="label label-success" id="spanCount"> Email Count</span></h4>
                <input type="submit" id="btn_promo"  name="btn_promo" class="btn btn-primary" value="Send Emails">

            <?php echo form_close(); ?>
    
        </div>
  </body>
</html>

