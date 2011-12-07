<html>
    <head>
        
        <title>
        Графики
    </title>
	<link rel="shortcut icon" href="icon/chart-pie-separate.png">
	<script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="dist/jquery.jqplot.min.js"></script>
        <script type="text/javascript" src="dist/plugins/jqplot.pieRenderer.min.js"></script>
        <link rel="stylesheet" href="dist/jquery.jqplot.css" type="text/css" />
	<link rel="stylesheet" href="diagram.css" type="text/css" />
        <style type="text/css">
            
        </style>
	<script  type="text/javascript"> $(document).ready(function(){


var a = [];
var b = [];
var i = 0;

$(this).find('tr').each(function(){ b[i++] = [$(this).find('.color').text(),parseInt($(this).find('.total').text())];})

var q = $.jqplot("pie", [b], {
    
    seriesDefaults: {
      renderer: $.jqplot.PieRenderer,
      rendererOptions: {
        sliceMargin:5,
        shadowOffset : 1
      }
    },
    seriesColors: [ "Firebrick", "yellow", "Lightseagreen", "Burlywood", "Cyan", "Whitesmoke",
        "#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],
    legend: { show:true }
  });

});

	</script>
    </head>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
import_request_variables('GP', 'g_');
mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);
$date = date('Y-m-d');
$date1= $date;
$date=!isset($g_date)?$date:$g_date;
$date1=!isset($g_date1)?$date1:$g_date1;
$i=0;
?>
    <body>
	<a href="?data=color">Цвет</a>
	<a href="?data=tip">Тип</a>
	<a href="?data=vid">Вид</a>
	<a href="?data=mas">Масса</a>
<table>
 
 
<?php
$query = mysql_query("select SUM(total) as total,$g_data as data from sclad,tovar where sclad.id=tovar.id group by $g_data ORDER BY 1 DESC");

while($row=mysql_fetch_assoc($query)){
    ?>       <tr>
	<td class="color"><?php echo $row[data] ?></td><td class="total"><?php echo $row[total] ?></td>
            </tr>
    <?php } ?>
               
</table>
<div id="pie"></div>

    </body>
</html>