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
        <li><a href="index.php/reserve_controller/getAllReservations">Cab Reservations</a></li>
    </ol>

    <h2 align="center" style="color: darkblue"><b>Cab Reservation Details</b></h2><br>
    
    <div class="col-md-14">
	<div class="portlet-body">
            <div class="table-scrollable">
		<table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
			<tr>
                            <th></i>&nbsp;&nbsp; <b>ID</b> </th>
                            <th><i class="glyphicon glyphicon-user"></i>&nbsp; <b>Passenger</b> </th>
                            <th><img src="assets/images/ic_marker_green.png" height="20" width="12">&nbsp; <b>Pickup Location</b> </th>
                            <th><img src="assets/images/ic_marker_red.png" height="20" width="12">&nbsp; <b>Drop Location</b> </th>
                            <th><i class="glyphicon glyphicon-calendar"></i>&nbsp; <b>Pickup Date & Time</b> </th>
                            <th><i class="glyphicon glyphicon-phone"></i>&nbsp; <b>Phone</b> </th>
                            <th><img src="assets/images/car_icon.png" height="20" width="18">&nbsp; <b>Vehicle Type</b> </th>
                            <th><i class="glyphicon glyphicon-cog"></i>&nbsp; <b>AC</b> </th>
                            <th><i class="glyphicon glyphicon-th-list"></i>&nbsp; <b>Purpose</b> </th>
                            <th></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php 
                        foreach($dt as $details)
                        {?>
			<tr>
                            <td class="highlight"><div class="success"></div>
                                &nbsp;&nbsp; 
                                <?php echo $details->reserved_id;?></td>
                            <td><?php echo $details->passenger;?></td>
                            <td><?php echo $details->pickup_loc;?></td>
                            <td><?php echo $details->drop_loc;?></td>
                            <td><?php echo $details->pickup_date_time;?></td>
                            <td><?php echo $details->phone;?></td>
                            <td><?php echo $details->vehicle_type;?></td>
                            <td><?php echo $details->AC;?></td>
                            <td><?php echo $details->purpose;?></td>
                            <td><a href="<?php echo site_url('reserve_controller/getDriver/'.$details->vehicle_type.'/'.$details->reserved_id);?>" class="btn btn-sm blue" >
				<i class="glyphicon glyphicon-arrow-right"></i> Reserve </a>
                            </td>
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
<br><br>