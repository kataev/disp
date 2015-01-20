<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="../icon/user-green.png">
        <link rel="stylesheet" href="style.css" type="text/css" />
                 <script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
         <script type="text/javascript" src="datepicker/jquery.datepick.js"></script>
		 <script type="text/javascript" src="datepicker/jquery.datepick-ru.js"></script>
		 <script type="text/javascript" src="scrips.js"></script>

        <title>Просмотр операций от контрагентов</title>

	<style type="text/css">
	    tr.end {
		height: 25px;
		vertical-align: top;
		background-color:lightblue;

		font-style: italic;
		text-decoration: underline;
		
		
}
	</style>

    </head>
    <body>
        <?php


$date = date('Y-m-d');
$date1= $date;
$date=!isset($g_date)?$date:$g_date;
$date1=!isset($g_date1)?$date1:$g_date1;
$day = array("Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота");
$mou = array("Января","Февраля","Марта","Апреля","Мая","Июня","Июля","Августа","Сентября","Октября","Ноября","Декабря");

mysql_connect('localhost','disp','disp');
mysql_query('SET NAMES "utf8"');
mysql_select_db('disp');

$agent=mysql_query("SELECT * FROM agent where id=$_SERVER[agent]");
$ag=mysql_fetch_assoc($agent);



?>
<div id="header">
	<img id="logo" src="../logo+text.png" />
	<div id="name"><h1>Операции</h1>
	    
		<a href="agents.php?agent=<?php echo $g_agent ?>&group=date">Дата</a>
		<a href="agents.php?agent=<?php echo $g_agent ?>&group=kirp">Кирпич</a>
	    
	</div>
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
                        <li id ="agent"><form name="agents" action="agents.php" method="GET">
	<select name="agent">
			<?php
			
			$agent = mysql_query("SELECT id,name from agent");
			while($ag=mysql_fetch_assoc($agent)){
			?>
			<option value="<?php echo $ag['id']; ?>"><?php echo $ag['name']; ?></option>

			<?php };?>
		    </select>
	<input type="hidden" name="group" value="kirp"/>
	<input type="submit" name="submit" value="OK"/>
	
	
    </form></li>
                    </ul>

		    </div>

        </div>

		<div id="links">
	    <?php require "menu.php";?>
	</div>
	</div>
    
    
    <table id="agents">
	<thead>
	    <tr>
	<th>#</th>
	<th>Продукция</th>
	<th>Водитель</th>
	<th>Кол-во</th>
	<th>Тара</th>
	<th>Деньги</th>
	
	

	    </tr>
	</thead>

	<tbody>

		
	    <?php
	    switch ($g_group) {
		case 'date':
		//SORTIROVKA PO DATE
	$q=mysql_query("SELECT jurnal.id as id,tovar.prim as name,color,mark,vid,tip,mas,jurnal.prim as agent,ROUND(jurnal.price*jurnal.minus) as money,date,time,nakl,minus,poddon
		FROM jurnal,tovar
		where agent=$g_agent and tovar.id=jurnal.tov ORDER BY date DESC ");// group by tovar.prim
	while($row=mysql_fetch_assoc($q)){
	    
	    if ($row['date']!=$date_t) {
		if ($i>0){ ?><tr class="end"><td colspan="3" style="text-align: right;" >Всего за день отгруженно:</td>
		    <td><?php echo $minus ?></td>
		    <td><?php echo $poddon ?></td>
		    <td><?php echo $money ?></td> </tr><?php
		$minus=0; $poddon=0;$money=0;
		}
			  ?>
			<tr>
		<td colspan="6" class="date" ><?php if ($date==$row['date']) {echo "<b>Сегондя</b> ";}; echo $day[date("w",strtotime($row['date']))]," ",date("d",strtotime($row['date']))," ",$mou[date("n",strtotime($row['date']))-1]," ",date("Y",strtotime($row['date']));

		?></td>
		</tr>
	<?php }
	?>
	    <tr jur="<?php echo $row['id'] ?>"
            class="<?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]") ;?>">
		<td><?php echo ++$i; ?></td>
	    	<td><?php echo $row['name'];?><span id="pr"><?php echo $row['nakl'];?></span><a title="Просмотр операции" href="operation.php?id=<?php echo $row['id'] ?>"><img src="../icon/truck--plus.png"/></a></td>
		<td><?php echo $row['agent'];?></td>
		<td><?php echo $row['minus'];  $minus+=$row['minus'];?></td>
		<td><?php echo $row['poddon']; $poddon+=$row['poddon']?></td>
		<td><?php printf("%.1f",$row['money']); $money+=$row['money']?></td>
	    </tr>
	    <?php $date_t = $row['date']; }
	    ?><tr class="end"><td colspan="3" style="text-align: right;" >Всего за день отгруженно:</td>
		    <td><?php echo $minus ?></td>
		    <td><?php echo $poddon ?></td>
		    <td><?php echo $money ?></td> </tr><?php 
	break;
	case 'kirp':
		$q=mysql_query("SELECT tovar.prim as name,color,mark,vid,tip,mas,
			jurnal.prim as agent,ROUND(jurnal.price*jurnal.minus) as money,
			date,time,nakl,minus as minus,poddon as poddon
		FROM jurnal,tovar
		where agent=$g_agent and tovar.id=jurnal.tov ORDER BY tovar.prim DESC,date ");// group by tovar.prim
	while($row=mysql_fetch_assoc($q)){
	     if ($row['name']!=$name) {
	    if ($i>0){ ?><tr class="end"><td colspan="3" style="text-align: right;" >Всего отгруженно:</td>
		    <td><?php echo $minus ?></td>
		    <td><?php echo $poddon ?></td>
		    <td><?php echo $money ?></td> </tr><?php
		$minus=0; $poddon=0;$money=0;
		}}
			  
	    	?>
	    <tr jur="<?php echo $row['id'] ?>"
            class="<?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]") ;?>">
		<td><?php echo ++$i; ?></td>
		<td><?php echo $row['name'];?><span id="pr"><?php echo $row['nakl'];?></span> <span id="pr"><?php echo $row['agent'];?></span></td>
		<td><?php echo date("d",strtotime($row['date']))," ",$mou[date("n",strtotime($row['date']))-1]," ",date("Y",strtotime($row['date']))?></td>
		<td><?php echo $row['minus'];  $minus+=$row['minus'];?></td>
		<td><?php echo $row['poddon']; $poddon+=$row['poddon']?></td>
		<td><?php echo $row['money']; $money+=$row['money']?></td>
    </tr>
<?php	$name = $row['name']; };
?><tr class="end"><td colspan="3" style="text-align: right;" >Всего отгруженно:</td>
		    <td><?php echo $minus ?></td>
		    <td><?php echo $poddon ?></td>
		    <td><?php echo $money ?></td> </tr><?php
		break;
		};
	    ?>

	</tbody>

    </table>
	
	
    </body>
</html>
