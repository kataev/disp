<?php
//header("Request-URI: index.php");
//header("Content-Location: index.php");
//header("Location: index.php");
import_request_variables('GP', 'g_');
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
	$q = "UPDATE  `disp`.`sclad`
	    SET  `total` = '".mysql_escape_string($g_total)."'
		 WHERE  `sclad`.`id` ='".mysql_escape_string($g_id)."'  LIMIT 1 ";
	echo $q;
	mysql_query($q);
	$q = "UPDATE  `disp`.`tovar` SET
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

//EDIT2---------------------------------------
    case workshop:
	mysql_query("UPDATE  `disp`.`sclad` SET
		`total` =  sclad.total-".mysql_escape_string($g_shop)."
		WHERE  `sclad`.`id` =".mysql_escape_string($g_id)." LIMIT 1 ;");

	mysql_query("INSERT INTO `disp`.`jurnal`
		(`tov`, `workshop`,`poddon`,`date`, `time`, `prim`)
		VALUES ('".mysql_escape_string($g_id)."',
			'".mysql_escape_string($g_shop)."',
			'".mysql_escape_string($g_poddon)."',
			'$date',
			CURTIME(),
			'".mysql_escape_string($g_prim)."');

        ");

	break;

//EDIT2---------------------------------------
    case canceladd:
	echo canceladd ;
	$query="SELECT tov,plus FROM jurnal where id=$g_jur";
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo $row[tov];
	echo $row[plus];
	$w=mysql_query("UPDATE `sclad` SET `total`=`total`-$row[plus] WHERE id=$row[tov] LIMIT 1");

	mysql_query("DELETE FROM jurnal WHERE id=$g_jur limit 1");
	break;

//ADDtovar---------------------------------------
    case addtovar:
	echo addtovar ;
	$qe = "INSERT INTO  `disp`.`tovar` (
`id` ,`name` ,`mark` ,`color` ,`tip` ,`vid` ,`mas` ,`brak` ,`prim`)
VALUES (NULL ,'".mysql_escape_string($g_name)."',  '".mysql_escape_string($g_mark)."',
	'".mysql_escape_string($g_color)."',  '".mysql_escape_string($g_tip)."',
	'".mysql_escape_string($g_vid)."',  '".mysql_escape_string($g_mas)."',
	'".mysql_escape_string($g_brak)."','".mysql_escape_string($g_prim)."')";
	echo $qe;
	mysql_query($qe);
	
	$query="SELECT id FROM tovar where prim=\"$g_prim\" limit 1 ";
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo $query;
	if ($row[id]!=""){
	mysql_query("INSERT INTO `disp`.`sclad` (`id`, `total`)
		VALUES ('$row[id]','0')");}
	break;


//EDIT2---------------------------------------
    case canceltransfer:
	
	$q=mysql_query(" SELECT id,tov,makt,pakt,akt FROM jurnal where akt = (SELECT akt FROM jurnal where id=$g_jur)");
	echo $q;
	while($row=mysql_fetch_assoc($q)){
	    $w=mysql_query("UPDATE `disp`
		SET `total`=`total`+".mysql_escape_string($row[makt])."-".mysql_escape_string($row[pakt])."
		    WHERE id=$row[tov] LIMIT 1");
	    echo $w;
	    $akt=$row[akt];
	}
	
	mysql_query("DELETE FROM jurnal WHERE akt = $akt limit 2");
	echo canceltransfer;
	break;



////EDIT2---------------------------------------
    case cancelsold:
	echo cancelsold;
	$query="SELECT tov,minus FROM jurnal where id=$g_jur";
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo $row[tov];
	echo $row[minus];
	$w=mysql_query("UPDATE `sclad` SET `total`=`total`+$row[minus] WHERE id=$row[tov] LIMIT 1");

	mysql_query("DELETE FROM jurnal WHERE id=$g_jur limit 1");


	break;



//EDIT2---------------------------------------
    case add:
	echo add;
	mysql_query("UPDATE  `disp`.`sclad` SET
		`total` =  sclad.total+".mysql_escape_string($g_plus)."
		WHERE  `sclad`.`id` =".mysql_escape_string($g_id)." LIMIT 1 ;");

	mysql_query("INSERT INTO `disp`.`jurnal`
		(`tov`, `plus`,`date`, `time`, `prim`)
		VALUES ('".mysql_escape_string($g_id)."]',
			'".mysql_escape_string($g_plus)."',
			'$date',
			CURTIME(),
			'".mysql_escape_string($g_prim)."');

        ");
	break;
//EDIT2---------------------------------------
    case transfer:
	echo trans;
mysql_query("INSERT INTO `disp`.`jurnal`
	    (`tov`, `makt`,`poddon`,`akt`,`date`, `time`, `prim`)
	    VALUES ('$g_from',
	'$g_kirp',
	'$g_poddon',
	'$g_akt',
	'$date',
	CURTIME(),
	'$_GET[prim]'); ");

mysql_query("UPDATE  `disp`.`sclad`
	SET  `total` =  sclad.total-$g_kirp
	WHERE  `sclad`.`id` =$g_from LIMIT 1 ;");

mysql_query("INSERT INTO `disp`.`jurnal`
	(`tov`, `pakt`,`poddon`,`akt`,`date`, `time`, `prim`)
        VALUES ('$g_to]',
	'$g_kirp',
	'$g_poddon',
	'$g_akt',
	'$date',
	CURTIME(),
	'$g_prim'); ");

mysql_query("UPDATE  `disp`.`sclad`
	SET  `total` =  sclad.total+$g_kirp
	WHERE  `sclad`.`id` =$g_to LIMIT 1 ;");
	break;
//EDIT2---------------------------------------
    case sold:
	mysql_query("UPDATE  `disp`.`sclad` SET
		`total` =  sclad.total-".mysql_escape_string($g_minus)."
		WHERE  `sclad`.`id` =".mysql_escape_string($g_id)." LIMIT 1 ;");

	mysql_query("INSERT INTO `disp`.`jurnal`
		(`tov`, `minus`,`poddon`,`agent`,`nakl`,`date`, `time`, `prim`)
		VALUES ('".mysql_escape_string($g_id)."]',
			'".mysql_escape_string($g_minus)."',
			'".mysql_escape_string($g_poddon)."',
			'".mysql_escape_string($g_agent)."',
			'".mysql_escape_string($g_nakl)."',
			'$date',
			CURTIME(),
			'".mysql_escape_string($g_prim)."');

        ");

	break;
//Addagent---------------------------------------
    case agentadd:

		$qe = "INSERT INTO `disp`.`agent`
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

}
//$q = mysql_escape_string($q);
//echo $q;
//$query = mysql_query($q);
//while($row=mysql_fetch_assoc($query)){
//echo $row[id];
//}
?>
