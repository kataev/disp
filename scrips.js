
     $(document).ready(function(){
$('.spis,.no_con').hide()     
 $('input[name="date"]').datepick({dateFormat: 'yy-mm-dd'});


       var fr, te;
       var sel=0;
//$('#test').text(sel);
		$('.transfer').click(function(){//Akt


                        if (sel==0){
                        sel=1;
                        var mak = parseInt($(this).parent().parent().attr('mark'));
			//$('#test').text(mak);
			fr = $(this).parent().parent().attr('id');
                        $(this).parent().parent().appendTo('thead');

                        $('#menu li').removeClass('dwn');
                        var mak = $(this).parent().parent().attr('mark');
                        $('li#'+$(this).parent().parent().attr('color')).click();
                        $('li#'+$(this).parent().parent().attr('mas')).click();
			//$('#test').text(sel);
                        $('ul#mark li').each(function(){if ($(this).attr('id') <= mak) {$(this).click()}});
                        } else {
			    $('#test').text('ololo');
                            $(this).parent().parent().appendTo('thead');
                            $('tbody tr').hide();
                            te = $(this).parent().parent().attr('id');
			    $('tr span#vsego a').attr('href','transfer.php?from=' + fr +"&to=" + te)
			    $('tr span#vsego a').css('visibility','visible');
			    //$('#test').text(sel);
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
	$('#menu #clear').click(function(){
            $('#menu li').removeClass('dwn');}
	    );
	



        $('#menu li').click(function(){
            $(this).toggleClass('dwn');
            $('tbody tr').hide();
            var col = "tr",mark = "", tip="", vid="";
            $('#menu #color .dwn').each(function(){col += "." + $(this).attr('id') + "," ;});
            $('#menu #mark .dwn').each(function(){mark += "." + $(this).attr('id') + "," ;});
            $('#menu #tip .dwn').each(function(){tip += "." + $(this).attr('id') + "," ;});
            $('#menu #vid .dwn').each(function(){vid += "." + $(this).attr('id') + "," ;});
            //$('#test').text(col+mark+tip);
            
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

	    if ($('#menu #percent').hasClass('dwn')){
                 $('tbody tr[brak*="%"]').hide()

             }
		
	    var n=0, ye=0;

	    
var i =0;
	    $('tr#end td.data').each(function(){
		var s = $(this).attr('id');
		var n=0; var ye=0;
		var st = "tbody ."+s+":visible";
		$(st).each(function(){
		 a = parseInt($(this).text());
                 b = parseInt($(this).attr('title'));
		 if (isNaN(a)) {a=0;b=0} else {
		 n+=a;
		 ye+=b;}
		 var sr= "#"+s;		 
		 $(sr).attr('title',ye).text(n);
		});
		});



             });

	     $('#menu #no_co').click(function(){
		 if ($(this).hasClass('dwn'))
		{$('.spis,.no_con').show()} else
		    {$('.spis,.no_con').hide()} 
	     });
	     $('#menu #cancell').click(function(){
	    var jur;
	    var address,action;
	    $('tbody tr').css('cursor','pointer');
	    $('tbody tr').toggleClass('cancell');
	    if ($('#cancell').hasClass('dwn'))
	    {
		$('tbody tr').click(function(){
		    jur=$(this).attr('jur');
		    action=$(this).attr('action');
		    address = "action.php?action=cancel"+action+"&jur="+jur;
		    document.location.href = address;
	    });
	    }
	    if ($('#cancell').hasClass('dwn')){}else{
		$('tbody tr').css('cursor','default');}
	});
	
//      $('.data,.data td').filter('[ye]').hover(function(){$(this).addClass("ue").text($(this).attr('ye'))},
//            function(){$(this).removeClass("ue").text($(this).attr('n'))}
//        );

//	test = $('tbody tr[brak*="Фаска"]')
//	$('#test').text(test);
$('li#zero').click();

        });//end script

function test_n() {return 'asd';}
function showDate(date) {
	$('#popupDatepicker').text(date);

}


