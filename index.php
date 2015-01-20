<?php
import_request_variables('GP', 'g_');
$g_month = isset($g_month) ? $g_month : date('m');
$g_year = isset($g_year) ? $g_year : date('Y');
$day = array("Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота");
$mou = array("Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");

mysql_connect(localhost, disp, disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);
?>
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
    <link rel="stylesheet" href="datepicker/jquery.datepick.css" type="text/css"/>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="datepicker/jquery.datepick.js"></script>
    <script type="text/javascript" src="datepicker/jquery.datepick-ru.js"></script>
    <script type="text/javascript" src="scrips.js"></script>

</head>
<body>
<div id="header">
    <img id="logo" src="../logo+text.png"/>

    <div id="name"><h1>Журнал</h1></div>
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


            <ul>
                <li id="date">
                    <form name="date" action="index.php" method="GET">


                        <select name="month">
                            <?php

                            $mon = mysql_query("SELECT month(date) AS month FROM jurnal GROUP BY month(date) ORDER BY 1 DESC;");
                            while ($ag = mysql_fetch_assoc($mon)) {
                                ?>
                                <option value="<?php echo $ag[month]; ?>"><?php echo $mou[$ag[month] - 1]; ?></option>

                            <?php }; ?>
                        </select>
                        <select name="year">
                            <?php

                            $mon = mysql_query("SELECT year(date) AS year FROM jurnal GROUP BY year(date) ORDER BY 1 DESC;");
                            while ($ag = mysql_fetch_assoc($mon)) {
                                ?>
                                <option value="<?php echo $ag[year]; ?>"><?php echo $ag[year]; ?></option>

                            <?php }; ?>
                        </select>
                        <input type="submit" name="submit" value="OK"/>
                    </form>
                </li>
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
        <?php require "menu.php"; ?>
    </div>
</div>
<?php

$query = mysql_query("SELECT mark,jurnal.id,tovar.prim,jurnal.prim AS pr,jurnal.price,jurnal.trans,nakl,
	tov,minus,plus,akt,poddon,jurnal.agent AS agid,agent.name AS agent,pakt,makt,date,time,color,mas,vid,tip,
	workshop AS pws,mws,ROUND(jurnal.price*jurnal.minus) AS money, spis, no_con
	    FROM jurnal
	    LEFT JOIN tovar ON tovar.id=jurnal.tov
	    LEFT JOIN agent ON jurnal.agent=agent.id WHERE month(date)=$g_month AND year(date)=$g_year
	    ORDER BY DATE DESC,TIME DESC,NAKL,id
");
//$query = mysql_query("SELECT jurnal.id,tovar.prim,jurnal.prim as pr,tov,minus,plus,akt,poddon,agent.name as agent,pakt,makt,date,time,color,mas,vid,tip
//    FROM jurnal,tovar,agent
//    WHERE month(date)=MONTH(CURDATE()) and tov=tovar.id or jurnal.agent=agent.id
//
//    ORDER BY DATE DESC,TIME DESC ");

?>
<table id="main" class="jurnal">
    <caption></caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Продукция</th>
        <th>Кол-во</th>
        <th>Тара</th>
        <th>Стои<br/>мость</th>


    </tr>
    </thead>

    <tbody>
    <?php while ($row = mysql_fetch_assoc($query)) {
        if ($row[date] != $date_t) {
            ?>
            <tr>
                <td colspan="7" class="date"><?php if ($date == $row[date]) {
                        echo "<b>Сегондя</b> ";
                    };
                    echo $day[date("w", strtotime($row[date]))], " ", date("d", strtotime($row[date])), " ", $mou[date("n", strtotime($row[date])) - 1], " ", date("Y", strtotime($row[date])) ?></td>
            </tr>
        <?php
        }
    ;
        $date_t = $row[date];
        if ($row[akt] != 0) {
            $act = "akt";
        }
        if ($row[plus] > 0) {
            $act = "plus";
        }
        if ($row[minus] > 0) {
            $act = "minus";
        }
        if ($row[mws] > 0) {
            $act = "mws";
        }
        if ($row[pws] > 0) {
            $act = "pws";
        }
        if ($row[spis] > 0) {
            $act = "spis";
        }
        if ($row[no_con] > 0) {
            $act = "no_con";
        }

        $pic["akt"] = "../icon/arrow-split.png";
        $pic["plus"] = "../icon/box--plus.png";
        $pic["minus"] = "../icon/truck--plus.png";
        $pic["mws"] = "../icon/wall-break.png";
        $pic["pws"] = "../icon/wall--arrow.png";
        $pic["spis"] = "../icon/folder-broken.png";
        $pic["no_con"] = "../icon/folder-stamp.png";
        switch ($act) {
            case 'akt':
                ?>
                <!--Акт на перевод-->
                <tr jur="<?php echo $row[id] ?>" action="transfer"
                    class="<?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]"); ?>">
                    <td><img src="<?php echo $pic[$act] ?>"/></td>
                    <td><?php echo $row[prim];
                        $row = mysql_fetch_assoc($query);
                        echo " > " . $row[prim]; ?>

                        <span id="pr"><?php echo preg_replace('/\\\/', '', $row[pr]); ?></span></td>
                    <td><?php if ($row[makt] == 0) {
                            echo $row[pakt];
                        } else {
                            echo $row[makt];
                        } ?></td>
                    <td><?php echo $row[poddon]; ?></td>
                    <td></td>
                </tr>
                <?php break; ?>

            <?php
            case 'plus': ?>
                <!--Добавление на склад-->
                <tr jur="<?php echo $row[id] ?>" action="add"
                    class="add <?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]"); ?>">
                    <td><img src="<?php echo $pic[$act] ?>"/></td>
                    <td><?php echo $row[prim]; ?>
                        <span id="add">Принято</span>
                        <span id="pr"><?php echo preg_replace('/\\\/', '', $row[pr]); ?></span></td>
                    <td><?php echo $row[plus] ?></td>
                    <td colspan="1"><?php echo $row[pr] ?></td>
                    <td></td>
                </tr>
                <?php break; ?>

            <?php
            case 'spis': ?>
                <!--Добавление на склад-->
                <tr jur="<?php echo $row[id] ?>" action="spis"
                    class="add <?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]"); ?>">
                    <td><img src="<?php echo $pic[$act] ?>"/></td>
                    <td><?php echo $row[prim]; ?>
                        <span id="spis">Списано</span>
                        <span id="pr"><?php echo preg_replace('/\\\/', '', $row[pr]); ?></span></td>
                    <td><?php echo $row[spis] ?></td>
                    <td colspan="1"><?php echo $row[pr] ?></td>
                    <td></td>
                </tr>
                <?php break; ?>

            <?php
            case 'no_con': ?>
                <!--Добавление на склад-->
                <tr jur="<?php echo $row[id] ?>" action="no_con"
                    class="add <?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]"); ?>">
                    <td><img src="<?php echo $pic[$act] ?>"/></td>
                    <td><?php echo $row[prim]; ?>
                        <span id="no_con">Некондиция</span>
                        <span id="pr"><?php echo preg_replace('/\\\/', '', $row[pr]); ?></span></td>
                    <td><?php echo $row[no_con] ?></td>
                    <td colspan="1"><?php echo $row[pr] ?></td>
                    <td></td>
                </tr>
                <?php break; ?>

            <?php
            case 'minus': ?>
                <!--Отгрузка-->
                <tr jur="<?php echo $row[id] ?>" action="sold"
                    class="sold <?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]"); ?>">
                    <td><a title="Просмотр операции" href="operation.php?id=<?php echo $row[id] ?>"><img
                                src="<?php echo $pic[$act] ?>"/></a></td>
                    <td><?php echo $row[prim]; ?>
                        <span id="agent"><a
                                href="agents.php?group=date&agent=<?php echo $row[agid] ?>"><?php echo preg_replace('/\\\/', '', $row[agent]); ?></a></span>
                        <span id="pr"><?php echo $row[pr] ?></span> <span id="nakl"><?php echo $row[nakl]; ?></span>
                        <?php if ($row[trans] == -1) { ?>
                            <span style="float:right; border:1px red solid;" class="trans"><a
                                    href="operation.php?id=<?php echo $row[id] ?>"><img title="Не указана цена доставки"
                                                                                        src="../icon/wooden-box--exclamation.png"><a/></span>
                        <?php } ?>
                    </td>
                    <td><?php echo $row[minus] ?></td>
                    <td><?php echo $row[poddon] ?></td>
                    <td><?php echo $row[money] ?></td>
                </tr>
                <?php break; ?>
            <?php
            case 'mws': ?>
                <!--Выдача в цех-->
                <tr jur="<?php echo $row[id] ?>" action="mws"
                    class="mws <?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]"); ?>">
                    <td><img src="<?php echo $pic[$act] ?>"/></td>
                    <td><?php echo $row[prim]; ?>
                        <span id="mws">Выдано в цех</span>
                        <span id="pr"><?php echo preg_replace('/\\\/', '', $row[pr]); ?></span> <span
                            id="nakl"><?php echo $row[nakl] ?></span></td>
                    <td><?php echo $row[mws] ?></td>
                    <td colspan="1"><?php echo $row[poddon] ?></td>
                    <td></td>
                </tr>
                <?php break; ?>
            <?php
            case 'pws': ?>
                <!--Получение из цеха-->
                <tr jur="<?php echo $row[id] ?>" action="pws"
                    class="pws <?php printf("$row[mark] $row[mas] $row[vid] $row[tip] $row[color]"); ?>">
                    <td><img src="<?php echo $pic[$act] ?>"/></td>
                    <td><?php echo $row[prim]; ?>
                        <span id="pws">Принято на склад из цеха</span>
                        <span id="pr"><?php echo preg_replace('/\\\/', '', $row[pr]); ?></span> <span
                            id="nakl"><?php echo $row[nakl] ?></span></td>
                    <td><?php echo $row[pws] ?></td>
                    <td colspan="1"><?php echo $row[poddon] ?></td>
                    <td></td>
                </tr>
                <?php break;
        }
    } ?>
    </tbody>
</table>
</body>
</html>
