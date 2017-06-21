<?php
include "db.php";
/**
 * 
 * @global type $countries
 * @staticvar int $i
 * @return table array 
 */
function out_arr() {
	global $countries;
	// делаем переменную $countries глобальной
	$arr_out = array();
	$arr_out[] = "<table class='out'>";
	$arr_out[] = "<tr><td>№</td><td>Страна</td><td>Столица</td><td>Площадь</td><td>Население за 2000 год</td><td>Население за 2010 год</td><td>Среднее население</td></tr>";
	foreach ($countries as $country) {
		static $i = 1;
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
/**
 * 
 * @global type $users
 * @param type $log
 * @param type $pas
 * @return boolean
 */
function check_autorize($log, $pas) {
	global $users;
	if (in_array($log, $users)) {
		return true;
	} else {
		return false;
	}
}
/**
 * 
 * @global type $users
 * @param type $log
 * @param type $pas
 * @return boolean
 */
function check_admin($log, $pas) {
	global $users;
	if (in_array($log, $users) && ($pas == $users["admin"])) {
		return true;
	} else {
		return false;
	}
}
/**
 * Проверка наличия логина пользователя
 * @param string $log
 * 
 */
function check_log($log) {
	if ($log == "admin") {
		return true;
	} else {
		return false;
	}
}
/**
 * 
 * @param string $a
 * @param string $b
 * @return int
 */
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
 	if ($a["population"]["2000"] + $a["population"]["2010"]< $b["population"]["2000"] + $b["population"]["2010"]) 
 		return -1;
	elseif ($a["population"]["2000"] + $a["population"]["2010"]==$b["population"]["2000"] + $b["population"]["2010"]) 
		return 0;
	else 
		return 1;
}
/**
 * 
 * @global type $countries
 * @param type $p
 */
function sorting($p){
	global $countries;
	uasort($countries, $p);
 }
	

