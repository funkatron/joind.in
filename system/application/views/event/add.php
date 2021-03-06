<?php
//$tz_list=array('Select Continent');
//foreach($tz as $k=>$v){ $tz_list[(string)$v->offset]=floor((string)$v->offset/3600); }

$offset_list=array_merge(range(-12,12),range(0,12));
foreach($offset_list as $k=>$v){ 
	if($v<0){ 
		$tz_list[$v]='UTC '.$v.' hours'; 
	}elseif($v>0){
		$tz_list[$v]='UTC +'.$v.' hours'; 
	}else{ $tz_list[$v]='UTC 0 hours'; }
}

echo $this->validation->error_string;
if(isset($this->edit_id) && $this->edit_id){
	echo form_open_multipart('event/edit/'.$this->edit_id);
	$sub='Save Edits';
	$title='Edit Event: '.$detail[0]->event_name;
	$curr_img=$detail[0]->event_icon;
	menu_pagetitle('Edit Event: '.$detail[0]->event_name);
}else{ 
	echo form_open_multipart('event/add'); 
	$sub	= 'Add Event';
	$title	= 'Add Event';
	$curr_img='none.gif';
	menu_pagetitle('Add an Event');
}

echo '<h2>'.$title.'</h2>';

if(isset($msg)){ echo '<div class="notice">'.$msg.'</div>'; }
?>

<div class="box">
    <div class="row">
    	<label for="event_name">Event Name:</label>
	<?php echo form_input('event_name',$this->validation->event_name); ?>
    </div>
    <div class="clear"></div>
    <div class="row">
    	<label for="event_start">Event Start:</label>
	<?php
	foreach(range(1,12) as $v){
	    $m=date('M',mktime(0,0,0,$v,1,date('Y')));
	    $start_mo[$v]=$m; }
	foreach(range(1,32) as $v){ $start_day[$v]=$v; }
	foreach(range(2008,date('Y')+5) as $v){ $start_yr[$v]=$v; }
	echo form_dropdown('start_mo',$start_mo,$this->validation->start_mo);
	echo form_dropdown('start_day',$start_day,$this->validation->start_day);
	echo form_dropdown('start_yr',$start_yr,$this->validation->start_yr);
	?>
    </div>
    <div class="clear"></div>
    <div class="row">
    	<label for="event_end">Event End:</label>
	<?php
	foreach(range(1,12) as $v){
	    $m=date('M',mktime(0,0,0,$v,1,date('Y')));
	    $end_mo[$v]=$m; }
	foreach(range(1,32) as $v){ $end_day[$v]=$v; }
	foreach(range(2008,date('Y')+5) as $v){ $end_yr[$v]=$v; }
	echo form_dropdown('end_mo',$end_mo,$this->validation->end_mo);
	echo form_dropdown('end_day',$end_day,$this->validation->end_day);
	echo form_dropdown('end_yr',$end_yr,$this->validation->end_yr);
	?>
    </div>
    <div class="clear"></div>
    <div class="row">
    	<label for="event_location">Event Location:</label>
	<?php echo form_input('event_loc',$this->validation->event_loc); ?>
    </div>
    <div class="clear"></div>
    <!--<div class="row">
    	<label for="event_timezone">Event Timezone:</label>
	<?php echo form_dropdown('event_tz',$tz_list,$this->validation->event_tz); ?>
    </div>
    <div class="clear"></div>-->
    <div class="row">
    	<label for="event_description">Event Description:</label>
	<?php
	$arr=array(
		'name'	=> 'event_desc',
		'cols'	=> 45,
		'rows'	=> 12,
		'value'	=> $this->validation->event_desc
	);
	echo form_textarea($arr);
	?>
    </div>
    <div class="clear"></div>
    <div class="row">
    	<label for="event_icon">Event Icon:</label>
	<input type="file" name="event_icon" size="20" /><br/><br/>
	<img src="/inc/img/event_icons/<?php echo $curr_img; ?>"/>
    </div>
    <div class="clear"></div>
    <div class="row">
    	<label for="event_link">Event Link(s):</label>
	<?php echo form_input('event_href',$this->validation->event_href); ?>
    </div>
    <div class="clear"></div>
    <div class="row">
    	<label for="event_hashtag">Event Hashtag(s):</label>
	<?php echo form_input('event_hashtag',$this->validation->event_hashtag); ?>
	<span style="color:#3567AC;font-size:11px">Seperate tags with commas</span>
    </div>
    <div class="clear"></div>
    <div class="row">
    	<?php echo form_submit('sub',$sub); ?>
    </div>
</div>
<?php echo form_close(); ?>