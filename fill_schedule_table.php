<?php

include_once 'inc.db.php';
include_once 'inc.functions.php';


for ($i = 0; $i < 100; $i++) {
	//get all regions from DB
	$sql = "SELECT * FROM vi_regions;";
	$sth = $pdo->prepare($sql);
	$sth->execute();

	$regions = array();
	foreach ($sth as $row)
		$regions[] = array('id'          => $row['id'],
						   'travel-time' => $row['travel-time']);

	$selected_region = $regions[array_rand($regions)];

	//generate random date
	$d_begin = new DateTime('2015-06-01');
	$d_end = new DateTime();
	$date_from = DateTime::createFromFormat('U', rand($d_begin->format('U'), $d_end->format('U')));

	//calculate till date
	$date_till = new DateTime($date_from->format('Y-m-d'));
	$date_till->add(new DateInterval("P" . $selected_region['travel-time'] . "D"));

	//get free couriers
	$couriers = find_free_couriers($date_from->format('Y-m-d'), $date_till->format('Y-m-d'));
	if (count($couriers) > 0) {
		//random courier
		$courier = $couriers[array_rand($couriers)]['id'];
		//insert to DB
		insert_to_schedule($couriers, $date_from->format('Y-m-d'), $courier, $selected_region['id']);
	}
}