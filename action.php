<?php
header("Request-URI: index.php");
header("Content-Location: index.php");
header("Location: index.php");

$date = date('Y-m-d');
$date1= $date;
if ($g_date!="") {$date=$g_date;}
$date1=!isset($g_date1)?$date1:$g_date1;
echo $date;
mysql_connect(localhost,disp,disp);
mysql_query('SET NAMES "utf8"');
mysql_select_db(disp);

switch ($g_action) {

//EDIT----------------------------------------
    case edit:
	$q = "UPDATE  `sclad`
	    SET  `total` = '".mysql_escape_string($g_total)."'
		 WHERE  `sclad`.`id` ='".mysql_escape_string($g_id)."'  LIMIT 1 ";
	echo $q;
	mysql_query($q);
	$q = "UPDATE  `tovar` SET
		`name`='".mysql_escape_string($g_name)."',
		 `prim`='".mysql_escape_string($g_prim)."',
		  `vid`='".mysql_escape_string($g_vid)."',
		  `mas`='".mysql_escape_string($g_mas)."',
		  `tip`='".mysql_escape_string($g_tip)."',
		`color`='".mysql_escape_string($g_color)."'
		
	WHERE  `tovar`.`id` ='".mysql_escape_string($g_id)."' LIMIT 1 ";
	echo $q;
	mysql_query($q);
	echo $q;
	break;

//workshop---------------------------------------
    case workshop:
	mysql_query("UPDATE  `sclad` SET
		`total` =  sclad.total-".mysql_escape_string($g_shop)."
		WHERE  `sclad`.`id` =".mysql_escape_string($g_id)." LIMIT 1 ;");

	mysql_query("INSERT INTO `jurnal`
		(`tov`, `workshop`,`poddon`,`date`, `time`, `prim`)
		VALUES ('".mysql_escape_string($g_id)."',
			'".mysql_escape_string($g_shop)."',
			'".mysql_escape_string($g_poddon)."',
			'$date',
			NOW(),
			'".mysql_escape_string($g_prim)."');

        ");

	break;
//debit---------------------------------------
    case debit:
	mysql_query("UPDATE  `sclad` SET
		`total` =  sclad.total - ".mysql_escape_string($g_minus)."
		WHERE  `sclad`.`id` =".mysql_escape_string($g_id)." LIMIT 1 ;");

	mysql_query("INSERT INTO `jurnal`
		(`tov`, `spis`,`poddon`,`date`, `time`, `prim`)
		VALUES ('".mysql_escape_string($g_id)."',
			'".mysql_escape_string($g_minus)."',
			'".mysql_escape_string($g_poddon)."',
			'$date',
			NOW(),
			'".mysql_escape_string($g_prim)."');

        ");

	break;

//canceldebit---------------------------------------
    case cancelspis:
	echo canceldebit;
	$query="SELECT tov,spis FROM jurnal where id=$g_jur";
	echo $query;
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo "tov =$row[tov]";
	echo "spis =$row[spis]";
	$w=mysql_query("UPDATE `sclad` SET `total`=`total`+".$row[spis]." WHERE id=".$row[tov].". LIMIT 1");
	mysql_query("DELETE FROM jurnal WHERE id=".$g_jur." limit 1");
	break;


//no_condition---------------------------------------
    case no_condition:
	mysql_query("UPDATE  `sclad` SET
		`total` =  sclad.total-".mysql_escape_string($g_minus)."
		WHERE  `sclad`.`id` =".mysql_escape_string($g_id)." LIMIT 1 ;");

	mysql_query("INSERT INTO `jurnal`
		(`tov`, `no_con`,`poddon`,`date`, `time`, `prim`)
		VALUES ('".mysql_escape_string($g_id)."',
			'".mysql_escape_string($g_minus)."',
			'".mysql_escape_string($g_poddon)."',
			'$date',
			NOW(),
			'".mysql_escape_string($g_prim)."');

        ");

	break;

//cancelno_con---------------------------------------
    case cancelno_con:
	echo cancelno_con;
	$query="SELECT tov,no_con FROM jurnal where id=".$g_jur;
	echo $query;
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo "tov =$row[tov]";
	echo "no_con =$row[no_con]";
	$w=mysql_query("UPDATE `sclad` SET `total`=`total`+".$row[no_con]." WHERE id=".$row[tov]." LIMIT 1");
	mysql_query("DELETE FROM jurnal WHERE id=".$g_jur." limit 1");
	mysql_query("INSERT INTO `history` (`tov`,`kol`,`action`) VALUES (".$row[tov].",".$row[no_con].",'no_con')");

	break;


//ADDtovar---------------------------------------
    case addtovar:
	echo addtovar ;

	switch ($g_color){
	    case Красный:
		$sort=0;
		break;
	    case Желтый:
		$sort=1;
		break;
	    case Коричневый:
		$sort=2;
		break;
	    case Белый:
		$sort=3;
		break;
	    case Светлый:
		$sort=4;
		break;
	    case КЕ:
		$sort=5;
		break;
	}

	$qe = "INSERT INTO  `tovar` (`id` ,`name` ,`mark` ,`color` ,`tip` ,`vid` ,`mas` ,`brak` ,`prim`,`sort`)
        VALUES (NULL ,'".$g_name."',  '".$g_mark."','".$g_color."',  '".$g_tip."','".$g_vid."',  '".$g_mas."',
	'".$g_brak."','".$g_prim."','".$sort."')";
	echo $qe;
	mysql_query($qe);

	$query="SELECT id FROM tovar where prim=\"".$g_prim."\" limit 1 ";
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo $query;
	if ($row[id]!=""){
	mysql_query("INSERT INTO `sclad` (`id`, `total`)
		VALUES ('$row[id]','0')");}
	break;

//canceladd---------------------------------------
    case canceladd:
	echo canceladd ;
	$query="SELECT tov,plus FROM jurnal where id=$g_jur";
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo $row[tov];
	echo $row[plus];
	$w=mysql_query("UPDATE `sclad` SET `total`=`total`-".$row[plus]." WHERE id=".$row[tov]." LIMIT 1");

	mysql_query("DELETE FROM jurnal WHERE id=".$g_jur." limit 1");
	break;


//canceltransfer---------------------------------------
    case canceltransfer:
	echo canceltransfer;
	$q=mysql_query(" SELECT id,tov,makt,pakt,akt FROM jurnal where akt = (SELECT akt FROM jurnal where id=".$g_jur.")");
	echo $q;

	while($row=mysql_fetch_assoc($q)){
	    $w=mysql_query("UPDATE `sclad` SET total=total + ".mysql_escape_string($row[makt])." - ".mysql_escape_string($row[pakt])."
		    WHERE id=".$row[tov]." LIMIT 1");
	    $a = $row[pakt];
	    echo $w;
	    $akt=$row[akt];
	}
	mysql_query("DELETE FROM jurnal WHERE akt = ".$akt." limit 2");
	break;



////cancelsold---------------------------------------
    case cancelsold:
	echo cancelsold;
	$query="SELECT tov,minus FROM jurnal where id=".$g_jur;
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo $row[tov];
	echo $row[minus];
	$w=mysql_query("UPDATE `sclad` SET `total`=`total` + ".$row[minus]." WHERE id=".$row[tov]." LIMIT 1");

	mysql_query("DELETE FROM jurnal WHERE id=".$g_jur." limit 1");
	break;

//cancelMWS---------------------------------------
    case cancelmws:
	echo cancelmws;
	$query="SELECT tov,mws FROM jurnal where id=".$g_jur;
	echo $query;
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo "tov =$row[tov]";
	echo "mws =$row[mws]";
	$w=mysql_query("UPDATE `sclad` SET `total`=`total` + ".$row[mws]." WHERE id=".$row[tov]." LIMIT 1");
	mysql_query("DELETE FROM jurnal WHERE id=".$g_jur." limit 1");
	break;
//cancelPWS---------------------------------------
    case cancelpws:
	echo cancelpws;
	$query="SELECT tov,workshop as pws FROM jurnal where id=".$g_jur;
	echo $query;
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo "tov =$row[tov]";
	echo "pws =$row[pws]";
	$w=mysql_query("UPDATE `sclad` SET `total`=`total`+".$row[pws]." WHERE id=".$row[tov]." LIMIT 1");
	mysql_query("DELETE FROM jurnal WHERE id=".$g_jur." limit 1");

	break;

//add---------------------------------------
    case add:
	echo add;
	$q = "UPDATE  `sclad` SET
		`total` =  sclad.total+".mysql_escape_string($g_plus)."
		WHERE  `sclad`.`id` =".mysql_escape_string($g_id)." LIMIT 1 ;";
	echo $q;
mysql_query($q);
	$q = "INSERT INTO `jurnal`
		(`tov`, `plus`,`date`, `time`, `prim`)
		VALUES ('".mysql_escape_string($g_id)."]',
			'".mysql_escape_string($g_plus)."',
			'".$date."',
			NOW(),
			'".mysql_escape_string($g_prim)."');";
	echo $q;
	mysql_query($q);
	break;
//transfer---------------------------------------
    case transfer:
	echo trans;
mysql_query("INSERT INTO `jurnal`
	    (`tov`, `makt`,`poddon`,`akt`,`date`, `time`, `prim`)
	    VALUES ('".$g_from."',
	'".$g_kirp."',
	'".$g_poddon."',
	'".$g_akt."',
	'".$date."',
	NOW(),
	'".$_GET[prim]."'); ");

mysql_query("UPDATE  `sclad`
	SET  `total` =  sclad.total-".$g_kirp."
	WHERE  `sclad`.`id` =".$g_from." LIMIT 1 ;");

mysql_query("INSERT INTO `jurnal`
	(`tov`, `pakt`,`poddon`,`akt`,`date`, `time`, `prim`)
        VALUES ('".$g_to."',
	'".$g_kirp."',
	'".$g_poddon."',
	'".$g_akt."',
	'".$date."',
	NOW(),
	'".$g_prim."'); ");

mysql_query("UPDATE  `sclad`
	SET  `total` =  sclad.total+".$g_kirp."
	WHERE  `sclad`.`id` =".$g_to." LIMIT 1 ;");
	break;

//SHIPING---------------------------------------
    case sold:
	$q = "UPDATE  `sclad` SET
		`total` =  sclad.total-".mysql_escape_string($g_minus)."
		WHERE  `sclad`.`id` =".mysql_escape_string($g_id)." LIMIT 1 ;";
	echo $q;
mysql_query($q);
	$q = "INSERT INTO `jurnal`
		(`tov`, `minus`,`poddon`,`agent`,`nakl`,`date`, `time`, `prim`,`price`,`trans`)
		VALUES ('".mysql_escape_string($g_id)."]',
			'".mysql_escape_string($g_minus)."',
			'".mysql_escape_string($g_poddon)."',
			'".mysql_escape_string($g_agent)."',
			'".mysql_escape_string($g_nakl)."',
			'$date',
			NOW(),
			'".mysql_escape_string($g_prim)."',
			'".mysql_escape_string(str_replace(",",".",$g_price))."',
			'".mysql_escape_string(str_replace(",",".",$g_trans))."'
				);

        ";
	echo $q;
	mysql_query($q);

	break;
//Addagent---------------------------------------
    case agentadd:

		$qe = "INSERT INTO `agent`
		(`name`, `inn`,`address`,`schet`,`bank`,`phone`, `cp`)
		VALUES ('".mysql_escape_string($g_name)."',
			'".mysql_escape_string($g_inn)."',
			'".mysql_escape_string($g_address)."',
			'".mysql_escape_string($g_schet)."',
			'".mysql_escape_string($g_bank)."',
			'".mysql_escape_string($g_phone)."',
			'$g_ip'
			)";
	echo $qe;
	mysql_query($qe);


	break;

    //wsm---------------------------------------
    case wsm:
	mysql_query("UPDATE  `sclad` SET
		`total` =  sclad.total-".$g_minus."
		WHERE  `sclad`.`id` =".$g_id." LIMIT 1 ;");

	mysql_query("INSERT INTO `jurnal`
		(`tov`, `mws`,`poddon`,`date`, `time`, `prim`)
		VALUES ('".$g_id."]',
			'".$g_minus."',
			'".$g_poddon."',
			'".$date."',
			NOW(),
			'".$g_prim."');

        ");

	break;

    //wsm---------------------------------------
    case wsp:
	mysql_query("UPDATE  `sclad` SET
		`total` =  sclad.total+".mysql_escape_string($g_minus)."
		WHERE  `sclad`.`id` =".mysql_escape_string($g_id)." LIMIT 1 ;");

	mysql_query("INSERT INTO `jurnal`
		(`tov`, `workshop`,`poddon`,`date`, `time`, `prim`)
		VALUES ('".mysql_escape_string($g_id)."]',
			'".mysql_escape_string($g_minus)."',
			'".mysql_escape_string($g_poddon)."',
			'$date',
			NOW(),
			'".mysql_escape_string($g_prim)."');

        ");

	break;
//Operation---------------------------------------
    case oper:
	$qe= "UPDATE  `jurnal` SET
		`price` =  '".str_replace(",",".",$g_price)."', `trans` = '".str_replace(",",".",$g_trans)."'
		WHERE  `jurnal`.`id` =".mysql_escape_string($g_id)." LIMIT 1 ;";
	echo $qe;
	mysql_query($qe);


	break;

}

//$q = mysql_escape_string($q);
//echo $q;
//$query = mysql_query($q);
//while($row=mysql_fetch_assoc($query)){
//echo $row[id];
//}
?>
