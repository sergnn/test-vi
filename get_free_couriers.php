<?php
include_once 'inc.db.php';
include_once 'inc.functions.php';

//parse date
$date_tmp = array_reverse(explode('.', $_GET['datefrom']));
array_map('intval', $date_tmp);
$date_tmp[0] = $date_tmp[0] > 2000 ? $date_tmp[0] : $date_tmp[0] + 2000;
$date_from = new DateTime(implode('-', $date_tmp));

$id = @intval($_GET['region']);

//get travel time
$travel_time = get_travel_time($id);

if ($travel_time > 0) {
	//calculate till date
	$date_till = new DateTime($date_from->format('Y-m-d'));
	$date_till->add(new DateInterval("P" . $travel_time . "D"));

	//find free couriers
	$couriers = find_free_couriers($date_from->format('Y-m-d'), $date_till->format('Y-m-d'));
	//insert courier to schedule
	if (count($couriers) > 0 && $_GET["action"] == 'add' && intval($_GET['courier'])) {
		insert_to_schedule($couriers, $date_from->format('Y-m-d'), @intval($_GET['courier']), @intval($_GET['region']));
	}
}

//output
if (isset($couriers))
	$result = array('type'    => 'success',
					'names'   => $couriers,
					'time'    => $travel_time,
					'arrival' => $date_till->format('d.m.Y'));
else
	$result = array('type' => 'error');


print json_encode($result);