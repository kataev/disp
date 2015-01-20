<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="../icon/truck--plus.png">
        <link rel="stylesheet" href="forms.css" type="text/css" />
        <link rel="stylesheet" href="datepicker/jquery.datepick.css" type="text/css" />
        <script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="datepicker/jquery.validate.js"></script>
	<script type="text/javascript" src="datepicker/jquery.datepick.js"></script>
	<script type="text/javascript" src="datepicker/jquery.datepick-ru.js"></script>
        <title>Установка нового прайса</title>
        <script type="text/javascript">
        $(document).ready(function(){
    
        });
            </script>
    </head>
    <style type="text/css">
	div form fieldset label {width: 250px;
	}
	lagend {margin-left: auto;margin-right: auto;}
	body>div {width: 100%;}
    </style>
    <body>
        <?php

mysql_connect('localhost','disp','disp');
mysql_query('SET NAMES "utf8"');
mysql_select_db('disp');
//$query = mysql_query("  SELECT tovar.id as id,mark,vid,mas,tip,color,tovar.prim as name,total
//                        FROM sclad,tovar
//                        WHERE sclad.id=tovar.id and tovar.id=$_SERVER['id']");
//$row = mysql_fetch_assoc($query);



?>
        <div>
            <div id="h">
                <h1>Установка нового прайса</h1>
                <h2><?php echo $row[name]?></h2>
		<a href="sclad.php"><img src="../icon/arrow-turn-180-left.png" />Назад</a>
            </div>
            <form name="Установка нового прайса" action="#" method="GET">
                <fieldset>
		    <legend>Одинарный пустотелый</legend>
		    Кирпич керамический пустотелый рядовой одинарный ГОСТ 530-2007
                   <label for=""><img src="../icon/calendar.png" /> 100:</label>
                    <input type="text" name=""/><br />
		    <label for=""><img src="../icon/calendar.png" /> 125:</label>
                    <input type="text" name=""/><br />
		    <label for=""><img src="../icon/calendar.png" /> 150:</label>
                    <input type="text" name=""/><br />
		    <label for=""><img src="../icon/calendar.png" /> 175:</label>
                    <input type="text" name=""/><br />
		    <label for=""><img src="../icon/calendar.png" /> 200:</label>
                    <input type="text" name=""/><br />
                    <label for=""><img src="../icon/calendar.png" />Уровень дефекта до 20%:</label>
                    <input type="text" name=""/><br />
		    <label for=""><img src="../icon/calendar.png" />Уровень дефекта свыше 20%:</label>
                    <input type="text" name=""/><br />

                   <label for=""><img src="../icon/calendar.png" />Некондиция:</label>
                    <input type="text" name=""/><br />

                   <label for=""><img src="../icon/calendar.png" />Лицевой Марка: 100-150:</label>
                    <input type="text" name=""/><br />
                </fieldset>
		 <fieldset>
		    <legend>Одинарный цветной</legend>
		    Кирпич керамический пустотелый<br/> рядовой одинарный коричневый ГОСТ 530-2007<br/>
                   <label for=""><img src="../icon/calendar.png" /> 100:</label>
                    <input type="text" name=""/><br />
		    <label for=""><img src="../icon/calendar.png" /> 125:</label>
                    <input type="text" name=""/><br />
		    <label for=""><img src="../icon/calendar.png" /> 150:</label>
                    <input type="text" name=""/><br />
		    <label for=""><img src="../icon/calendar.png" /> 175:</label>
                    <input type="text" name=""/><br />
                </fieldset>
            </form>
        </div>
    </body>
</html>
