<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Журнал</title>
<link rel="shortcut icon" href="../icon/luggage.png">
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
                        <li id="cancell">Отмена</li>
			<li id="clear">Сбр фил</li>
                    </ul>

		    </div>

        </div>
		<div id="links">
	    <ul>
		<a href="index.php" title="Журнал"><li><img src="../icon/luggage.png"/></li></a>
		<a href="sclad.php" title="Склад" ><li><img src="../icon/address-book-blue.png"/></li></a>
		<a href="agentadd.php" title="Добавление КонтрАгента" ><li><img src="../icon/user-green.png"/></li></a>
		
		<a href="tovar.php" title="Изменение продукции" ><li><img src="../icon/cutter.png"/></li></a>

		<a href="diagram.php?action=minus&data=color#" title="Круговые диаграммы" ><li><img src="../icon/chart-pie-separate.png"/></li></a>

	    </ul>
	</div>
	</div>
<?php

$date = date('Y-m-d');
$date1= $date;
$date=!isset($g_date)?$date:$g_date;
$date1=!isset($g_date1)?$date1:$g_date1;
$day = array("Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота");
$mou = array("Января","Февраля","Марта","Апреля","Мая","Июня","Июля","Августа","Сентября","Октября","Ноября","Декабря");

mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);
$query = mysql_query("select jurnal.id,tovar.prim,jurnal.prim as pr,nakl,tov,minus,plus,akt,poddon,jurnal.agent as agid,agent.name as agent,pakt,makt,date,time,color,mas,vid,tip, workshop as pws,mws,money
	    from jurnal
	    left join tovar on tovar.id=jurnal.tov
	    left join agent on jurnal.agent=agent.id
	    ORDER BY DATE DESC,TIME DESC,NAKL
");
//$query = mysql_query("SELECT jurnal.id,tovar.prim,jurnal.prim as pr,tov,minus,plus,akt,poddon,agent.name as agent,pakt,makt,date,time,color,mas,vid,tip
//    FROM jurnal,tovar,agent
//    WHERE month(date)=MONTH(CURDATE()) and tov=tovar.id or jurnal.agent=agent.id
//
//    ORDER BY DATE DESC,TIME DESC ");

?>
        <table id="main" class="jurnal"><caption></caption>
            <thead>
		<tr>
		    <th>#</th>
		    <th>Продукция</th>
		    <th>Кол-во</th>
		    <th>Тара</th>
		    <th>Стои<br />мость</th>
		    
		   
		    

		</tr>
                </thead>

                <tbody>
                  <?php while($row=mysql_fetch_assoc($query)){
		      if ($row[date]!=$date_t) {
			  ?>
		<tr>
		<td colspan="7" class="date" ><?php if ($date==$row[date]) {echo "<b>Сегондя</b> ";}; echo $day[date("w",strtotime($row[date]))]," ",date("d",strtotime($row[date]))," ",$mou[date("n",strtotime($row[date]))-1]," ",date("Y",strtotime($row[date])) ?></td>
		</tr>
		<?php };
		$date_t = $row[date];
		if ($row[akt]!=0)   {$act="akt";}
		if ($row[plus]>0)   {$act="plus";}
		if ($row[minus]>0)  {$act="minus";}
		if ($row[mws]>0)    {$act="mws";}
		if ($row[pws]>0)    {$act="pws";}

		$pic["akt"]="../icon/arrow-split.png";
		$pic["plus"]="../icon/box--plus.png";
		$pic["minus"]="../icon/truck--plus.png";
		$pic["mws"]="../icon/wall-break.png";
		$pic["pws"]="../icon/wall--arrow.png";
		switch ($act) {
//akt----------------------------------------
    case akt: ?>
<!--Акт на перевод-->
<tr jur="<?php echo $row[id] ?>" action="transfer"  class="transfer <?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]"); ?>">
    <td rowspan=2><img src="<?php echo $pic[$act]?>"/></td>
    <td><?php echo $row[prim]; ?>
        <span id="agent"><a href="agents.php?agent=<?php echo $row[agid] ?>"><?php echo $row[agent] ?></a></span>
	<span id="pr"><?php echo $row[pr] ?></span></td>
    <td rowspan=2><?php echo $row[makt] ?></td>
    <td rowspan=2 ><?php echo $row[poddon];?></td><td rowspan=2  ></td>
</tr>
<?php $row=mysql_fetch_assoc($query) ?>
<tr jur="<?php echo $row[id] ?>" action="transfer"  class="transfer <?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]"); ?>">
    <td><?php echo $row[prim]; ?></td>
</tr>
		    
<?php break;

//plus----------------------------------------
    case plus: ?>
<!--Добавление на склад-->
<tr jur="<?php echo $row[id] ?>" action="add" class="add <?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]"); ?>">
    <td><img src="<?php echo $pic[$act]?>"/></td>
    <td><?php echo $row[prim]; ?>
        <span id="add">Принято с производства</span>
	<span id="pr"><?php echo $row[pr] ?></span></td>
    <td><?php echo $row[plus] ?></td>
    <td colspan="1"><?php echo $row[pr] ?></td><td></td>
</tr>
<?php break;

//minus----------------------------------------
    case minus: ?>
<!--Отгрузка-->
<tr jur="<?php echo $row[id] ?>" action="sold" class="sold <?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]"); ?>">
    <td><img src="<?php echo $pic[$act]?>"/></td>
    <td><?php echo $row[prim]; ?>
	<span id="agent"><a href="agents.php?agent=<?php echo $row[agid] ?>"><?php echo preg_replace('/\\\/','',$row[agent]); ?></a></span>
	<span id="pr"><?php echo $row[pr]?></span> <span id="nakl"><?php echo $row[nakl] ?></span></td>
    <td><?php echo $row[minus] ?></td>
    <td><?php echo $row[poddon] ?></td>
    <td><?php echo $row[money] ?></td>
</tr>
<?php break;

//ws----------------------------------------
    case mws: ?>
<!--Выдача в цех-->
<tr jur="<?php echo $row[id] ?>" action="mws" class="mws <?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]"); ?>">
    <td><img src="<?php echo $pic[$act]?>"/></td>
    <td><?php echo $row[prim]; ?>
	<span id="mws">Выдано в цех</span>
	<span id="pr"><?php echo $row[pr]?></span> <span id="nakl"><?php echo $row[nakl] ?></span></td>
    <td><?php echo $row[mws] ?></td>
    <td colspan="1"><?php echo $row[poddon] ?></td><td></td>
</tr>
<?php
    break;
    case pws: ?>
<!--Получение из цеха-->
<tr jur="<?php echo $row[id] ?>" action="pws" class="pws <?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]"); ?>">
    <td><img src="<?php echo $pic[$act]?>"/></td>
    <td ><?php echo $row[prim]; ?>
	<span id="pws">Принято на склад из цеха</span>
	<span id="pr"><?php echo $row[pr]?></span> <span id="nakl"><?php echo $row[nakl] ?></span></td>
    <td><?php echo $row[pws] ?></td>
    <td colspan="1"><?php echo $row[poddon] ?></td><td></td>
</tr>
<?php
    break;

//End case, end fetch----------------------------------------
		}} ?>
                </tbody>
                <tfoot>
                   

                </tfoot>
        </table>
   


    
    </body>
</html>
