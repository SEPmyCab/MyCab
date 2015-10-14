<!DOCTYPE html>
<html lang="en">
<head>

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>

<link href="assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

</head>
  
    <body>
    <br>
    
    <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php/Admin_controller">Administration</a></li>
        <li><a href="index.php/driver_controller/calls">View Log</a></li>
    </ol>
    
    <h2 align="center" style="color: darkblue"><b>Log of Calls</b></h2><br>
           
    <div class="col-md-12">
	<div class="portlet-body">
            <div class="table-scrollable">
		<table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
			<tr>
                            <th><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp; <b>Passenger's ID</b> </th>
                            <th><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp; <b>Driver's NIC</b> </th>
                            <th><i class="glyphicon glyphicon-calendar"></i> &nbsp;&nbsp; <b>Called Date & Time</b> </th>
			
			</tr>
                    </thead>
                    
                    <tbody>
                        <?php 
                        foreach($dt1 as $details)
                        {?>
			<tr>
                            <td class="highlight"><div class="success"></div>
                                &nbsp;&nbsp;&nbsp;&nbsp; 
                                <?php echo $details->Passenger_Id;?></td>
                            <td><?php echo $details->Driver_NIC;?></td>
                            <td><?php echo $details->Called_Time;?></td>
                        </tr>
								
                        <?php 
                        }
                        ?>
			</tbody>
		</table>
	</div>
	</div>
      <br><br><br><br> 
    </div> 
   
    </body>
    
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

</html>
