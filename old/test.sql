select tovar.id as id,tovar.sort,mark,vid,mas,tip,color,tovar.brak,tovar.prim as name,sclad.id,total+IFNULL(newbegin,0) as begin,
		    total,mplus,mminus,dplus,dminus,ju.makt,ju.pakt,workshop,mws
    from  tovar,sclad left join
    (SELECT mtov,mplus,mminus,dplus,dminus,makt,pakt,newbegin,workshop,mws
        FROM (select tov as mtov,SUM(plus) as mplus,SUM(minus) as mminus,IFNULL(SUM(minus)-SUM(plus)+SUM(makt)-SUM(pakt),0) as newbegin
            FROM jurnal where month(date)=month(CURDATE()) GROUP BY tov) as m
    left join
    (select tov as dtov,SUM(plus) as dplus, SUM(minus) as dminus,SUM(makt) as makt,SUM(pakt) as pakt,workshop,mws
	FROM jurnal where date=CURDATE()  GROUP BY tov) as d on m.mtov=d.dtov) as ju
	    on id=mtov Where sclad.id=tovar.id ORDER BY sort,mas DESC,vid,brak,mark,tip