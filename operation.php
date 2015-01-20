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
        <title>Отгрузка</title>
        <script type="text/javascript">
        $(document).ready(function(){
	
        });
            </script>
    </head>
    <body>
        <?php

mysql_connect('localhost','disp','disp');
mysql_query('SET NAMES "utf8"');
mysql_select_db('disp');

$query = mysql_query("select tovar.prim as name,color,mark,vid,mas,mark,minus,agent.name as agent,date,time,poddon,nakl,date,trans,jurnal.price as price,money
	from jurnal,tovar,agent
	where jurnal.agent=agent.id and tovar.id=jurnal.tov and jurnal.id=$g_id");
$row = mysql_fetch_assoc($query);
$day = array("Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота");
$mou = array("Января","Февраля","Марта","Апреля","Мая","Июня","Июля","Августа","Сентября","Октября","Ноября","Декабря");



?>
        <div>
            <div id="h">
                <h1>Отгрузка от <?php echo date("d",strtotime($row[date]))," ",$mou[date("n",strtotime($row[date]))-1]," ",date("Y",strtotime($row[date]))?></h1>
                <h2><?php echo $row[name]?></h2>
		<a href="index.php"><img src="../icon/arrow-turn-180-left.png" />Назад</a>
            </div>
	    <form action="action.php" method="GET">
		<label for="minus"><img src="../icon/counter.png" /> Кол-во кирпича:</label>
		<input readonly="readonly" value="<?php echo $row[minus] ?>" type="text" name="minus"/><br />

                    <label for="poddon"><img src="../icon/store.png" /> Кол-во поддонов:</label>
                    <input type="text" readonly="readonly" value="<?php echo $row[poddon] ?>" name="poddon"/><br />

                    <label for="nakl"><img src="../icon/drawer.png" /> Номер накладной:</label>
                    <input type="text" readonly="readonly" value="<?php echo $row[nakl] ?>" name="nakl"/><br />

		    <label for="agent"><img src="../icon/user-business.png" /> КонтрАгент:</label>
		    <input type="text" readonly="readonly" value="<?php echo $row[agent] ?>" name="agent"/><br />
		    
<!--		    <span id="money"><?php echo $row[money] ?></span>-->
		    <label for="price"><img src="../icon/money.png" /> Цена за шт:</label>
                    <input type="text"  value="<?php echo $row[price] ?>" name="price"/><br />

		    <label for="price"><img src="../icon/wooden-box.png" /> Доставка за шт:</label>
                    <input type="text"  value="<?php if($row[trans]!=-1) {echo $row[trans];} ?>" name="trans"/><br />
		    
		    <label for="money"><img src="../icon/currency.png" /> Сумма:</label>
                    <input type="text" readonly="readonly" value="<?php echo $row[price]*$row[minus]; ?>" name="money"/><br />

		    <?php if($row[trans]>0){?>
		    <label for="delivery"><img src="../icon/truck-empty.png" /> Сумма доставки:</label>
                    <input type="text" readonly="readonly" value="<?php echo $row[trans]*$row[minus]; ?>" name="delivery"/><br />
			<?php
		    }?>

                    <label for="date"><img src="../icon/calendar.png" /> Дата отгрузки:</label>
                    <input type="text" readonly="readonly" value="<?php echo $row[date] ?>" name="date"/><br />

                    <label for="prim"><img src="../icon/ui-accordion.png" /> Примечание:</label>
                    <textarea name="prim" readonly="readonly" value="<?php echo $row[prim] ?>" cols="40" rows="3"></textarea>

		    <input type="hidden" name="id" value="<?php echo $_GET[id] ?>"/>
		    <input type="hidden" name="action" value="oper"/>

		    <input type="submit" value="Сохранить"/>

	    </form>
        </div>
    </body>
</html>
