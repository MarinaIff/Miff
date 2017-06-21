<?php

include "db.php";

function table_walk($country, $key_country) {// создаем функцию, которую хотим применить к элементам массива
	//$key = "Автор: " .$key ." ";
	//$val = "Название: \"" . $val ."\"";
	//echo $key." ".$val."\n";
	static $i = 1;
	//статическая глобальная переменная-счетчик
	echo "<tr>";
	echo "<td>" . $i . "</td>";
	foreach ($country as $key => $value) {
		if (!is_array($value))
			echo "<td>$value</td>";
		else {
			foreach ($value as $k => $v)
				echo "<td>$v</td>";
		}
	}
	echo "</tr>";
	$i++;
}

function out() {
	global $countries;
	// делаем переменную $countries глобальной
	$arr_out = array();
	$arr_out = $countries;
	echo "<table class='out'>";
	echo "<tr><td>№</td><td>Страна</td><td>Столица</td><td>Площадь</td><td>Население за 2000 год</td><td>Население за 2010 год</td></tr>";
	if (isset($countries))
		array_walk($countries, "table_walk");
	echo "</table>";
}

function out_arr() {
	global $countries;
	// делаем переменную $countries глобальной
	$arr_out = array();
	$arr_out[] = "<table class='out'>";
	$arr_out[] = "<tr><td>№</td><td>Страна</td><td>Столица</td><td>Площадь</td><td>Население за 2000 год</td><td>Население за 2010 год</td><td>Среднее население</td></tr>";
	foreach ($countries as $country) {
		$i = 1;
		//статическая глобальная переменная-счетчик
		$str = "<tr>";
		$str .= "<td>" . $i . "</td>";
		foreach ($country as $key => $value) {
			if (!is_array($value))
				$str .= "<td>$value</td>";
			else {
				foreach ($value as $k => $v)
					$str .= "<td>$v</td>";
			}
			
		}
		$str .= "<td>".(array_sum($country['population'])/count($country['population']))."</td>";
		$str .= "</tr>";
		$arr_out[] = $str;
		$i++;
	}
	$arr_out[] = "</table>";
	return $arr_out;
}

function check_autorize($log, $pas) {
	global $users;
	if (in_array($log, $users)) {
		return true;
	} else {
		return false;
	}
}

function check_admin($log, $pas) {
	global $users;
	if (in_array($log, $users) && ($pas == $users["admin"])) {
		return true;
	} else {
		return false;
	}
}

function check_log($log) {
	if ($log == "admin") {
		return true;
	} else {
		return false;
	}
}

function name($a,$b){ // функция, определяющая способ сортировки (по названию столицы)
  if ($a["capital"] < $b["capital"]) return -1;
  elseif ($a["capital"]==$b["capital"]) return 0;
  else return 1;
 }

function area($a,$b){ // функция, определяющая способ сортировки (по населению)
  if ($a["population"]["2000"] < $b["population"]["2000"]) return -1;
  elseif ($a["population"]["2000"]==$b["population"]["2000"]) return 0;
  else return 1;
 }

function population($a,$b){  // функция, определяющая способ сортировки (по сумме населения за 2000 и за 2010 годы)
 	if ($a["population"]["2000"] + $a["population"]["2010"]< $b["population"]["2000"] + $b["population"]["2010"]) return -1;
	elseif ($a["population"]["2000"] + $a["population"]["2010"]==$b["population"]["2000"] + $b["population"]["2010"]) return 0;
	else return 1;
}
function sorting($p){
	global $countries;
	uasort($countries, $p);
 }
	

