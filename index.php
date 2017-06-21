<?php
ob_start(); // Начало буфферизации
include_once "action.php";
include "header.php";
if (isset($_POST['go'])) {
	$login = $_POST['login'];
	$password = $_POST['pass'];
	if (check_autorize($login, $password)) {
		if (check_admin($login, $password)) {
			// echo "Приветствуем Вас, $login!"; // Вариант
			// echo "<a href='report.php'>Просмотр отчета</a>"; // Вариант
			header("Location: hello.php?login=$login");
			ob_end_flush();// Конец буфферизации
		} else
			echo "Приветствуем Вас, $login!";
	} else {
		echo "Вы не зарегистрированы!";
	}
}

$str_form = "<span id='massage'></span>
			<form  name='autoForm' action='index.php' method='post' onSubmit='return overify_login(this);' >
 			 Логин: <input type='text' name='login'>
 			 Пароль: <input type='password' name='pass'>
 			 <input type='submit' name='go' value='Подтвердить'>
 		     </form>";
echo $str_form;
$str_form_s = '<h3>Сортировать по:</h3>
<form action="index.php" name="myform" method="post">
 <select name="sort" size="1">
   <option value="name">Названию</option>
   <option value="area">Площади</option>
   <option value="population">Среднему населению</option>
 </select>
 <input name="Submit" type=submit value="Подтвердить">
</form>';
echo $str_form_s;
if(isset($_POST['sort'])){
	sorting($_POST['sort']);
}
// блок отображения информации
$out = out_arr();
// вызов функции out_arr() из action.php для получения массива
if (count($out) > 0) {
	foreach ($out as $row) {//вывод массива построчно
		echo $row;
	}
} else// если нет данных
	echo "Нет данных...";
	
//include "content.php"; // Можно вынести таблицу в отдельный файл

include "footer.php";
