<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css" />
        <script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
        <script src="datepicker/jquery.validate.js" type="text/javascript"></script>
        <title>Отгрузка</title>
        <script type="text/javascript">
        $(document).ready(function(){





   

        $("form").validate({
               rules : {
                       kirp : {required : true,number: true,},
                       poddon: {required : true,number: true,},
                       
               },
               messages : {
                       kirp : {
                               required : "Введите кол-во кирпича",
                               number: "Вводите число",

                       },
                      poddon : {
                               required : "Введите кол-во поддонов",
                               number: "Вводите число",
                       },
              
               }
       });
        });
            </script>
    </head>
    <body>
        <?php

import_request_variables('GP', 'g_');
$date = date('Y-m-d');
$date1= $date;
if ($g_date!="") {$date=$g_date;}
$date1=!isset($g_date1)?$date1:$g_date1;

mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);


switch ($g_action) {

//SOLD----------------------------------------
    case sold:
    $q=mysql_query("SELECT * FROM jurnal where agent=$g_agent");
	echo $q;
	while($row=mysql_fetch_assoc($q)){
	echo $row[agent];
	}
	break;
}
?>
	<div id="transfer">
    <h1>Просмотр операции номер <?php echo $g_id?></h1>
	
	</div>
    </body>
</html>
