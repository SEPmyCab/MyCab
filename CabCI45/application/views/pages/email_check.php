 <?php echo validation_errors(); 
echo "<div class='error_msg'>";
if (isset($error_message)) {
echo $error_message;

}?>
         <?php 
          $attributes = array('class' => 'form');
         echo form_open('get_forgot_pwd/index',$attributes); ?>
      
      
         <h4>Please enter your Email Address</h4>
           <input type="text" size="30" id="email" name="email"/>
          <br/>
     <br/>
     <input class="btn btn-default btn-primary"type="submit" name="submit"  value="Submit"/>
         </form>