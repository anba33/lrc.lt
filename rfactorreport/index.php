<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!--
(c)2006 Frank Wynants

rFactor-report uses the Mozilla Public License 1.1 (MPL 1.1). 
This means that it is against the law to take parts of 
rFactor-report and use them in your own project, 
unless you make your own project open-source to, 
or if your own project also uses some proprietry libraries.

When making changes to rFactor-report I encourage you to 
commit those changes back to the project and not to make your 
own version of rFactor-report (note that if you make your own 
version of rFactor-report you are obliged to make it open-source).

-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" version="-//W3C//DTD XHTML 1.1//EN" xml:lang="en">
<head>
	<title>rFactor-report</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<link type="text/css" href="{$cssstyle}" rel="stylesheet" media="screen" />
    <link media='screen' rel="stylesheet" type="text/css" href="<?php echo (!$_REQUEST['cssstyle'])?'style/rfactor-report.css':$_REQUEST['cssstyle'] ?>" />   
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/rfactor-report.js" type="text/javascript"></script>
</head>

<?php
// read URL parameters
$qualyfile = $_REQUEST['qualyfile'];
$racefile = $_REQUEST['racefile'];
$startlap = $_REQUEST['startlap'];
$endlap = $_REQUEST['endlap'];
$file = $_REQUEST['file']; //older result files combined qualy + race in 1 xml
$limit = $_REQUEST['limit'];
$cssstyle = $_REQUEST['cssstyle'];
if($cssstyle = "") $cssstyle = "style/rfactor-report.css";

require_once('dbexport.php');
$db = initDatabase($dbexport);
$smarty = setupSmarty(); //smarty init
ini_set('zend.ze1_compatibility_mode', 0);

//if 1 parameter is given compute the report
if (!(($qualyfile == "") && ($file == "") && ($racefile == ""))) {
	require_once ("lib/tools.php"); //some much used functions
	require_once ("lib/xmlphp4.php"); //php4 xml parser tool

	if ($file != "") //if older then V1.070 of rFactor
		{
		$qualyfile = $file;
		$racefile = $file;
	}

	if (url_exists($qualyfile)) //read qualyfile
		{
		$qualyfile = leesXml($qualyfile);
		$qualyxmlstring = file_get_contents($qualyfile);
		$qualyxml = new XMLParser($qualyxmlstring);
		$qualyxml->Parse();
	} else {
		exit ('Could not find given qualifying URL...<br>If you think this is a bug please send an e-mail (or contact me on google-talk) to <A HREF="mailto:frank.wynants@gmail.com">frank.wynants@gmail.com</A> (please provide the URL you used)');
	}
	if (url_exists($racefile)) //read racefile
		{
		$racefile = leesXml($racefile);
		$racexmlstring = file_get_contents($racefile);
		$racexml = new XMLParser($racexmlstring);
		$racexml->Parse();		
	} else {
		exit ('Could not find given race URL...<br>If you think this is a bug please send an e-mail (or contact me on google-talk) to <A HREF="mailto:frank.wynants@gmail.com">frank.wynants@gmail.com</A> (please provide the URL you used)');
	}

	if (!$qualyxml) //check if file is valid
		{
		exit ('<span style="color: red;">The qualifying XML is invalid... If you think this is due to a bug in rFactor-report please send an email (or contact me on google-talk) to <A HREF="mailto:frank.wynants@gmail.com">frank.wynants@gmail.com</A><br>If you see UTF-8 errors above this message then the XML is broken due to a bug in rFactor prior to 1.070.</span>)');
	}
	if (!$racexml) //check if file is valid
		{
		exit ('<span style="color: red;">The race XML is invalid... If you think this is due to a bug in rFactor-report please send an email (or contact me on google-talk) to <A HREF="mailto:frank.wynants@gmail.com">frank.wynants@gmail.com</A><br>If you see UTF-8 errors above this message then the XML is broken due to a bug in rFactor prior to 1.070.</span>)');
	}

	//check number of qualifications. We only use last qualification
	//More qualyfication session occur when qualification was restarted
	$mq = 0;
	if ($qualyxml->document->raceresults[0]->qualify[0] != null)
	{
		foreach ($qualyxml->document->raceresults[0]->qualify as $abc) {
			$mq++;
		}
	}
	
	//check number of races. We only use last race (more races can ocur due to restarts)      
	$mr = 0;
	foreach ($racexml->document->raceresults[0]->race as $abc) {
		$mr++;
	}
	
	$mq--;
	$mr--;

	//the real work
	$smarty->assign('cssstyle', $cssstyle);
   $smarty->assign('qualyfile', $qualyfile);
   $smarty->assign('racefile', $racefile);
   $smarty->assign('startlap', $startlap);
   $smarty->assign('endlap', $endlap);
   
	$smarty = overview($qualyxml, $racexml, $smarty, $mq, $mr);
	$allersnelsteronde = zoekSnelsteRonde($racexml, $mr);
	$smarty = mostlapslead($racexml, $smarty, $mr);
	$smarty = qualification($qualyxml, $smarty, $mq, $dbexport, $db);
	$smarty = swap($racexml, $smarty, $mr);
	$smarty = race($racexml, $smarty, $mr, $dbexport, $db, $allersnelsteronde);
	$smarty = incidents($racexml, $smarty, $mr);
   $smarty = chat($racexml, $smarty, $mr);
	$smarty = fastestlap($racexml, $smarty, $mr, $dbexport, $db);
	$smarty = fastestsector($racexml, $smarty, "s1", $mr, $dbexport, $db);
	$smarty = fastestsector($racexml, $smarty, "s2", $mr, $dbexport, $db);
	$smarty = fastestsector($racexml, $smarty, "s3", $mr, $dbexport, $db);
	$smarty = highestclimber($racexml, $smarty, $mr);
	$racefile = urlencode($racefile);
	$smarty->assign('racehistorygraph', "racehistory.php?file=$racefile"); //build racehistory graph
	$smarty = consistency($racexml, $smarty, "std", $mr);
	$smarty = consistency($racexml, $smarty, "avg", $mr);
	$smarty->assign('lapbylapgraph', "lapbylap.php?file=$racefile"); //build lap by lap graph
	$smarty = fastestpossiblelap($racexml, $smarty, $mr);
	$smarty->assign('url', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?qualyfile=" . urlencode($_REQUEST['qualyfile'])  . "&amp;racefile=" . urlencode($_REQUEST['racefile']) . "&amp;cssfile=" . urlencode($_REQUEST['cssfile']));

   
	$smarty->display('index.tpl'); //when everything is computed show it
} else //if no params given just show the main file
	{
   $smarty->assign('cssstyle', $cssstyle);
   $smarty->assign('qualyfile', $qualyfile);
   $smarty->assign('racefile', $racefile);
	$smarty->display('inputpage.tpl');
}

/**
* Compute positions for each driver and each lap and return as a double array : called from mostlapslead 
* Compute who lead for how many laps
*/
function berekenPositions($tijd, $rijderslengte, $rondeslengte, $xml, $name, $car, $carclass, $smarty) {
	for ($i = 0; $i < $rijderslengte; $i++) //rijders aflopen
		{
		for ($j = 1; $j < $rondeslengte + 1; $j++) //rondes per rijder aflopen
			{
			$positie[$i][$j] = 1;

			for ($k = 0; $k < $rijderslengte; $k++) //alle rijders aflopen en positie invullen
				{
				if (($tijd[$i][$j] > $tijd[$k][$j]) && ($tijd[$k][$j] != 0)) {
					$positie[$i][$j]++;
				}
				if ($tijd[$i][$j] == 0) {
					$positie[$i][$j] = null;
				}
			}

			if ($positie[$i][$j] != null) {
				$positie[$i][$j] = - $positie[$i][$j];

				if ($positie[$i][$j] == -1) {
					$leider[$i]++;
				}
			}
		}
	}

	$mostlapslead = 0;
	for ($i = 0; $i < $rijderslengte; $i++) //rijders aflopen
		{
		if ($leider[$i] > $mostlapslead) {
			$mostlapslead = $leider[$i];
			$mostlapsleaddriver = $name[$i];
		}
	}
	$smarty->assign('mostlapsleddriver', $mostlapsleaddriver);

	$smarty->assign('mostlapsledlaps', $mostlapslead);
	$smarty = leadersort($smarty, count($name), $leider, $name, $car, $carclass, 'raceleaderrondes', 'raceleadernamen', 'raceleadercar', 'raceleadernumber');

	return $smarty;
}

/**
 * sort leader overview : called from berekenPositions
 */
function leadersort($smarty, $lengte, $leider, $name, $car, $carclass, $smartyrondes, $smartynamen, $smartycar, $smartynumber) {
	$vlag = 1;

	for ($i = 1; $i < $lengte; $i++) {
		if ($vlag == 1) {
			$vlag = 0;
			for ($j = 0; $j < $lengte - $i; $j++) {
				if ($leider[$j] < $leider[$j +1]) {
					$vlag = 1;

					$hulpleider = $leider[$j +1];
					$leider[$j +1] = $leider[$j];
					$leider[$j] = $hulpleider;

					$hulpname = $name[$j +1];
					$name[$j +1] = $name[$j];
					$name[$j] = $hulpname;

					$hulpcar = $car[$j +1];
					$car[$j +1] = $car[$j];
					$car[$j] = $hulpcar;

					$hulpcarclass = $carclass[$j +1];
					$carclass[$j +1] = $carclass[$j];
					$carclass[$j] = $hulpcarclass;
				}
			}
		}
	}

	//clean up drivers who did not lead the race
	for ($i = 0; $i < $lengte; $i++) {
		if ($leider[$i] != null) {
			$rleider[$i] = $leider[$i];
			$rname[$i] = $name[$i];
			$rcar[$i] = $car[$i];
			$rcarclass[$i] = $carclass[$i];
		}
	}

	$smarty->assign($smartynamen, $rname);
	$smarty->assign($smartycar, $rcar);
	$smarty->assign($smartynumber, $rcarclass);
	$smarty->assign($smartycar, $rcar);
	$smarty->assign($smartyrondes, $rleider);
	
	return $smarty;
}
/*
* Overview of most laps lead
* @param xml the race xml
* @param smarty smarty object
* @param mr number of racesessions, only last session is used
*/
function mostlapslead($xml, $smarty, $mr) {
	foreach ($xml->document->raceresults[0]->race[$mr]->driver as $driver) {
		$i = (int) $driver->position[0]->tagData;
		$i--;
		$name[$i] = $driver->name[0]->tagData;
		$car[$i] = $driver->cartype[0]->tagData;
		$carclass[$i] = $driver->carclass[0]->tagData;
		$team[$i] = $driver->teamname[0]->tagData;

		$j = 0;
		$tijd[$i][0] = 0.0;

		if ($driver->lap[0] != null) 
		{
			foreach ($driver->lap as $lap) 
			{
				if($lap->tagData == "--.----") //if time is missing from racereport take previous time
				{
					$tijd[$i][$j +1] = (float) $tijd[$i][$j] + $previous;
				}
				else
				{
					$tijd[$i][$j +1] = (float) $tijd[$i][$j] + (float) $lap->tagData;
					if ($lap->tagData == 0)
						$tijd[$i][$j +1] = 0;

					$previous = (float) $lap->tagData;
				}
				$j++;
			}
		}
		if ($i == 0)
			$aantallaps = $j;
	}
	$smarty = berekenPositions($tijd, count($name), $aantallaps, $xml, $name, $car, $carclass, $smarty);
	
	
	
	return $smarty;
}

/*
* consistency
* @param xml race xml
* @param smarty smarty object
* @param type std or avg defining which type of consistency is computed
* @param mr number of race sessions, only last session is used
*/
function consistency($xml, $smarty, $type, $mr) {
	$i = 0;
	foreach ($xml->document->raceresults[0]->race[$mr]->driver as $driver) {
		$consdriver[$i] = $driver->name[0]->tagData;
		$conscar[$i] = $driver->cartype[0]->tagData;
		$conscarclass[$i] = $driver->carclass[0]->tagData;

		$j = 0;
		$totaltime = 0.0;
		if ($driver->lap[0] != null) {		
			foreach ($driver->lap as $Laps) 
			{
				if($lap->tagData == "--.----") //if time is missing from racereport take previous time
				{
					$totaltime += $previous;
				}
				else
				{
					$totaltime += (float) $Laps->tagData;
					$previous = (float) $Laps->tagData;
				}
				$j++;
			}
		}
		if ($j != 0) {
			$avgtime = $totaltime / $j;
			$constime[$i] = 0;
			//(X1-Avg)�+(X2-Avg)�+(X3-Avg)�
			foreach ($driver->lap as $Laps) {
				if ($type == "std")
				{
					if($Laps->tagData == "--.----")
					{ 
						
						$constime[$i] += pow(($previous - $avgtime), 2);
					}
					else
					{
						$constime[$i] += pow(($Laps->tagData - $avgtime), 2);
						$previous = $Laps->tagData;
					}
				}
				else
				{
					if($Laps->tagData == "--.----") 
					{
						$constime[$i] += abs($previous - $avgtime);
					}
					else
					{
						$constime[$i] += abs($Laps->tagData - $avgtime);
						$previous = $Laps->tagData;
					}
				}
			}
			$constime[$i] /= $j;
			if ($type == "std")
				$constime[$i] = sqrt($constime[$i]);
			$constime[$i] = round($constime[$i], 3);
         if($constime[$i] == 0) $constime[$i] =  "9999 (Not enough laps)";
			$i++;
		} else 
      {
			$constime[$i] = "9999 (Not enough laps)";
			$i++;
		}
	}
	$lengte = $i;
	if ($type == "std")
		$smarty = bubblesort(null, null, null, null, $smarty, $i, $constime, $consdriver, $conscar, $conscarclass, 'stddevpos', 'stddevtime', 'stddevgap', 'stddevdriver', 'stddevcar', 'stddevcarclass');
	else
		$smarty = bubblesort(null, null, null, null, $smarty, $i, $constime, $consdriver, $conscar, $conscarclass, 'avgdevpos', 'avgdevtime', 'avgdevgap', 'avgdevdriver', 'avgdevcar', 'avgdevcarclass');
		
	return $smarty;
}

/*
* Highest climbers
* @param xml the race xml
* @param smarty smarty object
* @param mr number of race session, only last session is used
*/
function highestclimber($xml, $smarty, $mr) {
	//array maken van racerijders op positie
	foreach ($xml->document->raceresults[0]->race[$mr]->driver as $driver) {
		$i = (int) $driver->position[0]->tagData;
		$i--;
		$racedriver[$i] = $driver->name[0]->tagData;
		$racecar[$i] = $driver->cartype[0]->tagData;
		$racecarclass[$i] = $driver->carclass[0]->tagData;
		$startposition[$i] = $driver->gridpos[0]->tagData;
		$hcfinishposition[$i] = $driver->position[0]->tagData;
		$hcpositions[$i] = $startposition[$i] - $hcfinishposition[$i];
		$i++;
	}
	$lengte = count($racedriver);

	$smarty = sortClimbers($smarty, $lengte, $hcpositions, $racedriver, $racecar, $racecarclass, $startposition, $hcfinishposition);
	
	return $smarty;
}

/*
* sort highest climbers
* @param smarty smarty object
* @param lengte length of arrays
* @param hcpositions number of positions climbed
* @param driver driver names
* @param car carmodels
* @param carclass number of cars
* @param team teamnames
* @param startposition starting positions
* @param hcfinishposition finishing positions
*/
function sortClimbers($smarty, $lengte, $hcpositions, $driver, $car, $carclass, $startposition, $hcfinishposition) {
	$vlag = 1;

	for ($i = 1; $i < $lengte; $i++) {
		if ($vlag == 1) {
			$vlag = 0;
			for ($j = 0; $j < $lengte - $i; $j++) {
				if ($hcpositions[$j] < $hcpositions[$j +1]) {
					$vlag = 1;

					$hulphcpositions = $hcpositions[$j +1];
					$hcpositions[$j +1] = $hcpositions[$j];
					$hcpositions[$j] = $hulphcpositions;

					$hulpdriver = $driver[$j +1];
					$driver[$j +1] = $driver[$j];
					$driver[$j] = $hulpdriver;

					$hulpcar = $car[$j +1];
					$car[$j +1] = $car[$j];
					$car[$j] = $hulpcar;

					$hulpcarclass = $carclass[$j +1];
					$carclass[$j +1] = $carclass[$j];
					$carclass[$j] = $hulpcarclass;

					$hulpstartposition = $startposition[$j +1];
					$startposition[$j +1] = $startposition[$j];
					$startposition[$j] = $hulpstartposition;

					$hulphcfinishposition = $hcfinishposition[$j +1];
					$hcfinishposition[$j +1] = $hcfinishposition[$j];
					$hcfinishposition[$j] = $hulphcfinishposition;
				}
			}
		}
	}
	
	$smarty->assign('highestclimber', $driver[0]);
	$smarty->assign('highestclimberposition', $hcpositions[0]);
	$smarty->assign('hcpositions', $hcpositions);
	$smarty->assign('hcdriver', $driver);
	$smarty->assign('hcstartposition', $startposition);
	$smarty->assign('hcfinishposition', $hcfinishposition);
	$smarty->assign('hccar', $car);
	$smarty->assign('hccarclass', $carclass);
	
	return $smarty;
}

/**
 * gets the fastest time the driver did in the sector
 */
function getFastestSectorTime($sector, $driver)
{
	$fastestsectortime=999999;
	if ($driver->lap[0] != null) {
		foreach ($driver->lap as $Lap){
			$sectortime = $Lap->tagAttrs[$sector];
			if($sectortime != '')
			{
				if ($sectortime < $fastestsectortime)
				{
					$fastestsectortime = $sectortime;					
				}
			}
		}
	}	
	return $fastestsectortime;
}

/*
 * gives an overview of the fastest laps possible per driver as wel
 * as the most fastests lap between drivers 
 */
function fastestpossiblelap($xml, $smarty, $mr)
{
	$i = 0;
	foreach ($xml->document->raceresults[0]->race[$mr]->driver as $driver) {
		$fastestsectortimes1 = getFastestSectorTime('s1', $driver);
		$fastestsectortimes2 = getFastestSectorTime('s2', $driver);
		$fastestsectortimes3 = getFastestSectorTime('s3', $driver);
		
		$pdriver[$i] = $driver->name[0]->tagData;
		$pcar[$i] = $driver->cartype[0]->tagData;
		$pcarclass[$i] = $driver->carclass[0]->tagData;
		
		$fastestpossible[$i] = $fastestsectortimes1 + $fastestsectortimes2 + $fastestsectortimes3;
		$i++;
	}
	$smarty = bubblesort(null, null, null, null, $smarty, $i, $fastestpossible, $pdriver, $pcar, $pcarclass, 'ppos', 'ptime', 'pgap', 'pdriver', 'pcar', 'pcarclass');
	
	return $smarty;
}

/*
* Fastest sector times
* @param xml the race xml
* @param smarty smarty object
* @param sector = s1, s2 or s3 defining which sector
* @param mr number of race sessions, only last session is used
*/
function fastestsector($xml, $smarty, $sector, $mr, $dbexport, $db) {
	$i = 0;
	foreach ($xml->document->raceresults[0]->race[$mr]->driver as $driver) {
		$fastestsectortime[$i] = 99999999;
		if ($driver->lap[0] != null) {
			foreach ($driver->lap as $Lap) {
				$sectortime = $Lap->tagAttrs[$sector];
				if ($sectortime != "") {
					if ($sectortime < $fastestsectortime[$i])
						$fastestsectortime[$i] = $sectortime;
				}
			}
		}

		$fastestsectorname[$i] = $driver->name[0]->tagData;
		$fastestsectorcar[$i] = $driver->cartype[0]->tagData;
		$fastestsectorcarclass[$i] = $driver->carclass[0]->tagData;
		$i++;
	}
	//sort and print
	$smarty = bubblesort('fastest' . $sector, $db, $dbexport, $xml, $smarty, $i, $fastestsectortime, $fastestsectorname, $fastestsectorcar, $fastestsectorcarclass, $sector . 'position', $sector . 'time', $sector . 'gap', $sector . 'name', $sector . 'car', $sector . 'carclass');
	
	return $smarty;
}

/*
* sort $time and let $name, $car, $carclass and $team follow
* display the result using the $smarty... parameters
* this method is called from : fastestlap, fastestsector and concistency
* @param lengte The length of the arrays
*/
function bubblesort($type, $db, $dbexport, $xml, $smarty, $lengte, $time, $name, $car, $carclass, $smartyposition, $smartytime, $smartygap, $smartyname, $smartycar, $smartycarclass) {
	$vlag = 1;
	
	for ($i = 1; $i < $lengte; $i++) {
		if ($vlag == 1) {
			$vlag = 0;
			for ($j = 0; $j < $lengte - $i; $j++) {
				if ($time[$j] > $time[$j +1]) {
					$vlag = 1;

					$hulptime = $time[$j +1];
					$time[$j +1] = $time[$j];
					$time[$j] = $hulptime;

					$hulpgap = $gap[$j +1];
					$gap[$j +1] = $gap[$j];
					$gap[$j] = $hulpgap;

					$hulpname = $name[$j +1];
					$name[$j +1] = $name[$j];
					$name[$j] = $hulpname;

					$hulpcar = $car[$j +1];
					$car[$j +1] = $car[$j];
					$car[$j] = $hulpcar;

					$hulpcarclass = $carclass[$j +1];
					$carclass[$j +1] = $carclass[$j];
					$carclass[$j] = $hulpcarclass;
				}
			}
		}
	}

	for ($i = 0; $i < $lengte; $i++) {
		$fastestposition[$i] = $i +1;
		if (($smartytime != "fastesttime") && ($smartytime != "stddevtime") && ($smartytime != "avgdevtime"))
			$time[$i] = convertToNormalTime($time[$i]);

		if ($i == 0)
			$gap[$i] = "/";
		else {
			if (($smartytime == "stddevtime") || ($smartytime == "avgdevtime"))
				$gap[$i] = $time[0] - $time[$i];
			else {
				$gap[$i] = computeDifference($time[0], $time[$i]);
			}
		}
	}
	$smarty->assign($smartyposition, $fastestposition);
	$smarty->assign($smartytime, $time);
	$smarty->assign($smartygap, $gap);
	$smarty->assign($smartyname, $name);
	$smarty->assign($smartycarclass, $carclass);
	$smarty->assign($smartycar, $car);
	
	return $smarty;
}

/*
* Fastest laps results
* @param xml the race xml
* @param smarty smarty object
* @param mr number of race sessions, only last session is used
*/
function fastestlap($xml, $smarty, $mr, $dbexport, $db) {
	$i = 0;
	foreach ($xml->document->raceresults[0]->race[$mr]->driver as $driver) {
		if ($driver->bestlaptime[0]->tagData != '') {
			$fastestname[$i] = $driver->name[0]->tagData;
			$fastesttime[$i] = $driver->bestlaptime[0]->tagData;
			$pos = strrpos($fastesttime[$i], ":");
			if ($pos === false) {
				$fastesttime[$i] = convertToNormalTime($fastesttime[$i]);
			}

			$fastestcar[$i] = $driver->cartype[0]->tagData;
			$fastestcarclass[$i] = $driver->carclass[0]->tagData;
			$i++;
		}
	}
	//sort and assign to smarty
   
	$smarty = bubblesort('fastestlaps', $db, $dbexport, $xml, $smarty, $i, $fastesttime, $fastestname, $fastestcar, $fastestcarclass, 'fastestposition', 'fastesttime', 'fastestgap', 'fastestname', 'fastestcar', 'fastestcarclass');
	
	return $smarty;
}

/*
* Overview of incidents
* @param xml race xml file
* @param smarty smarty object
* @param mr number of race sessions, only last session is used
*/
function incidents($xml, $smarty, $mr) {
	$i = 0;
	if ($xml->document->raceresults[0]->race[$mr]->stream[0] != null) { //if this is a raceresult file (and not a racecast file)
		foreach ($xml->document->raceresults[0]->race[$mr]->stream[0]->incident as $incident) {
			$gevonden = false;
			$itime[$i] = $incident->tagAttrs['et'];
			$incidentreport[$i] = $incident->tagData;
			for ($j = 0; $j < count($incidentnames); $j++) {
				if ($incidentnames[$j] == substr($incidentreport[$i], 0, strpos($incidentreport[$i], "("))) {
					$incidentcounter[$j]++;
					$gevonden = true;
				}
			}
			if (!$gevonden) {
				$incidentnames[count($incidentnames)] = substr($incidentreport[$i], 0, strpos($incidentreport[$i], "("));
				$incidentcounter[count($incidentnames) - 1] = 1;
			}
			$i++;
		}
		$smarty = incidentsort($incidentnames, $incidentcounter, $smarty);
	}

	$smarty->assign('itime', $itime);
	$smarty->assign('iincident', $incidentreport);
	
	return $smarty;
}

/*
* Complete chat
* @param xml race xml file
* @param smarty smarty object
* @param mr number of race sessions, only last session is used
*/
function chat($xml, $smarty, $mr) 
{
	$i = 0;
	if ($xml->document->raceresults[0]->race[$mr]->stream[0] != null) //if this is a raceresult file (and not a racecast file)
   { 
		foreach ($xml->document->raceresults[0]->race[$mr]->stream[0]->chat as $chat) 
      {
         $dubbelpuntPositie = strpos($chat->tagData, ':');
         
         if($dubbelpuntPositie === false)
         {
         }
         else
         {
            $ichattime[$i] = $chat->tagAttrs['et'];
            $ichatDriver[$i] = substr($chat->tagData, 0, $dubbelpuntPositie);
            $ichatMessage[$i] = substr($chat->tagData, $dubbelpuntPositie + 2);
            $i++;
         }
		}
	}
   $smarty->assign('ichattime', $ichattime);
	$smarty->assign('ichatDriver', $ichatDriver);
   $smarty->assign('ichatMessage', $ichatMessage);
	
	return $smarty;
}

/*
* Sort incidents... Highest incident count first
* This method is called from incidents
* @param names array of names of drivers involved in an incident
* @param counter array of numbers of incident these drivers made
* @param smarty smarty object
*/
function incidentsort($names, $counter, $smarty) {
	$vlag = 1;
	$lengte = count($names);

	for ($i = 1; $i < $lengte; $i++) {
		if ($vlag == 1) {
			$vlag = 0;
			for ($j = 0; $j < $lengte - $i; $j++) {
				if ($counter[$j] < $counter[$j +1]) {
					$vlag = 1;

					$hulpcounter = $counter[$j +1];
					$counter[$j +1] = $counter[$j];
					$counter[$j] = $hulpcounter;

					$hulpnames = $names[$j +1];
					$names[$j +1] = $names[$j];
					$names[$j] = $hulpnames;
				}
			}
		}
	}
	$smarty->assign('incidentnames', $names);
	$smarty->assign('incidentcounter', $counter);
	
	return $smarty;
}

/*
* Complete race result
* @param xml race xml file
* @param smarty smarty object
* @param mr number of race sessions, only last session is used
*/
function race($xml, $smarty, $mr, $dbexport, $db, $allersnelsteronde) 
{
	//overview
	foreach ($xml->document->raceresults[0]->race[$mr]->driver as $driver) {
		$i = (int) $driver->position[0]->tagData;
		$i--;
		$rpos[$i] = $i +1;
		$rnaam[$i] = $driver->name[0]->tagData;
		$rlaptime[$i] = $driver->finishtime[0]->tagData;
		$rlaptime[$i] = convertToNormalTime($rlaptime[$i]);
		if ($rlaptime[$i] == "00:00") //convert 00:00 to DNF
		{
			$reason = $driver->dnfreason[0]->tagData;		
			$rlaptime[$i] = "DNF (" . $reason . ")";
		}
		$rcar[$i] = $driver->cartype[0]->tagData;
		$rcarclass[$i] = $driver->carclass[0]->tagData;
		$rpenalty[$i] = $driver->penaltymass[0]->tagData;
		if($rpenalty[$i]=="") $rpenalty[$i] = "0";
		$rlaps[$i] = $driver->laps[0]->tagData;

		$lapsfound = 0;
		$rpit[$i] = " (";

		if ($driver->lap[0] != null) 
		{		
			foreach ($driver->lap as $Lap) 
			{
				if ($Lap->tagAttrs['pit'] == "1") 
				{
					$rpit[$i] .= "L" . $Lap->tagAttrs['num'] . ", ";
					$lapsfound++;
				}
			}
		}
		if ($lapsfound != 0)
		{
			$rpit[$i] = substr($rpit[$i], 0, strlen($rpit[$i]) - 2);
		}
		$rpit[$i] = $lapsfound . $rpit[$i] . ")";
	}

	//compute the gaps
	for ($i = 0; $i < count($rlaptime); $i++) {
		if ($i == 0)
			$rgap[$i] = "/";
		else
			if ($rlaps[0] == $rlaps[$i]) {
				$rgap[$i] = computeDifference($rlaptime[0], $rlaptime[$i]);
			} else {
				$lapsdown = $rlaps[$i] - $rlaps[0];
				$rgap[$i] = $lapsdown . "laps";
			}
	}
	if($dbexport == 'true')
	{
		doexport($db, $rpos, $rnaam, $rlaptime, $rcar, $rcarclass, $rteam, $rlaps, $rpit, $xml, 'raceresults');
	}

	$smarty->assign('rpos', $rpos);
	$smarty->assign('rnaam', $rnaam);
	$smarty->assign('rlaptime', $rlaptime);
	$smarty->assign('rcar', $rcar);
	$smarty->assign('rcarclass', $rcarclass);
	$smarty->assign('rteam', $rteam);
	$smarty->assign('rpenalty', $rpenalty);
	$smarty->assign('rlaps', $rlaps);
	$smarty->assign('rpit', $rpit);
	$smarty->assign('rgap', $rgap);

	//lap detail for each driver ; sorted by finishing position
	foreach ($xml->document->raceresults[0]->race[$mr]->driver as $driver) {
		$i = (int) $driver->position[0]->tagData;
		$i--;
		$rdetailnaam[$i] = $driver->name[0]->tagData;
		$j = 0;
		if ($driver->lap[0] != null) {
			foreach ($driver->lap as $Laps) {
				$rlapnumber[$i][$j] = $j +1;
				$rdetails1[$i][$j] = convertToNormalTime($Laps->tagAttrs['s1']);
				if ($rdetails1[$i][$j] == "00:00") //if time was not measured replace with unknown
					$rdetails1[$i][$j] = "unknown";
				$rdetails2[$i][$j] = convertToNormalTime($Laps->tagAttrs['s2']);
				if ($rdetails2[$i][$j] == "00:00")
					$rdetails2[$i][$j] = "unknown";
				$rdetails3[$i][$j] = convertToNormalTime($Laps->tagAttrs['s3']);
				if ($rdetails3[$i][$j] == "00:00")
					$rdetails3[$i][$j] = "unknown";
				
				$rdetaillap[$i][$j] = convertToNormalTime($Laps->tagData);
            $rfuellevel[$i][$j] = ((float)$Laps->tagAttrs['fuel']) * 100;
            $rfuellevel[$i][$j] .= "&#37;";
				
				if($rdetaillap[$i][$j] == "00:00.---")
				{
					echo "<B>WARNING:</B><BR>Unknown laptime for lap " . $j . " of  " . $rdetailnaam[$i] . ".<BR>Replaced with laptime from lap " . ($j - 1) . ".<BR>This means that the racehistory graph, lapbylapgraph and the consistency tables will be slightly incorrect for this driver.<br><br>";
					$rdetaillap[$i][$j] = "unknown";
				}
				else
				{
                  $verschil = computeDifference($allersnelsteronde, $rdetaillap[$i][$j]);
                  if($verschil == 1) $rdetaillap[$i][$j] = "<span class=\"darkred\">" . $rdetaillap[$i][$j] . "</span>";	
	               else if($verschil < 0.500)
	               {
	                  $rdetaillap[$i][$j] = "<span class=\"lightgreen\">" . $rdetaillap[$i][$j] . "</span>";	
	               }
	               else
	               {
	               	  $snelsterondepiloot = zoekSnelsteRondePiloot($driver);
	               	  $verschil = (float)computeDifference($snelsterondepiloot, $rdetaillap[$i][$j]);
                       
	               	  if($verschil < 0.500)
	               	  {
	               	  	$rdetaillap[$i][$j] = "<span class=\"green\">" . $rdetaillap[$i][$j] . "</span>";	
	               	  }	
	               	  else if($verschil < 1.500)
	               	  {
	               	  	$rdetaillap[$i][$j] = "<span class=\"orange\">" . $rdetaillap[$i][$j] . "</span>";	
	               	  }	
	               	  else if($verschil < 3.000)
	               	  {
	               	  	$rdetaillap[$i][$j] = "<span class=\"red\">" . $rdetaillap[$i][$j] . "</span>";	
	               	  }	
	               	  else
	               	  {
	               	  	$rdetaillap[$i][$j] = "<span class=\"darkred\">" . $rdetaillap[$i][$j] . "</span>";	
	               	  }	
	               }
				}
				
				$j++;
			}
		}
		$i++;
	}
	$smarty->assign('rdetailnaam', $rdetailnaam);
	$smarty->assign('rdetaillap', $rdetaillap);
	$smarty->assign('rlapnumber', $rlapnumber);
	$smarty->assign('rdetails1', $rdetails1);
	$smarty->assign('rdetails2', $rdetails2);
	$smarty->assign('rdetails3', $rdetails3);
   $smarty->assign('rfuellevel', $rfuellevel);
	
	return $smarty;
}

/**
 * Overview van swaps
 */
function swap($xml, $smarty, $mr) 
{
	$swapped = "false";
	$i=0;
	foreach ($xml->document->raceresults[0]->race[$mr]->driver as $driver)
	{
		if ($driver->swap[0] != null) 
		{
			$swapnaam[$i] = $driver->name[0]->tagData;
			$j=0;
			foreach($driver->swap as $swap)
			{
				$swapdetailstartlap[$i][$j] = "L" . $swap->tagAttrs['startlap'];
				$swapdetailendlap[$i][$j] = "L" . $swap->tagAttrs['endlap'];
				$swapdetaildriver[$i][$j] = $swap->tagData;
				$j++;
				$swapped = "true";
			}
			$i++;
		}
	}
	$smarty->assign('swapped', $swapped);	
	$smarty->assign('swapnaam', $swapnaam);
	$smarty->assign('swapdetailstartlap', $swapdetailstartlap);
	$smarty->assign('swapdetailendlap', $swapdetailendlap);	
	$smarty->assign('swapdetaildriver', $swapdetaildriver);
	
	return $smarty;
}

function zoekSnelsteRondePiloot($driver)
{
	$snelste = 999999;
	foreach ($driver->lap as $Laps) 
	{
		$tijd = $Laps->tagData;
		if($tijd < $snelste) $snelste = $tijd;	
	}	
	return convertToNormalTime($snelste);
}

/*
* Complete qualification results
* @param xml the qualification xml
* @param smarty Smarty object
* @param mq number of qualification sessions, only last session is used
*/
function qualification($xml, $smarty, $mq, $dbexport, $db) {
	//overview
	if ($mq != -1) {
		foreach ($xml->document->raceresults[0]->qualify[$mq]->driver as $driver) {
			$i = (int) $driver->position[0]->tagData;
			$i--;
			$positie = $i +1;
			$qpos[$i] = $positie;
			$qnaam[$i] = $driver->name[0]->tagData;
			$qlaptime[$i] = $driver->bestlaptime[0]->tagData;

			$pos = strrpos($qlaptime[$i], ":"); //if laptime does not contain : convert to normal laptime
			if ($pos == false) {
				$qlaptime[$i] = convertToNormalTime($qlaptime[$i]);
			}
			$qcar[$i] = $driver->cartype[0]->tagData;
			$qcarclass[$i] = $driver->carclass[0]->tagData;
			$qpenalty[$i] = $driver->penaltymass[0]->tagData;
			if($qpenalty[$i] == "") $qpenalty[$i] = "0";
			$qlaps[$i] = $driver->laps[0]->tagData;
			if($qlaptime[$i] == "00:00")
			{
				$qlaptime[$i] = "no laptime";
			}
		}
	}
	//compute gaps
	for ($tel = 0; $tel < count($qlaptime); $tel++) {
		if ($tel == 0)
			$qgap[$tel] = "/"; //for the pole driver the gap is /
		else 
		{
			if($qlaptime[$tel] == "no laptime")
			{
				$qgap[$tel] = "no laptime";
			}
			else
			{
				$qgap[$tel] = computeDifference($qlaptime[0], $qlaptime[$tel]);
			}
		}
	}
	
	$smarty->assign('qpos', $qpos);
	$smarty->assign('qnaam', $qnaam);
	$smarty->assign('qlaptime', $qlaptime);
	$smarty->assign('qgap', $qgap);
	$smarty->assign('qcar', $qcar);
	$smarty->assign('qcarclass', $qcarclass);
	$smarty->assign('qpenalty', $qpenalty);
	$smarty->assign('qlaps', $qlaps);

	//lap by lap detail for each driver ; sorted by qualificationposition
	if ($mq != -1) {
		foreach ($xml->document->raceresults[0]->qualify[$mq]->driver as $driver) {
			$i = (int) $driver->position[0]->tagData;
			$i--;
			$qdetailnaam[$i] = $driver->name[0]->tagData;
			$j = 0;
			if($driver->lap != null)
			{
				foreach ($driver->lap as $Laps) {
					$qlapnumber[$i][$j] = $j +1;
					$qdetails1[$i][$j] = convertToNormalTime($Laps->tagAttrs['s1']);
					if ($qdetails1[$i][$j] == "00:00")
						$qdetails1[$i][$j] = "unknown";
					$qdetails2[$i][$j] = convertToNormalTime($Laps->tagAttrs['s2']);
					if ($qdetails2[$i][$j] == "00:00")
						$qdetails2[$i][$j] = "unknown";
					$qdetails3[$i][$j] = convertToNormalTime($Laps->tagAttrs['s3']);
					if ($qdetails3[$i][$j] == "00:00")
						$qdetails3[$i][$j] = "unknown";
					$qdetaillap[$i][$j] = convertToNormalTime($Laps->tagData);
					if ($qdetaillap[$i][$j] == "00:00.---")
						$qdetaillap[$i][$j] = "incomplete lap";
               $qfuellevel[$i][$j] = ((float)$Laps->tagAttrs['fuel']) * 100;
               $qfuellevel[$i][$j] .= "&#37;";
					$j++;
				}
			}
		}
	}
	$smarty->assign('qdetailnaam', $qdetailnaam);
	$smarty->assign('qdetaillap', $qdetaillap);
	$smarty->assign('qlapnumber', $qlapnumber);
	$smarty->assign('qdetails1', $qdetails1);
	$smarty->assign('qdetails2', $qdetails2);
	$smarty->assign('qdetails3', $qdetails3);
   $smarty->assign('qfuellevel', $qfuellevel);
	
	return $smarty;
}

/*
* Builds the overview part of the report
* @param qualyxml the qualification xml file
* @param racexml the race xml file
* @param smarty smarty object
* @param mq number of qualification sessions, only last session is used
* @param mr number of race sessions, only last session is used
*/
function overview($qualyxml, $racexml, $smarty, $mq, $mr) {
	$serverName = $qualyxml->document->raceresults[0]->servername[0]->tagData;
	$date = $qualyxml->document->raceresults[0]->timestring[0]->tagData;
	$track = $qualyxml->document->raceresults[0]->trackcourse[0]->tagData;
	$distance = $qualyxml->document->raceresults[0]->tracklength[0]->tagData;
	$mod = $qualyxml->document->raceresults[0]->mod[0]->tagData;
	$mod = substr($mod, 0, strpos($mod, '.'));
	$laps = $racexml->document->raceresults[0]->racelaps[0]->tagData;
	$time = $racexml->document->raceresults[0]->racetime[0]->tagData;
	//pole
	if ($mq != -1) {
		foreach ($qualyxml->document->raceresults[0]->qualify[$mq]->driver as $driver) {
			if ($driver->position[0]->tagData == "1") {
				$poledriver = $driver->name[0]->tagData;
				$poletime = $driver->bestlaptime[0]->tagData;
				$poletime = convertToNormalTime($poletime);
				break;
			}
		}
	}
	//winner
	foreach ($racexml->document->raceresults[0]->race[$mr]->driver as $driver) {
		if ($driver->position[0]->tagData == "1") {
			$winnerdriver = $driver->name[0]->tagData;
			$winnertime = $driver->finishtime[0]->tagData;
			$winnertime = convertToNormalTime($winnertime);
			break;
		}
	}

	$smarty->assign('serverName', $serverName);
	$smarty->assign('date', $date);
	$smarty->assign('track', $track);
	$smarty->assign('laps', $laps);
	$smarty->assign('time', $time);
	$smarty->assign('poledriver', $poledriver);
	$smarty->assign('poletime', $poletime);
	$smarty->assign('winnerdriver', $winnerdriver);
	$smarty->assign('winnertime', $winnertime);
	$smarty->assign('distance', $distance);
	$smarty->assign('mod', $mod);

	//search fastest lap
	$fastestlaptime = "9999:99.999";
	foreach ($racexml->document->raceresults[0]->race[$mr]->driver as $driver) {
		if ($driver->bestlaptime[0]->tagData != '') {
			if ($driver->bestlaptime[0]->tagData < $fastestlaptime) {
				$fastestlapdriver = $driver->name[0]->tagData;
				$fastestlaptime = $driver->bestlaptime[0]->tagData;
			}
		}
	}
	$fastestlaptime = convertToNormalTime($fastestlaptime);
	$smarty->assign('fastestlapdriver', $fastestlapdriver);
	$smarty->assign('fastestlaptime', $fastestlaptime);
	
	return $smarty;
}

function zoekSnelsteRonde($racexml, $mr)
{
	//search fastest lap
	$fastestlaptime = "9999:99.999";
	foreach ($racexml->document->raceresults[0]->race[$mr]->driver as $driver) {
		if ($driver->bestlaptime[0]->tagData != '') {
			if ($driver->bestlaptime[0]->tagData < $fastestlaptime) {
				$fastestlapdriver = $driver->name[0]->tagData;
				$fastestlaptime = $driver->bestlaptime[0]->tagData;
			}
		}
	}
	$fastestlaptime = convertToNormalTime($fastestlaptime);
	
	return $fastestlaptime;
}

/*
* Computes te difference from 2 times
* @param time1 a time in format mm:ss.ttt
* @param time2 a time in format mm:ss.ttt
* @return difference between these two times
*/
function computeDifference($time1, $time2) 
{
	$duizensten1 = substr($time1, strpos($time1, '.') + 1);
	$duizensten2 = substr($time2, strpos($time2, '.') + 1);
   
	$aantal1 = substr_count($time1 ,":");
	$aantal2 = substr_count($time2 ,":");
   
	if($aantal1 == 1)$seconden1 = substr($time1, strrpos($time1, ':') + 1, strpos($time1, '.') - 2);
	else $seconden1 = substr($time1, strrpos($time1, ':') + 1, strpos($time1, '.') - 4);
	if($aantal2 == 1)$seconden2 = substr($time2, strrpos($time2, ':') + 1, strpos($time2, '.') - 2);
	else $seconden2 = substr($time2, strrpos($time2, ':') + 1, strpos($time2, '.') - 4);
   
	if ($aantal1 == 1) $minuten1 = substr($time1, 0, strpos($time1, ':'));
	else $minuten1 = substr($time1, strpos($time1, ':') + 1, strrpos($time1, ':') - 2);

	if ($aantal2 == 1)$minuten2 = substr($time2, 0, strpos($time2, ':'));
	else $minuten2 = substr($time2, strpos($time2, ':') + 1, strrpos($time2, ':') - 2);

	if ($aantal1 == 1) $uren1 = 0;
	else $uren1 = substr($time1, 0, strpos($time1, ':'));

	if ($aantal2 == 1) $uren2 = 0;
	else $uren2 = substr($time2, 0, strpos($time2, ':'));

	$duizensten = $duizensten2 - $duizensten1;
   
	if ($duizensten < 0) {
		$duizensten = 1000 + $duizensten;
		$seconden = $seconden2 - $seconden1 -1;
	} else {
		$seconden = $seconden2 - $seconden1;
	}
   
	if ($seconden < 0) {
		$seconden = 60 + $seconden;
		$minuten = $minuten2 - $minuten1 -1;
	} else {
		$minuten = $minuten2 - $minuten1;
	}
   
	if($minuten < 0)
	{
		$minuten = 60 + $minuten;
		$uren = $uren2 - $uren1 - 1;
	}
	else
	{
		$uren = $uren2 - $uren1;
	}
   
	if ($duizensten < 10)
		(string) $duizensten = "00" . (string) $duizensten;
	else
		if ($duizensten < 100)
			(string) $duizensten = "0" . (string) $duizensten;

	if (($seconden < 10) && ($seconden > 0))
		(string) $seconden = "0" . (string) $seconden;


   if($seconden == 0) (string)$seconden = "00";

	if ($minuten < 10)
		(string) $minuten = "0" . (string) $minuten;
      
   if($minuten == 0) (string) $minuten = "00";

	if ($uren != 0)
	{
		$verschil = $uren . ":" . $minuten . ":" . $seconden . "." . $duizensten;
	}
	else if (($uren == 0) && ($minuten != 0))
	{
		$verschil = $minuten . ":" . $seconden . "." . $duizensten;
	}
	else
	{
		$verschil = $seconden . "." . $duizensten;
	}

	return $verschil;
}

/*
* Converts a time in seconds to a normal time with minutes
* @param seconds A time in seconds
* @return a formatted time with hours:minutes:seconds.thousands
*/
function convertToNormalTime($seconds) {
	$hours = intval($seconds / 3600);
	$minutes = intval(($seconds - ($hours * 3600)) / 60);
	$seconden = (int)($seconds - (($hours * 3600) + ($minutes * 60)));
	$rest = substr($seconds, strpos($seconds, '.'));
	$rest = substr($rest, 0, 4);

	if (strlen($minutes) == 1)
		$minutes = "0" . $minutes;
	if (strlen($seconden) == 1)
		$seconden = "0" . $seconden;

	if ($hours != 0)
		$time = $hours . ":" . $minutes . ":" . $seconden . $rest;
	else
		$time = $minutes . ":" . $seconden . $rest;
		
	return $time;
}

/*
* Initialize the Smarty template engine
*/
function setupSmarty() {
	require ('./smarty/Smarty.class.php');

	$smarty = new Smarty();

	$smarty->template_dir = 'smarty_templates';
	$smarty->compile_dir = 'smarty_templates_c';
	$smarty->cache_dir = 'smarty_cache';
	$smarty->config_dir = 'smarty_config';

	return $smarty;
}
?>
