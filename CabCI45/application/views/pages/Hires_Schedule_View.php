<script src="<?= asset_url();?>dhtmlxScheduler_v4.3.1_evaluation/codebase/dhtmlxscheduler.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?= asset_url();?>dhtmlxScheduler_v4.3.1_evaluation/codebase/dhtmlxscheduler.css" type="text/css">
<script src="<?= asset_url();?>dhtmlxScheduler_v4.3.1_evaluation/codebase/ext/dhtmlxscheduler_collision.js" type="text/javascript"></script>
<script src="<?= asset_url();?>dhtmlxScheduler_v4.3.1_evaluation/codebase/ext/dhtmlxscheduler_limit.js" type="text/javascript"></script>
<script src="<?= asset_url();?>dhtmlxScheduler_v4.3.1_evaluation/codebase/ext/dhtmlxscheduler_timeline.js" type="text/javascript"></script>
<script src="<?= asset_url();?>dhtmlxScheduler_v4.3.1_evaluation/codebase/ext/dhtmlxscheduler_treetimeline.js" type="text/javascript"></script>
<script src="<?= asset_url();?>dhtmlxScheduler_v4.3.1_evaluation/codebase/ext/dhtmlxscheduler_daytimeline.js" type="text/javascript"></script>
<style type="text/css">
   html, body{
	margin:1px;
	padding:1px;
	height:100%; /*mandatory*/
	     
}

</style>
 <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php/Admin_controller">Administration</a></li>
        <li><a href="index.php/Hires_Schedule_Controller">Hire Details</a></li>
    </ol>
<script type="text/javascript" charset="utf-8">
    document.body.onload = function() {
        scheduler.config.xml_date="%Y-%m-%d %H:%i";
        scheduler.config.details_on_create=true;
	scheduler.config.details_on_dblclick=true;
        scheduler.locale.labels.section_template = 'Hire Details';
        scheduler.config.lightbox.sections=[
            {name:"Pickup", height:70, map_to:"text", type:"textarea", focus:true},
             {name:"Destination", height:70, map_to:"Destination", type:"textarea", focus:true},
            { name:"template", height: 40, type:"template", map_to:"loc_template"},
            { name:"Time Duration", height:72, type:"time", map_to:"startTime"}
        ];
        scheduler.attachEvent("onBeforeLightbox", function(id) {
            var ev = scheduler.getEvent(id);
            ev.loc_template = "<b>Pickup:</b>"+ ev.text+"&nbsp&nbsp&nbsp&nbsp<b>Destination:</b>"+ ev.Destination;
            return true;
            });
        /*scheduler.attachEvent("onBeforeEventCreated", function (e){
                var now = new Date();
                var start_date = scheduler.getActionData(e).date;
                if(start_date.valueOf() < now.valueOf())
                return false;
                return true;
                });*/
        scheduler.config.first_hour = 4;
        scheduler.config.limit_time_select = true;
        scheduler.locale.labels.timeline_tab ="Timeline";
         /*
                
         scheduler.attachEvent("onBeforeEventChanged", function (e){
                var now = new Date();
                var start_date = scheduler.getActionData(e).date;
                if(start_date.valueOf() < now.valueOf())
                return false;
                return true;
                });
                        
        scheduler.attachEvent("onEventSave", function (e){
                var now = new Date();
                var start_date = scheduler.getActionData(e).date;
                if(start_date.valueOf() < now.valueOf())
                return false;
                return true;
                });*/
        
        scheduler.init('scheduler_here',new Date(),"month");
        scheduler.setLoadMode("month");
        scheduler.load("index.php/Hires_Schedule_Controller/data");
      
        scheduler.config.dblclick_create = false;
        scheduler.createTimelineView({
            name:"timeline",
            x_unit:"minute",//measuring unit of the X-Axis.
            x_date:"%H:%i", //date format of the X-Axis
            x_step:60,      //X-Axis step in 'x_unit's
            //x_size:24,      //X-Axis length specified as the total number of 'x_step's
            //x_start:16,     //X-Axis offset in 'x_unit's
            //x_length:48,    //number of 'x_step's that will be scrolled at a time
            y_unit:scheduler.serverList("sections"),//sections of the view (titles of Y-Axis)
            y_property:"driverNIC", //mapped data property
            folder_events_available: true,
            dy:60,
            render:"bar"             //view mode
            });
   
        var dp = new dataProcessor("index.php/Hires_Schedule_Controller/data");
        dp.action_param = "dhx_editor_status";
        dp.setTransactionMode("POST", true);
      /*  dp.attachEvent("onAfterUpdate", function(sid, action, tid, details) {
            if (action == "updated") {
                scheduler.clearAll();
                scheduler.updateView();
            }
        });
        */
        dp.init(scheduler); 
       
      
          
        
    };
    
</script>
<div id="scheduler_here" class="dhx_cal_container" style='width:1000px; height:500px;'>
    <div class="dhx_cal_navline">
        <div class="dhx_cal_tab" name="timeline_tab" style="right:280px;"></div>
        <div class="dhx_cal_prev_button">&nbsp;</div>
        <div class="dhx_cal_next_button">&nbsp;</div>
        <div class="dhx_cal_today_button"></div>
        <div class="dhx_cal_date"></div>
        <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
        <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
        <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
    </div>
    <div class="dhx_cal_header">
    </div>
    <div class="dhx_cal_data">
    </div>
</div>

