<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="../icon/plus-circle-frame.png">
        <link rel="stylesheet" href="forms.css" type="text/css" />
        <script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
        <script src="datepicker/jquery.validate.js" type="text/javascript"></script>
        <title>Редактирование</title>
        <script type="text/javascript">
        $(document).ready(function(){
	
	$('[value='+$('fieldset#edit').attr('color')+']').click()
	$('[value='+$('fieldset#edit').attr('mas')+']').click()
	$('[value='+$('fieldset#edit').attr('mark')+']').click()
	$('[value='+$('fieldset#edit').attr('vid')+']').click()
	$('[value='+$('fieldset#edit').attr('tip')+']').click()

	
        });
            </script>
    </head>
    <body>
        <?php

mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);

if (isset($_GET[id])){
$query = mysql_query("  SELECT tovar.id as id,mark,vid,mas,tip,color,tovar.prim,tovar.name,total
                        FROM sclad,tovar
                        WHERE sclad.id=tovar.id and tovar.id=$_GET[id]");
$row = mysql_fetch_assoc($query);
$act = "edit";
$h1 = "Редакти-<br/>рование";
}
else {
    $act = "addtovar";
    $h1 = "Добавление продукции";
}


?>
        <div>
            <div id="h">
                <h1><?php echo $h1 ?></h1>
                <h2><?php echo $row[name]?></h2>
		<a href="sclad.php"><img alt="" src="../icon/arrow-turn-180-left.png" />Назад</a>
            </div>
            <form name="Изменение" action="action.php" method="GET">
                
                <fieldset id="edit"
			  color="<?php echo $row[color];?>"
			  mas="<?php echo $row[mas];?>"
                          mark="<?php echo $row[mark];?>" 
			  vid="<?php echo $row[vid];?>"
			  tip="<?php echo $row[tip];?>"
			  class="<?php $zero=""; if (!($row[begin]||$row[total])) {$zero = "zero";}
                            printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color] $zero") ?>">
                    <label for="name">Имя для накладной:</label>
                    <textarea name="name" cols="40" rows="3"></textarea><br />

                    <label for="prim">Внутреннее имя:</label>
                    <textarea name="prim" cols="40" rows="3"></textarea><br />

		    <label for="total">Остаток:</label>
                    <input type="text" name="total" value="<?php echo $row[total] ?>"/><br />
		    <label for="mark">Марка:</label>
		    <fieldset>
		    <input type="radio" name="mark" value="100" />100
		    <input type="radio" name="mark" value="125" />125
		    <input type="radio" name="mark" value="150" />150<br />
		    <input type="radio" name="mark" value="175" />175
		    <input type="radio" name="mark" value="200" />200
		    <input type="radio" name="mark" value="250" />250<br />
		    <input type="radio" name="mark" value="300" />300
		    <input type="radio" name="mark" value="0" />Более 20% (Некондиция)
		    </fieldset>
		    <label for="mark">Цвет:</label>
		    <fieldset>		    
                    <input type="radio" name="color" value="Красный" />Красный
		    <input type="radio" name="color" value="Желтый" />Желтый
		    <input type="radio" name="color" value="Коричневый" />Коричневый<br />
		    <input type="radio" name="color" value="Светлый" />Светлый
		    <input type="radio" name="color" value="Белый" />Белый
		    <input type="radio" name="color" value="КЕ" />Прочее
		    </fieldset>

		    <label for="mark">Тип:</label>
		    <fieldset>
		    <input type="radio" name="tip" value="0" />Нет
		    <input type="radio" name="tip" value="1" />Тип 1
		    <input type="radio" name="tip" value="2" />Тип 2
		    <input type="radio" name="tip" value="3" />Тип 3
		    </fieldset>

		    <label for="mark">Толщина:</label>
		    <fieldset>
                    <input type="radio" name="mas" value="Полуторный" />Полуторный
		    <input type="radio" name="mas" value="Одинарный" />Одинарный<br/>
		    <input type="radio" name="mas" value="Прочее" />Прочее
		    </fieldset>

		    <label for="mark">Вид:</label>
		    <fieldset>
                    <input type="radio" name="vid" value="Лицевой" />Лицевой
		    <input type="radio" name="vid" value="Строительный" />Строительный
		    </fieldset>

		    <label for="brak">Особенности:</label>
		    <fieldset>
		    <input type="checkbox" name="polo" value="Полосы" />Полосы
		    <input type="checkbox" name="faska" value="Фаска" />Фаска<br/>
		    <input type="checkbox" name="20" value="Больше 20%" />Больше 20%
		    <input type="checkbox" name="20" value="Меньше 20%" />Меньше 20%
		    </fieldset>
		    
		    <input type="hidden" name="action" value="<?php echo $act ?>"/>
                    <input type="hidden" name="id" value="<?php echo $_GET[id] ?>"/>
                    <a id="backbutton" href="tovar.php">Назад</a>
                    <input id="subbutton" type="submit" name="submit" value="Сохранить"/>
                </fieldset>


            </form>
        </div>
    </body>
</html>
