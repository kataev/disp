<html>
    <head>
        
        <title>
        Круговая диаграмма
    </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="../icon/chart-pie-separate.png">
	<script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="dist/jquery.jqplot.min.js"></script>
        <script type="text/javascript" src="dist/plugins/jqplot.pieRenderer.min.js"></script>
	<script type="text/javascript" src="dist/plugins/jqplot.pieRenderer.lineLabels.js"></script>
        <link rel="stylesheet" href="dist/jquery.jqplot.css" type="text/css" />

	<link rel="stylesheet" href="datepicker/jquery.datepick.css" type="text/css" />
        <script src="datepicker/jquery.validate.js" type="text/javascript"></script>
	<script type="text/javascript" src="datepicker/jquery.datepick.js"></script>
	<script type="text/javascript" src="datepicker/jquery.datepick-ru.js"></script>

	<link rel="stylesheet" href="diagram.css" type="text/css" />
	<link rel="stylesheet" href="forms.css" type="text/css" />
        <style type="text/css">
	div#date input {width: 75px;}
        </style>
	<script  type="text/javascript"> $(document).ready(function(){

$('div#date input').datepick({dateFormat: 'yy-mm-dd'});

$('input[value="'+data+'"]').click();
$('input[value="'+action+'"]').click();
var data;
var action;
var a = [];
var b = [];
var i = 0;
var sort="color";
var oper="total";
var date;
var date1;
var color=0;
var mas;
var vid;
var mark;

$('div#date input[name="date"]').change(function(){
    date=$(this).attr('value');
    plot();
});

	    $('div#date input[type="reset"]').click(function(){
		date = 0;
		
		plot();
//alert();
	    });

$('div#date input[name="date1"]').change(function(){
    date1=$(this).attr('value');
    plot();
});

$('ul#color li').click(function(){
    color = $(this).attr('color');
//    $(this).toggleClass(".dwn");
    plot();
});

$('ul#vid li').click(function(){
    vid = $(this).attr('vid');
    $(this).parent().find('li').each(function(){$(this).removeClass("dwn")})
    $(this).toggleClass("dwn");;
    plot();
});

$('ul#sort li').click(function(){
    sort = $(this).attr('sort');
    $(this).parent().find('li').each(function(){$(this).removeClass("dwn")})
    $(this).toggleClass("dwn");
    plot();
});

$('ul#mark li').click(function(){
    mark = $(this).attr('mark');
    $(this).parent().find('li').each(function(){$(this).removeClass("dwn")})
    $(this).toggleClass("dwn");
    plot();
});

$('ul#mas li').click(function(){
    mas = $(this).attr('mas');
    $(this).parent().find('li').each(function(){$(this).removeClass("dwn")})
    $(this).toggleClass("dwn");
    plot();
});

$('ul#oper li').click(function(){
    oper = $(this).attr('oper');
    $(this).parent().find('li').each(function(){$(this).removeClass("dwn")})
    $(this).toggleClass("dwn");
    plot();
});

function plot(){
$.getJSON("json.php",
{
    sort: sort,
    oper: oper,
    color: color,
    mas : mas,
    vid : vid,
    mark : mark,
    date : date,
    date1 : date1
  },
function(json){
$('#pie>*').remove();
var q = $.jqplot("pie", [json], {

    seriesDefaults: {
      renderer: $.jqplot.PieRenderer,
      rendererOptions: {
        sliceMargin:5,
	
        shadowOffset : 2,
	lineLabels: true, lineLabelsLineColor: 'black'

      }
    },


    seriesColors: [ "Cyan", "Firebrick", "Burlywood", "Lightseagreen", "yellow", "gray",
        "#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],
    legend: { show:false }
  });
});//End plot
};//end func
plot();
});

	</script>
    </head>
    <body>
    <div>
            <div id="h">
                <h1>Круговая диаграмма</h1>
               
		<a href="sclad.php"><img src="../icon/arrow-turn-180-left.png" />Назад</a>
            </div>
	<div id="menu">
		    <div>
            <div style="">
                        <ul id="oper">
                <li oper="total" class="dwn" title="Склад">Склад</li>
                <li oper="add" title="Производство">Произ-во</li>
                <li oper="minus" title="Отгрузка">Отгрузка</li>
		<li oper="minusbyday" title="Отгрузка">Отгрузка<br/>By day</li>
		<li oper="plusbyday" title="Отгрузка">Произ-во<br/>By day</li>


            </ul>

            <ul id="sort">
                <li sort="color" class="dwn" title="По цвету">По цвету</li>
                <li sort="mark" title="По марке">По марке</li>
                <li sort="vid" title="По виду">По виду</li>
                <li sort="mas" title="По размерам">По размеру</li>
                <li sort="tip" title="По типу">По типу</li>
            </ul>
            <div/>
	    <ul id="color">
                <li color="" id="all" title="Все"><img src="../icon/color-swatch.png">Все</li><br/>
                <li color="1" id="Красный" title="Красный"></li>
                <li color="2" id="Желтый" title="Желтый"></li>
                <li color="3" id="Коричневый" title="Коричневый"></li>
                <li color="4" id="Светлый" title="Светлый"></li>
                <li color="5" id="Белый" title="Белый"></li>
                <li color="6" id="КЕ" title="КЕ"></li>

            </ul>


            <ul id="mark">
                <li mark="" id="all" class="dwn">Все марки</li>
                <li mark="100">100</li>
                <li mark="125">125</li>
                <li mark="150">150</li>
                <li mark="175">175</li>
                <li mark="200">200</li>
                <li mark="250">250</li>
	    </ul>
		    </div>
		    <div style="float:left;">
        <ul id="vid">
                <li vid="" class="dwn">Лиц и Ряд</li>
                <li vid="1">Лицевой</li>
                <li vid="2">Рядовой</li>
                </ul>

            <ul id="mas">
                <li mas="" class="dwn">Все</li>
                <li mas="1">Одинарный</li>
                <li mas="2">Утолщенный</li>

           </ul>
			

		    </div>
		<div id="date" style="float:right;">
		    <form action="#">
			Период:
			<input type="text" name="date" >
			<input type="text" name="date1">
			<input type="reset" value="Сброс">

		    </form>

		</div>

        </div>
	<div id="pie" style="height:400px; width:600px; float:left;"></div>
    </div>
	</div>



    </body>
</html>