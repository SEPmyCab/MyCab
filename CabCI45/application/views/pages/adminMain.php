<br>

<?php

        echo '<ol class="breadcrumb">';
            echo '<li><a href="index.php">Home</a></li>';
            echo '<li><a href="index.php/Admin_controller">Administration</a></li>';
        echo '</ol>';
    
        echo '<img src="assets/images/admin.jpg" width="800" height="120" alt="admin_banner" style="margin:0px auto;display:block"/>';
        echo '<br>';
        echo '<br>';
        echo ' <div align="center">';

        echo ' <button type="button" name="btn_driver" onClick=location.href="index.php/driver_controller" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-user"></span>&nbsp; View Driver Details</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo ' <button type="button" name="btn_passenger" onClick=location.href="index.php/passenger_controller" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-user"></span>&nbsp; View Passenger Details</button>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo ' <button type="button" name="btn_viewloc" onClick=location.href="index.php/location_ctrl" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-map-marker"></span>&nbsp; View Driver Location</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo ' <button type="button" name="btn_block" onClick=location.href="index.php/driver_controller/comments" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-lock"></span>&nbsp; Block Drivers</button>';

        echo '<br>';
        echo '<br>';
        echo '<br>';
        
        echo ' <button type="button" name="btn_log" onClick=location.href="index.php/driver_controller/calls" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-th-list"></span>&nbsp; View Log</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo ' <button type="button" name="btn_reserv" onClick=location.href="index.php/reserve_controller/getAllReservations" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; View Reservations</button>';

        echo '<br>';
        echo '<br>';
        echo '<br>';
        
        echo ' <button type="button" name="btn_vehicles" onClick=location.href="index.php/vehicle_controller" class="btn btn-primary" style="width:200px"><img src="assets/images/icons/car.png" height="35" width="30">&nbsp; Vehicle Management</button>';

        echo '<br>';
        echo '<br>';
        echo '<br>';
        
        echo ' <button type="button" name="btn_priority" onClick=location.href="index.php/columnchart_controller" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-tasks"></span>&nbsp; Priority Schedule Graphs</button>';
echo ' <button type="button" name="btn_Hires" onClick=location.href="index.php/Hires_Schedule_Controller" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-list-alt"></span>View Hires</button>';

        
        echo '<br>';
        echo '<br>';
        echo '<br>';
        
        echo ' <button type="button" name="btn_promo" onClick=location.href="index.php/send_promotional_emails_controller" class="btn btn-primary" style="width:430px"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Send Promotional Emails</button>';
        
        echo '<br>';
        echo '<br>';
        echo '<br>';
        
        echo ' <button type="button" name="btn_fuel" onClick=location.href="index.php/fuel_expenses_controller/index" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-fire"></span>&nbsp;Fuel Expenses</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo ' <button type="button" name="btn_repair" onClick=location.href="index.php/repair_expenses_controller/index" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-wrench"></span>&nbsp;Repair Expenses</button>';
        
        echo ' </div>';
        
?>
       
<br>
<br>      
<br> 