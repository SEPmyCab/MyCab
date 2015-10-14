<?php
echo 'login page';
if (isset($logout_message)) {
echo "<div class='message'>";
echo $logout_message;
echo "</div>";
}

if (isset($message_display)) {
echo "<div class='message'>";
echo $message_display;
echo "</div>";
}

echo "<div class='error_msg'>";
if (isset($error_message)) {
echo $error_message;

}
echo form_error('inputEmaillogin'); 
echo form_error('inputPasswordlogin'); 
echo validation_errors();
echo "</div>";
