<?php

echo "<div class='error_msg'>";
echo validation_errors();
echo "</div>";

echo "<div class='error_msg'>";
if (isset($message_display)) {
echo $message_display;
}
echo "</div>";

$data = array(
'type' => 'email',
'name' => 'email_value'
);

