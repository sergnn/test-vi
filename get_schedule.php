<?php
include_once 'inc.db.php';

$sql = "SELECT `first-name`, `last-name`, `middle-name`, `departure`, vi_regions.`name`, (`departure` + INTERVAL `travel-time` DAY) as `arrival` " .
	"FROM vi_schedule, vi_regions, vi_courier WHERE `who` = vi_courier.`id` AND `destination` = vi_regions.`id` ORDER BY `departure`;";
$sth = $pdo->prepare($sql);
$sth->execute();

foreach ($sth as $row)
	$schedule[] = array('courier'   => $row['last-name'] . ' ' . $row['first-name'] . ' ' . $row['middle-name'],
						'name'      => $row['name'],
						'departure' => $row['departure'],
						'arrival'   => $row['arrival']);

if (isset($schedule))
	$result = array('type'    => 'success',
					'couriers' => $schedule);
else
	$result = array('type' => 'error');

print json_encode($result);