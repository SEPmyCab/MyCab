/*
@license
dhtmlxScheduler v.4.3.1 

This software is covered by DHTMLX Evaluation License. Contact sales@dhtmlx.com to get Commercial or Enterprise license. Usage without proper license is prohibited.

(c) Dinamenta, UAB.
*/
Scheduler._external_drag={from_scheduler:null,to_scheduler:null,drag_data:null,drag_placeholder:null,delete_dnd_holder:function(){var e=this.drag_placeholder;e&&(e.parentNode&&e.parentNode.removeChild(e),document.body.className=document.body.className.replace(" dhx_no_select",""),this.drag_placeholder=null)},copy_event_node:function(e,t){for(var i=null,a=0;a<t._rendered.length;a++){var n=t._rendered[a];if(n.getAttribute("event_id")==e.id||n.getAttribute("event_id")==t._drag_id){i=n.cloneNode(!0),
i.style.position=i.style.top=i.style.left="";break}}return i||document.createElement("div")},create_dnd_holder:function(e,t){if(this.drag_placeholder)return this.drag_placeholder;var i=document.createElement("div"),a=t.templates.event_outside(e.start_date,e.end_date,e);return a?i.innerHTML=a:i.appendChild(this.copy_event_node(e,t)),i.className="dhx_drag_placeholder",i.style.position="absolute",this.drag_placeholder=i,document.body.appendChild(i),document.body.className+=" dhx_no_select",i},move_dnd_holder:function(e){
var t={x:e.clientX,y:e.clientY};if(this.create_dnd_holder(this.drag_data.ev,this.from_scheduler),this.drag_placeholder){var i=t.x,a=t.y,n=document.documentElement,s=document.body,r=this.drag_placeholder;r.style.left=10+i+(n&&n.scrollLeft||s&&s.scrollLeft||0)-(n.clientLeft||0)+"px",r.style.top=10+a+(n&&n.scrollTop||s&&s.scrollTop||0)-(n.clientTop||0)+"px"}},clear_scheduler_dnd:function(e){e._drag_id=e._drag_mode=e._drag_event=e._new_event=null},stop_drag:function(e){e&&this.clear_scheduler_dnd(e),
this.delete_dnd_holder(),this.drag_data=null},inject_into_scheduler:function(e,t,i){e._count=1,e._sorder=0,e.event_pid&&"0"!=e.event_pid&&(e.event_pid=null,e.rec_type=e.rec_pattern="",e.event_length=0),t._drag_event=e,t._events[e.id]=e,t._drag_id=e.id,t._drag_mode="move",i&&t._on_mouse_move(i)},start_dnd:function(e){if(e.config.drag_out){this.from_scheduler=e,this.to_scheduler=e;var t=this.drag_data={};t.ev=e._drag_event,t.orig_id=e._drag_event.id}},land_into_scheduler:function(e,t){if(!e.config.drag_in)return this.move_dnd_holder(t),
!1;var i=this.drag_data,a=e._lame_clone(i.ev);if(e!=this.from_scheduler){a.id=e.uid();var n=a.end_date-a.start_date;a.start_date=new Date(e.getState().min_date),a.end_date=new Date(a.start_date.valueOf()+n)}else a.id=this.drag_data.orig_id,a._dhx_changed=!0;return this.drag_data.target_id=a.id,e.callEvent("onBeforeEventDragIn",[a.id,a,t])?(this.to_scheduler=e,this.inject_into_scheduler(a,e,t),this.delete_dnd_holder(),e.updateView(),e.callEvent("onEventDragIn",[a.id,a,t]),!0):!1},drag_from_scheduler:function(e,t){
if(this.drag_data&&e._drag_id&&e.config.drag_out){if(this.to_scheduler==e&&(this.to_scheduler=null),!e.callEvent("onBeforeEventDragOut",[e._drag_id,e._drag_event,t]))return!1;this.create_dnd_holder(this.drag_data.ev,e);var i=e._drag_id;return this.drag_data.target_id=null,delete e._events[i],this.clear_scheduler_dnd(e),e.updateEvent(i),e.callEvent("onEventDragOut",[i,this.drag_data.ev,t]),!0}return!1},reset_event:function(e,t){this.inject_into_scheduler(e,t),this.stop_drag(t),t.updateView()},move_permanently:function(e,t,i,a){
a.callEvent("onEventAdded",[t.id,t]),this.inject_into_scheduler(e,i),this.stop_drag(i),e.event_pid&&"0"!=e.event_pid?(i.callEvent("onConfirmedBeforeEventDelete",[e.id]),i.updateEvent(t.event_pid)):i.deleteEvent(e.id),i.updateView(),a.updateView()}},dhtmlxEvent(window,"load",function(){dhtmlxEvent(document.body,"mousemove",function(e){var t=Scheduler._external_drag,i=t.target_scheduler;if(i)if(t.from_scheduler)if(i._drag_id);else{var a=t.to_scheduler;(!a||t.drag_from_scheduler(a,e))&&t.land_into_scheduler(i,e);

}else"move"==i.getState().drag_mode&&i.config.drag_out&&t.start_dnd(i);else t.from_scheduler&&(t.to_scheduler?t.drag_from_scheduler(t.to_scheduler,e):t.move_dnd_holder(e));t.target_scheduler=null}),dhtmlxEvent(document.body,"mouseup",function(e){var t=Scheduler._external_drag,i=t.from_scheduler,a=t.to_scheduler;if(i)if(a&&i==a)i.updateEvent(t.drag_data.target_id);else if(a&&i!==a){var n=t.drag_data.ev,s=a.getEvent(t.drag_data.target_id);i.callEvent("onEventDropOut",[n.id,n,a,e])?t.move_permanently(n,s,i,a):t.reset_event(n,i);

}else{var n=t.drag_data.ev;i.callEvent("onEventDropOut",[n.id,n,null,e])&&t.reset_event(n,i)}t.stop_drag(),t.current_scheduler=t.from_scheduler=t.to_scheduler=null})}),Scheduler.plugin(function(e){e.config.drag_in=!0,e.config.drag_out=!0,e.templates.event_outside=function(e,t,i){};var t=Scheduler._external_drag;e.attachEvent("onTemplatesReady",function(){dhtmlxEvent(e._obj,"mousemove",function(i){t.target_scheduler=e}),dhtmlxEvent(e._obj,"mouseup",function(i){t.target_scheduler=e})})});