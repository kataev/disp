<?php
mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);
$g_agent = "select id,name from agent";
$qe_color = mysql_query($g_agent);
$col = array("blanchedalmond","blue","blueviolet","brown","burlywood","cadetblue","chartreuse","chocolate","coral","cornflowerblue","cornsilk","crimson","cyan","darkblue","darkcyan","darkgoldenrod","darkgray","darkgreen","darkgrey","darkkhaki","darkmagenta","darkolivegreen","darkorange","darkorchid","darkred","darksalmon","darkseagreen","darkslateblue","darkslategray","darkslategrey","darkturquoise","darkviolet","deeppink","deepskyblue","dimgray","dimgrey","dodgerblue","firebrick","floralwhite","forestgreen","fuchsia","gainsboro","ghostwhite","gold","goldenrod","gray","green","greenyellow","grey","honeydew","hotpink","indianred","indigo","ivory","khaki","lavender","lavenderblush","lawngreen","lemonchiffon","lightblue","lightcoral","lightcyan","lightgoldenrodyellow","lightgray","lightgreen","lightgrey","lightpink","lightsalmon","lightseagreen","lightskyblue","lightslategray","lightslategrey","lightsteelblue","lightyellow","lime","limegreen","linen","magenta","maroon","mediumaquamarine","mediumblue","mediumorchid","mediumpurple","mediumseagreen","mediumslateblue","mediumspringgreen","mediumturquoise","mediumvioletred","midnightblue","mintcream","mistyrose","moccasin","navajowhite","navy","oldlace","olive","olivedrab","orange","orangered","orchid","palegoldenrod","palegreen","paleturquoise","palevioletred","papayawhip","peachpuff","peru","pink","plum","powderblue","purple","red","rosybrown","royalblue","saddlebrown","salmon","sandybrown","seagreen","seashell","sienna","silver","skyblue","slateblue","slategray","slategrey","snow","springgreen","steelblue","tan","teal","thistle","tomato","turquoise","violet","wheat","white","whitesmoke","yellow","yellowgreen");
?>

<html>
    <head>

        <title>Выручка</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="../icon/chart-pie-separate.png">

<script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="dist/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="dist/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="dist/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="dist/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="dist/plugins/jqplot.cursor.min.js"></script>

<script type="text/javascript" src="datepicker/jquery.datepick.js"></script>
<script type="text/javascript" src="datepicker/jquery.datepick-ru.js"></script>

<link rel="stylesheet" href="dist/jquery.jqplot.css" type="text/css" />
<link rel="stylesheet" href="datepicker/jquery.datepick.css" type="text/css" />
<!--	<link rel="stylesheet" href="diagram.css" type="text/css" />-->
<!--	<link rel="stylesheet" href="forms.css" type="text/css" />-->
        <style type="text/css">
	span {text-decoration: underline; cursor: pointer; color:green;}
        </style>
	<script  type="text/javascript"> $(document).ready(function(){

$('input[name="date"]').datepick({dateFormat: 'yy-mm-dd'});
$('input[name="date1"]').datepick({dateFormat: 'yy-mm-dd'});
var year;
var month;
var oper = "agent";
$('select').change(function(){
    month = parseInt($('select[name="month"] option:selected').attr('value'))
    year = parseInt($('select[name="year"] option:selected').attr('value'));
    plotcolor();
});

$('span#color').click(function(){
//   oper = $(this).attr('id');
   plotcolor();
});

$('span#agent').click(function(){

   plotagent();
});

$('span#ip').click(function(){
   plotip();
});

function plotcolor(){
$.getJSON("json_grap.php",
{
   oper: "color",
   year: year,
   month : month
  },
function(json){
$('#total').text(json.total);


$('#pie>*').remove();

plot9 = $.jqplot('pie', [json.red,json.yellow,json.ke,json.brown,json.light,json.white], {
    stackSeries: true,
    title: 'Выручка',
    seriesDefaults: {renderer: $.jqplot.BarRenderer,labels: json.names},
    legend: {show: false, location: 'ne'},tickOptions:{
                formatString:'P ',
                fontSize:'10pt',
                fontFamily:'Tahoma',
		
                angle:-30
            },

seriesColors: [  "Firebrick","yellow", "Cyan", "Burlywood", "Lightseagreen", "gray",
        "#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],
    axes: {
      xaxis: {numberTicks:31,min:0.5,max:30.5,
          tickOptions:{formatString:'%d'},label:'Дни месяца'
      },
      yaxis: {min: 0}, tickOptions:{formatString:'%d P'}},
  cursor: {tooltipLocation:'nw'}


});
});//End plotcolor
};//end func

function plotip(){
$.getJSON("json_grap.php",
{
   oper: "ip",
   year: year,
   month : month
  },
function(json){
$('#total').text(json.total);


$('#pie>*').remove();

plot9 = $.jqplot('pie', [json.a1,json.a2], {
    stackSeries: true,
    title: 'Выручка',
    seriesDefaults: {renderer: $.jqplot.BarRenderer,labels: json.names},
    legend: {show: true, location: 'ne'},tickOptions:{
                formatString:'P ',
                fontSize:'10pt',
                fontFamily:'Tahoma',
                angle:-30
            },
series: [{label:'Организации'},{label:'Частные предприниматели'}],
seriesColors: [  "Firebrick","yellow", "Cyan", "Burlywood", "Lightseagreen", "gray",
        "#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],
    axes: {
      xaxis: {numberTicks:31,min:0.5,max:30.5,
          tickOptions:{formatString:'%d'},label:'Дни месяца'
      },
      yaxis: {min: 0}, tickOptions:{formatString:'%d P'}},
  cursor: {tooltipLocation:'nw'}


});
});//End plotip
};//end func


function plotagent(){
$.getJSON("json_grap.php",
{
   oper: oper,
   year: year,
   month : month
  },
function(json){
$('#total').text(json.total);


$('#pie>*').remove();

plot9 = $.jqplot('pie', [
<?php while($j++!=mysql_num_rows($qe_color)){
    echo "json.a$j,";
} echo "json.a$j";
?>
	    ], {
    stackSeries: true,
    title: 'Выручка',
    seriesDefaults: {renderer: $.jqplot.BarRenderer},
    legend: {show: true, location: 'ne'},tickOptions:{
                formatString:'P ',
                fontSize:'10pt',
                fontFamily:'Tahoma',
		
                angle:-30
            },
    series: [
	<?php $r=0; while($r++!=mysql_num_rows($qe_color)){
		$n=mysql_fetch_assoc($qe_color);
		echo "{label:'$n[name]',color: '".$col[rand(1, 140)]."',},";

}
mysql_fetch_assoc($qe_color);
echo "{label:'$n[name]'}";
?>
    ],

    axes: {
      xaxis: {
	  renderer:$.jqplot.DateAxisRenderer,
	  numberTicks:31,min:0.5,max:30.5,tickInterval:1,tickOptions:{
                formatString:'%Y/%#m/%#d',
                fontSize:'10pt',
                fontFamily:'Tahoma',
                angle:0
            },label:'Дни месяца'
      },
      yaxis: {min: 0}, tickOptions:{formatString:'%d P'}},
  cursor: {tooltipLocation:'nw'}
    
    
});
});//End plot
};//end func
plotcolor();
});

	</script>
    </head>
    <body>
        <?php
        // put your code here
        ?>
	<span id="color">По цвету</span> <span id="agent">По агентам</span> <span id="ip">По ЧП</span>
	      <form name="date" action="#" method="GET">
		    <select name="month">
			<?php
			$mou = array("Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь");
						$mon = mysql_query("select month(date) as month from jurnal group by month(date) order by 1 desc;");
			while($ag=mysql_fetch_assoc($mon)){
			?>
			<option value="<?php echo $ag[month]; ?>"><?php echo $mou[$ag[month]-1]; ?></option>

			<?php };?>
		    </select>
		    <select name="year">
			<?php

			$mon = mysql_query("select year(date) as year from jurnal group by year(date) order by 1 desc;");
			while($ag=mysql_fetch_assoc($mon)){
			?>
			<option value="<?php echo $ag[year]; ?>"><?php echo $ag[year]; ?></option>

			<?php };?>
		    </select>
Всего:<span id="total"></span> руб
	      </form>
		<a href="sclad.php"><img src="../icon/arrow-turn-180-left.png" />Назад</a>
		<div id="pie" style="height:90%; width:1000px; float:left;"></div>
            

    </body>
</html>
