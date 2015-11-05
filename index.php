<?php
include_once 'inc.db.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Расписание курьеров</title>
	<title>Расписание курьеров</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="main.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body>
<div class="addform">
	<p>
		<label for="region">Регион</label><br>
		<select name="region" id="region">
			<option value="0">выберите регион</option>
			<?php
			$sql = "SELECT * FROM vi_regions ORDER BY `name` ASC";
			$sth = $pdo->query($sql);
			foreach ($sth as $row)
				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>' . PHP_EOL;
			?>
		</select>
	</p>
	<p>
		<label for="date">Дата выезда из Москвы:</label><br>
		<input id="date" type="text" value="<?= date("d.m.Y") ?>">
	</p>
	<p>
		<label for="couriers">Курьер:</label><br>
		<select id="couriers">
			<option value="0">выберите регион</option>
		</select>
	</p>
	<p>
		Дата прибытия в регион <span id="arrival">неизвестна</span>, дней в пути: <span id="days">-</span>
	</p>
	<input type="button" id="insert" value="Добавить в расписание">
</div>
<div id="schedule"></div>
</body>
</html>