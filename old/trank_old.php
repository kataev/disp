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
mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);
$date=!isset($_GET[date])?$date:date('Y-m-d');

mysql_query("INSERT INTO `disp`.`jurnal` (`tov`, `makt`,`poddon`,`akt`,`date`, `time`, `prim`)
        VALUES ('$_GET[from]]', '$_GET[kirp]','$_GET[poddon]','$_GET[akt]','$date', CURTIME(), '$_GET[prim]'); ");

mysql_query("UPDATE  `disp`.`sclad` SET  `total` =  sclad.total-$_GET[kirp] WHERE  `sclad`.`id` =$_GET[from] LIMIT 1 ;");

mysql_query("INSERT INTO `disp`.`jurnal` (`tov`, `pakt`,`poddon`,`akt`,`date`, `time`, `prim`)
        VALUES ('$_GET[to]]', '$_GET[kirp]','$_GET[poddon]','$_GET[akt]', '$date', CURTIME(), '$_GET[prim]'); ");

mysql_query("UPDATE  `disp`.`sclad` SET  `total` =  sclad.total+$_GET[kirp] WHERE  `sclad`.`id` =$_GET[to] LIMIT 1 ;");
//mysql_query("UPDATE  `disp`.`sclad` SET  `total` =  sclad.total-$_GET[minus] WHERE  `sclad`.`id` =$_GET[id] LIMIT 1 ;");



?>

    </body>
</html>
