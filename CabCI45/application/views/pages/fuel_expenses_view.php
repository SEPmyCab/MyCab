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
            <li><a href="index.php/reserve_controller/getAllReservations">Fuel Expenses</a></li>
        </ol>

        <h2 align="center" style="color: darkblue"><b>Fuel Expenses Details</b></h2><br>
        <table>
            <tr>
                <td><div id="piechart" style="width: 700px; height: 500px;"></div></td>
                <td>
                    <div class="panel panel-primary" align="center">
                        <div class="panel-heading"><h3>Monthly Summery</h3></div>
                        <div class="panel-body">
                            <h5>Total fuel cost for the current month</h5>
                        </div>
                        <h4>Total Diesel Cost <span class="label label-primary">Rs: <?php foreach($dieselCost as $ddetails){ ?><?php echo $ddetails->total_diesel_cost; ?><?php }?>/=</span></h4>
                        <br>
                        <h4>Total Petrol Cost <span class="label label-danger">Rs: <?php foreach($petrolCost as $pdetails){ ?><?php echo $pdetails->total_petrol_cost; ?><?php }?>/=</span></h4>
                        <br>
                        <h3>&nbsp;Total Fuel Cost <span class="label label-success">Rs: <?php foreach($fuelCost as $fdetails){ ?><?php echo $fdetails->total_fuel_cost; ?><?php }?>/=</span>&nbsp;</h3>
                    </div>
                </td>    
            </tr>
        </table>
        
        <div class="col-md-14">
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th><i class="glyphicon glyphicon-list-alt"></i>&nbsp; <b>Record ID</b> </th>
                                <th><img src="assets/images/icons/car.png" height="28" width="28">&nbsp; <b>Vehicle Number</b> </th>
                                <th><i class="glyphicon glyphicon-fire"></i>&nbsp; <b>Fuel Type</b> </th>
                                <th><img src="assets/images/icons/fuel.png" height="28" width="28">&nbsp; <b>Litres</b> </th>
                                <th><img src="assets/images/icons/unit.png" height="25" width="25">&nbsp; <b>Unit Price</b> </th>
                                <th><img src="assets/images/icons/money.png" height="25" width="25">&nbsp; <b>Total Cost</b> </th>
                                <th><i class="glyphicon glyphicon-calendar"></i>&nbsp; <b>Filling Date</b> </th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            <?php 
                                foreach($fuelData as $details)
                            {?>
                            <tr>
                                <td class="highlight"><div class="success"></div>
                                    &nbsp;&nbsp; 
                                    <?php echo $details->record_id;?></td>
                                <td><?php echo $details->reg_No;?></td>
                                <td><?php echo $details->fuel_type;?></td>
                                <td><?php echo $details->litres;?></td>
                                <td><?php echo $details->unit_price;?></td>
                                <td><?php echo $details->total_cost;?></td>
                                <td><?php echo $details->filling_date;?></td>
                            </tr>
								
                            <?php 
                            }
                            ?>
			</tbody>
                    </table>
                </div>
            </div>
            
            <br>
      
            <h2 align="center" style="color: darkblue"><b>Insert Billing Details</b></h2><br>    
            <?php  echo form_open('fuel_expenses_controller/addFuelBill');?>
                <table>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Vehicle&nbsp;&nbsp;</td>
                        <td>
                            <select class="btn btn-default dropdown-toggle" id="vehicleNo" name="vehicleIdWithFuelType">
                              <?php foreach($vehicleData as $vehicleDetails){ ?>
                              <option value="<?php echo $vehicleDetails->vehicle_ID.$vehicleDetails->fuel; ?>"> <?php echo $vehicleDetails->reg_No ?> </option>;
                              <?php }?>
                            </select>
                        </td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Litres&nbsp;&nbsp;</td>
                        <td><input type="number" min="0" class="form-control" id="exampleInputEmail2" name="litres"></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-default" id="btnAddBill" name="btnAddBill" value="Add Bill"></td>
                    </tr>
                </table>
            <?php echo form_close(); ?> 
  
            <h2 align="center" style="color: darkblue"><b>Remove Billing Details</b></h2><br> 
            <?php  echo form_open('fuel_expenses_controller/deleteBill');?>
                <table>
                     <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Record ID&nbsp;&nbsp;</td>
                        <td>
                            <select class="btn btn-default dropdown-toggle" id="recordID" name="recordID">
                              <?php foreach($fuelData as $details){ ?>
                              <option value="<?php echo $details->record_id; ?>"> <?php echo $details->record_id ?> </option>;
                              <?php }?>
                            </select>
                        </td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-default" id="btnRemoveBill" name="btnRemoveBill" value="Remove Bill"></td>
                    </tr>
                </table>
            <?php echo form_close(); ?> 
        </div>

    </body>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Fuel Type', 'Cost'],
          <?php foreach($dieselCost as $ddetails){ ?>
          ['Diesel', <?php echo $ddetails->total_diesel_cost; ?>],
           <?php }?>
               <?php foreach($petrolCost as $pdetails){ ?>
          ['Petrol', <?php echo $pdetails->total_petrol_cost; ?>]
          <?php }?>
        ]);

        var options = {
          title: 'Total Fuel Cost For The Current Month'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

</html>