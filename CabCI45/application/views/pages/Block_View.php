<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
  
    <body>
    <br>
    
    <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php/Admin_controller">Administration</a></li>
        <li><a href="index.php/driver_controller/comments">Block Drivers</a></li>
    </ol>
    
    <h2 align="center" style="color: darkblue">Block Drivers</h2><br>
          
    <table class = "table-bordered" width="75%" align = "center">
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
                        echo '<b><i class="text-danger"> Already Blocked';
                ?>
            </td>
        </tr>    
     <?php 
     }?>  
    </table>

    <br><br>
          
    <h2 align="center" style="color: darkblue">Feedback of the Passengers</h2><br>
    
    <div style="height:300px;overflow:auto;">
    <table class = "table-bordered" width="80%" align = "center" cellspacing="0">
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
