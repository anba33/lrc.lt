<?php
/**
 * this script contains all the function uses by the dbexport
 */
/*
* Make a connection with the database
*/

/**
 * Export qualification results to database
 */
function doexport($db, $pos, $naam, $laptime, $car, $carnumber, $team, $laps, $pits, $xml, $type)
{
	$servername = $xml->document->raceresults[0]->servername[0]->tagData;
	$trackname = $xml->document->raceresults[0]->trackcourse[0]->tagData;

	$rfactorreportid = time();
	$exported = 'false';
	
	for ($i = 0; $i < count($pos); $i++) {
		if(($type=='qualificationresults') || ($type=='fastestlaps') || ($type=='fastests1') || ($type=='fastests2') || ($type=='fastests3'))
		{
			$insertquery = "insert into $type (rfactorreportid, servername, trackname, " .
					       "position, drivername, carnumber, cartype, team, time, exported) " .
					       "values($rfactorreportid, '$servername', '$trackname', $pos[$i], '$naam[$i]', $carnumber[$i]," .
					       "'$car[$i]', '$team[$i]', '$laptime[$i]', '$exported')";
		}
		else if($type=='raceresults')
		{
			$insertquery = "insert into $type (rfactorreportid, servername, trackname, " .
					       "position, drivername, carnumber, cartype, team, time, laps, pitstops, exported) " .
					       "values($rfactorreportid, '$servername', '$trackname', $pos[$i], '$naam[$i]', $carnumber[$i]," .
					       "'$car[$i]', '$team[$i]', '$laptime[$i]', $laps[$i], '$pits[$i]', '$exported')";
		}
		mysql_query($insertquery,$db);	
	}
	echo "exported with rfactorreportid = $rfactorreportid<br>";
}

/**
 * initialise db
 */
function initDatabase($dbExport) {
	if($dbExport == 'true')
	{
		require_once('dbsettings.php');
		$db = mysql_connect($mysql_host,$mysql_user,$mysql_password);
		mysql_select_db($mysql_dbname, $db);
		return $db;
	}
} 
?>
