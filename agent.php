<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="../icon/user.png">
	<link rel="stylesheet" href="style.css" type="text/css" />
        <title>КонтрАгенты</title>
    </head>
    <body>
        <?php

mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);
$date = date('Y-m-d');
$date1= $date;
$date=!isset($g_date)?$date:$g_date;
$date1=!isset($g_date1)?$date1:$g_date1;

$query = mysql_query("select * from agent");
        ?>
	<div>
	    <div id="header">
	<img id="logo" src="../logo+text.png" />
	<div id="name"><h1>КонтрАгенты<br />Черновой</h1> </div>

	</div>
	   <div id="links">
	    <?php require "menu.php";?>
	</div>
	</div>
	<table id="main">
	    <thead>
	    <tr>
	    <td>Имя</td>
	    <td>Инн</td>
	    <td>Адрес</td>
	    <td>Счет в банке</td>
	    <td>Телефон</td>
	    </tr>
	    </thead>
	    <tbody>
                  <?php while($row=mysql_fetch_assoc($query)){?>
		<tr>
		    <td><a href="agents.php?agent=<?php echo $row[id] ?>"><?php echo preg_replace('/\\\/','',$row[name])?></a></td>
		    <td><?php echo $row[inn]?></td>
		    <td><?php echo $row[address]?></td>
		    <td title="<?php echo preg_replace('/\\\/','',$row[bank]) ?>"><?php echo $row[schet]?></td>
		    <td><?php echo $row[phone]?></td>
		</tr>

		<?php } ?>
	    </tbody>
	</table>
    </body>
</html>
