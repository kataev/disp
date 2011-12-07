<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="refresh" content="0; url=sclad.php">
        <title></title>
    </head>
    <body>
        <?php
import_request_variables('GP', 'g_');
mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);

$date=!isset($q_date)?$date:date('Y-m-d');
if ($_GET[request]=='УДАЛИТЬ'){
$q = mysql_query("SELECT id,minus,plus FROM jurnal where id=$_GET[id]");
$q = mysql_fetch_assoc($q);
echo $q[id],$q[minus],$q[$plus];
mysql_query("UPDATE  `disp`.`sclad` SET  `total` =  sclad.total+$q[minus] WHERE  `sclad`.`id` =$q[id] LIMIT 1 ;");
mysql_query("UPDATE  `disp`.`jurnal` SET  jurnal.minus =  0 and jurnal.plus=0 WHERE `jurnal`.`id` =$q[id] LIMIT 1 ;");
echo 'Удалено';}
else {echo "Ошибка: Вводите УДАЛИТЬ в поле проверки";}
#mysql_query("INSERT INTO `disp`.`jurnal` (`tov`, `minus`,`poddon`,`agent`,`nakl`,`date`, `time`, `prim`) 
#        VALUES ('$_GET[id]]', '$_GET[minus]','$_GET[poddon]','$_GET[agent]','$_GET[nakl]','$date', CURTIME(), '$_GET[prim]');
#        
#        ");


?>

    </body>
</html>
