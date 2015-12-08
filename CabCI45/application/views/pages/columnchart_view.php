<!DOCTYPE HTML>


<section class="content">
    
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
          <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/highcharts-more.js"></script>
         <script src="http://code.highcharts.com/modules/exporting.js"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                var options = {
                    chart: {
                        type: 'column',
                        renderTo: 'container',
                        
                    },
                    title: {
                        text: 'Priority Levels of Hires for a Driver'
                    },
                    subtitle: {
                        text: 'For each driver'
                    },
                    xAxis: {
                        
                        categories: [],
                        crosshair: true,
                         
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Priority'
                        }
                    },
                    tooltip: {
                       
                        headerFormat: '<span style="font-size:10px">Driver NIC: {point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.005,
                            borderWidth: 2
                        }
                    },
                    series: []
                }

                $.getJSON("columnchart_controller/drawChart", function(json) {
                    options.xAxis.categories = json[0]['data'];
                    options.series[0] = json[1];
                    options.series[1] = json[2];
                    options.series[2] = json[3];
                    options.series[3] = json[4];
                    options.series[4] = json[5];
                    chart = new Highcharts.Chart(options);
                });
                
                
                
                
                

            });
        </script>

      
        <script src="<?php echo site_url('js/chartjs/highcharts.js') ?>"></script>
	<script src="<?php echo site_url('js/chartjs/modules/exporting.js') ?>"></script>
        
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script> 

        <div id="container" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
        
        <?php  echo form_open('columnchart_controller/changePriority');?> 
          <div>
             
              <b>Change priority</b> <br><br>
              
              Driver NIC:<input type="text"  name="d1" id="d1"><br><br>
              Select Hire:<input type="text" name="p1" id="p1" placeholder="hire1"><br><br>               
              Priority Level:<input type="number" name="p2" id="p2"><br><br>
              <input type="submit" id="btnpost" name = "btnpost" value="Post" class="btn btn-primary" />
        </div>
        
        <?php echo form_close(); ?>
</section>