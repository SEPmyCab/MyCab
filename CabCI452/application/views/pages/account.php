
<?php
$attributes = array('class' => 'form', 'id' => 'account');
?>
<div style="float:left; width: 500px; height: 400px;padding: 60px"><?php
echo form_open('account_controller', $attributes); ?>

<p>
        <label for="email">Email</label>
        <?php echo form_error('email'); ?>
        <br /><input id="email" type="text" name="email"  value="<?php echo $result['Email']; ?>" disabled/>
</p>

<p>
        <label for="first_name">First Name</label>
        <?php echo form_error('first_name'); ?>
        <br /><input id="first_name" type="text" name="first_name"  value="<?php echo $result['FName']; ?>"  />
</p>

<p>
        <label for="last_name">Last Name</label>
        <?php echo form_error('last_name'); ?>
        <br /><input id="last_name" type="text" name="last_name"  value="<?php echo $result['LName']; ?>"  />
</p>

<p>
        <label for="phone_number">Phone Number</label>
       
        <?php echo form_error('phone_number'); ?>
        <br /><input id="phone_number" type="text" name="phone_number"  placeholder="+9471xxxxxxx" value="<?php echo $result['Phone_No']; ?>"  />
</p>


<p align="center">
    <?php
      $attributes3 = array('class' => 'btn btn-default btn-primary', 'type' => 'submit');
              echo form_button($attributes3,'Save Changes');?>
</p>

<?php echo form_close(); ?>
</div>
<div style="float:right; width: 500px;padding: 60px">
    <?php
$attributes = array('class' => 'form', 'id' => 'changePwd');
echo form_open('changePwd_controller', $attributes);
?>
    
<p>
        <label for="Curr_Pwd">Enter current password</label>
        <?php echo form_error('Curr_Pwd'); ?>
        <br /><input id="email" type="password" name="Curr_Pwd"  value=""  />
</p>

<p>
        <label for="New_Pwd">Enter New Password</label>
        <?php echo form_error('New_Pwd'); ?>
        <br /><input id="first_name" type="password" name="New_Pwd"  value=""  />
</p>

<p>
        <label for="Con_New_Pwd">Confirm New Password</label>
        <?php echo form_error('Con_New_Pwd'); ?>
        <br /><input id="last_name" type="password" name="Con_New_Pwd"  value=""  />
</p>
</br>
</br>
<p align="center">
    <?php
      $attributes3 = array('class' => 'btn btn-default btn-primary', 'type' => 'submit');
              echo form_button($attributes3,'Change Password');?>
</p>
</div>



