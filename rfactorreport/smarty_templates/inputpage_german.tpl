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

Translated to German by Dimitri Vlaanderen

This page is the default page of rFactorreport
-->
            <body>
            <H1>rFactor-report von Frank Wynants <a href="http://sourceforge.net/projects/rfactorreport/"><img src="http://sflogo.sourceforge.net/sflogo.php?group_id=160119&amp;type=2" width="125" height="37" border="0" alt="SourceForge.net Logo" /></a></H1>
            <H2>Willkommen</H2>
            <p>
               Diese Webseite wird genutzt um die <a href="http://www.rfactor.net">rFactor</a> Ergebnis-Files in eine leicht zu lesende Webseite umzuwandeln.            </p>
            <p>
                Solltet ihr Probleme haben, meldet euch bei mir unter  
                <A HREF="mailto:frank.wynants@gmail.com">frank.wynants@gmail.com</A> mittels Email oder nutzt Google-talk und ich werde versuchen das Problem zu beheben. (Bitte gebt die Racecast-URL die ihr benutzt habt, an).            </p>
            <H2>Neues!</H2>
            <p>
            	rFactor report ist jetzt opensource !!!<br>
            	Ihr finden den Source-Code und die Installations-Anweisung hier: (Englisch) <A HREF='http://sourceforge.net/projects/rfactorreport/'>http://sourceforge.net/projects/rfactorreport/</A>.            </p>
            <H2>Report erstellen: </H2>
            <p>
            <FORM METHOD="get" ACTION="index.php">
					Qualifikation - raceresult URL : <br>
					<INPUT TYPE=text NAME="qualyfile" SIZE="70"/><br>
					Rennen - raceresult URL :  <br>
					<INPUT TYPE=text NAME="racefile" SIZE="70"/><br>
					<INPUT TYPE=hidden NAME='cssstyle' VALUE='{$cssstyle}'/>
                    <input name="Submit" type="submit" id="Submit" value="Absenden"/>
            </FORM>   
                  <br>
                  ODER
                  <br>
                  <FORM METHOD="get" ACTION="index.php">
                     &quot;Kombiniertes Ergebnis&quot;- report URL : <br>
                     <INPUT TYPE=text NAME="file" SIZE="70"/><br>
					<INPUT TYPE=hidden NAME='cssstyle' VALUE='{$cssstyle}'/>
                     <input type="submit" value="Absenden"/>
                  </FORM>         
            </p>   
            <H2>Nutzung</H2>
            <p>
               Es gibt 3 M&ouml;glichkeiten, diese &quot;Software&quot; zu nutzen:
            <UL>
                  <LI>Indem ihr seperate Qualy und Ergebnis-result-Files nutzt
                    <UL>
                        <LI>Die Ergebnisfiles werden gespeichert unter PFAD_ZU_RFACTOR\UserData\LOG\results
                        <LI>Sucht nach den 2 .xml files welche ihr umwandeln m&ouml;chtet. Ihr werdet das Qualy (dasjenige File das mit SQ.xml aufh&ouml;rt), und das Rennergebnis xml file (dasjenige mit SR.xml am Ende) brauchen.
                        <LI>Ladet diese 2 Dateien auf euren Webspace hoch (Zum Beispiel: Ich habe 2 Dateien hierhin hochgeladen:  <A HREF="http://www.vrl-simracing.be/rfactorreport/qualify1070.xml">http://www.vrl-simracing.be/rfactorreport/qualify1070.xml</A> und
                         <A HREF="http://www.vrl-simracing.be/rfactorreport/race1070.xml">http://www.vrl-simracing.be/rfactorreport/race1070.xml</A>.<br>
                      <LI>Kopiert die URL's und f&uuml;gt sie oben in den leeren Felder ein. Klickt dann auf Absenden.
                      <LI>Die komplette rFactor-report URL k&ouml;nnt ihr dann   den Leuten weitergeben, die es interessiert. (Zum Beispiel: <A HREF="http://www.vrl-simracing.be/rfactorreport/index.php?qualyfile=http%3A%2F%2Fwww.vrl-simracing.be%2Frfactorreport%2Fqualify1070.xml&amp;racefile=http%3A%2F%2Fwww.vrl-simracing.be%2Frfactorreport%2Frace1070.xml">http://www.vrl-simracing.be/rfactorreport/index.php?qualyfile=http%3A%2F%2Fwww.vrl-simracing.be%2Frfactorreport%2Fqualify1070.xml&amp;racefile=http%3A%2F%2Fwww.vrl-simracing.be%2Frfactorreport%2Frace1070.xml</A>); 
                    </UL>
              <LI>Indem ihr eine Kombinierte Qualy/Rennergebnis Result-File verwendet
                     <UL>
                        <LI>Die Ergebnisfiles werden gespeichert unter PFAD_ZU_RFACTOR\UserData\LOG\results
                        <LI>Sucht nach dem .xml file welches ihr umwandeln m&ouml;chtet.
                        <LI>Ladet diese Datei auf euren Webspace hoch (Zum Beispiel <A HREF="http://www.vrl-simracing.be/rfactorreport/raceresult.xml">http://www.vrl-simracing.be/rfactorreport/raceresult.xml</A>
                       <LI>Kopiert die URL's und f&uuml;gt sie oben in <em>&quot;Kombiniertes Ergebnis&quot;- report URL</em> ein. Klickt dann auf Absenden.
                       
                       <LI>Die komplette rFactor-report URL k&ouml;nnt ihr dann   den Leuten weitergeben, die es interessiert. (z. B.: <A HREF="http://www.vrl-simracing.be/rfactorreport/index.php?file=http%3A%2F%2Fwww.vrl-simracing.be%2Frfactorreport%2Fraceresult.xml">http://www.vrl-simracing.be/rfactorreport/index.php?file=http%3A%2F%2Fwww.vrl-simracing.be%2Frfactorreport%2Fraceresult.xml</A>); 
                     </UL>
              <LI>Mittels racecast
                     <UL>
                        <LI>Geht zu  <A HREF="http://racecast.rfactor.net/" TARGET="_BLANK">http://racecast.rfactor.net/</A> und sucht nach dem Rennen, dass ihr &quot;umwandeln&quot; m&ouml;chtet. 
                        <LI>Kopiert die URL des racecast report (z. B.: <A HREF="http://racecast.rfactor.net/?go=racedetails&amp;raceID=9769&amp;sessiontype=Race" TARGET="_BLANK">http://racecast.rfactor.net/?go=racedetails&amp;raceID=9769&amp;sessiontype=Race)</A>
                                und f&uuml;gt diese ins in <em>&quot;Kombiniertes Ergebnis&quot;- report URL</em> ein. Klickt dann auf Absenden.
                        <LI>Die komplette rFactor-report URL k&ouml;nnt ihr dann   den Leuten weitergeben, die es interessiert.
                        </UL>
            </UL>
            </p>
            <H2> Layout anpassen </H2>
            <p>
               Mittels CSS ist es m&ouml;glich, das Aussehen des rfactor-report an euren Seiten anzupassen.             </p>
            <H2>Nutzung:</H2>
				<p>
			<UL>
						<FORM METHOD="get" ACTION="index.php">
							CSS URL : <br><INPUT TYPE=text NAME="cssstyle" SIZE="70"/><br>
							<input type="submit" value="Absenden"/>
						</FORM>         
	                  <LI>Ladet die Beispiel-CSS-Datei runter: <A HREF="style/rfactorreport.css">style/rfactorreport.css</A>.
    	              <LI>Modifiziert diese nach euren W&uuml;nschen. Was was macht, steht alles in der CSS beschrieben. 
        	          <LI>Lade die neu erstellte CSS-Datei hoch zu deiner Seite.
            	      <LI>Gibt die URL zu diesem CSS im obigen Feld ein und klickt auf Absenden.
                	  <LI>Jetzt ist die Seite dem Layout eurer CSS angepasst worden. 
                	  
                	  <LI>Wenn ihr euch jetzt einen Report anschaut, seht ihr, dass es das gleiche Layout benutzt.
    	              <LI>Diese CSS ist ein Teil der URL. Wenn ihr also eine rfactor-report-URL weitergeben solltet, dann werden die Anderen das so sehen, wie du die CSS angepasst hast.<br>
   	        </UL>
            	</p>
            <p>
            <H2>Bekannte Bugs und was noch hinzukommt</H2>
               <UL>
               	<LI>Keine bestehenden Bugs die bekannt w&auml;ren und auch keine neuen Features in Planung.
               	
               </UL>
            </p>
            </body>
