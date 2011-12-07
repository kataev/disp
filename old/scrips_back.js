       $(document).ready(function(){

       var sel=0;

		$('.transfer').click(function(){


                        if (sel==0){
                        sel=1;
                        
			//$('#test').text(from);
                        $(this).parent().parent().appendTo('thead');
                        $(this).parent().children('span.icon').html("<img src=\"icons/arrow-branch.png\">");
                        $('#amenu span').removeClass('dwn');
                        var marka = $(this).attr('mark');
                        $('span#'+$(this).parent().parent().attr('color')).click();
                        $('span#'+$(this).parent().parent().attr('mas')).click();
                        
                        } else {
                            $(this).parent().parent().appendTo('thead');
                            $('tbody tr').hide();
                            $(this).parent().children('span.icon').html("<img src=\"icons/arrow-curve-000-left.png\">");
                        }
			
			
			
			
			});



        //$('#test').text(test_n());
        $('div.Datepicker form input').datepick({onSelect: showDate, dateFormat: 'yy-mm-dd'});
        
        $('#amenu #vid span').not('.dwn').click(function(){
                 $('#amenu #vid .dwn').toggleClass('dwn');
                 $(this).removeClass('dwn');
             });

        $('#amenu #mas span').not('.dwn').click(function(){
                 $('#amenu #mas .dwn').toggleClass('dwn');
                 $(this).removeClass('dwn');
             });

        $('#amenu #vid span').click(function(){//Lichevoi radovio
            if ($(this).hasClass('dwn')){$(this).removeClass('dwn');}
        });
        $('#amenu #mas span').click(function(){
            if ($(this).hasClass('dwn')){$(this).removeClass('dwn');}
        });

        $('#amenu span').not('#vid').click(function(){
            $(this).toggleClass('dwn');
            $('tbody tr').hide();
            var col = "tr",mark = "", tip="";
            $('#amenu #color .dwn').each(function(){col += "." + $(this).attr('id') + "," ;});
            $('#amenu #mark .dwn').each(function(){mark += "." + $(this).attr('id') + "," ;});
            $('#amenu #tip .dwn').each(function(){tip += "." + $(this).attr('id') + "," ;});
            $('#amenu #vid .dwn').each(function(){vid += "." + $(this).attr('id') + "," ;});
            //$('caption').text(col+mark+tip);
            
            if (mark!="")
            {if(tip!="") {$(col).filter(mark).filter(tip).show();}
                        else {$(col).filter(mark).show();}
            }
             else {
                 if(tip!="") {$(col).filter(tip).show();}
                        else {$(col).show();}

             }
             if ($('#amenu #vid span').not('dwn')){
                 var v = '.' +$('#amenu #vid .dwn').attr('id');
                 $('tbody tr:visible').filter(v).hide();
             }

             if ($('#amenu #mas span').not('.dwn')){
                 var v = '.' +$('#amenu #mas .dwn').attr('id');
                 $('tbody tr:visible').filter(v).hide();
             }

             if ($('#amenu #zero').hasClass('dwn')){
                 $('.zero').hide()
                 
             }
             var yebegin = 0
             var begin = 0;
             $('tbody .begin:visible').each(function(){
                 if ($(this).parent().hasClass('Одинарный')){
              begin += parseInt($(this).text());
              yebegin += parseInt($(this).text());}
                if ($(this).parent().hasClass('Полуторный')){
              begin += parseInt($(this).text());
              yebegin += parseFloat($(this).text()*1.35);}
          $('#begin').attr('ue',yebegin);
             });
             $('#begin').text(begin);
             
             var yetotal = 0;
             var total = 0;
             $('tbody .total:visible').each(function(){
                 if ($(this).parent().hasClass('Одинарный')){
              total += parseInt($(this).text());
              yetotal += parseInt($(this).text());}
                 if ($(this).parent().hasClass('Полуторный')){
              total += parseInt($(this).text());
              yetotal += parseFloat($(this).text()*1.35);}
              $('#total').attr('ue',yetotal);
             });
             $('#total').text(total);
             });




            var b;
          $('.Полуторный > .begin,.Полуторный > .total').hover(function(){
              var a = parseInt($(this).text());
              b = a;
              a = parseFloat($(this).text()*1.35);
              a = Math.round(a);
              $(this).text(a).addClass('ue');

      },function(){$(this).text(b).removeClass('ue');});
	var ui = 0;
        $('#total').hover(function(){
            ui = $(this).text(u);
            //$('caption').text(ui);
            var u = Math.round($(this).attr('ue'));
            $(this).text(u).addClass('ue');

        },function(){$(this).text(ui).removeClass('ue');});

        $('#begin').hover(function(){
            ui = $(this).text(u);
            //$('caption').text(ui);
            var u = Math.round($(this).attr('ue'));
            $(this).text(u).addClass('ue');

        },function(){$(this).text(ui).removeClass('ue');});




        });//end script

function test_n() {return 'asd';}
function showDate(date) {
	$('#popupDatepicker').text(date);

}
