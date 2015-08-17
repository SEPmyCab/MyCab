<!DOCTYPE html>
<html lang="en">
  <head>
  </head>
  <body>
  
      <br>
      <b><a href="index.php/Admin_controller" style="float: right;" >Back to Main Page</a></b> 
      
      <h3 align="center">Driver Details</h3><br>
      
    <table class = "table-bordered" width="100%" align = "center">
        <tr>
            <th><strong>NIC</strong></th>
            <th><strong>Email</strong></th>
            <th><strong>Phone No</strong></th>
            <th><strong>Last Name</strong></th>
            <th><strong>First Name</strong></th>
            <th><strong>Certification</strong></th>
            <th><strong>Status</strong></th>
        </tr>
        
     <?php 
     
     foreach($dt as $details)
     {?>
        <tr>
            <td><?php echo $details->NIC;?></td>
            <td><?php echo $details->Email;?></td>
            <td><?php echo $details->Phone_No;?></td>
            <td><?php echo $details->LName;?></td>
            <td><?php echo $details->FName;?></td>
            <td><?php echo $details->Certification;?></td>
            <td><?php echo $details->status;?></td>
            
            <td><a href ="<?php echo site_url('driver_controller/edit/'.$details->NIC);?>">Edit</a></td>
<!--            <td><a onclick="return confirm('Do you want to delete?')"on href ="<!--?php echo site_url('driver_controller/del/'.$details->NIC);?>">Delete</a></td>-->
             
        </tr>    
     <?php 
     }?>  
   </table>

  </body>
</html>
