<html>
    <head>
        
        <title>
        test
    </title>
	<script type="text/javascript" src="../../jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="../dist/jquery.jqplot.min.js"></script>
        <script type="text/javascript" src="../dist/plugins/jqplot.pieRenderer.min.js"></script>
        <link rel="stylesheet" href="../dist/jquery.jqplot.css" type="text/css" />
        <style type="text/css">
            canvas.jqplot-event-canvas {color:red;}!important
        </style>
	<script  type="text/javascript"> $(document).ready(function(){
$(document).ready(function(){
 	  plot1 = [[1,2],[2,6],[3,8],[4,1],[5,9]];
 	  plot2 = [[1,4],[2.5,4],[3,7],[4,14],[5,3]];
 	  $.jqplot("example",
 	           [plot1],
 	           {
 	             title: "Оранжевый и голубой",
                     renderer: $.jqplot.PieRenderer,
 	             rendererOptions: {
        sliceMargin:8
      },
 	             series: [
                 	{ color:"red",label:"Голубой" }
 	            	
 	             ],
 	             legend: {
 	                show: true,
 	                location: "ne",
 	                
 	              }
 	           }
 	          );
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
<table>
 
 
<?php
$query = mysql_query("select SUM(total) as total,color from sclad,tovar where sclad.id=tovar.id group by color");





//php $query = mysql_query("select sclad.id,total+IFNULL(begin,0) as a
//    from sclad left join
//    (select tov as tov, IFNULL(SUM(minus)-SUM(plus)+SUM(makt)-SUM(pakt)-SUM(workshop)+SUM(mws),0) as begin
//    FROM jurnal where date>'2010-11-$i'
//    GROUP BY tov) as s on s.tov=sclad.id");
while($row=mysql_fetch_assoc($query)){
    ?>       <tr>
            <td><?php echo $row[color] ?></td><td><?php echo $row[total] ?></td>
            </tr>
    <?php } ?>
        
        
</table>
<div id="example" style="height:320px; width:400px;"></div>

    </body>
</html>