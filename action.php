<?php
header("Request-URI: index.php");
header("Content-Location: index.php");
header("Location: index.php");

$date = date('Y-m-d');
$date1= $date;
if ($_SERVER['date']!="") {$date=$_SERVER['date'];}
$date1=!isset($_SERVER['date1'])?$date1:$_SERVER['date1'];
echo $date;
mysql_connect('localhost','disp','disp');
mysql_query('SET NAMES "utf8"');
mysql_select_db('disp');

switch ($_SERVER['action']) {

//EDIT----------------------------------------
    case 'edit':
	$q = "UPDATE  `sclad`
	    SET  `total` = '".mysql_escape_string($_SERVER['total'])."'
		 WHERE  `sclad`.`id` ='".mysql_escape_string($_SERVER['id'])."'  LIMIT 1 ";
	echo $q;
	mysql_query($q);
	$q = "UPDATE  `tovar` SET
		`name`='".mysql_escape_string($_SERVER['name'])."',
		 `prim`='".mysql_escape_string($_SERVER['prim'])."',
		  `vid`='".mysql_escape_string($_SERVER['vid'])."',
		  `mas`='".mysql_escape_string($_SERVER['mas'])."',
		  `tip`='".mysql_escape_string($_SERVER['tip'])."',
		`color`='".mysql_escape_string($_SERVER['color'])."'
		
	WHERE  `tovar`.`id` ='".mysql_escape_string($_SERVER['id'])."' LIMIT 1 ";
	echo $q;
	mysql_query($q);
	echo $q;
	break;

//workshop---------------------------------------
    case 'workshop':
	mysql_query("UPDATE  `sclad` SET
		`total` =  sclad.total-".mysql_escape_string($_SERVER['shop'])."
		WHERE  `sclad`.`id` =".mysql_escape_string($_SERVER['id'])." LIMIT 1 ;");

	mysql_query("INSERT INTO `jurnal`
		(`tov`, `workshop`,`poddon`,`date`, `time`, `prim`)
		VALUES ('".mysql_escape_string($_SERVER['id'])."',
			'".mysql_escape_string($_SERVER['shop'])."',
			'".mysql_escape_string($_SERVER['poddon'])."',
			'$date',
			NOW(),
			'".mysql_escape_string($_SERVER['prim'])."');

        ");

	break;
//debit---------------------------------------
    case 'debit':
	mysql_query("UPDATE  `sclad` SET
		`total` =  sclad.total - ".mysql_escape_string($_SERVER['minus'])."
		WHERE  `sclad`.`id` =".mysql_escape_string($_SERVER['id'])." LIMIT 1 ;");

	mysql_query("INSERT INTO `jurnal`
		(`tov`, `spis`,`poddon`,`date`, `time`, `prim`)
		VALUES ('".mysql_escape_string($_SERVER['id'])."',
			'".mysql_escape_string($_SERVER['minus'])."',
			'".mysql_escape_string($_SERVER['poddon'])."',
			'$date',
			NOW(),
			'".mysql_escape_string($_SERVER['prim'])."');

        ");

	break;

//canceldebit---------------------------------------
    case 'cancelspis':
	echo 'canceldebit';
	$query="SELECT tov,spis FROM jurnal where id=$_SERVER[jur]";
	echo $query;
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo "tov =$row[tov]";
	echo "spis =$row[spis]";
	$w=mysql_query("UPDATE `sclad` SET `total`=`total`+".$row['spis']." WHERE id=".$row['tov'].". LIMIT 1");
	mysql_query("DELETE FROM jurnal WHERE id=".$_SERVER['jur']." limit 1");
	break;


//no_condition---------------------------------------
    case 'no_condition':
	mysql_query("UPDATE  `sclad` SET
		`total` =  sclad.total-".mysql_escape_string($_SERVER['minus'])."
		WHERE  `sclad`.`id` =".mysql_escape_string($_SERVER['id'])." LIMIT 1 ;");

	mysql_query("INSERT INTO `jurnal`
		(`tov`, `no_con`,`poddon`,`date`, `time`, `prim`)
		VALUES ('".mysql_escape_string($_SERVER['id'])."',
			'".mysql_escape_string($_SERVER['minus'])."',
			'".mysql_escape_string($_SERVER['poddon'])."',
			'$date',
			NOW(),
			'".mysql_escape_string($_SERVER['prim'])."');

        ");

	break;

//cancelno_con---------------------------------------
    case 'cancelno_con':
	echo 'cancelno_con';
	$query="SELECT tov,no_con FROM jurnal where id=".$_SERVER['jur'];
	echo $query;
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo "tov =$row[tov]";
	echo "no_con =$row[no_con]";
	$w=mysql_query("UPDATE `sclad` SET `total`=`total`+".$row['no_con']." WHERE id=".$row['tov']." LIMIT 1");
	mysql_query("DELETE FROM jurnal WHERE id=".$_SERVER['jur']." limit 1");
	mysql_query("INSERT INTO `history` (`tov`,`kol`,`action`) VALUES (".$row['tov'].",".$row['no_con'].",'no_con')");

	break;


//ADDtovar---------------------------------------
    case 'addtovar':
	echo 'addtovar' ;

	switch ($_SERVER['color']){
	    case 'Красный':
		$sort=0;
		break;
	    case 'Желтый':
		$sort=1;
		break;
	    case 'Коричневый':
		$sort=2;
		break;
	    case 'Белый':
		$sort=3;
		break;
	    case 'Светлый':
		$sort=4;
		break;
	    case 'КЕ':
		$sort=5;
		break;
	}

	$qe = "INSERT INTO  `tovar` (`id` ,`name` ,`mark` ,`color` ,`tip` ,`vid` ,`mas` ,`brak` ,`prim`,`sort`)
        VALUES (NULL ,'".$_SERVER['name']."',  '".$_SERVER['mark']."','".$_SERVER['color']."',  '".$_SERVER['tip']."','".$_SERVER['vid']."',  '".$_SERVER['mas']."',
	'".$_SERVER['brak']."','".$_SERVER['prim']."','".$sort."')";
	echo $qe;
	mysql_query($qe);

	$query="SELECT id FROM tovar where prim=\"".$_SERVER['prim']."\" limit 1 ";
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo $query;
	if ($row['id']!=""){
	mysql_query("INSERT INTO `sclad` (`id`, `total`)
		VALUES ('$row[id]','0')");}
	break;

//canceladd---------------------------------------
    case 'canceladd':
	echo 'canceladd' ;
	$query="SELECT tov,plus FROM jurnal where id=$_SERVER[jur]";
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo $row['tov'];
	echo $row['plus'];
	$w=mysql_query("UPDATE `sclad` SET `total`=`total`-".$row['plus']." WHERE id=".$row['tov']." LIMIT 1");

	mysql_query("DELETE FROM jurnal WHERE id=".$_SERVER['jur']." limit 1");
	break;


//canceltransfer---------------------------------------
    case 'canceltransfer':
	echo 'canceltransfer';
	$q=mysql_query(" SELECT id,tov,makt,pakt,akt FROM jurnal where akt = (SELECT akt FROM jurnal where id=".$_SERVER['jur'].")");
	echo $q;

	while($row=mysql_fetch_assoc($q)){
	    $w=mysql_query("UPDATE `sclad` SET total=total + ".mysql_escape_string($row['makt'])." - ".mysql_escape_string($row['pakt'])."
		    WHERE id=".$row['tov']." LIMIT 1");
	    $a = $row['pakt'];
	    echo $w;
	    $akt=$row['akt'];
	}
	mysql_query("DELETE FROM jurnal WHERE akt = ".$akt." limit 2");
	break;



////cancelsold---------------------------------------
    case 'cancelsold':
	echo 'cancelsold';
	$query="SELECT tov,minus FROM jurnal where id=".$_SERVER['jur'];
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo $row['tov'];
	echo $row['minus'];
	$w=mysql_query("UPDATE `sclad` SET `total`=`total` + ".$row['minus']." WHERE id=".$row['tov']." LIMIT 1");

	mysql_query("DELETE FROM jurnal WHERE id=".$_SERVER['jur']." limit 1");
	break;

//cancelMWS---------------------------------------
    case 'cancelmws':
	echo 'cancelmws';
	$query="SELECT tov,mws FROM jurnal where id=".$_SERVER['jur'];
	echo $query;
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo "tov =$row[tov]";
	echo "mws =$row[mws]";
	$w=mysql_query("UPDATE `sclad` SET `total`=`total` + ".$row['mws']." WHERE id=".$row['tov']." LIMIT 1");
	mysql_query("DELETE FROM jurnal WHERE id=".$_SERVER['jur']." limit 1");
	break;
//cancelPWS---------------------------------------
    case 'cancelpws':
	echo 'cancelpws';
	$query="SELECT tov,workshop as pws FROM jurnal where id=".$_SERVER['jur'];
	echo $query;
	$q=mysql_query($query);
	$row=mysql_fetch_assoc($q);
	echo "tov =$row[tov]";
	echo "pws =$row[pws]";
	$w=mysql_query("UPDATE `sclad` SET `total`=`total`+".$row['pws']." WHERE id=".$row['tov']." LIMIT 1");
	mysql_query("DELETE FROM jurnal WHERE id=".$_SERVER['jur']." limit 1");

	break;

//add---------------------------------------
    case 'add':
	echo 'add';
	$q = "UPDATE  `sclad` SET
		`total` =  sclad.total+".mysql_escape_string($_SERVER['plus'])."
		WHERE  `sclad`.`id` =".mysql_escape_string($_SERVER['id'])." LIMIT 1 ;";
	echo $q;
mysql_query($q);
	$q = "INSERT INTO `jurnal`
		(`tov`, `plus`,`date`, `time`, `prim`)
		VALUES ('".mysql_escape_string($_SERVER['id'])."]',
			'".mysql_escape_string($_SERVER['plus'])."',
			'".$date."',
			NOW(),
			'".mysql_escape_string($_SERVER['prim'])."');";
	echo $q;
	mysql_query($q);
	break;
//transfer---------------------------------------
    case 'transfer':
	echo 'trans';
mysql_query("INSERT INTO `jurnal`
	    (`tov`, `makt`,`poddon`,`akt`,`date`, `time`, `prim`)
	    VALUES ('".$_SERVER['from']."',
	'".$_SERVER['kirp']."',
	'".$_SERVER['poddon']."',
	'".$_SERVER['akt']."',
	'".$date."',
	NOW(),
	'".$_GET['prim']."'); ");

mysql_query("UPDATE  `sclad`
	SET  `total` =  sclad.total-".$_SERVER['kirp']."
	WHERE  `sclad`.`id` =".$_SERVER['from']." LIMIT 1 ;");

mysql_query("INSERT INTO `jurnal`
	(`tov`, `pakt`,`poddon`,`akt`,`date`, `time`, `prim`)
        VALUES ('".$_SERVER['to']."',
	'".$_SERVER['kirp']."',
	'".$_SERVER['poddon']."',
	'".$_SERVER['akt']."',
	'".$date."',
	NOW(),
	'".$_SERVER['prim']."'); ");

mysql_query("UPDATE  `sclad`
	SET  `total` =  sclad.total+".$_SERVER['kirp']."
	WHERE  `sclad`.`id` =".$_SERVER['to']." LIMIT 1 ;");
	break;

//SHIPING---------------------------------------
    case 'sold':
	$q = "UPDATE  `sclad` SET
		`total` =  sclad.total-".mysql_escape_string($_SERVER['minus'])."
		WHERE  `sclad`.`id` =".mysql_escape_string($_SERVER['id'])." LIMIT 1 ;";
	echo $q;
mysql_query($q);
	$q = "INSERT INTO `jurnal`
		(`tov`, `minus`,`poddon`,`agent`,`nakl`,`date`, `time`, `prim`,`price`,`trans`)
		VALUES ('".mysql_escape_string($_SERVER['id'])."]',
			'".mysql_escape_string($_SERVER['minus'])."',
			'".mysql_escape_string($_SERVER['poddon'])."',
			'".mysql_escape_string($_SERVER['agent'])."',
			'".mysql_escape_string($_SERVER['nakl'])."',
			'$date',
			NOW(),
			'".mysql_escape_string($_SERVER['prim'])."',
			'".mysql_escape_string(str_replace(",",".",$_SERVER['price']))."',
			'".mysql_escape_string(str_replace(",",".",$_SERVER['trans']))."'
				);

        ";
	echo $q;
	mysql_query($q);

	break;
//Addagent---------------------------------------
    case 'agentadd':

		$qe = "INSERT INTO `agent`
		(`name`, `inn`,`address`,`schet`,`bank`,`phone`, `cp`)
		VALUES ('".mysql_escape_string($_SERVER['name'])."',
			'".mysql_escape_string($_SERVER['inn'])."',
			'".mysql_escape_string($_SERVER['address'])."',
			'".mysql_escape_string($_SERVER['schet'])."',
			'".mysql_escape_string($_SERVER['bank'])."',
			'".mysql_escape_string($_SERVER['phone'])."',
			'$_SERVER[ip]'
			)";
	echo $qe;
	mysql_query($qe);


	break;

    //wsm---------------------------------------
    case 'wsm':
	mysql_query("UPDATE  `sclad` SET
		`total` =  sclad.total-".$_SERVER['minus']."
		WHERE  `sclad`.`id` =".$_SERVER['id']." LIMIT 1 ;");

	mysql_query("INSERT INTO `jurnal`
		(`tov`, `mws`,`poddon`,`date`, `time`, `prim`)
		VALUES ('".$_SERVER['id']."]',
			'".$_SERVER['minus']."',
			'".$_SERVER['poddon']."',
			'".$date."',
			NOW(),
			'".$_SERVER['prim']."');

        ");

	break;

    //wsm---------------------------------------
    case 'wsp':
	mysql_query("UPDATE  `sclad` SET
		`total` =  sclad.total+".mysql_escape_string($_SERVER['minus'])."
		WHERE  `sclad`.`id` =".mysql_escape_string($_SERVER['id'])." LIMIT 1 ;");

	mysql_query("INSERT INTO `jurnal`
		(`tov`, `workshop`,`poddon`,`date`, `time`, `prim`)
		VALUES ('".mysql_escape_string($_SERVER['id'])."]',
			'".mysql_escape_string($_SERVER['minus'])."',
			'".mysql_escape_string($_SERVER['poddon'])."',
			'$date',
			NOW(),
			'".mysql_escape_string($_SERVER['prim'])."');

        ");

	break;
//Operation---------------------------------------
    case 'oper':
	$qe= "UPDATE  `jurnal` SET
		`price` =  '".str_replace(",",".",$_SERVER['price'])."', `trans` = '".str_replace(",",".",$_SERVER['trans'])."'
		WHERE  `jurnal`.`id` =".mysql_escape_string($_SERVER['id'])." LIMIT 1 ;";
	echo $qe;
	mysql_query($qe);


	break;

}

//$q = mysql_escape_string($q);
//echo $q;
//$query = mysql_query($q);
//while($row=mysql_fetch_assoc($query)){
//echo $row['id'];
//}
?>
