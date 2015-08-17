<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
  
    <body>
  
    <br>
    <b><a href="index.php/Admin_controller" style="float: right;" >Back to Main Page</a></b>
    
    <h3 align="center">Block Drivers</h3><br>
          
    <table class = "table-bordered" width="75%" align = "center" >
        <tr>
            <th><strong>Driver's Name</strong></th>
            <th><strong>Status</strong></th>
        </tr>
        
        <?php 
        foreach($dt1 as $details)
        {?>
        <tr>
            <td><?php echo $details['Driver_Name'];?></td>
            <td>
                <?php 
                if($details['b_status'] == "Block" && $details['status'] != "BLOCKED")  
                {?> 
                    <a onclick="return confirm('Do you want to block this driver ?')" href ="<?php echo site_url('driver_controller/block/'.$details['Driver_Name']);?>">Block</a>
                   
                <?php 
                }
                    else
                        echo '<i class="text-danger"> Already blocked';
                ?>
            </td>
        </tr>    
     <?php 
     }?>  
    </table>

    <br><br>
          
    <h3 align="center">Feedback of the Passengers</h3><br>
    
    <div style="height:300px;overflow:auto;">
    <table class = "table-bordered" width="80%" align = "center">
        <tr>
            <th><strong>Passenger's Email</strong></th>
            <th><strong>Driver's Name</strong></th>
            <th><strong>Comments</strong></th>
        </tr>
        
        <?php 
        foreach($dt2 as $details)
        {?>
        <tr>
            <td><?php echo $details->Email;?></td>
            <td><?php echo $details->Driver_Name;?></td>
            <td><?php echo $details->Comment;?></td>
        </tr>    
        <?php 
        }
        ?>  
    </table>
    </div> 
    
    </body>
</html>
