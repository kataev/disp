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
        
	$('input[name="date"]').datepick({dateFormat: 'yy-mm-dd'});




        $('input[name="minus"]').change(function(){

	if (parseInt($(this).attr('value')) <= ($(this).attr('max'))){

            if ($('fieldset').hasClass('Строительный') && $('fieldset').hasClass('Полуторный'))
                { kirp_pod = 288; }
            if ($('fieldset').hasClass('Строительный') && $('fieldset').hasClass('Одинарный'))
                { kirp_pod = 352; }
            if ($('fieldset').hasClass('Лицевой') && $('fieldset').hasClass('Полуторный'))
                { kirp_pod = 192; }
            if ($('fieldset').hasClass('Лицевой') && $('fieldset').hasClass('Одинарный'))
                { kirp_pod = 264; }


            var koll= $('input[name="minus"]').attr('value')/kirp_pod ;

            $('input[name="poddon"]').val(koll);}
	    else {alert("На складе меньше кирпича, сделайте перевод")}
        })

        $('input[name="poddon"]').change(function(){



            if ($('fieldset').hasClass('Строительный') && $('fieldset').hasClass('Полуторный'))
                { kirp_pod = 288; }
            if ($('fieldset').hasClass('Строительный') && $('fieldset').hasClass('Одинарный'))
                { kirp_pod = 352; }
            if ($('fieldset').hasClass('Лицевой') && $('fieldset').hasClass('Полуторный'))
                { kirp_pod = 192; }
            if ($('fieldset').hasClass('Лицевой') && $('fieldset').hasClass('Одинарный'))
                { kirp_pod = 264; }


            var koll= $('input[name="poddon"]').attr('value')*kirp_pod ;

	    if (koll<=($('input[name="minus"]').attr('max'))){
            $('input[name="minus"]').val(koll);}
	else {alert("На складе меньше кирпича, сделайте перевод")}

        })

        $("form").validate({
               rules : {
                       minus : {required : true,number: true,},
                       poddon: {required : true,number: true,},
                       nakl: {required : true,number: true},
               },
               messages : {
                       minus : {
                               required : "Введите кол-во кирпича",
                               number: "Вводите число",
                               
                       },
                      poddon : {
                               required : "Введите кол-во поддонов",
                               number: "Вводите число",
                       },
                       nakl : {
                               required : "Введите номер накладной",
                               number: "Вводите число",
                       }
               }
       });
        });
            </script>
    </head>
    <body>
        <?php

mysql_connect('localhost','disp','disp');
mysql_query('SET NAMES "utf8"');
mysql_select_db('disp');
$query = mysql_query("  SELECT tovar.id as id,mark,vid,mas,tip,color,tovar.prim as name,total
                        FROM sclad,tovar
                        WHERE sclad.id=tovar.id and tovar.id=$_GET[id]");
$row = mysql_fetch_assoc($query);



?>
        <div>
            <div id="h">
                <h1>Отгрузка</h1>
                <h2><?php echo $row[name]?></h2>
		<a href="sclad.php"><img src="../icon/arrow-turn-180-left.png" />Назад</a>
            </div>
            <form name="Отгрузка" action="action.php" method="GET">
                <fieldset id="shipping" class="<?php
                            $zero=""; if (!($row[begin]||$row[total])) {$zero = "zero";}
                            printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color] $zero") ?>">
                    <label for="minus"><img src="../icon/counter.png" /> Кол-во кирпича:</label>
                    <input max="<?php echo $row[total] ?>" type="text" name="minus"/><br />

                    <label for="poddon"><img src="../icon/store.png" /> Кол-во поддонов:</label>
                    <input type="text" name="poddon"/><br />

                    <label for="nakl"><img src="../icon/drawer.png" /> Номер накладной:</label>
                    <input type="text" name="nakl"/><br />
                    
		    <label for="agent"><img src="../icon/user-business.png" /> КонтрАгент:</label>
		    <select id="agent" name="agent">
			<?php
			$agent = mysql_query("  SELECT id,name from agent");
			while($ag=mysql_fetch_assoc($agent)){
			?>
			<option value="<?php echo $ag[id]; ?>"><?php echo preg_replace('/\\\/','',$ag[name]); ?></option>

			<?php };?>
		    </select><a href="agentadd.php" title="Добавить контрагента"><img src="../icon/user--plus.png" alt="Добавить контрагента" /></a><br />

		    <label for="price"><img src="../icon/money.png" /> Цена за шт:</label>
                    <input type="text" name="price"/><br />

		    <label for="price"><img src="../icon/wooden-box.png" /> Доставка:</label>
                    <input type="checkbox" name="trans" value="-1"/><br />

                    <label for="date"><img src="../icon/calendar.png" /> Дата отгрузки:</label>
                    <input type="text" name="date"/><br />

                    <label for="prim"><img src="../icon/ui-accordion.png" /> Примечание:</label>
                    <textarea name="prim" cols="40" rows="3"></textarea><br/>
                    
		    <input type="reset"  value="Сброс"/>
                    <input type="submit" value="Сохранить"/>
		    
                    <input type="hidden" name="id" value="<?php echo $_GET[id] ?>"/>
		    <input type="hidden" name="action" value="sold"/>
                    
                </fieldset>
            </form>
        </div>
    </body>
</html>
