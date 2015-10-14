<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
    <br>
     
    <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php/Admin_controller">Administration</a></li>
        <li><a href="index.php/location_ctrl">View Driver Location</a></li>
    </ol>
      
    <h2 align="center" style="color: darkblue">View Driver Location </h2><br>
     
        <table class="table table-bordered table-hover" align = "center" >
            <thead>
            <tr>
                <th><strong>Driver's NIC</strong></th>
                <th><strong>Vehicle No</strong></th>
                <th><strong>Latitude</strong></th>
                <th><strong>Longitude</strong></th>
            </tr>
            </thead>
        
        <tbody>
        <?php 
     
        foreach($dt as $details)
        {?>
            <tr>
                <td><?php echo $details->NIC;?></td>
                <td><?php echo $details->Vehicle_ID;?></td>
                <td><b><i class="text-primary"><?php echo $details->Latitude;?></i></td>
                <td><b><i class="text-primary"><?php echo $details->Longitude;?></i></td>
            
                <td><a href ="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo $details->Latitude;?>+<?php echo $details->Longitude;?>">Get Location</a></td>

        <?php 
        }?> 
        </tbody>
        </table>
      
    </body>
</html>
