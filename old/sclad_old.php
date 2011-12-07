<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
        <style type="text/css">

table {font-size:75%; border-collapse:collapse;
margin-right:0px;
margin-left:5%;
width:65%;
//border:1px black solid;
}

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
   .sale{border:none;}
</style>
        <title>Склад</title>
    </head>
    <body>

    <div class="menu">
<a href="?" id="ul" >Весь</a> <a href="sclad.php" id="ul" >Склад</a>
<br />
<a href="?mark=100&<?php echo "col=$_GET[col]&vid=$_GET[vid]&mass=$_GET[mass]&brak=$_GET[brak]"?>">Марка 100</a>
<a href="?mark=125&<?php echo "col=$_GET[col]&vid=$_GET[vid]&mass=$_GET[mass]&brak=$_GET[brak]"?>">Марка 125</a>
<a href="?mark=150&<?php echo "col=$_GET[col]&vid=$_GET[vid]&mass=$_GET[mass]&brak=$_GET[brak]"?>">Марка 150</a>
<a href="?mark=175&<?php echo "col=$_GET[col]&vid=$_GET[vid]&mass=$_GET[mass]&brak=$_GET[brak]"?>">Марка 175</a>
<a href="?mark=200&<?php echo "col=$_GET[col]&vid=$_GET[vid]&mass=$_GET[mass]&brak=$_GET[brak]"?>">Марка 200</a>
<br />
<a href="?mark=<?php echo $_GET[mark];?>&col=Красный<?php echo "&vid=$_GET[vid]&mass=$_GET[mass]&brak=$_GET[brak]";?>">Красный</a>
<a href="?mark=<?php echo $_GET[mark];?>&col=Желтый<?php echo "&vid=$_GET[vid]&mass=$_GET[mass]&brak=$_GET[brak]";?>">Желтый</a>
<a href="?mark=<?php echo $_GET[mark];?>&col=Светлый<?php echo "&vid=$_GET[vid]&mass=$_GET[mass]&brak=$_GET[brak]";?>">Светлый</a>
<a href="?mark=<?php echo $_GET[mark];?>&col=Коричневый<?php echo "&vid=$_GET[vid]&mass=$_GET[mass]&brak=$_GET[brak]";?>">Коричневый</a>
<br />
<a href="?mark=<?php echo "$_GET[mark]&col=$_GET[col]&"?>vid=Строительный<?php echo "&mass=$_GET[mass]&brak=$_GET[brak]";?>">Строительный</a>
<a href="?mark=<?php echo "$_GET[mark]&col=$_GET[col]&"?>vid=Лицевой<?php echo "&mass=$_GET[mass]&brak=$_GET[brak]";?>">Лицевой</a>
<br />
<a href="?mark=<?php echo "$_GET[mark]&col=$_GET[col]&vid=$_GET[vid]&";?>mass=1<?php echo "&brak=$_GET[brak]";?>">Одинарный</a>
<a href="?mark=<?php echo "$_GET[mark]&col=$_GET[col]&vid=$_GET[vid]&";?>mass=1.4<?php echo "&brak=$_GET[brak]";?>"><b>Утолщенный</b></a>


    </div>
<?php
mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);

#$q = mysql_query("select tovar.id,tovar.prim,tovar.mark,tovar.color,tovar.mas,tovar.vid,tovar.tip,sclad.tovar,sclad.total,sclad.date from tovar inner join sclad on ((sclad.tovar = tovar.id)AND(sclad.date=CURDATE()))");
$q = mysql_query("select tovar.prim,tovar.color,tovar.mark,tovar.mas,tovar.vid,tovar.tip,er.total,er.tovar from tovar inner join (select tovar,(total+delta) as total,delta,sclad.date,pok,prim from sclad left join jurnal on sclad.id=jurnal.tov) AS er on tovar.id=er.tovar");
for ($w=1;$w<=200;$w++){
$r=rand(0,1230);$u=rand(0,1230);
#mysql_query("INSERT INTO  `disp`.`sclad` (`id` ,`begin` ,`today`)VALUES ('$w',  '$r',  '$u')");
#echo rand(-1234,123) ;
}
?>
<table>
    <caption>Склад</caption>
<tr>
<th>№</th><th>Имя</th><th></th><th>Марка</th><th>Date</th><th>Сегодня</th>
</tr>
<?php
while($row=mysql_fetch_assoc($q))
{
$j++;
if (($row[mark] != $_GET["mark"]) && ($_GET["mark"]!="")) continue;
if (($row[mas] != $_GET["mass"]) && ($_GET["mass"]!="")) continue;
if (($row[tip] != $_GET["tip"]) && ($_GET["tip"]!="")) continue;
if (($row[color] != $_GET["col"]) && ($_GET["col"]!="")) continue;
if (($row[vid] != $_GET["vid"]) && ($_GET["vid"]!="")) continue;
echo "<TR marka=\"$row[mark]\" vid=\"$row[vid]\" mass=\"$row[mas]\"  color=\"$row[color]\"><td>$j</td><td >$row[prim]</td><td class=\"sale\"><a href=\"sale.php?id=$row[tovar]\">sale</a></td><td>$row[mark]</td><td>$row[date]</td><td>$row[total]</td></TR>";
}
        ?>
</table>
    </body>
</html>
