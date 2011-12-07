<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="../icon/user-green.png">
        <link rel="stylesheet" href="forms.css" type="text/css" />
        <script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
        <script src="datepicker/jquery.validate.js" type="text/javascript"></script>
        <title>Отгрузка</title>
        <script type="text/javascript">
        $(document).ready(function(){

        $("form").validate({
               rules : {
                       minus : {required : true,number: true,},
                       poddon: {required : true,number: true,},
                       nakl: {required : true,number: true},
               },
               messages : {
                       minus : {
                               required : "Введите кол-во кирпича",
                               number: "Вводите число",
                               
                       },
                      poddon : {
                               required : "Введите кол-во поддонов",
                               number: "Вводите число",
                       },
                       nakl : {
                               required : "Введите номер накладной",
                               number: "Вводите число",
                       }
               }
       });
        });
            </script>
    </head>
    <body>
        <div id="shipping"  >
	    <div id="h"><h1>Добавление КонтрАгента</h1>
	    <a href="sclad.php"><img src="../icon/arrow-turn-180-left.png" />Назад</a>
	    </div>
            
            <form name="Добавление КонтрАгента" action="action.php" method="GET">
		<fieldset id="agentadd">
                    <label for="name"><img src="../icon/user-business.png" /> Имя контрагента:</label>
                    <textarea name="name" title="Пример: Северная Керамика, ООО" rows="3" /></textarea><br />

                    <label for="inn"><img src="../icon/card-address.png" /> Инн:</label>
                    <input type="text" name="inn"/><br />

                    <label width="100%" for="address"><img src="../icon/address-book-open.png" /> Адрес:</label>
                    <textarea name="address" title="Пример: Северная Керамика, ООО" rows="3" /></textarea><br />

		    <label for="schet "><img src="../icon/money.png" /> Счет:</label>
                    <input type="text" name="schet"/><br />

		    <label for="bank"><img src="../icon/bank.png" /> Банк:</label>
                    <input type="text" name="bank"/><br />

		    <label for="phone"><img src="../icon/mobile-phone--pencil.png" /> Телефон:</label>
                    <input type="text" name="phone"/><br />

		    <label for="ip"><img src="../icon/user-silhouette-question.png" /> ИП:</label>
                    <input type="checkbox" name="ip" value="1"/><br />



		    <input type="reset"  value="Сброс"/>
                    <input type="submit" name="submit" value="Сохранить"/>

		    <input id="subm" type="hidden" name="action" value="agentadd"/>
                    
                </fieldset>
            
            
            </form>
        </div>
    </body>
</html>
