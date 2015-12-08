<?php

function update($action){ 
$this->get_values($action);
if ($this->validate($action)){ 
if (!$this->color) {
$this->color = $this->get_event_color($this->event_type);
}
$this->case_num = format_cn($this->case_num);
$this->active = 1;
$this->db->update("hires", $this, array("id" => $action->get_id()));
$action->success();
// <<<<< I WAS FORCED TO PUT THIS IN DELETE BUT DOESNT WORK HERE IF I UNCOMMENT	RENDER
// $connector->render(); 
}
}

function get_event_color($event_type) {
$event_colors = sess_get('setup','event_colors');
$event_colors_array = explode(',', $event_colors);
if ($event_colors_array) {
foreach ($event_colors_array as $event_color) {
$event_color_array = explode('|',$event_color);
if ($event_color_array[0] == $event_type) {
return $event_color_array[1];
}
}
}
}

function delete($action){

$this->db->update("hires", array('active' => 0), array("id" => $action->get_id()));

$data = array(
'user_id' => sess_get('user','user_id'),
'event_id' => $action->get_id(),
'action' => 'delete',
'action_date' => date('Y-m-d H:i:s')
);
$this->db->insert('log', $data);

$action->success();
$connector->render();
}

