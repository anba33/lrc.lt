<?php /* Smarty version 2.6.10, created on 2009-11-26 17:11:03
         compiled from inputpage.tpl */ ?>
<html xmlns="http://www.w3.org/1999/xhtml" version="-//W3C//DTD XHTML 1.1//EN" xml:lang="en">
<head>
        <title>rFactor-report</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link type="text/css" href="style/generate-report.css" rel="stylesheet" media="screen" />
</head>
<body>
<div id="generateReport">

        <div id="support">
                <h1>
                        rFactor-report <a href="http://www.lrc.lt/rfactorreport/">
                        <img src="lrc.png" alt="LRC logo" />
                        </a>
                </h1>
                        <div>
                </div>
                        </form>
                </div><!--paypal-->
        </div><!--support-->


        <h2>Sveiki</h2>
        <h2>Sugeneruokite lenktyniu apzvalga</h2>
        <div>
                <form method="get" action="index.php">
                <div>
                        <label for="qualyfile">Kvalifikacijos rezultatu URL :</label>
                        <input type="text" id="qualyfile" name="qualyfile" size="70" /><br>
                        <label for="racefile">Lenktyniu rezultatu URL :</label>
                        <input type="text" id="racefile" name="racefile" size="70" />
                        <input type="hidden" class="hidden" name="cssstyle" value="<?php echo $this->_tpl_vars['cssstyle']; ?>
" />
                        <input type="submit" class="button" value="Submit"/>
                </div>
                </form>
        </div>
        <p>ARBA</p>
        <div>
        <form method="get" action="index.php">
        <div>
                <label for="file">Kombinuotu rezultatu URL :</label>
                <input type="text" id="file" name="file" size="70" />
                <input type="hidden" class="hidden" name="cssstyle" value="<?php echo $this->_tpl_vars['cssstyle']; ?>
" />
                <input type="submit" class="button" value="Submit" />
        </div>
        </form> 
        </div>   
        <h2>Naudojimas:</h2>
        <p>
                There are 3 ways to use this software
        </p>
        <ul>
                <li>Using seperate qualification and race-result files
                        <ul>
                                <li>The resultfiles are stored in PATH_TO_RFACTOR\UserData\LOG\results</li>
                                <li>Search for the 2 .xml files you want to be parsed. You&#39;ll need the qualification 
                                        (this is the one ending with SQ.xml), and the raceresult xml file (this is the one ending with SR.xml).</li>
                                <li>Upload these files to your own webspace (as an example I have uploaded two files to 
                                        <a href="http://www.vrl-simracing.be/rfactorreport/qualify1070.xml">http://www.vrl-simracing.be/rfactorreport/qualify1070.xml</a> and
                                        <a href="http://www.vrl-simracing.be/rfactorreport/race1070.xml">http://www.vrl-simracing.be/rfactorreport/race1070.xml</a>.</li>
                                <li>Copy these URL&#39;s and paste them into the to input fields on the rfactor-report website and click on the submit button.</li>
                                <li>Give the complete rFactor-report URL to the persons interested in the report (for example: 
                                        <a href="http://www.vrl-simracing.be/rfactorreport/index.php?qualyfile=http%3A%2F%2Fwww.vrl-simracing.be%2Frfactorreport%2Fqualify1070.xml&amp;racefile=http%3A%2F%2Fwww.vrl-simracing.be%2Frfactorreport%2Frace1070.xml">
                                                http://www.vrl-simracing.be/rfactorreport/index.php?qualyfile=http%3A%2F%2Fwww.vrl-simracing.be%2Frfactorreport%2Fqualify1070.xml&amp;racefile=http%3A%2F%2Fwww.vrl-simracing.be%2Frfactorreport%2Frace1070.xml
                                                </a>);
                                </li>
                        </ul>
                </li>
                <li>Using one combined qualification/race result file
                        <ul>
                                <li>The resultfiles are stored in PATH_TO_RFACTOR\UserData\LOG\results</li>
                                <li>Search for the xml files you want to be parsed.</li>
                                <li>Upload this file to your own webspace (as an example I have uploaded two files to 
                                        <a href="http://www.vrl-simracing.be/rfactorreport/raceresult.xml">http://www.vrl-simracing.be/rfactorreport/raceresult.xml</a></li>
                                <li>Copy this URL and paste it into the to the &#39;Combined result URL&#39; field on the rfactor-report website and click on the submit button.</li>
                                <li>Give the complete rFactor-report URL to the persons interested in the report (for example: 
                                        <a href="http://www.vrl-simracing.be/rfactorreport/index.php?file=http%3A%2F%2Fwww.vrl-simracing.be%2Frfactorreport%2Fraceresult.xml">http://www.vrl-simracing.be/rfactorreport/index.php?file=http%3A%2F%2Fwww.vrl-simracing.be%2Frfactorreport%2Fraceresult.xml</a>); 
                                        <br />
                                        If you find that the URL&#39;s are to long you can create a short URL at the bottom of the report.
                                </li>                    
                        </ul>
                </li>
                <li>Using racecast
                        <ul>
                                <li>Browse to <a href="http://racecast.rfactor.net/">http://racecast.rfactor.net/</a> and search for the race you want to parse.</li>
                                <li>Copy the URL of your racecast report (for example <a href="http://racecast.rfactor.net/?go=racedetails&amp;raceID=9769&amp;sessiontype=Race">http://racecast.rfactor.net/?go=racedetails&amp;raceID=9769&amp;sessiontype=Race)</a>
                                        to the &#39;Combined result URL&#39; field on the rfactor-report website and click on the submit button.</li>
                                <li>Give the complete rFactor-report URL to the persons interested in the report</li>
                        </ul>
                </li>
        </ul>
</div><!--generateReport-->
<hr>
<center>
<i>Dekojame:</i>
<br>
<i>PHP koduote</i> : Frank Wynants
<br>
<i>Isdestymas</i> : Jeff Carriere
</center>
</body>
</html>