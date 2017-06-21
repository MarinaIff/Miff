<?php
	include_once "db.php";
	include_once "action.php";
        include "header.php";
// блок отображения сообщений
	$c=0;	
	if (isset($_SESSION ['user_login'])) {
                $str_form = "<form  name='autoForm' action='autorize.php' method='post' onSubmit='return overify_login(this);' >
 			 Логин: <input type='text' name='login'>
 			 Пароль: <input type='password' name='pas'>
 			 <input type='submit' name='go' value='Подтвердить'>
 		     </form>";
                echo $str_form;
	}
	$out=out(5);// вызов функции out() из action.php для получения массива с результатом запроса SELECT * FROM GBookTable
	if(count($out)>0){
            foreach($out as $row) {//вывод массива 
                	
?>
			<div class = "arr">
					<div class = "data_header">Страна: <span class = "data_data"><?php echo $row['username']; ?></span></div>
					<div class = "data_data"><?php echo $row['message'];  ?></div>
			</div>
<?php
            }
	}	 
	include "footer.php";
