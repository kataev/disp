     
     $(document).ready(function(){



       
       var fr, te;
       var sel=0;

		$('.transfer').click(function(){//Akt

			
                        if (sel==0){
                        sel=1;
                        var mak = parseInt($(this).parent().parent().attr('mark'));
			//$('#test').text(mak);
			fr = $(this).parent().parent().attr('id');
                        $(this).parent().parent().appendTo('thead');
			$(this).parent().children('span.icon').html("<img src=\"icons/arrow-branch.png\">");
                        $('#amenu span').removeClass('dwn');
                        var marka = $(this).attr('mark');
                        $('span#'+$(this).parent().parent().attr('color')).click();
                        $('span#'+$(this).parent().parent().attr('mas')).click();
                        $('#mark span').each(function(){ if ($(this).attr('id') <= mak) { $(this).click()} });
                        } else {
                            $(this).parent().parent().appendTo('thead');
                            $('tbody tr').hide();
                            $(this).parent().children('span.icon').html("<img src=\"icons/arrow-curve-000-left.png\">");
			    te = $(this).parent().parent().attr('id');
			    $('tr span#vsego a').attr('href','transfer.php?from=' + fr +"&to=" + te)
			    $('tr span#vsego a').css('visibility','visible');
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
	
	$('#amenu #vid span').click(function(){//Lichevoi radovio
            if ($(this).hasClass('dwn')){$(this).removeClass('dwn');}
        });
	
        $('#amenu #mas span').click(function(){
            if ($(this).hasClass('dwn')){$(this).removeClass('dwn');}
        });

        $('#amenu span').click(function(){
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
             if ($('#amenu #vid span').hasClass('dwn')){
                 v = '.' +$('#amenu #vid .dwn').attr('id');
                 $('tbody tr:visible').not(v).hide();
             }

             if ($('#amenu #mas span').hasClass('dwn')){
                 m = '.' +$('#amenu #mas .dwn').attr('id');
                 $('tbody tr:visible').not(m).hide();
             }

             if ($('#amenu #zero').hasClass('dwn')){
                 $('.zero').hide()
                 
             }
	    var n=0, ye=0;
             $('tbody .begin.data:visible').each(function(){
                 n=n+parseInt($(this).attr('n'));
                 ye=ye+parseInt($(this).attr('ye'));
		 $('#begin').attr('ye',ye).attr('n',n).text(n);
		});
	     
             n=0; ye=0;
             $('tbody .total.data:visible').each(function(){
                 n=n+parseInt($(this).attr('n'));
                 ye=ye+parseInt($(this).attr('ye'));
                 $('#total').attr('ye',ye).attr('n',n).text(n);

             });

             });

	
      $('.data,.data td').filter('[ye]').hover(function(){$(this).addClass("ue").text($(this).attr('ye'))},
            function(){$(this).removeClass("ue").text($(this).attr('n'))}
        );
            
     



       
       var fr, te;
       var sel=0;

		$('.transfer').click(function(){//Akt

			
                        if (sel==0){
                        sel=1;
                        var mak = parseInt($(this).parent().parent().attr('mark'));
			//$('#test').text(mak);
			fr = $(this).parent().parent().attr('id');
                        $(this).parent().parent().appendTo('thead');
			$(this).parent().children('li.icon').html("<img src=\"icons/arrow-branch.png\">");
                        $('#menu li').removeClass('dwn');
                        var marka = $(this).attr('mark');
                        $('li#'+$(this).parent().parent().attr('color')).click();
                        $('li#'+$(this).parent().parent().attr('mas')).click();
                        $('#mark li').each(function(){ if ($(this).attr('id') <= mak) { $(this).click()} });
                        } else {
                            $(this).parent().parent().appendTo('thead');
                            $('tbody tr').hide();
                            $(this).parent().children('li.icon').html("<img src=\"icons/arrow-curve-000-left.png\">");
			    te = $(this).parent().parent().attr('id');
			    $('tr li#vsego a').attr('href','transfer.php?from=' + fr +"&to=" + te)
			    $('tr li#vsego a').css('visibility','visible');
                        }
			
			
			
			
			});



        //$('#test').text(test_n());
        $('div.Datepicker form input').datepick({onSelect: showDate, dateFormat: 'yy-mm-dd'});
        
        $('#menu #vid li').not('.dwn').click(function(){
                 $('#menu #vid .dwn').toggleClass('dwn');
                 $(this).removeClass('dwn');
             });

        $('#menu #mas li').not('.dwn').click(function(){
                 $('#menu #mas .dwn').toggleClass('dwn');
                 $(this).removeClass('dwn');
             });

        $('#menu #vid li').click(function(){//Lichevoi radovio
            if ($(this).hasClass('dwn')){$(this).removeClass('dwn');}
        });
        $('#menu #mas li').click(function(){
            if ($(this).hasClass('dwn')){$(this).removeClass('dwn');}
        });

        $('#menu li').click(function(){
            $(this).toggleClass('dwn');
            $('tbody tr').hide();
            var col = "tr",mark = "", tip="";
            $('#menu #color .dwn').each(function(){col += "." + $(this).attr('id') + "," ;});
            $('#menu #mark .dwn').each(function(){mark += "." + $(this).attr('id') + "," ;});
            $('#menu #tip .dwn').each(function(){tip += "." + $(this).attr('id') + "," ;});
            $('#menu #vid .dwn').each(function(){vid += "." + $(this).attr('id') + "," ;});
            //$('caption').text(col+mark+tip);
            
            if (mark!="")
            {if(tip!="") {$(col).filter(mark).filter(tip).show();}
                        else {$(col).filter(mark).show();}
            }
             else {
                 if(tip!="") {$(col).filter(tip).show();}
                        else {$(col).show();}

             }
             if ($('#menu #vid li').hasClass('dwn')){
                 v = '.' +$('#menu #vid .dwn').attr('id');
                 $('tbody tr:visible').not(v).hide();
             }

             if ($('#menu #mas li').hasClass('dwn')){
                 m = '.' +$('#menu #mas .dwn').attr('id');
                 $('tbody tr:visible').not(m).hide();
             }

             if ($('#menu #zero').hasClass('dwn')){
                 $('.zero').hide()
                 
             }
	    var n=0, ye=0;
             $('tbody .begin.data:visible').each(function(){
                 n=n+parseInt($(this).attr('n'));
                 ye=ye+parseInt($(this).attr('ye'));
		 $('#begin').attr('ye',ye).attr('n',n).text(n);
		});
	     
             n=0; ye=0;
             $('tbody .total.data:visible').each(function(){
                 n=n+parseInt($(this).attr('n'));
                 ye=ye+parseInt($(this).attr('ye'));
                 $('#total').attr('ye',ye).attr('n',n).text(n);

             });

             });

	
      $('.data,.data td').filter('[ye]').hover(function(){$(this).addClass("ue").text($(this).attr('ye'))},
            function(){$(this).removeClass("ue").text($(this).attr('n'))}
        );


        });//end script

function test_n() {return 'asd';}
function showDate(date) {
	$('#popupDatepicker').text(date);

}


