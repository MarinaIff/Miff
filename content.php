<?php

// блок отображения сообщений
$str_form = "<form  name='autoForm' action='autorize.php' method='post' onSubmit='return overify_login(this);' >
 			 Логин: <input type='text' name='login'>
 			 Пароль: <input type='password' name='pas'>
 			 <input type='submit' name='go' value='Подтвердить'>
 		     </form>";
echo $str_form;
//out();// вызов функции out() из action.php для получения массива
$out = out_arr();
// вызов функции out() из action.php для получения массива с результатом запроса SELECT * FROM GBookTable
if (count($out) > 0) {
	foreach ($out as $row) {//вывод массива построчно
		echo $row;
	}
} else// если ни одной записи не встретилось
	echo "Нет данных...";
