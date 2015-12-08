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
            <li><a href="index.php/reserve_controller/getAllReservations">Repair Expenses</a></li>
        </ol>

        <h2 align="center" style="color: darkblue"><b>Repair Expenses Details</b></h2><br>
        <table>
            <tr>
                <td><div id="piechart" style="width: 700px; height: 500px;"></div></td>
                <td>
                    <div class="panel panel-primary" align="center">
                        <div class="panel-heading"><h3>Monthly Summery</h3></div>
                        <div class="panel-body">
                            <h5>Total Repair cost for the current month</h5>
                        </div>
                        <h4><img src="assets/images/icons/engine.png" height="50" width="50">&nbsp; Total Engine Repair Cost <span class="label label-primary">Rs: <?php foreach($engineCost as $edetails){ ?><?php echo $edetails->total_engine_repair_cost; ?><?php }?>/=</span>&nbsp;</h4>
                        <br>
                        <h4><img src="assets/images/icons/body.png" height="50" width="50">&nbsp;Total Body Repair Cost <span class="label label-danger">Rs: <?php foreach($bodyCost as $bdetails){ ?><?php echo $bdetails->total_body_repair_cost; ?><?php }?>/=</span>&nbsp;</h4>
                        <br>
                        <h4><img src="assets/images/icons/tire.png" height="50" width="50">Total Tires Repair Cost <span class="label label-warning">Rs: <?php foreach($tiresCost as $tdetails){ ?><?php echo $tdetails->total_tires_repair_cost; ?><?php }?>/=</span>&nbsp;</h4>
                        <br>
                        <h3>&nbsp;Total Repair Cost <span class="label label-success">Rs: <?php foreach($repairCost as $rdetails){ ?><?php echo $rdetails->total_repair_cost; ?><?php }?>/=</span>&nbsp;</h3>
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
                                <th><i class="glyphicon glyphicon-wrench"></i>&nbsp; <b>Repair Type</b> </th>
                                <th><img src="assets/images/icons/parts.png" height="25" width="25">&nbsp; <b>Parts Cost</b> </th>
                                <th><img src="assets/images/icons/mechanic.png" height="25" width="25">&nbsp; <b>Technician Cost</b> </th>
                                <th><img src="assets/images/icons/money.png" height="25" width="25">&nbsp; <b>Total Cost</b> </th>
                                <th><i class="glyphicon glyphicon-calendar"></i>&nbsp; <b>Repair Date</b> </th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            <?php 
                                foreach($repairData as $details)
                            {?>
                            <tr>
                                <td class="highlight"><div class="success"></div>
                                    &nbsp;&nbsp; 
                                    <?php echo $details->record_id;?></td>
                                <td><?php echo $details->reg_No;?></td>
                                <td><?php echo $details->repair_type;?></td>
                                <td><?php echo $details->parts_cost;?></td>
                                <td><?php echo $details->technician_cost;?></td>
                                <td><?php echo $details->total_cost;?></td>
                                <td><?php echo $details->repair_date;?></td>
                            </tr>
								
                            <?php 
                            }
                            ?>
			</tbody>
                    </table>
                </div>
            </div>
            <br>
      
            <h2 align="center" style="color: darkblue"><b>Insert Repair Details</b></h2><br>    
            <?php  echo form_open('repair_expenses_controller/addRepairBill');?>
                <table>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Vehicle&nbsp;&nbsp;</td>
                        <td>
                            <select class="btn btn-default dropdown-toggle" id="vehicleNo" name="vehicleId">
                              <?php foreach($vehicleData as $vehicleDetails){ ?>
                              <option value="<?php echo $vehicleDetails->vehicle_ID?>"> <?php echo $vehicleDetails->reg_No ?> </option>;
                              <?php }?>
                            </select>
                        </td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Repair Type&nbsp;&nbsp;</td>
                        <td>
                            <select class="btn btn-default dropdown-toggle" id="repairType" name="repairType">

                              <option value="Engine Repair">Engine Repair</option>;
                              <option value="Body Repair">Body Repair</option>;
                              <option value="Tires Repair">Tires Repair</option>;

                            </select>
                        </td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parts Cost&nbsp;&nbsp;</td>
                        <td><input type="number" min="0" class="form-control" id="exampleInputEmail2" name="partsCost"></td>    
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Technician Cost&nbsp;&nbsp;</td>
                        <td><input type="number" min="0" class="form-control" id="exampleInputEmail2" name="technicianCost"></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-default" id="btnAddRepairBill" name="btnAddRepairBill" value="Add Bill"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
    
                </table>
                <?php echo form_close(); ?> 
  
                <h2 align="center" style="color: darkblue"><b>Remove Billing Details</b></h2><br> 
                
                <?php  echo form_open('repair_expenses_controller/deleteRepairBill');?>
                    <table>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Record ID&nbsp;&nbsp;</td>
                            <td>
                                <select class="btn btn-default dropdown-toggle" id="recordID" name="recordID">
                                  <?php foreach($repairData as $details){ ?>
                                  <option value="<?php echo $details->record_id; ?>"> <?php echo $details->record_id ?> </option>;
                                  <?php }?>
                                </select>
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-default" id="btnRemoveRepairBill" name="btnRemoveRepairBill" value="Remove Bill"></td>
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
          ['Repair Type', 'Cost'],
          <?php foreach($engineCost as $edetails){ ?>
          ['Engine Repairs', <?php echo $edetails->total_engine_repair_cost; ?>],
          <?php }?>
          <?php foreach($bodyCost as $bdetails){ ?>
          ['Body Repairs', <?php echo $bdetails->total_body_repair_cost; ?>],
          <?php }?>
          <?php foreach($tiresCost as $tdetails){ ?>
          ['Tire Repairs', <?php echo $tdetails->total_tires_repair_cost; ?>],
          <?php }?>    
        ]);

        var options = {
          title: 'Total Repair Cost For The Current Month'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

</html>