<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Склад - остатки</title>
        <link rel="shortcut icon" href="../icon/address-book-blue.png">
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
                <li id="КЕ" title="Прочее"></li>

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
                        <li id="zero">Пустые</li>
			<li id="percent">&plusmn;20%</li>
			<li id="clear">Сброс</li>
                    </ul>

		    </div>

        </div>
		<div id="links">
	    <?php require "menu.php";?>
	</div>
	</div>


        <?php

mysql_connect('localhost','disp','disp');
mysql_query('SET NAMES "utf8"');
mysql_select_db('disp');
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

$query = mysql_query("select * from tovar left join price on price.key=tovar.price");
        ?>
       <table id='main'>
            <thead>
                <tr>
                    <th id = 'disp' rowspan="2">Продукция</th>
                    <th rowspan="2">Начало<br/>месяца</th>
                    <th colspan="2">Приход</th>
                    <th colspan="2">Акт за месяц</th>
                    <th colspan="2">Расход</th>
                    <th rowspan="2">Из<br/>цеха</th>
		    <th rowspan="2">В<br/>цех</th>
                    <th rowspan="2">Остатки</th>
                </tr>
                <tr>                  
                    <th class="dplus">Месяц</th>
                    <th class="dplus">День</th>
		    <th>Плюс</th>
		    <th>Минус</th>
                    <th>Месяц</th>
                    <th>День</th>
                </tr>

                </thead>
                <tfoot>
                <tr>
                    <th id = 'disp' rowspan="2">Продукция</th>
                    <th rowspan="2">Начало<br/>месяца</th>
                    <th colspan="2">Приход</th>
                    <th colspan="2">Акт за месяц</th>
                    <th colspan="2">Расход</th>
                    <th rowspan="2">Из<br/>цеха</th>
		    <th rowspan="2">В<br/>цех</th>
                    <th rowspan="2">Остатки</th>
                </tr>
                <tr>
                    <th>Месяц</th>
                    <th>День</th>
		    <th>Плюс</th>
		    <th>Минус</th>
                    <th>Месяц</th>
                    <th>День</th>
                </tr>

                </tfoot>

                <tbody>
                  <?php while($row=mysql_fetch_assoc($query)){?>
		
                    <tr id="<?php echo $row[id] ?>" color="<?php echo $row[color];?>" mas="<?php echo $row[mas];?>"
                            mark="<?php echo $row[mark];?>" brak="<?php echo $row[brak] ?>"
                    class="<?php $zero=""; if (!($row[begin]||$row[total]||$row[pakt]||$row[makt]||$row[mws]||$row[pws]||$row[mplus]||$row[mminus])) {$zero = "zero";}
                            printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color] $zero") ;?>">
                        <td><span class="icon"></span><?php echo $row[name];?>
			    <img class='transfer' src="../icon/arrow-split.png" title="Перевод" />
                            <a href="shipping.php?id=<?php echo $row[id]; ?>"  ><img src="../icon/truck--plus.png" title="Отгрузка"  /></a>
                            <a href="add.php?id=<?php echo $row[id]; ?>"><img src="../icon/box--plus.png" title="Приход"/></a>
			    <a href="workshop.php?id=<?php echo $row[id]; ?>"  ><img src="../icon/wall-break.png" title="Выдача в цех на переборку"  /></a>
			    
                        </td>
                        <td class="begin data" title="<?php echo r_ye($row[begin],$row[mas]);?>"
			    n="<?php echo $row[begin]; ?>"
                            ye="<?php echo r_ye($row[begin],$row[mas]);
                                        $yeb += r_ye($row[begin],$row[mas]); ?>">
                            <?php echo $row[begin]; $begin+=$row[begin] ?></td>

                        <td class="mplus data" title="<?php echo r_ye($row[mplus],$row[mas]);?>"
			    n="<?php echo $row[mplus];?>"
			    ye="<?php echo r_ye($row[mplus],$row[mas]); ?>"
			    ><?php echo $row[mplus]; $mplus+=$row[mplus]; $mplusye+=r_ye($row[mplus],$row[mas]) ?></td>

                        <td class="dplus data" title="<?php echo r_ye($row[dplus],$row[mas]);?>"
			    n="<?php echo $row[dplus];?>"
			    ye="<?php echo r_ye($row[dplus],$row[mas]); ?>"
			    ><?php echo $row[dplus]; $dplus+=$row[dplus];$dplusye+=r_ye($row[dplus],$row[mas]) ?></td>

			<td class="pakt data" title="<?php echo r_ye($row[pakt],$row[mas]);?>"
			    n="<?php echo $row[pakt];?>"
			    ye="<?php echo r_ye($row[pakt],$row[mas]); ?>"
			    ><?php echo $row[pakt]; $pakt+=$row[pakt]; $plakt_ye+=r_ye($row[pakt],$row[mas]) ?></td>

                        <td class="makt data" title="<?php echo r_ye($row[makt],$row[mas]);?>"
			    n="<?php echo $row[makt];?>"
			    ye="<?php echo r_ye($row[makt],$row[mas]); ?>"
			    ><?php echo $row[makt]; $makt+=$row[makt]; $mlakt_ye+=r_ye($row[makt],$row[mas])?></td>

                        <td class="mminus data" title="<?php echo r_ye($row[mminus],$row[mas]);?>"
			    n="<?php echo $row[mminus];?>"
			    ye="<?php echo r_ye($row[mminus],$row[mas]); ?>"
			    ><?php echo $row[mminus]; $mminus+=$row[mminus]; $mminus_ye+=r_ye($row[mminus],$row[mas]) ?></td>

                        <td class="dminus data" title="<?php echo r_ye($row[dminus],$row[mas]);?>"
			    n="<?php echo $row[dminus];?>"
			    ye="<?php echo r_ye($row[dminus],$row[mas]); ?>"
			    ><?php echo $row[dminus]; $dminus+=$row[dminus]; $dminus_ye+=r_ye($row[dminus],$row[mas]) ?></td>

                        <td class="uex data pws" title="<?php echo r_ye($row[pws],$row[mas]);?>"
			    n="<?php echo $row[pws];?>"
			    ye="<?php echo r_ye($row[pws],$row[mas]); ?>"
			    ><?php echo $row[pws]; $pws+=$row[pws]; $pws_ye+=r_ye($row[pws],$row[mas]) ?></td>

			<td class="uex data mws" title="<?php echo r_ye($row[mws],$row[mas]);?>"
			    n="<?php echo $row[mws];?>"
			    ye="<?php echo r_ye($row[mws],$row[mas]); ?>"
			    ><?php echo $row[mws]; $mws+=$row[mws]; $mws_ye+=r_ye($row[mws],$row[mas]) ?></td>

                        <td class="total data" title="<?php echo r_ye($row[total],$row[mas]);?>"
			    n="<?php echo $row[total]; ?>"
                            ye="<?php echo r_ye($row[total],$row[mas]);
                                        $yet += r_ye($row[total],$row[mas]);?>">
                            <?php echo $row[sel]; $total+=$row[total]; ?></td>
                        
                </tr>
                <?php }?>
                </tbody>
                <tfoot>
                    <tr id="end" class="data">
                        <td ><span id="vsego"><a href="transfer.php">Перевод</a></span>Всего:</td>
                        <td id="begin" class="data begin" title="<?php echo $yeb;?>"><?php echo $begin; ?></td>
			<td id="mplus" class="data mplus" title="<?php echo $mplusye;?>"><?php echo $mplus; ?></td>
			<td id="dplus" class="data dplus" title="<?php echo $dplusye;?>"><?php echo $dplus; ?></td>
			<td id="pakt" class="data pakt" title="<?php echo $pakt_ye;?>"><?php echo $pakt; ?></td>
			<td id="makt" class="data makt" title="<?php echo $makt_ye;?>"><?php echo $makt; ?></td>
			<td id="mminus" class="data mminus" title="<?php echo $mminus_ye;?>"><?php echo $mminus ?> </td>
			<td id="dminus" class="data dminus" title="<?php echo $dminus_ye;?>"><?php echo $dminus ?> </td>
			<td id="pws" class="data uex pws" title="<?php echo $pws_ye;?>"><?php echo $pws ?> </td>
			<td id="mws" class="data uex mws" title="<?php echo $mws_ye;?>"><?php echo $mws ?> </td>
			<td id="total" class="data total" title="<?php echo $yet; ?>"><?php echo $total; ?></td>

                    </tr>

                </tfoot>
        </table>
        

    </body>
</html>
