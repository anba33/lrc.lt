<?php
/**
(c)2006 Frank Wynants
Some general methods needed by rFactor-report
*/

/**
 * Check if the given url exists
 * @param $url A url
 * @return true if given url exists 
 */
   function url_exists($url) {
       $a_url = parse_url($url);
       if (!isset($a_url['port'])) $a_url['port'] = 80;
       $errno = 0;
       $errstr = '';
       $timeout = 30;
       if(isset($a_url['host']) && $a_url['host']!=gethostbyname($a_url['host'])){
           $fid = fsockopen($a_url['host'], $a_url['port'], $errno, $errstr, $timeout);
           if (!$fid) return false;
           $page = isset($a_url['path'])  ?$a_url['path']:'';
           $page .= isset($a_url['query'])?'?'.$a_url['query']:'';
           fputs($fid, 'HEAD '.$page.' HTTP/1.0'."\r\n".'Host: '.$a_url['host']."\r\n\r\n");
           $head = fread($fid, 4096);
           fclose($fid);
           return preg_match('#^HTTP/.*\s+[200|302]+\s#i', $head);
       } else {
           return false;
       }
   }
   
/**
   * Reads an xml file
   * If $file points to a racecast url the main result link is recovered from the index racecast page
   * @param file a raceresult file or a racecastfile
   * @return the xml as a string
   */ 
   function leesxml($file)
   {
		require_once("httpclient.php");
        $line = HttpClient::quickGet($file);
        if(substr_count($line,'xmlresults.php?gameid') == 1)
        {
           $startpos = strpos($line, 'xmlresults.php?gameid');
           $file = substr($line, $startpos);
           $endpos = strpos($file, '"');
           $file = substr($file, 0, $endpos);
           $file = "http://racecast.rfactor.net/" . $file;
        }


      return $file;
   }   
?>