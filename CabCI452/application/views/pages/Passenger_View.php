<!DOCTYPE html>
<html lang="en">
  <head>
  </head>
  <body>
  
      <br>
      <b><a href="index.php/Admin_controller" style="float: right;" >Back to Main Page</a></b> 
      
    <h3 align="center" >Passenger Details</h3><br>
    
    <table class = "table-bordered" width="100%" align = "center">
        <tr>
            <th><strong>Passenger ID</strong></th>
            <th><strong>Email</strong></th>
            <th><strong>Phone No</strong></th>
            <th><strong>Last Name</strong></th>
            <th><strong>First Name</strong></th>
        </tr>
        
     <?php 
     
     foreach($dt as $details)
     {?>
        <tr>
            <td><?php echo $details->Passenger_Id;?></td>
            <td><?php echo $details->Email;?></td>
            <td><?php echo $details->Phone_No;?></td>
            <td><?php echo $details->LName;?></td>
            <td><?php echo $details->FName;?></td>
            
<!--            <td><a onclick="return confirm('Do you want to delete?')" href ="<!--?php echo site_url('passenger_controller/del/'.$details->Passenger_Id);?>">Delete</a></td>-->
        </tr>    
     <?php 
     }?>  
   </table>
      
 
  </body>
</html>
<br><br>