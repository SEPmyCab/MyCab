<?php  echo validation_errors();
      
      echo "Password :".form_password('password', '');?>
      </br><?php
      echo "Password Confirmation :".form_password('passconf', '');?>
            </br>
<?php
      echo form_submit('submit', 'Submit');
     
