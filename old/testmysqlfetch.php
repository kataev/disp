<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);
for($id=1;$id<=172;$id++){
$col=0;
$p = random(0,20000);
$q = mysql_query("INSERT INTO  `disp`.`jurnal` (
`id` ,
`tov` ,
`plus` ,
`minus` ,
`agent` ,
`date` ,
`time` ,
`prim`
)
VALUES (
NULL ,  '$id',  '$p',  '0',  '2', CURDATE( ) , CURTIME( ) ,  ''
);");
}

        ?>
    </body>
</html>
