<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
    <br>
     
    <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php/Admin_controller">Administration</a></li>
        <li><a href="index.php/passenger_controller">Passenger Details</a></li>
    </ol>

    <h2 align="center" style="color: darkblue" >Passenger Details</h2><br>
    
    <table class="table table-bordered table-hover" width="100%" align = "center">
        <thead>
        <tr>
            <th><strong><i class="glyphicon glyphicon-credit-card"></i>&nbsp; Passenger ID</strong></th>
            <th><strong><i class="glyphicon glyphicon-envelope"></i>&nbsp; Email</strong></th>
            <th><strong><i class="glyphicon glyphicon-phone"></i>&nbsp; Phone No</strong></th>
            <th><strong><i class="glyphicon glyphicon-user"></i>&nbsp; Last Name</strong></th>
            <th><strong><i class="glyphicon glyphicon-user"></i>&nbsp; First Name</strong></th>
        </tr>
        </thead>
        
        <tbody>
     <?php 
     
     foreach($dt as $details)
     {?>
        <tr>
            <td><?php echo $details->Passenger_Id;?></td>
            <td><?php echo $details->Email;?></td>
            <td><?php echo $details->Phone_No;?></td>
            <td><?php echo $details->LName;?></td>
            <td><?php echo $details->FName;?></td>
        </tr>    
        
     <?php 
     }?> 
        </tbody>
   </table>
      
 
  </body>
</html>
<br><br>