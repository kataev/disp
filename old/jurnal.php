<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="datepicker/jquery.datepick.js"></script>
	<script type="text/javascript" src="datepicker/datepicker/jquery.datepick-ru.js"></script>
        <title></title>
        
        <style type="text/css">
@import "datepicker/jquery.datepick.css";
table {font-size:75%; border-collapse:collapse;
margin-right:0px;
margin-left:5%;
width:65%;
//border:1px black solid;
}
a{color:black; border:1px solid black;}
td{border:1px solid black; font-size:110%; }
caption {text-decoration:underline; font-weight:bold; font-size:150%;}
.di {font-style:italic ; color:olive;}
.menu {
        position:absolute;
        top:70px;
        right:0px;
        width:30%;
    }
    table{border-bottom-width:12px;}
   tr[color="Красный"]{background-color:Indianred;}
   tr[color="Желтый"]{background-color:Peachpuff;}
   tr[color="Коричневый"]{background-color:Tan; }
   tr[color="Светлый"]{background-color:Seashell; }
   tr:hover{background-color:Gainsboro;}
   tr[vid="Лицевой"]{font-style:italic;}
   tr[mass="1.4"]{font-weight:bold;}
   tr[marka="200"]{border-left-width:thin;}
</style>
    </head>
    <body>
<?php mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);

$q = mysql_query("SELECT tovar.prim,tovar.mark,tovar.mas,tovar.vid,tovar.color,jurnal.date,jurnal.time,jurnal.minus,jurnal.plus
		    FROM jurnal INNER JOIN tovar on tovar.id = jurnal.tov");

?>
        <a href="sclad.php">Sclad</a>
<table id='main'>
    <caption>Дневной Журнал</caption>
<thead><tr>
<th>№</th><th>Имя</th><th>Марка</th><th>Date</th><th>Time</th><th>Delta</th><th>Delta</th>
    </tr></thead><tbody>
<?php
while($row=mysql_fetch_assoc($q))
{
if (($row[mark] != $_GET["mark"]) && ($_GET["mark"]!="")) continue;
if (($row[mas] != $_GET["mass"]) && ($_GET["mass"]!="")) continue;
if (($row[tip] != $_GET["tip"]) && ($_GET["tip"]!="")) continue;
if (($row[color] != $_GET["col"]) && ($_GET["col"]!="")) continue;
if (($row[vid] != $_GET["vid"]) && ($_GET["vid"]!="")) continue;
echo "<TR marka=\"$row[mark]\" vid=\"$row[vid]\" mass=\"$row[mas]\"  color=\"$row[color]\"><td>$j</td><td>$row[prim]</td><td>$row[mark]</td><td>$row[date]</td><td>$row[time]</td><td>$row[minus]</td><td>$row[plus]</td></TR>";
}
        ?>
</tbody>
</table>
    </body>
</html>
