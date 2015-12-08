<html lang="en">
    <head>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!--  Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- fullCalendar 2.2.5-->
        <link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.min.css">
        <link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.print.css" media="print">
        <!-- Theme style -->
        <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins  -->
        <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
    </head>

    <body>
        <br>
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php/Admin_controller">Administration</a></li>
            <li><a href="index.php/driver_controller">Driver Details</a></li>
        </ol>

        <h2 align="center" style="color: darkblue">Driver Details</h2><br>

        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab"><i class="glyphicon glyphicon-user"></i>&nbsp; Edit Driver Details</a></li>
            <li><a href="#tab2" data-toggle="tab"><i class="glyphicon glyphicon-calendar"></i>&nbsp; Driver Availability</a></li>
            <li><a href="#tab3" data-toggle="tab"><i class="glyphicon glyphicon-calendar"></i>&nbsp; Driver Schedule</a></li>
        </ul>
        <br>

        <div class="tab-content">
            
            <div class="tab-pane active" id="tab1">
                <br>
                <table class="table table-bordered table-hover" width="100%" align = "center">
                    <thead>
                        <tr>
                            <th><strong><i class="glyphicon glyphicon-credit-card"></i>&nbsp; NIC</strong></th>
                            <th><strong><i class="glyphicon glyphicon-envelope"></i>&nbsp; Email</strong></th>
                            <th><strong><i class="glyphicon glyphicon-phone"></i>&nbsp; Phone No</strong></th>
                            <th><strong><i class="glyphicon glyphicon-user"></i>&nbsp; Last Name</strong></th>
                            <th><strong><i class="glyphicon glyphicon-user"></i>&nbsp; First Name</strong></th>
                            <th><strong><i class="glyphicon glyphicon-certificate"></i>&nbsp; Certification</strong></th>
                            <th><strong><i class="glyphicon glyphicon-check"></i>&nbsp; Status</strong></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($dt as $details) {
                            ?>
                            <tr>
                                <td><?php echo $details->NIC; ?></td>
                                <td><?php echo $details->Email; ?></td>
                                <td><?php echo $details->Phone_No; ?></td>
                                <td><?php echo $details->LName; ?></td>
                                <td><?php echo $details->FName; ?></td>
                                <td><b><i class="text-danger"><?php echo $details->Certification; ?></i></td>
                                <td><b><i class="text-danger"><?php echo $details->status; ?></i></td>

                                <td style="width: 8%"><a href ="<?php echo site_url('driver_controller/edit/' . $details->NIC); ?>" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i>&nbsp; Edit</a></td>
                            </tr>    
                        <?php }
                        ?>  
                    </tbody>   
                </table>
            </div> <!--/tab1 -->
            
            <div class="tab-pane" id="tab2">
                <div style="float:left; margin-left: 10%; width:45%;" >
                <h3 align="left" style="color: darkblue">Add Availability Details</h3><br>   
                    
                <?php  echo form_open('driver_controller/addAvb');?> 
                
                <div class="input-group">
                    <label style="width:250px;" for="nic" >Driver's NIC</label>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-credit-card"></span>
                    </span>
                    <select name="nic" class="form-control" style="width: 250px" required="true">
                        <option value="">---------------Select---------------</option>
                        <?php foreach($dt_nic as $nic) { ?>
                        <option value="<?php echo $nic->NIC; ?>&nbsp; &nbsp;<?php echo $nic->FName; ?>"><?php echo $nic->NIC; ?>&nbsp; &nbsp;<?php echo $nic->FName; ?></option>;
                        <?php } ?>
                    </select>
                </div>    
                
                <br>
                <label style="float:left; margin-left: 52%;" for="to_from" >From</label> 
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To</label><br><br>
                
                <input type="checkbox" name="chk_mon" value="OFF" />&nbsp; Monday
                <div class="input-group" style="float:left; margin-left: 52%;">
                    <div class="input-group input-medium date date-picker">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="from_time1" name="from_time1"  style = "width: 120px">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="to_time1" name="to_time1"  style = "width: 120px">
                    </div>
                </div>
                
                <br><br>
                <input type="checkbox" name="chk_tue" value="OFF" />&nbsp; Tuesday
                <div class="input-group" style="float:left; margin-left: 52%;">
                    <div class="input-group input-medium date date-picker">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="from_time2" name="from_time2"  style = "width: 120px">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="to_time2" name="to_time2"  style = "width: 120px">
                    </div>
                </div>
                
                <br><br>
                <input type="checkbox" name="chk_wed" value="OFF" />&nbsp; Wednesday
                <div class="input-group" style="float:left; margin-left: 52%;">
                    <div class="input-group input-medium date date-picker">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="from_time3" name="from_time3"  style = "width: 120px">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="to_time3" name="to_time3"  style = "width: 120px">
                    </div>
                </div>
                
                <br><br>
                <input type="checkbox" name="chk_thu" value="OFF" />&nbsp; Thursday
                <div class="input-group" style="float:left; margin-left: 52%;">
                    <div class="input-group input-medium date date-picker">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="from_time4" name="from_time4"  style = "width: 120px">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="to_time4" name="to_time4"  style = "width: 120px">
                    </div>
                </div>
                
                <br><br>
                <input type="checkbox" name="chk_fri" value="OFF" />&nbsp; Friday
                <div class="input-group" style="float:left; margin-left: 52%;">
                    <div class="input-group input-medium date date-picker">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="from_time5" name="from_time5"  style = "width: 120px">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="to_time5" name="to_time5"  style = "width: 120px">
                    </div>
                </div>
                
                <br><br>
                <input type="checkbox" name="chk_sat" value="OFF" />&nbsp; Saturday
                <div class="input-group" style="float:left; margin-left: 52%;">
                    <div class="input-group input-medium date date-picker">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="from_time6" name="from_time6"  style = "width: 120px">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="to_time6" name="to_time6"  style = "width: 120px">
                    </div>
                </div>
                
                <br><br>
                <input type="checkbox" name="chk_sun" value="OFF" />&nbsp; Sunday
                <div class="input-group" style="float:left; margin-left: 52%;">
                    <div class="input-group input-medium date date-picker">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="from_time7" name="from_time7"  style = "width: 120px">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="time" class="form-control" id="to_time7" name="to_time7"  style = "width: 120px">
                    </div>
                </div>
               
                <br><br><br><br><br>
                <input type="submit" id="btnSave" name ="btnSave" value="Save Availability Details"  class="btn btn-primary"
                       onclick="return confirm('Confirm availability details ?');" />
                <br><br>
                
                <?php echo form_close(); ?>
                </div>
                
                <br><br>   
                <hr width="1000px" > 
        
                <div style="width: 100%; height:600px;overflow:auto;">
                
                <br>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><strong><i class="glyphicon glyphicon-credit-card"></i>&nbsp; NIC</strong></th>
                            <th><strong><i class="glyphicon glyphicon-info-sign"></i>&nbsp; Monday</strong></th>
                            <th><strong><i class="glyphicon glyphicon-info-sign"></i>&nbsp; Tuesday</strong></th>
                            <th><strong><i class="glyphicon glyphicon-info-sign"></i>&nbsp; Wednesday</strong></th>
                            <th><strong><i class="glyphicon glyphicon-info-sign"></i>&nbsp; Thursday</strong></th>
                            <th><strong><i class="glyphicon glyphicon-info-sign"></i>&nbsp; Friday</strong></th>
                            <th><strong><i class="glyphicon glyphicon-info-sign"></i>&nbsp; Saturday</strong></th>
                            <th><strong><i class="glyphicon glyphicon-info-sign"></i>&nbsp; Sunday</strong></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($dt1 as $details) {
                            ?>
                            <tr>
                                <td><?php echo $details->driver_NIC; ?><br><?php echo $details->FName; ?></td>
                                <td><?php echo $details->Monday_from; ?>&nbsp;<?php echo " - "?><?php echo $details->Monday_to; ?></td>
                                <td><?php echo $details->Tuesday_from; ?>&nbsp;<?php echo " - "?><?php echo $details->Tuesday_to; ?></td></td>
                                <td><?php echo $details->Wednesday_from; ?>&nbsp;<?php echo " - "?><?php echo $details->Wednesday_to; ?></td></td>
                                <td><?php echo $details->Thursday_from; ?>&nbsp;<?php echo " - "?><?php echo $details->Thursday_to; ?></td></td>
                                <td><?php echo $details->Friday_from; ?>&nbsp;<?php echo " - "?><?php echo $details->Friday_to; ?></td></td>
                                <td><?php echo $details->Saturday_from; ?>&nbsp;<?php echo " - "?><?php echo $details->Saturday_to; ?></td></td>
                                <td><?php echo $details->Sunday_from; ?>&nbsp;<?php echo " - "?><?php echo $details->Sunday_to; ?></td></td>    
                                
                                <td style="width: 10%"><a href ="<?php echo site_url('driver_controller/editAvb/'.$details->driver_NIC); ?>" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i>&nbsp; Edit</a></td>
                            </tr>    
                        <?php }
                        ?>  
                    </tbody>   
                </table>
                
                </div>
                
            </div>



            <div class="tab-pane" id="tab3">
                <br>
                <section class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h4 class="box-title">Driver Schedule</h4>
                                </div>
                                <div class="box-body">
                                    <!-- the events -->
                                    <div id="external-events">
                                        <div class="external-event bg-blue">DRIVERS</div>
                                        <?php
                                        foreach ($dt as $details) {
                                        ?>
                                            <div class="external-event bg-teal"><?php echo $details->NIC; ?>&nbsp;&nbsp;- <?php echo $details->FName; ?></div>
                                        <?php }?>
                                        
                                        <br>
                                        <div class="external-event bg-orange">HIRES</div>    
                                            
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /. box -->
                        </div><!-- /.col -->
                        <div class="col-md-9">
                            <div class="box box-primary">
                                <div class="box-body no-padding">
                                    <!-- THE CALENDAR -->
                                    <div id="calendar"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /. box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </section><!-- /.content -->
            </div><!--/tab3 -->

        </div> <!--/tab-content -->
            
    <!-- jQuery 2.1.4 -->
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Slimscroll -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="assets/plugins/fastclick/fastclick.min.js"></script>
    <!--AdminLTE for demo purposes--> 
    <script src="assets/dist/js/demo.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
    <script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
    
    <!-- Page specific script -->
    <script>
        $(function (){
            
            <?php
            $tot = sizeof($dt2); 
            ?>
                //initialize the external events
                function ini_events(ele) {
                    ele.each(function () {

                        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                        // it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this).text()) // use the element's text as the event title
                        };

                        // store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject);

                        // make the event draggable using jQuery UI
                        $(this).draggable({
                            zIndex: 1070,
                            revert: true, // will cause the event to go back to its
                            revertDuration: 0  //  original position after the drag
                            });

                        });
                    }
                ini_events($('#external-events div.external-event'));

                var t = "<?php echo $tot ?>";
                
                var options_javascript =<?php echo json_encode($dt2); ?>;
              
                var event = []; //The array
                
                for(var i =0;  i<t; i++) 
                {
                   //Hire schedule
                    event.push({
                        title: options_javascript[i]['driverNIC'] + "\n" + options_javascript[i]['pickup_loc'] + "\n" + options_javascript[i]['drop_loc'], 
                        start: options_javascript[i]['pickup_date_time'],
                        backgroundColor: "#f39c12",
                        borderColor: "#f39c12"  
                    });
                }
                
                //initialize the calendar
                $('#calendar').fullCalendar({
                      events: event,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    buttonText: {
                        today: 'Today',
                        month: 'Month',
                        week: 'Week',
                        day: 'Day'
                    },
                    
                    editable: true,
                    droppable: false, // this allows things to be dropped onto the calendar !!!
                    drop: function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    copiedEventObject.backgroundColor = $(this).css("background-color");
                    copiedEventObject.borderColor = $(this).css("border-color");

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
            
                    }
                    });

                });
            </script>

            <div role="log" aria-live="assertive" aria-relevant="additions" class="ui-helper-hidden-accessible"></div>
    </body>
</html>