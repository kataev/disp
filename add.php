<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="../icon/box--plus.png">
        <link rel="stylesheet" href="forms.css" type="text/css" />
	<link rel="stylesheet" href="datepicker/jquery.datepick.css" type="text/css" />
        <script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
        <script src="datepicker/jquery.validate.js" type="text/javascript"></script>
	<script type="text/javascript" src="datepicker/jquery.datepick.js"></script>
	<script type="text/javascript" src="datepicker/jquery.datepick-ru.js"></script>
        <title>Принятие с производства</title>
        <script type="text/javascript">
        $(document).ready(function(){
	$('input[name="date"]').datepick({dateFormat: 'yy-mm-dd'});
        

        $("form").validate({
               rules : {
                       kirp : {required : true,number: true,},
                       poddon: {required : true,number: true,},
                       
               },
               messages : {
                       kirp : {
                               required : "Введите кол-во кирпича",
                               number: "Вводите число",

                       },
                      poddon : {
                               required : "Введите кол-во поддонов",
                               number: "Вводите число",
                       },
              
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
$query = mysql_query("  SELECT id,mark,vid,mas,tip,color,tovar.prim as name
                        FROM tovar
                        WHERE tovar.id=$_GET[id]");
$row = mysql_fetch_assoc($query);

?>
	<div>
	    <div id="h"><h1>Принятие</h1>
	    <h2><?php echo $row[name]?></h2>
	    <a href="sclad.php"><img src="../icon/arrow-turn-180-left.png" />Назад</a>
	    </div>
    
	<form name="add" action="action.php" method="GET">
	    <fieldset id="add" class="<?php
		    printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]") ?>">
                    <label for="plus"><img src="../icon/counter.png" /> Кол-во кирпича:</label>
                    <input type="text" name="plus"/><br />

		    <label for="date"><img src="../icon/calendar.png" /> Дата:</label>
                    <input type="text" name="date"/><br />

		    <label for="prim"><img src="../icon/ui-accordion.png" /> Примечание:</label>
                    <textarea name="prim" cols="40" rows="3"></textarea>

		    <input id="action" type="hidden" name="id" value="<?php echo $_GET[id]?>"/>
		    <input id="add" type="hidden" name="action" value="add"/>
                   
                    <input id="subbutton" type="submit" name="submit" value="Сохранить"/>
                </fieldset>


            </form>
	</div>
    </body>
</html>
