<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="../icon/arrow-split.png">
    <link rel="stylesheet" href="forms.css" type="text/css"/>
    <script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
    <script src="datepicker/jquery.validate.js" type="text/javascript"></script>
    <script type="text/javascript" src="datepicker/jquery.datepick.js"></script>
    <script type="text/javascript" src="datepicker/jquery.datepick-ru.js"></script>
    <title>Перевод кирпича</title>
    <script type="text/javascript">
        $(document).ready(function () {
            $('input[name="date"]').datepick({dateFormat: 'yy-mm-dd'});
            $('input[name="kirp"]').change(function () {

                if ($('fieldset').hasClass('Строительный') && $('#to').hasClass('Полуторный')) {
                    kirp_pod = 288;
                }
                if ($('fieldset').hasClass('Строительный') && $('#to').hasClass('Одинарный')) {
                    kirp_pod = 352;
                }
                if ($('fieldset').hasClass('Лицевой') && $('#to').hasClass('Полуторный')) {
                    kirp_pod = 192;
                }
                if ($('fieldset').hasClass('Лицевой') && $('#to').hasClass('Одинарный')) {
                    kirp_pod = 264;
                }


                var koll = $('input[name="kirp"]').attr('value') / kirp_pod;

                $('input[name="poddon"]').val(koll);
            })


        });
    </script>
</head>
<body>
<?php

mysql_connect('localhost', 'disp', 'disp');
mysql_query('SET NAMES "utf8"');
mysql_select_db('disp');
$query = mysql_query("  SELECT tovar.id as id,mark,vid,mas,tip,color,tovar.prim as name,total
                        FROM sclad,tovar
                        WHERE sclad.id=tovar.id and tovar.id=$_SERVER[from]");
$from = mysql_fetch_assoc($query);
$query = mysql_query("  SELECT tovar.id as id,mark,vid,mas,tip,color,tovar.prim as name,total
                        FROM sclad,tovar
                        WHERE sclad.id=tovar.id and tovar.id=$_SERVER[to]");
$to = mysql_fetch_assoc($query);
$query = mysql_query("  select MAX(akt)+1 as max from jurnal");
$akt = mysql_fetch_assoc($query);

?>
<div>
    <div id="h">
        <h1>Перевод кирпича</h1>

        <h2><?php echo $from['name'] ?></h2>

        <h2><?php echo $to['name'] ?></h2>
        <a href="sclad.php"><img src="../icon/arrow-turn-180-left.png"/>Назад</a>
    </div>
    <form name="Перевод" action="action.php" method="GET">
        <fieldset id="transfer" class="<?php
        $zero = "";
        if (!($row['begin'] || $row['total'])) {
            $zero = "zero";
        }
        printf("$to[mark] $to[mas] $to[vid] $to[tip] $to[color] $zero") ?>">
            <label for="kirp"><img src="../icon/counter.png"/> Кол-во кирпича:</label>
            <input max="<?php echo $from['total'] ?>" type="text" name="kirp"/><br/>

            <label for="poddon"><img src="../icon/store.png"/> Кол-во поддонов:</label>
            <input type="text" name="poddon"/><br/>

            <label for="date"><img src="../icon/calendar.png"/> Дата:</label>
            <input type="text" name="date"/><br/>

            <label for="prim"><img src="../icon/ui-accordion.png"/> Примечание:</label>
            <textarea name="prim" cols="40" rows="3"></textarea>

            <input id="subm" type="hidden" name="akt" value="<?php echo $akt['max'] ?>"/>
            <input id="subm" type="hidden" name="from" value="<?php echo $_SERVER['from'] ?>"/>
            <input id="subm" type="hidden" name="to" value="<?php echo $_SERVER['to'] ?>"/>
            <input id="subm" type="hidden" name="action" value="transfer"/>

            <input id="subbutton" type="submit" name="submit" value="Перевести"/>
        </fieldset>


    </form>
</div>
</body>
</html>
