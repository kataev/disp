<?php
header('Content-Type: application/json; codepage=utf-8');

mysql_connect('localhost','disp','disp');
mysql_query('SET NAMES "utf8"');
mysql_select_db('disp');


$g_month=isset($_GET['month'])?$_GET['month']:date('m');
$g_year=isset($_GET['year'])?$_GET['year']:date('Y');
//echo $g_month,$g_year;
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

echo "{";

switch ($_GET['oper']){
//AGENT
    case agent:

$g_agent = "select agent.id,agent.name from agent,jurnal where jurnal.agent=agent.id and month(date)=$g_month and year(date)=$g_year";
$qe_color = mysql_query($g_agent);
echo "\"names\":[";
while ($col = mysql_fetch_assoc($qe_color)){
if (++$q!=mysql_num_rows($qe_color))
    {echo "\"".$col[name]."\",";} else
    {echo "\"".$col[name]."\"";}
    
}
echo "],";
$qe_color = mysql_query($g_agent);
while ($col = mysql_fetch_assoc($qe_color)){
$q = "select id,IFNULL(data,0) as data,date
    from sclad
    left join (select ROUND(sum(jurnal.price*minus),1) as data,day(date) as date from jurnal,tovar
where jurnal.agent=$col[id] and tovar.id=jurnal.tov and month(date)=$g_month and year(date)=$g_year
group by day(date)) as s on s.date=sclad.id limit 31 ";
//echo $q;
$query = mysql_query($q);

$i=0;
echo "\"a".++$f."\":[";
while($row=mysql_fetch_assoc($query)){
    $a+=$row['data'];
    if (++$i!=mysql_num_rows($query))
    {echo "[$row[id],".$row['data']."],";} else
    {echo "[$row[id],".$row['data']."]";}
}

echo "],\n";
}
break;
//COLOR
    case "color":
$q_color = "select color from tovar group by color";
$qe_color = mysql_query($q_color);
while ($col = mysql_fetch_assoc($qe_color)){

$q = "select id,IFNULL(data,0) as data,date
    from sclad
    left join (select ROUND(sum(jurnal.price*minus),1) as data,day(date) as date from jurnal,tovar
where color='$col[color]' and tovar.id=jurnal.tov and month(date)=$g_month and year(date)=$g_year
group by day(date)) as s on s.date=sclad.id limit 31
";
$query = mysql_query($q);
$i=0;
switch ($col['color']) {
    case "Белый  ":
	$color="white";
    break;
case Желтый:
    $color="yellow";
    ;
    break;
case КЕ:
    $color="ke";
    ;
    break;
case Коричневый:
    $color="brown";
    ;
    break;
case Красный:
    $color="red";
    ;
    break;
case Светлый:
    $color="light";
    ;
    break;

}

echo "\"$color\":[";
while($row=mysql_fetch_assoc($query)){
    $a+=$row['data'];
    if (++$i!=mysql_num_rows($query))
    {echo "[$row[id],".$row['data']."],";} else
    {echo "[$row[id],".$row['data']."]";}
}

echo "],\n";
}
break;
//IP!!!
 case "ip":
     $cp=0;
while ($cp<=1){

$q = "select id,IFNULL(data,0) as data,date
    from sclad
    left join (select ROUND(SUM(jurnal.price*minus),1) as data,cp,day(date) as date
    from jurnal,agent where agent.cp=$cp and agent.id=jurnal.agent group by day(date)
    ) as s on s.date=sclad.id limit 31
";
$cp++;
$query = mysql_query($q);
$i=0;

echo "\"a$cp\":[";
while($row=mysql_fetch_assoc($query)){
    $a+=$row['data'];
    if (++$i!=mysql_num_rows($query))
    {echo "[$row[id],".$row['data']."],";} else
    {echo "[$row[id],".$row['data']."]";}
}

echo "],\n";
}
break;
}//end switch
echo "\"total\" : $a";
echo "}";
?>
