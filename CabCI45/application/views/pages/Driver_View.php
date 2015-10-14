<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
    <br>
     
    <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php/Admin_controller">Administration</a></li>
        <li><a href="index.php/driver_controller">Driver Details</a></li>
    </ol>
      
    <h2 align="center" style="color: darkblue">Driver Details</h2><br>
      
    <table class="table table-bordered table-hover" width="100%" align = "center">
        <thead>
        <tr>
            <th><strong>NIC</strong></th>
            <th><strong>Email</strong></th>
            <th><strong>Phone No</strong></th>
            <th><strong>Last Name</strong></th>
            <th><strong>First Name</strong></th>
            <th><strong>Certification</strong></th>
            <th><strong>Status</strong></th>
        </tr>
        </thead>
      
        <tbody>
     <?php 
     
     foreach($dt as $details)
     {?>
        <tr>
            <td><?php echo $details->NIC;?></td>
            <td><?php echo $details->Email;?></td>
            <td><?php echo $details->Phone_No;?></td>
            <td><?php echo $details->LName;?></td>
            <td><?php echo $details->FName;?></td>
            <td><b><i class="text-danger"><?php echo $details->Certification;?></i></td>
            <td><b><i class="text-danger"><?php echo $details->status;?></i></td>
            
            <td><a href ="<?php echo site_url('driver_controller/edit/'.$details->NIC);?>">Edit</a></td>
        </tr>    
     <?php 
     }?>  
        </tbody>   
   </table>

  </body>
</html>
