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
        <title>Отмена операции</title>
        <script type="text/javascript">
        $(document).ready(function(){
        $("form").validate({
               rules : {
                       request : {required : true},

               },
               messages : {
                       request : {
                               required : "Чтобы удалить операцию введите УДАЛИТЬ",
                               
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
$query = mysql_query("  SELECT tovar.id as id,tovar.color,tovar.mark,tovar.vid,tovar.mas,tovar.prim as name,plus,minus,nakl,date,agent,poddon
                        FROM jurnal,tovar
                        WHERE jurnal.tov=tovar.id and jurnal.id=$_GET[id]");
$row = mysql_fetch_assoc($query);



?>
        <div id="shipping" >
            <h1>Отмена операции № <?php echo $_GET[id] ?> от <?php echo $row[date] ?></h1>
            <form name="Отмена операции" action="cancel.php" method="GET">
                <h2><?php echo $row[name]?></h2>
                <h3>Марка: <?php echo $row[mark]?>
                <?php echo $row[color]?>
                <?php echo $row[vid]," ",$row[mas];?><br />
                В кол-ве: <span class="warn"><?php echo $row[minus] ?></span> шт <span class="warn"><?php echo $row[poddon] ?></span> поддонов
                </h3>
                <fieldset id="shipping" class="<?php
                            $zero=""; if (!($row[begin]||$row[total])) {$zero = "zero";}
                            printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color] $zero") ?>">
                    <label for="request">Подтвержение введите "УДАЛИТЬ": </label>
                    <input type="text" name="request"/><br />

                    <input id="subm" type="hidden" name="id" value="<?php echo $_GET[id] ?>"/>
                    <a id="backbutton" href="jurnal.php">Назад</a>
                    <input id="subbutton" type="submit" name="submit" value="Удалить"/>
                </fieldset>


            </form>
        </div>
    </body>
</html>
