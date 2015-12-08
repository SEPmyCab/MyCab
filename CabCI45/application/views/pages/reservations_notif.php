<script>
    
    $(document).ready(function(){
    $("#nic").change(function(){
     
        var e = document.getElementById("nic");
        var strUser = e.options[e.selectedIndex].value.toString();
        var nic = strUser.split("V");
        var onic = nic[0]+"V";
        var k ;
      
        <?php
            $tot = sizeof($driver); 
        ?>
    
        var options_javascript =<?php echo json_encode($driver); ?>;
        var t = "<?php echo $tot ?>";
        
        for(var i=0; i<t; i++){
        if(onic == options_javascript[i][0]['NIC'])
        {
            k =  options_javascript[i][0]['Phone_No'];
        }
    }
     
        var name = document.getElementById('txtphone');
        name.value = k;
    });
   }); 
   
</script>
   
<script>
        function notif_d(){
            var phone = $('#id').val();
            var reqID = $('#txtreqID').val();
            var nic = $('#nic option:selected').text();
            var phonenum = $('#txtphone').val();
           
            var msg = [];
            msg.push(phone);
            msg.push(reqID);
            msg.push(nic);
            msg.push(phonenum);
            
            if (phone != '')
            {
               $.ajax({
                    type: "POST",
                    url: 'http://cabeelk.com/CabCI45/index.php/reserve_controller/getHireDetails',
                    crossDomain : true,
                    
                    data: {'msg': msg},
                    success: function(output){
                            alert(output);
                            $("#id").attr('disabled','disabled');
                    }
                });
            }
        }
</script>

<br>
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="index.php/Admin_controller">Administration</a></li>
  <li><a href="index.php/reserve_controller/getAllReservations">Allocate Drivers For Hires</a></li>
</ol>

<?php  echo form_open('reserve_controller/getAllReservations');?> 

    <h2 align="center" style="color: darkblue">Allocate Drivers For Hires</h2><br>

    <div class="box box-primary" style="float:left; margin-left: 10%; width:40%;" >
           
        <br>
        <div class="input-group">
            <label style="width:240px;" for="type">Driver's NIC</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"></span>
            </span>
            <select name="nic" id="nic" class="form-control" style = "width: 250px" required="true">
                <option value="">------Select NIC------</option>
                <?php foreach($driver as $dr) { ?>
            <option  value="<?php echo $dr[0]->NIC; ?>&nbsp;&nbsp;<?php echo $dr[0]->FName; ?>"><?php echo $dr[0]->NIC; ?>&nbsp;&nbsp;<?php echo $dr[0]->FName; ?></option>;
            <?php } ?>
            </select>    
        </div>

        <br>
        <div class="input-group">
            <label style="width:240px;" for="phone">Phone No </label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-earphone"></span>
            </span>
            <input type="tel"  name="txtphone" id="txtphone" class = "form-control" style = "width: 250px" placeholder="Phone No" required="true"  
                   onkeypress='return event.charCode >= 48 && event.charCode <= 57' title="Enter only 10 numbers starting from 07.. (0772305287)">
        </div>
            

        <?php
            $array = $this->uri->segment(4);
            $rid = $array;
        ?>
        
        <br>
        <input type="hidden" id="txtreqID" value="<?php echo $rid  ?>"/><br>

       
        <input type="button" id="btnpost" name = "btnpost" value="Send Notification" class="btn btn-primary" onclick="notif_d();" />
        
        <br>  
        <br>
    </div>
    
<?php echo form_close(); ?>

   