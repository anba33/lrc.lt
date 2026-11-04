<?php

/**
*(c)2006 Frank Wynants
*
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
* This script build racehistory graph
*/

ini_set('zend.ze1_compatibility_mode', 0);
require_once ("lib/tools.php");
require_once ("lib/xmlphp4.php");

$racefile = $_REQUEST['file']; //V1.070 result file
$startlap = $_REQUEST['startlap'];
$endlap = $_REQUEST['endlap'];

$racexmlstring = file_get_contents($racefile);
$xml = new XMLParser($racexmlstring);
$xml->Parse();

//$mr = number of racestarts ; we only use last race as other starts are due to restarts
$mr = 0;
foreach ($xml->document->raceresults[0]->race as $abc) {
	$mr++;
}
$mr--;

racehistory($xml, $mr, $startlap, $endlap);

/**
 * @param xml the resultfile
 * @param mr number of races
 * @return average racetime of winner
 */
function berekengemiddelderondetijdwinnaar($xml, $mr) {
	foreach ($xml->document->raceresults[0]->race[$mr]->driver as $driver) {
		if ($driver->position[0]->tagData == "1") {
			foreach ($driver->lap as $lap) 
			{
				if($lap->tagData == "--.----") //if time is missing from racereport take previous time
				{
					$totaltime += $previous; //compute totaltime
				}
				else
				{
					$totaltime += (float) $lap->tagData;
					$previous = (float) $lap->tagData;
				}
				$laps = $lap->tagAttrs['num'];
			}

			$gemiddeld = $totaltime / ($laps);
			return $gemiddeld;
		}
	}
}

/**
* plot the gaph
* @param tijd average totaltime for each driver and lap
* @param name names of each driver
* @param lengte number of laps
*/
function maakracehistorygraph($tijd, $name, $lengte, $startlap) 
{
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
	$graph = new Graph(1024, berekenHoogte($tijd), "auto");
	$graph->SetScale("textlin");
	
	// set font
	$graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);
	$graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD);
	// set titles
	$graph->title->Set('Race history graph');
	$graph->yaxis->title->Set("Seconds behind average fastest lap");
	$graph->xaxis->title->Set("Lap");
	//set shadow
	$graph->SetShadow();
	//margin instellen
	$graph->img->SetMargin(40, 200, 20, 40);

	// Create the linear plot
	for ($i = 0; $i < $lengte; $i++) 
	  {
		$lineplot[$i] = new LinePlot($tijd[$i]);
	
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

	$graph->legend->Pos(0.02, 0.5, "right", "center");
	$graph->ygrid->Show(true, true);
	$graph->xgrid->Show(true, false);
	//$graph->ygrid->SetFill(true,'#CCFFFF','#CCFFCC');
	// Display the graph
	$graph->legend->SetMarkAbsSize(20);
	$graph->legend->SetLineWeight(3);
	
	$graph->xaxis->SetTickLabels($labels);
	
	if($_REQUEST['highlight'] == null || $_REQUEST['highlight'] == '') $graph->img->SetAntiAliasing(); 
	
	$graph->Stroke();
}

function berekenHoogte($positions)
{
   $hoogte = 0;
   for($i=0;$i<count($positions);$i++)
   {
      for($j=0;$j<count($positions[$i]);$j++)
      {
         if($positions[$i][$j] != null)
         {
            if($positions[$i][$j] < $hoogte) $hoogte = $positions[$i][$j];
            //echo "positions[" . $i . "][" . $j . "] = " . $positions[$i][$j] . "<br>";
            //echo "hoogte = $hoogte<br>";
         }
      }
   }
   $hoogte = abs((int)$hoogte) * 2.5;
   if($hoogte < 768) $hoogte = 768;
   return $hoogte;
}

/*
* main function
*/
function racehistory($xml, $mr, $startlap, $endlap) {
   $endlap++;
	$aantal = 0;

   if($endlap <= $startlap)
   {
      $startlap = null;
      $endlap = null;
   }
   
	$gemiddelderondetijdwinnaar = berekengemiddelderondetijdwinnaar($xml, $mr);
	foreach ($xml->document->raceresults[0]->race[$mr]->driver as $driver) //for each driver
		{
		$i = (int) $driver->position[0]->tagData;
		if ($i > $aantal)
			$aantal = $i;
		$i--;
		$name[$i] = $driver->name[0]->tagData; //set drivername
		$j = 0;
		$tijd[$i][0] = 0.0;
		$totaltime = 0.0;
		if ($driver->lap[0] != null) {
			foreach ($driver->lap as $lap) //for each lap of this driver
			{
				if($lap->tagData == "--.----") //if time is missing from racereport take previous time
				{
					$totaltime += $previous; //compute totaltime
				}
				else
				{
					$totaltime += (float) $lap->tagData; //compute totaltime
					$previous = (float) $lap->tagData;
				}
				$totaltimegemiddeldwinnaar = $gemiddelderondetijdwinnaar * ($j +1); //compute average time of winner for these number of laps
				$tijd[$i][$j +1] = $totaltimegemiddeldwinnaar - $totaltime; //compute difference with winnertime
	
				$j++;
			}
		}
	}
   if(($endlap == null) || ($startlap == null))
   {
      maakracehistorygraph($tijd, $name, $aantal, $startlap);
   }
   else
   {
      for($i = 0;$i<count($tijd);$i++) //piloten
      {
         $teller = 0;
         for($j = $startlap;$j<$endlap;$j++) //rondes
         { 
            $realtijd[$i][$teller] = $tijd[$i][$j];
            $teller++;
         }
      }      
      maakracehistorygraph($realtijd, $name, $aantal, $startlap);
   }
}?>
