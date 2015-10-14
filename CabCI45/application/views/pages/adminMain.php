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

        echo ' <button type="button" name="btn_driver" onClick=location.href="index.php/driver_controller" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-user"></span>View Driver Details</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo ' <button type="button" name="btn_passenger" onClick=location.href="index.php/passenger_controller" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-user"></span>View Passenger Details</button>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo ' <button type="button" name="btn_viewloc" onClick=location.href="index.php/location_ctrl" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-map-marker"></span>View Driver Location</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo ' <button type="button" name="btn_block" onClick=location.href="index.php/driver_controller/comments" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-lock"></span>Block Drivers</button>';

        echo '<br>';
        echo '<br>';
        echo '<br>';
        
        echo ' <button type="button" name="btn_log" onClick=location.href="index.php/driver_controller/calls" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-th-list"></span>View Log</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo ' <button type="button" name="btn_reserv" onClick=location.href="index.php/reserve_controller/getAllReservations" class="btn btn-primary" style="width:200px"><span class="glyphicon glyphicon-list-alt"></span>View Reservations</button>';

        echo ' </div>';
        
?>
       
<br>
<br>      
<br> 