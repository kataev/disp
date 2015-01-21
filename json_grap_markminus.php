<?php
header('Content-Type: application/json; codepage=utf-8');

mysql_connect('localhost','disp','disp');
mysql_query('SET NAMES "utf8"');
mysql_select_db('disp');
$day = array("Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота");

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



switch ($_GET['oper']){
 case markmonth:
     
     break;

}
echo "{";
$mark=100;
while ($mark<=250){
echo "\"a".$mark."\":[";
$q = "select id,IFNULL(data,0) as data
    from ind
    left join (
    select month(date) as date,SUM($_GET[oper]) as data
    from jurnal,tovar
    where tovar.id=jurnal.tov
    and date>'2010-11-01'
    and mark=$mark $g_color
    group by month(date))
    as s on s.date=ind.id;";
$query = mysql_query($q);
$i=0;
while($row=mysql_fetch_assoc($query)){
//    echo $row[date];

    if ($i++!=11)
    {echo $row[data].",";} else
    {echo $row[data];}

}

if ($mark==200) {$mark+=25;}
$mark+=25;
if ($mark==275) {echo "]\n";}
else {echo "],\n";}
}
echo "}";
?>
