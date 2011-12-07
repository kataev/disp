<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Товар</title>
        <link rel="shortcut icon" href="../icon/cutter.png">
        <link rel="stylesheet" href="datepicker/jquery.datepick.css" type="text/css" />
         <link rel="stylesheet" href="style.css" type="text/css" />

         <script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
         <script type="text/javascript" src="datepicker/jquery.datepick.js"></script>
		 <script type="text/javascript" src="datepicker/jquery.datepick-ru.js"></script>
		 <script type="text/javascript" src="scrips.js"></script>


    </head>
    <body>
               
	<div id="header">
	<img id="logo" src="../logo+text.png" />
	<div id="name"><h1>Склад</h1> </div>
		<div id="menu">
		    <div>
	    <ul id="color">
                <li id="Красный" title="Красный"></li>
                <li id="Желтый" title="Желтый"></li>
                <li id="Коричневый" title="Коричневый"></li>
                <li id="Светлый" title="Светлый"></li>
                <li id="Белый" title="Белый"></li>
                <li id="КЕ" title="КЕ"></li>

            </ul>


            <ul id="mark">
                <li id="100">100</li>
                <li id="125">125</li>
                <li id="150">150</li>
                <li id="175">175</li>
                <li id="200">200</li>
                <li id="250">250</li>

            </ul>
		<ul id="vid">
                <li id="Лицевой">Лицевой</li>
                <li id="Строительный">Рядовой</li>
                </ul>
		    </div>
		    <div>
        <ul id="tip">
                <li id="1">Тип 1</li>
                <li id="2">Тип 2</li>
                <li id="3">Тип 3</li>

            </ul>

            <ul id="mas">
                <li id="Одинарный">Одинарный</li>
                <li id="Полуторный">Утолщенный</li>

           </ul>
                    <ul>
                     
			<li id="clear">Сбр фил</li>
                        <li id="add"><a href="edit.php">Доб товара</a></li>
                    </ul>

		    </div>

        </div>
		<div id="links">
	    <?php require "menu.php";?>
	</div>
	</div>
        <?php
import_request_variables('GP', 'g_');
mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);
$date = date('Y-m-d');
$date1= $date;
$date=!isset($g_date)?$date:$g_date;
$date1=!isset($g_date1)?$date1:$g_date1;

function r_ye($n,$s){
    if ($s=='Полуторный')
        return round($n*1.35);
    else
        return $n;
};

$query = mysql_query("select tovar.id,tovar.prim as name,color,mas,vid,tip,mark,total from tovar,sclad where sclad.id=tovar.id");
        ?>
       <table id='main'>
            <thead>
                <tr>
                    <th>#</th>
		    <th>Продукция</th>
		    <th>Марка</th>
		    <th>Цвет</th>
		    <th>Толщина</th>
		    <th>Вид</th>
		    <th>Тип</th>
		    <th>Остаток</th>
		    <th></th>
                </tr>


                </thead>

                <tbody>
                  <?php while($row=mysql_fetch_assoc($query)){?>
                    <tr id="<?php echo $row[id] ?>" color="<?php echo $row[color];?>" mas="<?php echo $row[mas];?>"
                            mark="<?php echo $row[mark];?>"
                    class="<?php $zero=""; if (!($row[begin]||$row[total])) {$zero = "zero";}
                            printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color] $zero") ;?>">
			<td><?php echo $row[id];?></td>
                        <td><?php echo $row[name];?></td>
			<td><?php echo $row[mark];?></td>
			<td><?php echo $row[color];?></td>
			<td><?php echo $row[mas];?></td>
			<td><?php echo $row[vid];?></td>
			<td><?php echo $row[tip];?></td>
			<td><?php echo $row[total];?></td>
			<td>
			<a href='edit.php?id=<?php echo $row[id];?>'><img src="../icon/book--pencil.png" /></a>
			<a href='debit.php?id=<?php echo $row[id];?>'><img src="../icon/folder-broken.png" /></a>
			</td>

                        

                </tr>
                <?php }?>
                </tbody>
                <tfoot>
                    </tfoot>
        </table>


    </body>
</html>
