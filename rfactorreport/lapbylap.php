<?php


/**
*(c)2006 Frank Wynants
* rFactor-report uses the Mozilla Public License 1.1 (MPL 1.1). 
* This means that it is against the law to take parts of 
* rFactor-report and use them in your own project, 
* unless you make your own project open-source to, 
* or if your own project also uses some proprietry libraries.
*
* When making changes to rFactor-report I encourage you to 
* commit those changes back to the project and not to make your 
* own version of rFactor-report (note that if you make your own 
* version of rFactor-report you are obliged to make it open-source).
*
* This script generates the lapbylap graph
*/

ini_set('zend.ze1_compatibility_mode', 0);

require_once ("lib/tools.php");
require_once ("lib/xmlphp4.php"); //php4 xml parser tool

//read the given xml
$racefile = $_REQUEST['file']; //V1.070 result file
$racexmlstring = file_get_contents($racefile);
$xml = new XMLParser($racexmlstring);
$xml->Parse();
$startlap = $_REQUEST['startlap'];
$endlap = $_REQUEST['endlap'];
$highlight = $_REQUEST['highlight'];

//$mr = number of races -> we only parse last race (earlier races are due to restarts)
$mr = 0;

foreach ($xml->document->raceresults[0]->race as $abc) {
	$mr++;
}
$mr--;

lapbylap($xml, $mr, $startlap, $endlap);

/**
 * Callback to negate the argument
 */
function _cb_negate($aVal) {
	return - $aVal;
}

/**
* plot the grap
* @param postions double array of positions index 1 = driver ; index 2 = lap
* @param name array of names of drivers
* @param lengte number of drivers 
*/
function maaklapbylaphistorygraph($positions, $name, $lengte, $startlap) {
	//set colors
   
   if($startlap == null) $startlap = 0;
   
	$kleur[0] = "violet";
	$kleur[1] = "black";
	$kleur[2] = "blue";
	$kleur[3] = "peachpuff4";
	$kleur[4] = "red";
	$kleur[5] = "gray";
	$kleur[6] = "teal";
	$kleur[7] = "chocolate1";
	$kleur[8] = "darkgreen";
	$kleur[9] = "darkolivegreen3";
	$kleur[10] = "chartreuse";
	$kleur[11] = "cornflowerblue";
	$kleur[12] = "darkblue";
	$kleur[13] = "darkgray";
	$kleur[14] = "darkgoldenrod2";
	$kleur[15] = "darkmagenta";
	$kleur[16] = "darkslategray";
	$kleur[17] = "deeppink2";
	$kleur[18] = "deeppink4";
	$kleur[19] = "firebrick";
	$kleur[20] = "indianred3";
	$kleur[21] = "ivory4";
	$kleur[22] = "limegreen";
	$kleur[23] = "mediumpurple3";
	$kleur[24] = "navy";
	$kleur[25] = "orange4";
	$kleur[26] = "palegreen4";
	$kleur[27] = "palevioletred";
	$kleur[28] = "peru";
	$kleur[29] = "peachpuff4";
	$kleur[30] = "salmon";
	$kleur[31] = "sienna4";
	$kleur[32] = "steelblue4";
	$kleur[33] = "tomato";
	$kleur[34] = "violet";
	$kleur[35] = "violetred4";
	$kleur[36] = "wheat3";
	$kleur[37] = "wheat4";

	include ("lib/jpgraph.php");
	include ("lib/jpgraph_line.php");

	// Create the graph.
	$graph = new Graph(1024, 768, "auto");

	$graph->SetScale("textint");
   
	// set font
	$graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);
	$graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD);
	// set titles
	$graph->title->Set('Lap by lap graph');
	$graph->yaxis->title->Set("Position");
	$graph->xaxis->title->Set("Lap");
	//set shadow
	$graph->SetShadow();
	//set margin
	$graph->img->SetMargin(40, 200, 20, 40);

	// Create the linear plot
	for ($i = 0; $i < $lengte; $i++) 
   	{
		$lineplot[$i] = new LinePlot($positions[$i]);

		if(strpos($name[$i], $_REQUEST['highlight']) !== false)
		{
			$lineplot[$i]->SetWeight(3);
		}	
		else
		{
			$lineplot[$i]->SetWeight(1);
		}
		$lineplot[$i]->SetColor($kleur[$i]);
		$lineplot[$i]->SetLegend($name[$i]);
		// Add the plot to the graph
		$graph->Add($lineplot[$i]);
	}

   	for($i =0;$i<1000;$i++)
	{
		$labels[$i] = $startlap + $i;
	}
   

	$graph->xaxis->SetPos('max');
	$graph->yaxis->SetLabelFormatCallback("_cb_negate"); //set reverse graph 
	$graph->legend->Pos(0.02, 0.5, "right", "center");
	$graph->ygrid->Show(true, false);
	$graph->xgrid->Show(true, false);
	// Display the graph
	$graph->legend->SetMarkAbsSize(20);
	$graph->legend->SetLineWeight(3);
	
	$graph->xaxis->SetTickLabels($labels);
	
	if($_REQUEST['highlight'] == null || $_REQUEST['highlight'] == '') $graph->img->SetAntiAliasing(); 
	
	$graph->Stroke();
}

/*
* compute the position of each driver for each lap and return as a double array
* @param tijd totaltime for each driver and each lap in double array; index1 = driver ; index2 = lap
* @param rijderslengte number of drivers
* @param rondeslengte number of laps
* @param xml the result xml
* @param name array of names of drivers
* @param mr number of racestarts. We only use last race
*/
function berekenPositions($tijd, $rijderslengte, $rondeslengte, $xml, $name, $mr) {
	for ($i = 0; $i < $rijderslengte; $i++) //for each driver
		{
		for ($j = 0; $j < $rondeslengte; $j++) //for each lap
			{
			$positie[$i][$j] = 1;

			if ($j == 0) //if first lap
				{
				foreach ($xml->document->raceresults[0]->race[$mr]->driver as $driver) //search driver name by looping each driver
					{
					if ($driver->name[0]->tagData == $name[$i]) //if drivername was found set position to gridposition
						{
						$pos = $driver->gridpos[0]->tagData; //1st lap --> position = GridPos
						$positie[$i][$j] = (int) $pos;
					}
				}
			} else //if not first lap
				{
				for ($k = 0; $k < $rijderslengte; $k++) {
					if (($tijd[$i][$j] > $tijd[$k][$j]) && ($tijd[$k][$j] != 0)) {
						$positie[$i][$j]++; //if laptime found less then this driver laptime position++
					}
					if ($tijd[$i][$j] == 0) {
						$positie[$i][$j] = null; //if driver crashed no position
					}
				}
			}
			if ($positie[$i][$j] != null)
			{
				$positie[$i][$j] = - $positie[$i][$j];
				if($positie[$i][$j] == -1) $positie[$i][$j] = -1.1;
			}
		}
	}

	return $positie;
}

/**
* build lap by lap graph
* @param xml the xml
* @param mr number of racestarts. We only use last race
*/
function lapbylap($xml, $mr, $startlap, $endlap) 
{
	$aantal = 0;
   $endlap++;
   
   if($endlap <= $startlap)
   {
      $startlap = null;
      $endlap = null;
   }
   
	foreach ($xml->document->raceresults[0]->race[$mr]->driver as $driver) //for each driver
		{
		$i = (int) $driver->position[0]->tagData; //get the finishing position of the driver
		if ($i > $aantal)
			$aantal = $i; //if the finishposition is higher then the number of drivers
		$i--; //substract 1 to get correct position
		$name[$i] = $driver->name[0]->tagData; //get name of the driver
		$j = 0; //$j = lap --> start with first lap
		$tijd[$i][0] = 0.0; //time in lap 0 is 0.0

		if ($driver->lap[0] != null) {
			foreach ($driver->lap as $lap) //for each lap of this driver
			{
				if($lap->tagData == "--.----") //if time is missing from racereport take previous time
				{
					$tijd[$i][$j +1] = (float) $tijd[$i][$j] + $previous; //compute total time
				}
				else
				{
					$tijd[$i][$j +1] = (float) $tijd[$i][$j] + (float) $lap->tagData; //compute total time
			 		$previous = (float) $lap->tagData;
				}
				if ($lap == 0)
					$tijd[$i][$j +1] = 0; //if driver crashed in this lap set totaltime to 0
				$j++;
			}
		}
		if ($i == 0)
			$aantallaps = $j +1;
	}
	$positions = berekenPositions($tijd, $aantal, $aantallaps, $xml, $name, $mr); //compute the positions for each driver each lap
   
   $teller = 0;
   
   if(($endlap == null) || ($startlap == null))
   {
      maaklapbylaphistorygraph($positions, $name, $aantal, $startlap); //make a graph of this
   }
   else
   {
      for($i = 0;$i<count($positions);$i++) //piloten
      {
         $teller = 0;
         for($j = $startlap;$j<$endlap;$j++) //rondes
         { 
            $realpositions[$i][$teller] = $positions[$i][$j];
            $teller++;
         }
      }
      
      maaklapbylaphistorygraph($realpositions, $name, $aantal, $startlap); //make a graph of this
   }
}
?>
