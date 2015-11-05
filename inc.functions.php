<?php

include_once 'inc.db.php';

function get_travel_time($region_id) {
	global $pdo;

	$sql = "SELECT `travel-time` FROM vi_regions WHERE `id` = :id;";
	$sth = $pdo->prepare($sql);
	$sth->bindParam(':id', $region_id);

	$travel_time = -1;

	$sth->execute();
	foreach ($sth as $row)
		$travel_time = $row['travel-time'];

	return $travel_time;
}

function find_free_couriers($date_from, $date_till) {
	global $pdo;

	$sql = "SELECT `who` FROM vi_regions, vi_schedule  " .
		"WHERE `destination` = vi_regions.`id` " .
		"AND NOT (`departure` + INTERVAL `travel-time` DAY < DATE('" . $date_from . "') " .
		"OR `departure` > DATE('" . $date_till . "')) ";

	$sql = "SELECT * FROM vi_courier WHERE `id` NOT IN (" . $sql . ") ORDER BY `last-name` ASC;";
	$sth = $pdo->prepare($sql);
	$sth->execute();
	foreach ($sth as $row)
		$couriers[] = array('id' => $row['id'], 'name' => $row['last-name'] . ' ' . $row['first-name'] . ' ' . $row['middle-name']);

	if (isset($couriers))
		return $couriers;
	else
		return array();
}

function insert_to_schedule($couriers, $date_from, $courier, $region) {
	global $pdo;
	$found = false;
	foreach ($couriers as $row)
		if ($row['id'] == $courier)
			$found = true;
	if ($found) {
		$sql = "INSERT INTO `vi_schedule` (`id`, `who`, `departure`, `destination`) VALUES (NULL , :who, DATE(:departure), :destination);";
		$sth = $pdo->prepare($sql);
		$sth->bindParam(':who', $courier, PDO::PARAM_INT);
		$sth->bindParam(':departure', $date_from);
		$sth->bindParam(':destination', $region, PDO::PARAM_INT);
		$sth->execute();
		if ($sth->errorCode() == 0)
			return true;
		else
			return false;
	} else
		return false;
}