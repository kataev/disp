<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css" />
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

	$("form").validate({
               rules : {
                       name : {required : true},
                       prim: {required : true},
                       
               },
               messages : {
                       name : {
                               required : "Введите",
                          

                       },
                      prim : {
                               required : "Введите",
                          
                       }
               }
       });
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
$h1 = "Редактирование продукции";
}
else {
    $act = "addtovar";
    $h1 = "Добавление продукции";
}


?>
        <div id="edit"  >
            <h1><?php echo $h1 ?></h1>
            <form name="Изменение" action="action1.php" method="GET">
                <h2><?php echo $row[name]?></h2>
                <fieldset id="edit"
			  color="<?php echo $row[color];?>"
			  mas="<?php echo $row[mas];?>"
                          mark="<?php echo $row[mark];?>" 
			  vid="<?php echo $row[vid];?>"
			  tip="<?php echo $row[tip];?>"
			  class="<?php $zero=""; if (!($row[begin]||$row[total])) {$zero = "zero";}
                            printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color] $zero") ?>">
                    <label for="name">Имя для накладной:</label>
                    <input type="text" name="name" value="<?php echo $row[name] ?>"/><br />

                    <label for="prim">Внутреннее имя:</label>
                    <input type="text" name="prim" value="<?php echo $row[prim] ?>" /><br />

		    <label for="total">Остаток:</label>
                    <input type="text" name="total" value="<?php echo $row[total] ?>"/><br />
		    <fieldset>
		    <label for="mark">Марка</label>
                    <input type="radio" name="mark" value="100" />100
		    <input type="radio" name="mark" value="125" />125
		    <input type="radio" name="mark" value="150" />150
		    <input type="radio" name="mark" value="175" />175
		    <input type="radio" name="mark" value="200" />200
		    <input type="radio" name="mark" value="250" />250
		    <input type="radio" name="mark" value="100" />0
		    </fieldset>

		    <fieldset>
		    <label for="mark">Цвет</label>
                    <input type="radio" name="color" value="Красный" />Красный
		    <input type="radio" name="color" value="Желтый" />Желтый
		    <input type="radio" name="color" value="Коричневый" />Коричневый
		    <input type="radio" name="color" value="Светлый" />Светлый
		    <input type="radio" name="color" value="Белый" />Белый
		    <input type="radio" name="color" value="КЕ" />КЕ
		    </fieldset>

		    <fieldset>
		    <label for="mark">Тип</label>
                    <input type="radio" name="tip" value="0" />Тип 0
		    <input type="radio" name="tip" value="1" />Тип 1
		    <input type="radio" name="tip" value="2" />Тип 2
		    <input type="radio" name="tip" value="3" />Тип 3
		    </fieldset>

		    <fieldset>
		    <label for="mark">Толщина</label>
                    <input type="radio" name="mas" value="Полуторный" />Полуторный
		    <input type="radio" name="mas" value="Одинарный" />Одинарный
		    </fieldset>

		    <fieldset>
		    <label for="mark">Вид</label>
                    <input type="radio" name="vid" value="Лицевой" />Лицевой
		    <input type="radio" name="vid" value="Строительный" />Строительный
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
