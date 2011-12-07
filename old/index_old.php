<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>DISP</title>
<script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
<style type="text/css">

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
<script type="text/javascript">
       $('#b1').click(function(){
           $('.di').removeClass('di');
        });
</script>
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
<table>
    <caption>Ассортимент</caption><thead>
<tr>
<th>№</th><th>Имя</th><th>Марка</th><th>Брак</th>
</tr></thead><tbody>
<?php
#print_r (array_keys($_GET));
#echo __FILE__;
mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);
$q =mysql_query("SELECT * FROM tovar");
$i=0;
while ($i != mysql_num_rows($q))
{
$di="";
#$k = mysql_result($q,$i,"id");
$n = mysql_result($q,$i,"prim");
$m = mysql_result($q,$i,"mark");
$col = mysql_result($q,$i,"color");
$v = mysql_result($q,$i,"vid");
$tip = mysql_result($q,$i,"tip");
$t = mysql_result($q,$i,"mas");
if ($t>1) $di="di";

$brak = mysql_result($q,$i,"brak");
$i++;
if (($m != $_GET["mark"]) && ($_GET["mark"]!="")) continue;
if (($t != $_GET["mass"]) && ($_GET["mass"]!="")) continue;
if (($tip != $_GET["tip"]) && ($_GET["tip"]!="")) continue;
if (($col != $_GET["col"]) && ($_GET["col"]!="")) continue;
if (($v != $_GET["vid"]) && ($_GET["vid"]!="")) continue;
if (($brak != $_GET["brak"]) && ($_GET["brak"]!="")) continue;

$j++;
echo "<TR marka=\"$m\" vid=\"$v\" mass=\"$t\"  color=\"$col\"><td>$j</td><td>$n</td><td>$m</td><td>$brak</td></TR>";
}





#printf("<a href=\"index.php?mark=%d&mass=%.1f&%s\">url</a>",$_GET["mark"],$_GET["mass"],$_GET["col"]);
mysql_close();
?>
    </tbody></table></body></html>
