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
          
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th><strong><i class="glyphicon glyphicon-user"></i>&nbsp; Driver's Name</strong></th>
            <th><strong><i class="glyphicon glyphicon-info-sign"></i>&nbsp; Status</strong></th>
        </tr>
        </thead>
        
        <tbody>
        <?php 
        foreach($dt1 as $details)
        {?>
        <tr>
            <td><?php echo $details['Driver_Name'];?></td>
            <td>
                <?php 
                if($details['b_status'] == "Block" && $details['status'] != "BLOCKED")  
                {?> 
                    <a onclick="return confirm('Do you want to block this driver ?')" href ="<?php echo site_url('driver_controller/block/'.$details['Driver_Name']);?>" class="btn btn-warning">
                        <i class="glyphicon glyphicon-ban-circle"></i>&nbsp; Block</a>
                   
                <?php 
                }
                    else
                        echo '<b><i class="text-danger"> Already Blocked';
                ?>
            </td>
        </tr>    
     <?php 
     }?>
        </tbody>
    </table>

    <br><br>
          
    <h2 align="center" style="color: darkblue">Feedback of the Passengers</h2><br>
    
    <div style="height:300px;overflow:auto;">
    <table class="table table-bordered table-hover" width="100%" align = "center">
        <thead>
        <tr>
            <th><strong><i class="glyphicon glyphicon-envelope"></i>&nbsp; Passenger's Email</strong></th>
            <th><strong><i class="glyphicon glyphicon-user"></i>&nbsp; Driver's Name</strong></th>
            <th><strong><i class="glyphicon glyphicon-comment"></i>&nbsp; Comments</strong></th>
         </tr>
        </thead>
        
        <tbody>
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
        </tbody> 
    </table>
    </div> 
    
    </body>
</html>
