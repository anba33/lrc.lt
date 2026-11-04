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

This page is the actual report-page of rFactorreport
German Translation provided by Dimitri Vlaanderen
-->

<body>
<H1 align="center"><a href="http://www.vlaanderen.de/"></a><img src="logo.gif" width="692" height="95" alt="rFactor @ [O-GC]"></H1>
<h1 align="center">Die Renn-Ergebnisse in der detaillierten &Uuml;bersicht! </h1>
<ul>
  <LI><A HREF="#overview">&Uuml;bersicht</A>
  <LI><A HREF="#qr">Qualy Ergebnis </A>
  <LI><A HREF="#rr">Renn-Ergebnis</A>
  <LI><A HREF="#ri">Renn-Vorkomnisse</A>
  <LI><A HREF="#rl">Wer hat gef&uuml;hrt &amp; wie lange? </A>
  <LI><A HREF="#fl">Schnellste Runden &amp; Sector Zeiten </A>
  <LI><A HREF="#possible">Schnellste m&ouml;glichen Runden </A>
  <LI><A HREF="#hc">Platzgewinn/-verlust</A>
  <LI><A HREF="#cons">Renn-Rundenzeit Vergleich</A>
  <LI><A HREF="#rhg">Rennverlauf (Grafisch) </A>
  <LI><A HREF="#lbl">Runde f&uuml;r Runde (Grafisch)</A>
</ul>
<p>
      <A NAME="overview"></A>
<h2>&Uuml;bersicht</h2>
      <table align="center">
         <tr class=altrow><td align=left class=altrow><b>ServerName:</b> {$serverName}</td></tr>
         <tr class=row>
           <td align=left class=row><b>Kurs:</b> {$track}</td>
         <tr class=altrow>
           <td align=left class=altrow><b>Runden:</b> {$laps}</td>
         <tr class=altrow><td align=left class=altrow><b>Pole:</b> {$poledriver} ({$poletime})</td>
         <tr class=row>
           <td align=left class=row><b>Sieger:</b> {$winnerdriver} ({$winnertime})</td>
         <tr class=altrow>
           <td align=left class=altrow><b>Schnellste Runde:</b> {$fastestlapdriver} ({$fastestlaptime})</td>
         <tr class=row>
           <td align=left class=row><b>Meisten Runden vorne:</b> {$mostlapsleddriver} ({$mostlapsledlaps} Runden)</td>
         <tr class=altrow>
           <td align=left class=altrow><b>Meisten Pl&auml;tze gewonnen :</b> {$highestclimber} ({$highestclimberposition} Pl&auml;tze gewonnen)</td>
      </table>
      <hr>
</p>
<p>
      <A NAME="qr"></A>
<h2>Qualy Ergebnisse </h2>
      <h3>&Uuml;bersicht</h3>
      <table align="center">
         <tr class=hdr>
            <td>Platz</td>
            <td>Fahrer</td>
            <td>Rundenzeit</td>
            <td>R&uuml;ckstand</td>
            <td>Wagen</td>
            <td>Nummer</td>
            <td>Team</td>
            <td>Anzahl Runden</td>
         </tr>
         {section name=teller loop=$qpos}
            <tr class="{cycle values="row, altrow"}">
               <td align=left>{$qpos[teller]}</td>
               <td align=left>{$qnaam[teller]}</td>
               <td align=left>{$qlaptime[teller]}</td>
               <td align=left>{$qgap[teller]}</td>
               <td align=left>{$qcar[teller]}</td>
               <td align=left>{$qcarnumber[teller]}</td>
               <td align=left>{$qteam[teller]}</td>
               <td align=left>{$qlaps[teller]}</td>
            </tr>
         {/section}
      </table>
      <h3>Runden Details (Sortiert nach der qualy Position)</h3>
      {section name=teller2 loop=$qdetailnaam}
         <table align="center">
               <tr class=hdr><td align=center colspan='5'>{$qdetailnaam[teller2]}</td></tr>
               <tr class=hdr>
                  <td>Runde</td>
                  <td>Sector 1</td><td>Sector 2</td><td>Sector 3</td>
                  <td>Rundenzeit</td>
               </tr>
               {section name=teller3 loop=$qdetaillap[teller2]}
               <tr class="{cycle values="row, altrow"}">
	             <td align=left>{$qlapnumber[teller2][teller3]}</td>
	             <td align=left>{$qdetails1[teller2][teller3]}</td>
	             <td align=left>{$qdetails2[teller2][teller3]}</td>
	             <td align=left>{$qdetails3[teller2][teller3]}</td>
	             <td align=left>{$qdetaillap[teller2][teller3]}</td>
            </tr>
            {/section}
         </table>
      {/section}
      <hr>
</p>
<p>
   <A NAME="rr"></A>
<h2>Rennergebnisse</h2>
      <h3>&Uuml;bersicht</h3>
      <table align="center">
         <tr class=hdr>
            <td>Platz</td><td>Fahrer</td>
            <td>Gesamtzeit</td>
            <td>R&uuml;ckstand</td>
            <td>Wagen</td>
            <td>Nummer</td>
            <td>Team</td>
            <td>Anzahl Runden</td>
            <td>Anzahl Stopps</td>
         </tr>
         {section name=teller loop=$rpos}
         <tr class="{cycle values="row, altrow"}">
         <td>{$rpos[teller]}</td>
         <td>{$rnaam[teller]}</td>
         <td>{$rlaptime[teller]}</td>
         <td>{$rgap[teller]}</td>
         <td>{$rcar[teller]}</td>
         <td>{$rcarnumber[teller]}</td>
         <td>{$rteam[teller]}</td>
         <td>{$rlaps[teller]}</td>
         <td>{$rpit[teller]}</td>
       </tr>
       {/section}
     </table>
     <h3>Runden Details  (Sortiert nach Rennergebnis)</h3>
     {section name=teller2 loop=$rdetailnaam}
      <table align="center">
            <tr class=hdr><td align=center colspan='5'>{$rdetailnaam[teller2]}</th></tr>
            <tr class=hdr>
              <td>Runde</td>
              <td>Sector 1</td><td>Sector 2</td><td>Sector 3</td>
              <td>Rundenzeit</td>
            </tr>
            {section name=teller3 loop=$rdetaillap[teller2]}
               <tr class="{cycle values="row, altrow"}">
                  <td>{$rlapnumber[teller2][teller3]}</td>
                  <td>{$rdetails1[teller2][teller3]}</td>
                  <td>{$rdetails2[teller2][teller3]}</td>
                  <td>{$rdetails3[teller2][teller3]}</td>
                  <td>{$rdetaillap[teller2][teller3]}</td>
               </tr>
            {/section}
</table>
      {/section}
      <hr>
</p>
<p>
   <A NAME="ri"></A>
<h2>Renn Vorkommnisse (Nicht verf&uuml;gbar bei Racecast-Reports)</h2>
      <H3>&Uuml;bersicht</H3>
      <table align="center">
         <tr class=hdr>
            <td>Zeitpunkt </td>
            <td>Vorkommnis</td>
         </tr>
         {section name=incidentteller loop=$itime}
            <tr class="{cycle values="row, altrow"}">
            <td>{$itime[incidentteller]}</td>
            <td>{$iincident[incidentteller]}</td>
         </tr>
         {/section}
      </table>
   <hr>
   <H3>Anzahl der Ber&uuml;hrung / Fahrer</H3>
   <table align="center">
      <tr class=hdr>
         <td>Anzahl der Vorkommnisse </td>
         <td>Fahrer</td>
      </tr>
      {section name=tteller loop=$incidentnames}
         <tr class="{cycle values="row, altrow"}">
            <td>{$incidentcounter[tteller]}</td>
            <td>{$incidentnames[tteller]}</td>
         </tr>
      {/section}
   </table>
   <hr>
</p>
<p>
      <A NAME="rl"></A>
<h2>Wer hat gef&uuml;hrt </h2>
       <table align="center">
         <tr class=hdr>
            <th>Fahrer</th>
            <th>Runden</th>
            <th>Wagen</th>
            <th>Nummer</th>
            <th>Team</th>
         </tr>
         {section name="leaderteller loop=$raceleaderrondes}
            <tr class="{cycle values="row, altrow"}">
               <td>{$raceleadernamen[leaderteller]}</td>
               <td>{$raceleaderrondes[leaderteller]}</td>
               <td>{$raceleadercar[leaderteller]}</td>
               <td>{$raceleadernumber[leaderteller]}</td>
               <td>{$raceleaderteam[leaderteller]}</td>
         {/section}
       </table>
      <hr>      
</p>
<p>
      <A NAME="fl"></A>
<h2>Schnellste Runden </h2>
      <h3>Gesamtzeiten</h3>
      <table align="center">
         <tr class=hdr>
            <td>Platz</td><td>Fahrer</td>
            <td>Rundenzeit</td>
            <td>R&uuml;ckstand</td>
            <td>Wagen</td>
            <td>Nummer</td>
            <td>Team</td>
         </tr>
         {section name=teller5 loop=$fastestname}
            <tr class="{cycle values="row, altrow"}">
               <td>{$fastestposition[teller5]}</td>
               <td>{$fastestname[teller5]}</td>
               <td>{$fastesttime[teller5]}</td>
               <td>{$fastestgap[teller5]}</td>
               <td>{$fastestcar[teller5]}</td>
               <td>{$fastestcarnumber[teller5]}</td>
               <td>{$fastestteam[teller5]}</td>
            </tr>
         {/section}
      </table>
      <h3>Sector 1</h3>
      <table align="center">
         <tr class=hdr>
            <td>Platz</td><td>Fahrer</td>
            <td>Rundenzeit</td>
            <td>R&uuml;ckstand</td>
            <td>Wagen</td>
            <td>Nummer</td>
            <td>Team</td>
         </tr>
         {section name=teller6 loop=$s1name}
            <tr class="{cycle values="row, altrow"}">
               <td>{$s1position[teller6]}</td>
               <td>{$s1name[teller6]}</td>
               <td>{$s1time[teller6]}</td>
               <td>{$s1gap[teller6]}</td>
               <td>{$s1car[teller6]}</td>
               <td>{$s1carnumber[teller6]}</td>
               <td>{$s1team[teller6]}</td>
            </tr>
         {/section}
      </table>
      <h3>Sector 2</h3>
      <table align="center">
         <tr class=hdr>
            <td>Platz</td><td>Fahrer</td>
            <td>Rundenzeit</td>
            <td>R&uuml;ckstand</td>
            <td>Wagen</td>
            <td>Nummer</td>
            <td>Team</td>
         </tr>
         {section name=teller7 loop=$s2name}
            <tr class="{cycle values="row, altrow"}">
               <td>{$s2position[teller7]}</td>
               <td>{$s2name[teller7]}</td>
               <td>{$s2time[teller7]}</td>
               <td>{$s2gap[teller7]}</td>
               <td>{$s2car[teller7]}</td>
               <td>{$s2carnumber[teller7]}</td>
               <td>{$s2team[teller7]}</td>
            </tr>
         {/section}
      </table>
      <h3>Sector 3</h3>
      <table align="center">
         <tr class=hdr>
            <td>Platz</td><td>Fahrer</td>
            <td>Rundenzeit</td>
            <td>R&uuml;ckstand</td>
            <td>Wagen</td>
            <td>Nummer</td>
            <td>Team</td>
         </tr>
         {section name=teller8 loop=$s3name}
            <tr class="{cycle values="row, altrow"}">
               <td>{$s3position[teller8]}</td>
               <td>{$s3name[teller8]}</td>
               <td>{$s3time[teller8]}</td>
               <td>{$s3gap[teller8]}</td>
               <td>{$s3car[teller8]}</td>
               <td>{$s3carnumber[teller8]}</td>
               <td>{$s3team[teller8]}</td>
            </tr>
         {/section}
      </table>
      <HR>
</p>
<p>
      <A NAME="possible"></A>
<H2>Schnellste m&ouml;gliche Zeiten  (Kombination der 3 besten Sectoren pro Fahrer)</H2>
         <TABLE align="center">
            <TR class=hdr>
               <td>Platz</td><td>Fahrer</td>
               <td>Schnellste m&ouml;gliche Zeit </td>
               <td>R&uuml;ckstand</td>
               <td>Wagen</td>
               <td>Nummer</td>
               <td>Team</td>
            </TR>
            {section name=teller20 loop=$ppos}
               <tr class="{cycle values="row, altrow"}">
               <td>{$ppos[teller20]}</td>
               <td>{$pdriver[teller20]}</td>
               <td>{$ptime[teller20]}</td>
               <td>{$pgap[teller20]}</td>
               <td>{$pcar[teller20]}</td>
               <td>{$pcarnumber[teller20]}</td>
               <td>{$pteam[teller20]}</td>
            </tr>
         {/section}
         </TABLE>
      <HR>
</p>
<p>
      <A NAME="hc"></A>
<H2>Platzgewinn/-verlust</H2>
            <TABLE align="center">
               <TR class=hdr>
                 <td>Pl&auml;tze gewonnen / verloren </td>
                 <td>Fahrer</td>
               <td>Startposition</td>
               <td>Zielposition</td>
               <td>Wagen</td>
               <td>Nummer</td>
               <td>Team</td></TR>
               {section name=teller9 loop=$hcpositions}
            <tr class="{cycle values="row, altrow"}">
            <td>{$hcpositions[teller9]}</td>
            <td>{$hcdriver[teller9]}</td>
            <td>{$hcstartposition[teller9]}</td>
            <td>{$hcfinishposition[teller9]}</td>
            <td>{$hccar[teller9]}</td>
            <td>{$hccarnumber[teller9]}</td>
            <td>{$hcteam[teller9]}</td>
         </tr>
        {/section}
      </TABLE>
      <HR>
</p>
<p>
      <A NAME="cons"></A>
<H2>Renn-Rundenzeit-Konstanz </H2>
      <H3>Std Abweichung </H3>
         <TABLE align="center">
            <TR class=hdr>
               <td>Platz</td><td>Fahrer</td>
               <td>Std Abweichung </td>
               <td>R&uuml;ckstand</td>
               <td>Wagen</td>
               <td>Nummer</td>
               <td>Team</td>
            </TR>
            {section name=teller10 loop=$stddevpos}
               <tr class="{cycle values="row, altrow"}">
               <td>{$stddevpos[teller10]}</td>
               <td>{$stddevdriver[teller10]}</td>
               <td>{$stddevtime[teller10]}</td>
               <td>{$stddevgap[teller10]}</td>
               <td>{$stddevcar[teller10]}</td>
               <td>{$stddevcarnumber[teller10]}</td>
               <td>{$stddevteam[teller10]}</td>
            </tr>
         {/section}
         </TABLE>
      <HR>
</p>
<p>
<H3>Durchschn. Abweichung</H3>
         <TABLE align="center">
            <TR>
               <td>Platz</td><td>Fahrer</td>
               <td>Durchschn. Abweichung</td>
               <td>R&uuml;ckstand</td>
               <td>Wagen</td>
               <td>Nummer</td>
               <td>Team</td>
            </TR>
            {section name=teller11 loop=$avgdevpos}
               <tr class="{cycle values="row, altrow"}">
               <td>{$avgdevpos[teller11]}</td>
               <td>{$avgdevdriver[teller11]}</td>
               <td>{$avgdevtime[teller11]}</td>
               <td>{$avgdevgap[teller11]}</td>
               <td>{$avgdevcar[teller11]}</td>
               <td>{$avgdevcarnumber[teller11]}</td>
               <td>{$avgdevteam[teller11]}</td>
            </tr>
         {/section}
         </TABLE>
      <HR>
</p>
<p>
      <A NAME="rhg"></A>
<h2>Rennverlauf als Grafik </h2>
         <IMG src="{$racehistorygraph}">
      <HR>      
</p>
<p>
      <A NAME="lbl"></A>
<h2>Runden-Grafik</h2>
         <b><b><br>
         <IMG src="{$lapbylapgraph}">
      <HR>
</p>
</body>
</html>
