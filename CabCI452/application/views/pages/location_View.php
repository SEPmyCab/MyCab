<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
  
      <br>
      <b><a href="index.php/Admin_controller" style="float: right;" >Back to Main Page</a></b>  
      
      <h3 align="center" >View Driver Location </h3><br>
    
        <table class = "table-bordered" width="75%" align = "center">
            <tr>
                <th><strong>Driver's NIC</strong></th>
                <th><strong>Vehicle No</strong></th>
                <th><strong>Latitude</strong></th>
                <th><strong>Longitude</strong></th>
            </tr>
        
        <?php 
     
        foreach($dt as $details)
        {?>
            <tr>
                <td><?php echo $details->NIC;?></td>
                <td><?php echo $details->Vehicle_ID;?></td>
                <td><?php echo $details->Latitude;?></td>
                <td><?php echo $details->Longitude;?></td>
            
                <td><a href ="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo $details->Latitude;?>+<?php echo $details->Longitude;?>">Get Location</a></td>

        <?php 
        }?>  
        </table>
      
        <a href="index.php/location_ctrl" style="float: right;" >Reload Page</a>
<!--        <input type="button" value="Refresh " name="btn_ref" onClick=location.href="index.php/location_ctrl"  class = "btn btn-primary" style="float: right" />-->
     
    </body>
</html>
