<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="forms.css" type="text/css" />
	<script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
	<link rel="stylesheet" href="datepicker/jquery.datepick.css" type="text/css" />
        <script src="datepicker/jquery.validate.js" type="text/javascript"></script>
	<script type="text/javascript" src="datepicker/jquery.datepick.js"></script>
	<script type="text/javascript" src="datepicker/jquery.datepick-ru.js"></script>
        <title>Списание и некондиция</title>
	<link rel="shortcut icon" href="../icon/wall-break.png">
        <script type="text/javascript">
        $(document).ready(function(){
	$('input[name="date"]').datepick({dateFormat: 'yy-mm-dd'});
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
        <div>
	    <div id="h" >
            <h1>Списание и прочие странности</h1>
	    <h2><?php echo $row[name]?></h2>
	    <a href="tovar.php"><img src="../icon/arrow-turn-180-left.png" />Назад</a>
	    </div>
            <form name="" action="action.php" method="GET">
            
            
            
                <fieldset id="workshop" class="<?php
                            $zero=""; if (!($row[begin]||$row[total])) {$zero = "zero";}
                            printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color] $zero") ?>">
		    <label for="action"><img src="../icon/folder-stamp.png" />Излишки</label>
		    <input type="radio" name="action" value="no_condition" /><br />
		    <label for="action"><img src="../icon/folder-broken.png" />Списание</label>
		    <input type="radio" name="action" value="debit" /><br />

                    <label for="shop"><img src="../icon/counter.png" /> Кол-во кирпича:</label>
                    <input max="<?php echo $row[total] ?>" type="text" name="minus"/><br />

                    <label for="poddon"><img src="../icon/store.png" /> Кол-во поддонов:</label>
                    <input type="text" name="poddon"/><br />

                    <label for="date"><img src="../icon/calendar.png" /> Дата:</label>
                    <input type="text" name="date"/><br />

		    <label for="prim"><img src="../icon/ui-accordion.png" /> Примечание:</label>
                    <textarea name="prim" cols="40" rows="3"></textarea>

                    <input type="submit" name="submit" value="Сохранить"/>
		    
                    <input id="subm" type="hidden" name="id" value="<?php echo $_GET[id] ?>"/>
		    
                    
                </fieldset>
            
            
            </form>
        </div>
    </body>
</html>
