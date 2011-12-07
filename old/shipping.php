<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="datepicker/jquery.datepick.css" type="text/css" />
        <script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
        <script src="datepicker/jquery.validate.js" type="text/javascript"></script>
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

mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);
$query = mysql_query("  SELECT tovar.id as id,mark,vid,mas,tip,color,tovar.prim as name,total
                        FROM sclad,tovar
                        WHERE sclad.id=tovar.id and tovar.id=$_GET[id]");
$row = mysql_fetch_assoc($query);



?>
        <div id="shipping"  >
            <h1>Отгрузка кирпича</h1>
            <form name="Отгрузка" action="action.php" method="GET">
                <h2><?php echo $row[name]?></h2>
                <h3>Марка: <?php echo $row[mark]?>
                <?php echo $row[color]?>
                <?php echo $row[vid]," ",$row[mas]?></h3>
                <fieldset id="shipping" class="<?php
                            $zero=""; if (!($row[begin]||$row[total])) {$zero = "zero";}
                            printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color] $zero") ?>">
                    <label for="minus">Кол-во кирпича:</label>
                    <input max="<?php echo $row[total] ?>" type="text" name="minus"/><br />

                    <label for="poddon">Кол-во поддонов:</label>
                    <input type="text" name="poddon"/><br />

                    <label for="nakl">Номер накладной:</label>
                    <input type="text" name="nakl"/><br />

                    
		    <label for="agent">КонтрАгент:</label>
		    <select id="agent" name="agent">
			<?php
			$agent = mysql_query("  SELECT id,name from agent");
			while($ag=mysql_fetch_assoc($agent)){
			?>
			<option value="<?php echo $ag[id]; ?>"><?php echo $ag[name]; ?></option>

			<?php };?>
		    </select>


                    <label for="prim">Примечание:</label>
                    <input type="text" name="prim"/><br />

                    <label for="date">Дата отгрузки:</label>
                    <input type="text" name="date"/><br />
		    <a id="backbutton" href="sclad.php">Назад</a>
                    <input id="subbutton" type="submit" name="submit" value="Сохранить"/>

		    
                    <input id="subm" type="hidden" name="id" value="<?php echo $_GET[id] ?>"/>
		    <input id="subm" type="hidden" name="action" value="sold"/>
                    
                </fieldset>
            
            
            </form>
        </div>
    </body>
</html>
