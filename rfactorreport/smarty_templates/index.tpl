<body>
        <div id="container">

                <ul id="menu">
                        <li><a href="#overview">Apžvalga</a></li>
                        <li><a href="#qualificationRules">Kvalifikacija</a></li>
                        <li><a href="#raceResults">Lenktynės</a></li>
                        <li><a href="#raceLeaders">Lyderiai</a></li>
                        <li><a href="#fastestLaps">Greičiausi ratai</a></li>
                        <li><a href="#highestClimbers">Atkovotos pozicijos</a></li>
                        <li><a href="#laptimeConsistency">Pastovumas</a></li>
                        <li><a href="#raceHistoryGraph">Lenktynių grafikas</a></li>
                        <li><a href="#lapByLapGraph">Detalus grafikas</a></li>
                        <li><a href="#raceIncidents">Incidentai</a></li>
                        
                </ul>


                <div id="overview" class="section">
                        <h2>Apžvalga</h2>
                        <dl>
                                <dt>Serveris:</dt>      <dd>{$serverName}</dd>
                                <dt>Data:</dt> <dd>{$date}</dd>
                                <dt>Trasa:</dt> <dd>{$track} <em>({$distance} metrai)</em></dd>
                                <dt>Modifikacija:</dt> <dd>{$mod}</dd>
                                <dt>Ratų skaičius:</dt> <dd>{$laps}</dd>
                                <dt>Laikas:</dt> <dd>{$time}</dd>
                                <dt>Pole:</dt> <dd>{$poledriver} <em>({$poletime})</em></dd>
                                <dt>Nugalėtojas:</dt> <dd>{$winnerdriver} <em>({$winnertime})</em></dd>
                                <dt>Greičiausias:</dt> <dd>{$fastestlapdriver} <em>({$fastestlaptime})</em></dd>
                                <dt>Ilgiausiai pirmavo:</dt> <dd>{$mostlapsleddriver} <em>({$mostlapsledlaps} ratų)</em></dd>
                                <dt>Pozicijos +/- :</dt> <dd>{$highestclimber} <em>({$highestclimberposition} laimėtos pozicijos)</em></dd>
                        </dl>
                </div><!--overview-->


                <div id="qualificationRules" class="section">

                        <h2>Kvalifikacijos rezultatai - {$track} - {$serverName} </h2>

                        <h3>Apžvalga</h3>

                        <table cellpadding="0" cellspacing="0">

                                <tr>
                                        <th>Pos</th>
                                        <th>Pilotas</th>
                                        <th>Laikas</th>
                                        <th>Skirtumas</th>
                                        
                                        <th>Komanda</th>
                                        
                                        <th>Ratai</th>
                                </tr>

                                {section name=teller loop=$qpos}
                                <tr class="{cycle values="row, altrow"}">
                                        <td class="position">{$qpos[teller]}</td>
                                        <td class="driver">{$qnaam[teller]}</td>
                                        <td class="time">{$qlaptime[teller]}</td>
                                        <td class="gap">{$qgap[teller]}</td>
                                        
                                        <td class="team">{$qcar[teller]}</td>
                                        <td>{$qlaps[teller]}</td>
                                </tr>
                                {/section}

                        </table>
         
                        <h4 id="qualifyLapDetail">Įveiktų ratų statistika (pagal iškovotas pozicijas)</h4>

                        <div class="subSection">

                        {section name=teller2 loop=$qdetailnaam}

                        <table cellpadding="0" cellspacing="0">

                                <tr>
                                        <th colspan="6">{$qdetailnaam[teller2]}</th>
                                </tr>

                                <tr>
                                        <th>Ratas</th>
                                        <th>Degalų kiekis</th>
                                        <th>Sektorius 1</th>
                                        <th>Sektorius 2</th>
                                        <th>Sektorius 3</th>
                                        <th>Rato laikas</th>
                                </tr>

                                {section name=teller3 loop=$qdetaillap[teller2]}

                                <tr class="{cycle values="row,altrow"}">
                                        <td>{$qlapnumber[teller2][teller3]}</td>
                                        <td>{$qfuellevel[teller2][teller3]}</td>
                                        <td>{$qdetails1[teller2][teller3]}</td>
                                        <td>{$qdetails2[teller2][teller3]}</td>
                                        <td>{$qdetails3[teller2][teller3]}</td>
                                        <td>{$qdetaillap[teller2][teller3]}</td>
                                </tr>

                                {/section}

                        </table>
                        {/section}

                        </div><!--lap detail subSection-->         
                
                </div><!-- Qualification results -->


                <div id="raceResults" class="section">

                        <h2>Lenktynių rezultatai - {$track} - {$serverName}</h2>

                        {if $swapped eq "true"}

                        <h3>Driver swaps</h3>
                
                        {section name=teller2 loop=$swapnaam}           
                        <table cellpadding="0" cellspacing="0">        
                                <tr>
                                        <th colspan="3">{$swapnaam[teller2]}</th>
                                </tr>
                
                                <tr>
                                        <td>Startlap</td>
                                        <td>Ending lap</td>
                                        <td>Driver</td>
                                </tr>
                
                                {section name=teller3 loop=$swapdetaildriver[teller2]}
                                <tr class="{cycle values="row, altrow"}">
                                        <td>{$swapdetailstartlap[teller2][teller3]}</td>
                                        <td>{$swapdetailendlap[teller2][teller3]}</td>
                                        <td>{$swapdetaildriver[teller2][teller3]}</td>
                                </tr>
                                {/section}
                                
                        </table> 
                        {/section}
        
                        <p>
                                <strong>Note:</strong>
                                The driver who drove the last stint will be used as the &#39;main driver&#39;.<br />
                                You will only find the name of the 'main driver' in the rest of this report.<br />
                                However, when driverswaps occured all information is car specific and not driver specific. For example you will 
                                see the name of the main driver in the fastest laps overview, but it could just as well be another driver of 
                                that car that drove the fastest lap.
                        </p>

                        {/if}

              <h3>Apžvalga</h3>

              <table cellpadding="0" cellspacing="0">

                 <tr>
                    <th>Pos</th>
                                        <th>Pilotas</th>
                                        <th>Laikas iš viso</th>
                                        <th>Skirtumas</th>
                                        
                                        <th>Komanda</th>
                                        
                                        <th>Ratai</th>
                                        <th>Pitstops</th>
                 </tr>

                                {section name=teller loop=$rpos}
                 <tr class="{cycle values="row, altrow"}">
                        <td class="position">{$rpos[teller]}</td>
                                        <td class="driver">{$rnaam[teller]}</td>
                        <td class="time">{$rlaptime[teller]}</td>
                        <td class="gap">{$rgap[teller]}</td>
                        
                        <td class="team">{$rcar[teller]}</td>
                        
                        <td>{$rlaps[teller]}</td>
                        <td>{$rpit[teller]}</td>
                </tr>
                                {/section}

                        </table>

                        <h4 id="raceLapDetail">Įveiktų ratų statistika (pagal finišo pozicijas) </h4>

                        <div class="raceSubSection">

                                <p>Spalvų kodai</p>
        
                                <ul>
                                        <li class="lightgreen">Šviesiai žalia : 0.5s ar mažiau lėtesnis rato įveikimas nuo greičiausio rato (pagal apskritai greičiausią ratą lenktynėse)</li>
                                        <li class="green">Žalia : 0.5s ar mažiau lėtesnis rato įveikimas nuo greičiausio asmeninio rato</li>
                                        <li class="orange">Geltona : tarp 0.5s ir 1.5s lėtesnis rato įveikimas nuo greičiausio asmeninio rato</li>
                                        <li class="red">Raudona : tarp 1.5s ir 3.0s lėtesnis rato įveikimas nuo greičiausio asmeninio rato</li>
                                        <li class="darkred">Tamsiai raudona : daugiau kaip 3.0s lėtesnis rato įveikimas nuo greičiausio asmeninio rato</li>      
                                </ul>

                                {section name=teller2 loop=$rdetailnaam}

                                <table cellpadding="0" cellspacing="0">
                                
                                        <tr>
                                                <th colspan="6">{$rdetailnaam[teller2]}</th>
                                        </tr>
                                        
                                        <tr>
                                                <th>Ratas</th>
                                                <th>Degalų kiekis</th>
                                                <th>Sektorius 1</th>
                                                <th>Sektorius 2</th>
                                                <th>Sektorius 3</th>
                                                <th>Rato laikas</th>
                                        </tr>

                                        {section name=teller3 loop=$rdetaillap[teller2]}

                                        <tr class="{cycle values="row, altrow"}">
                                                <td>{$rlapnumber[teller2][teller3]}</td>
                                                <td>{$rfuellevel[teller2][teller3]}</td>
                                                <td>{$rdetails1[teller2][teller3]}</td>
                                                <td>{$rdetails2[teller2][teller3]}</td>
                                                <td>{$rdetails3[teller2][teller3]}</td>
                                                <td>{$rdetaillap[teller2][teller3]}</td>
                                        </tr>

                                        {/section}

                                </table>

                                {/section}

                        </div><!--lap detail-->

                </div><!--Race Results-->


                <div id="raceIncidents" class="section">
        
                        <h2>Lenktynių incidentai - {$track} - {$serverName}</h2>
        
                        <h3>Incidentų/kontaktų skaičius</h3>
        
                        <!-- <div class="subSection"> -->
        
                                <table cellpadding="0" cellspacing="0">
        
                                <tr>
                                        <th class="numIncidents">Incidentų skaičius</th>
                                        <th>Pilotas</th>
                                </tr>
        
                                {section name=tteller loop=$incidentnames}

                                <tr class="{cycle values="row, altrow"}">
                                        <td class="numIncidents">{$incidentcounter[tteller]}</td>
                                        <td class="driver">{$incidentnames[tteller]}</td>
                                </tr>

                                {/section}
        
                                </table>
        
                        <!-- </div> --> <!-- subSection Number of contacts/driver-->
                
                        <h4 id="incidents">Incidentų apžvalga išsamiau</h4>
        
                        <div class="subSection">
        
                                <table cellpadding="0" cellspacing="0">
        
                                <tr>
                                        <th>Incidento laikas</th>
                                        <th>Incidentas</th>
                                </tr>
        
                                {section name=incidentteller loop=$itime}

                  <tr class="{cycle values="row, altrow"}">
                 <td class="timeOfIncident">{$itime[incidentteller]}</td>
                     <td class="driverIncident">{$iincident[incidentteller]}</td>
                  </tr>

                                {/section}
        
                                </table>
        
                        </div><!--Overview-->
            <h2>Pokalbiai - {$track} - {$serverName}</h2>
            <table cellpadding="0" cellspacing="0">
                                <tr>
                  <th>Laikas</th>
                                        <th>Pilotas</th>
                                        <th>Žinutė</th>
                                </tr>
                                {section name=chatcounter loop=$ichatDriver}
                  <tr class="{cycle values="row, altrow"}">
                  <td>{$ichattime[chatcounter]}</td>
                 <td>{$ichatDriver[chatcounter]}</td>
                  <td class="driverIncident">{$ichatMessage[chatcounter]}</td>
               </tr>
                                {/section}
            </table>
                </div><!--race incidents-->

                <div id="raceLeaders" class="section">
        
                        <h2>Lenktynių lyderiai - {$track} - {$serverName}</h2>
        
                        <table cellpadding="0" cellspacing="0">
        
                                <tr>
                                        <th>Pilotas</th>
                                        <th>Ratai</th>
                                        
                                        <th>Komanda</th>
                                </tr>
        
                                {section name="leaderteller loop=$raceleaderrondes}

                                <tr class="{cycle values="row, altrow"}">
                                        <td class="driver">{$raceleadernamen[leaderteller]}</td>
                                        <td>{$raceleaderrondes[leaderteller]}</td>
                                        
                                        <td class="team">{$raceleadercar[leaderteller]}</td>
                                </tr>

                                {/section}
        
                        </table>
        
                </div><!--Race Leaders -->


                <div id="fastestLaps" class="section">

                        <h2>Greičiausieji ratai - {$track} - {$serverName}</h2>
                
                        

<!--                    <div class="subSection">-->

                                <table cellpadding="0" cellspacing="0">

                                <tr>
                                        <th>Pos</th>
                                        <th>Pilotas</th>
                                        <th>Rato laikas</th>
                                        <th>Skirtumas</th>
                                        
                                        <th>Komanda</th>
                                </tr>

                                {section name=teller5 loop=$fastestname}

                                <tr class="{cycle values="row, altrow"}">
                                        <td class="position">{$fastestposition[teller5]}</td>
                                        <td class="driver">{$fastestname[teller5]}</td>
                                        <td class="time">{$fastesttime[teller5]}</td>
                                        <td class="gap">{$fastestgap[teller5]}</td>
                                        
                                        <td class="team">{$fastestcar[teller5]}</td>
                                </tr>

                                {/section}

                                </table>
                        <!--</div>--><!--Total times-->
                        
                        
                        <h4>Greičiausi įmanomi ratai (sudėjus greičiausius  3 sektorius)</h4>

                        <div class="subSection">

                                <table cellpadding="0" cellspacing="0">

                                        <tr>
                                                <th>Pos</th>
                                                <th>Pilotas</th>
                                                <th>Greičiausias įmanomas ratas</th>
                                                <th>Skirtumas</th>
                                        
                                                <th>Komanda</th>
                                        </tr>

                                        {section name=teller20 loop=$ppos}

                                        <tr class="{cycle values="row, altrow"}">
                                                <td class="position">{$ppos[teller20]}</td>
                                                <td class="driver">{$pdriver[teller20]}</td>
                                                <td class="time">{$ptime[teller20]}</td>
                                                <td class="gap">{$pgap[teller20]}</td>
                                                
                                                <td class="team">{$pcar[teller20]}</td>
                                        </tr>

                                        {/section}

                                </table>

                        </div><!--fastestpossible-->
                                
                        <h4 id="sector1">Sektorius 1</h4>

                        <div class="subSection">

                                <table cellpadding="0" cellspacing="0">

                                        <tr>    
                                                <th>Pos</th>
                                                <th>Pilotas</th>
                                                <th>Sektoriaus laikas</th>
                                                <th>Skirtumas</th>
                                                
                                                <th>Komanda</th>
                                        </tr>

                                        {section name=teller6 loop=$s1name}

                                        <tr class="{cycle values="row, altrow"}">
                                                <td class="position">{$s1position[teller6]}</td>
                                                <td class="driver">{$s1name[teller6]}</td>
                                                <td class="time">{$s1time[teller6]}</td>
                                                <td class="gap">{$s1gap[teller6]}</td>
                                                
                                                <td class="team">{$s1car[teller6]}</td>
                                        </tr>

                                        {/section}

                                </table>

                        </div><!--sector 1-->
                                
                        <h4 id="sector2">Sektorius 2</h4>

                        <div class="subSection">

                                <table cellpadding="0" cellspacing="0">

                                        <tr>
                                                <th>Pos</th>
                                                <th>Pilotas</th>
                                                <th>Sektoriaus laikas</th>
                                                <th>Skirtumas</th>
                                                
                                                <th>Komanda</th>
                                        </tr>

                                        {section name=teller7 loop=$s2name}

                                        <tr class="{cycle values="row, altrow"}">
                                                <td class="position">{$s2position[teller7]}</td>
                                                <td class="driver">{$s2name[teller7]}</td>
                                                <td class="time">{$s2time[teller7]}</td>
                                                <td class="gap">{$s2gap[teller7]}</td>
                                                
                                                <td class="team">{$s2car[teller7]}</td>
                                        </tr>

                                {/section}

                                </table>

                        </div><!--sector 2-->

                        <h4 id="sector3">Sektorius 3</h4>

                        <div class="subSection">

                                <table cellpadding="0" cellspacing="0">

                                        <tr>
                                                <th>Pos</th>
                                                <th>Pilotas</th>
                                                <th>Sektoriaus laikas</th>
                                                <th>Skirtumas</th>
                                                
                                                <th>Komanda</th>
                                        </tr>

                                        {section name=teller8 loop=$s3name}

                                        <tr class="{cycle values="row, altrow"}">
                                                <td class="position">{$s3position[teller8]}</td>
                                                <td class="driver">{$s3name[teller8]}</td>
                                                <td class="time">{$s3time[teller8]}</td>
                                                <td class="gap">{$s3gap[teller8]}</td>
                                                
                                                <td class="team">{$s3car[teller8]}</td>
                                        </tr>

                                        {/section}

                                </table>

                        </div><!--sector 3-->

                </div><!--Fastest laps-->


                <div id="highestClimbers" class="section">

                        <h2>Daugiausiai iškovoję pozicijų: - {$track} - {$serverName}</h2>

                        <table cellpadding="0" cellspacing="0">

                                <tr>
                                        <th>+/-</th>
                                        <th>Pilotas</th>
                                        <th>Starto pozicija</th>
                                        <th>Finišo pozicija</th>
                                        
                                        <th>Komanda</th>
                                </tr>

                                {section name=teller9 loop=$hcpositions}

                                <tr class="{cycle values="row, altrow"}">
                                        <td class="position">{$hcpositions[teller9]}</td>
                                        <td class="driver">{$hcdriver[teller9]}</td>
                                        <td>{$hcstartposition[teller9]}</td>
                                        <td>{$hcfinishposition[teller9]}</td>
                                        
                                        <td class="team">{$hccar[teller9]}</td>
                                </tr>

                                {/section}

                        </table>
                </div><!--highest climbers-->

                
                <div id="laptimeConsistency" class="section">

                        <h2>Lenktynių ratų įveikimo nuoseklumas - {$track} - {$serverName}</h2>
                
                        <h3 id="stdDeviation">Standartinis nuokrypis</h3>

                        <!-- <div class="subSection">-->

                                <table cellpadding="0" cellspacing="0">

                                        <tr>
                                                <th>Pos</th>
                                                <th>Pilotas</th>
                                                <th>Standartinis nuokrypis</th>
                                                <th>Skirtumas</th>
                                                
                                                <th>Komanda</th>
                                        </tr>

                                        {section name=teller10 loop=$stddevpos}

                                        <tr class="{cycle values="row, altrow"}">
                                                <td class="position">{$stddevpos[teller10]}</td>
                                                <td class="driver">{$stddevdriver[teller10]}</td>
                                                <td class="time">{$stddevtime[teller10]}</td>
                                                <td class="gap">{$stddevgap[teller10]}</td>
                                                
                                                <td class="team">{$stddevcar[teller10]}</td>
                                        </tr>

                                {/section}

                                </table>

                        <!-- </div> --> <!--Std Deviation-->
                
                        <h3 id="avgDeviation">Vidutinis nuokrypis</h3>

                        <!-- <div class="subSection"> -->

                                <table cellpadding="0" cellspacing="0">

                                        <tr>
                                                <th>Pos</th>
                                                <th>Pilotas</th>
                                                <th>Vidutinis nuokrypis</th>
                                                <th>Skirtumas</th>
                                                
                                                <th>Komanda</th>
                                        </tr>

                                        {section name=teller11 loop=$avgdevpos}

                                        <tr class="{cycle values="row, altrow"}">
                                                <td class="position">{$avgdevpos[teller11]}</td>
                                                <td class="driver">{$avgdevdriver[teller11]}</td>
                                                <td class="time">{$avgdevtime[teller11]}</td>
                                                <td class="gap">{$avgdevgap[teller11]}</td>
                                                
                                                <td class="team">{$avgdevcar[teller11]}</td>
                                        </tr>

                                        {/section}

                                </table>

                        <!-- </div> --> <!--Avg Deviation-->
                
                </div><!--Race laptime consistency-->


                <div id="raceHistoryGraph" class="section">

                        <h2>Lenktynių grafikas - {$track} - {$serverName}</h2>

                        <h3>(Vardai legendoje išdėstyti pagal finišo pozicijas)</h3>

                        <form action="racehistory.php">
                        <div><br><p>
                        

                <input type="hidden" class="hidden" name="file" value="{$racefile}" />

                                <input class="graphButton" type="submit" name="submit" value="Padidinti grafiką naujame lange" />

                        </div>
         </form>

                        <img src="{$racehistorygraph}" alt="" />

                </div><!--Race history graph-->


                <div id="lapByLapGraph" class="section">

                        <h2>Ratas po rato grafikas - {$track} - {$serverName}</h2>

                        <h3>(Vardai legendoje išdėstyti pagal finišo pozicijas)</h3>
                        
         <form action="lapbylap.php">
                        <div><br><p>

                 <input type="hidden" class="hidden" name="file" value="{$racefile}" />
        
                 <input class="graphButton" type="submit" name="submit" value="Padidinti grafiką naujame lange" />

                        </div>
         </form>

                        <img src="{$lapbylapgraph}" alt="" />

                </div><!--lap by lap-->


</body>
</html>
