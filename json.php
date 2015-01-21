<?php
header('Content-Type: application/json; codepage=utf-8');

mysql_connect('localhost','disp','disp');
mysql_query('SET NAMES "utf8"');
mysql_select_db('disp');
$day = array("Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота");

if (isset($_GET['date']) && isset($_GET['date1']) && ($_GET['date']!=0))
{
    $date = "and date>='$_GET[date]' and date<='$_GET[date1]'";
}


if (isset($_GET['color']))
    {
    switch ($_GET['color']){
	case 0: $g_color="";	break;
	case 1: $g_color=" and color=\"Красный\"";	break;
	case 2: $g_color=" and color=\"Желтый\"";	break;
	case 3: $g_color=" and color=\"Коричневый\"";	break;
	case 4: $g_color=" and color=\"Светлый\"";	break;
	case 5: $g_color=" and color=\"Белый  \"";	break;
	case 6: $g_color=" and color=\"КЕ\"";	break;

    }
    }
if (isset($_GET['mark']))
    {
    switch ($_GET['mark']){
	case 100: $g_mark=" and mark=100";	break;
	case 125: $g_mark=" and mark=125";	break;
	case 150: $g_mark=" and mark=150";	break;
	case 175: $g_mark=" and mark=175";	break;
	case 200: $g_mark=" and mark=200";	break;
	case 250: $g_mark=" and mark=250";	break;
    }
    }
if (isset($_GET['vid']))
    {
    switch ($_GET['vid']){
	case 1: $g_vid=" and vid=\"Лицевой\"";	break;
	case 2: $g_vid=" and vid=\"Строительный\"";	break;
    }
    }
if (isset($_GET['mas']))
    {
    switch ($_GET['mas']){
	case 1: $g_mas=" and mas=\"Одинарный\"";	break;
	case 2: $g_mas=" and mas=\"Полуторный\"";	break;
    }
    }

switch ($_GET['oper']){
 case total: 
     $q = "select $g_sort as name,SUM(total) as data from sclad,tovar
     where tovar.id=sclad.id $g_color $g_vid $g_mark $g_mas
     group by $_GET[sort]
     ORDER BY color DESC";
     break;
 case add:
     $q = "select $g_sort as name,SUM(plus) as data from jurnal,tovar 
     where tovar.id=jurnal.tov and plus>0 $g_color $g_vid $g_mark $g_mas $date
     group by $_GET[sort]
     ORDER BY color DESC";
     break;
 case minus:
     $q = "select $g_sort as name,SUM(minus) as data from jurnal,tovar 
     where tovar.id=jurnal.tov and minus>0 $g_color $g_vid $g_mark $g_mas $date
     group by $_GET[sort] ORDER BY color DESC";
     break;
 case minusbyday:
     $q = "select SUM(minus) as data,DAYOFWEEK(date) as name from jurnal
	 group by DAYOFWEEK(date);";
     break;
 case plusbyday:
     $q = "select SUM(plus) as data,DAYOFWEEK(date) as name from jurnal
	 group by DAYOFWEEK(date);";
     break;
}
//echo $q;
$query = mysql_query($q);
echo "[";
while($row=mysql_fetch_assoc($query)){
    if ($g_oper=="minusbyday" or $g_oper=="plusbyday"){
	$row['name'] = $day[$row['name']-1];
    }
++$i;
if (mysql_num_rows($query)!=$i){
echo "[\"".$row[name]."\",".$row['data']."],";} else {echo "[\"".$row[name]."\",".$row['data']."]";}
}
?>
]
