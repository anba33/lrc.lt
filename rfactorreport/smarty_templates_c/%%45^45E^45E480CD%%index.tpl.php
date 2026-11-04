<?php /* Smarty version 2.6.10, created on 2009-11-26 16:53:34
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'index.tpl', 57, false),)), $this); ?>
﻿<body>
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
                                <dt>Serveris:</dt>      <dd><?php echo $this->_tpl_vars['serverName']; ?>
</dd>
                                <dt>Data:</dt> <dd><?php echo $this->_tpl_vars['date']; ?>
</dd>
                                <dt>Trasa:</dt> <dd><?php echo $this->_tpl_vars['track']; ?>
 <em>(<?php echo $this->_tpl_vars['distance']; ?>
 metrai)</em></dd>
                                <dt>Modifikacija:</dt> <dd><?php echo $this->_tpl_vars['mod']; ?>
</dd>
                                <dt>Ratų skaičius:</dt> <dd><?php echo $this->_tpl_vars['laps']; ?>
</dd>
                                <dt>Laikas:</dt> <dd><?php echo $this->_tpl_vars['time']; ?>
</dd>
                                <dt>Pole:</dt> <dd><?php echo $this->_tpl_vars['poledriver']; ?>
 <em>(<?php echo $this->_tpl_vars['poletime']; ?>
)</em></dd>
                                <dt>Nugalėtojas:</dt> <dd><?php echo $this->_tpl_vars['winnerdriver']; ?>
 <em>(<?php echo $this->_tpl_vars['winnertime']; ?>
)</em></dd>
                                <dt>Greičiausias:</dt> <dd><?php echo $this->_tpl_vars['fastestlapdriver']; ?>
 <em>(<?php echo $this->_tpl_vars['fastestlaptime']; ?>
)</em></dd>
                                <dt>Ilgiausiai pirmavo:</dt> <dd><?php echo $this->_tpl_vars['mostlapsleddriver']; ?>
 <em>(<?php echo $this->_tpl_vars['mostlapsledlaps']; ?>
 ratų)</em></dd>
                                <dt>Pozicijos +/- :</dt> <dd><?php echo $this->_tpl_vars['highestclimber']; ?>
 <em>(<?php echo $this->_tpl_vars['highestclimberposition']; ?>
 laimėtos pozicijos)</em></dd>
                        </dl>
                </div><!--overview-->


                <div id="qualificationRules" class="section">

                        <h2>Kvalifikacijos rezultatai - <?php echo $this->_tpl_vars['track']; ?>
 - <?php echo $this->_tpl_vars['serverName']; ?>
 </h2>

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

                                <?php unset($this->_sections['teller']);
$this->_sections['teller']['name'] = 'teller';
$this->_sections['teller']['loop'] = is_array($_loop=$this->_tpl_vars['qpos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller']['show'] = true;
$this->_sections['teller']['max'] = $this->_sections['teller']['loop'];
$this->_sections['teller']['step'] = 1;
$this->_sections['teller']['start'] = $this->_sections['teller']['step'] > 0 ? 0 : $this->_sections['teller']['loop']-1;
if ($this->_sections['teller']['show']) {
    $this->_sections['teller']['total'] = $this->_sections['teller']['loop'];
    if ($this->_sections['teller']['total'] == 0)
        $this->_sections['teller']['show'] = false;
} else
    $this->_sections['teller']['total'] = 0;
if ($this->_sections['teller']['show']):

            for ($this->_sections['teller']['index'] = $this->_sections['teller']['start'], $this->_sections['teller']['iteration'] = 1;
                 $this->_sections['teller']['iteration'] <= $this->_sections['teller']['total'];
                 $this->_sections['teller']['index'] += $this->_sections['teller']['step'], $this->_sections['teller']['iteration']++):
$this->_sections['teller']['rownum'] = $this->_sections['teller']['iteration'];
$this->_sections['teller']['index_prev'] = $this->_sections['teller']['index'] - $this->_sections['teller']['step'];
$this->_sections['teller']['index_next'] = $this->_sections['teller']['index'] + $this->_sections['teller']['step'];
$this->_sections['teller']['first']      = ($this->_sections['teller']['iteration'] == 1);
$this->_sections['teller']['last']       = ($this->_sections['teller']['iteration'] == $this->_sections['teller']['total']);
?>
                                <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                                        <td class="position"><?php echo $this->_tpl_vars['qpos'][$this->_sections['teller']['index']]; ?>
</td>
                                        <td class="driver"><?php echo $this->_tpl_vars['qnaam'][$this->_sections['teller']['index']]; ?>
</td>
                                        <td class="time"><?php echo $this->_tpl_vars['qlaptime'][$this->_sections['teller']['index']]; ?>
</td>
                                        <td class="gap"><?php echo $this->_tpl_vars['qgap'][$this->_sections['teller']['index']]; ?>
</td>
                                        
                                        <td class="team"><?php echo $this->_tpl_vars['qcar'][$this->_sections['teller']['index']]; ?>
</td>
                                        <td><?php echo $this->_tpl_vars['qlaps'][$this->_sections['teller']['index']]; ?>
</td>
                                </tr>
                                <?php endfor; endif; ?>

                        </table>
         
                        <h4 id="qualifyLapDetail">Įveiktų ratų statistika (pagal iškovotas pozicijas)</h4>

                        <div class="subSection">

                        <?php unset($this->_sections['teller2']);
$this->_sections['teller2']['name'] = 'teller2';
$this->_sections['teller2']['loop'] = is_array($_loop=$this->_tpl_vars['qdetailnaam']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller2']['show'] = true;
$this->_sections['teller2']['max'] = $this->_sections['teller2']['loop'];
$this->_sections['teller2']['step'] = 1;
$this->_sections['teller2']['start'] = $this->_sections['teller2']['step'] > 0 ? 0 : $this->_sections['teller2']['loop']-1;
if ($this->_sections['teller2']['show']) {
    $this->_sections['teller2']['total'] = $this->_sections['teller2']['loop'];
    if ($this->_sections['teller2']['total'] == 0)
        $this->_sections['teller2']['show'] = false;
} else
    $this->_sections['teller2']['total'] = 0;
if ($this->_sections['teller2']['show']):

            for ($this->_sections['teller2']['index'] = $this->_sections['teller2']['start'], $this->_sections['teller2']['iteration'] = 1;
                 $this->_sections['teller2']['iteration'] <= $this->_sections['teller2']['total'];
                 $this->_sections['teller2']['index'] += $this->_sections['teller2']['step'], $this->_sections['teller2']['iteration']++):
$this->_sections['teller2']['rownum'] = $this->_sections['teller2']['iteration'];
$this->_sections['teller2']['index_prev'] = $this->_sections['teller2']['index'] - $this->_sections['teller2']['step'];
$this->_sections['teller2']['index_next'] = $this->_sections['teller2']['index'] + $this->_sections['teller2']['step'];
$this->_sections['teller2']['first']      = ($this->_sections['teller2']['iteration'] == 1);
$this->_sections['teller2']['last']       = ($this->_sections['teller2']['iteration'] == $this->_sections['teller2']['total']);
?>

                        <table cellpadding="0" cellspacing="0">

                                <tr>
                                        <th colspan="6"><?php echo $this->_tpl_vars['qdetailnaam'][$this->_sections['teller2']['index']]; ?>
</th>
                                </tr>

                                <tr>
                                        <th>Ratas</th>
                                        <th>Degalų kiekis</th>
                                        <th>Sektorius 1</th>
                                        <th>Sektorius 2</th>
                                        <th>Sektorius 3</th>
                                        <th>Rato laikas</th>
                                </tr>

                                <?php unset($this->_sections['teller3']);
$this->_sections['teller3']['name'] = 'teller3';
$this->_sections['teller3']['loop'] = is_array($_loop=$this->_tpl_vars['qdetaillap'][$this->_sections['teller2']['index']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller3']['show'] = true;
$this->_sections['teller3']['max'] = $this->_sections['teller3']['loop'];
$this->_sections['teller3']['step'] = 1;
$this->_sections['teller3']['start'] = $this->_sections['teller3']['step'] > 0 ? 0 : $this->_sections['teller3']['loop']-1;
if ($this->_sections['teller3']['show']) {
    $this->_sections['teller3']['total'] = $this->_sections['teller3']['loop'];
    if ($this->_sections['teller3']['total'] == 0)
        $this->_sections['teller3']['show'] = false;
} else
    $this->_sections['teller3']['total'] = 0;
if ($this->_sections['teller3']['show']):

            for ($this->_sections['teller3']['index'] = $this->_sections['teller3']['start'], $this->_sections['teller3']['iteration'] = 1;
                 $this->_sections['teller3']['iteration'] <= $this->_sections['teller3']['total'];
                 $this->_sections['teller3']['index'] += $this->_sections['teller3']['step'], $this->_sections['teller3']['iteration']++):
$this->_sections['teller3']['rownum'] = $this->_sections['teller3']['iteration'];
$this->_sections['teller3']['index_prev'] = $this->_sections['teller3']['index'] - $this->_sections['teller3']['step'];
$this->_sections['teller3']['index_next'] = $this->_sections['teller3']['index'] + $this->_sections['teller3']['step'];
$this->_sections['teller3']['first']      = ($this->_sections['teller3']['iteration'] == 1);
$this->_sections['teller3']['last']       = ($this->_sections['teller3']['iteration'] == $this->_sections['teller3']['total']);
?>

                                <tr class="<?php echo smarty_function_cycle(array('values' => "row,altrow"), $this);?>
">
                                        <td><?php echo $this->_tpl_vars['qlapnumber'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                        <td><?php echo $this->_tpl_vars['qfuellevel'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                        <td><?php echo $this->_tpl_vars['qdetails1'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                        <td><?php echo $this->_tpl_vars['qdetails2'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                        <td><?php echo $this->_tpl_vars['qdetails3'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                        <td><?php echo $this->_tpl_vars['qdetaillap'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                </tr>

                                <?php endfor; endif; ?>

                        </table>
                        <?php endfor; endif; ?>

                        </div><!--lap detail subSection-->         
                
                </div><!-- Qualification results -->


                <div id="raceResults" class="section">

                        <h2>Lenktynių rezultatai - <?php echo $this->_tpl_vars['track']; ?>
 - <?php echo $this->_tpl_vars['serverName']; ?>
</h2>

                        <?php if ($this->_tpl_vars['swapped'] == 'true'): ?>

                        <h3>Driver swaps</h3>
                
                        <?php unset($this->_sections['teller2']);
$this->_sections['teller2']['name'] = 'teller2';
$this->_sections['teller2']['loop'] = is_array($_loop=$this->_tpl_vars['swapnaam']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller2']['show'] = true;
$this->_sections['teller2']['max'] = $this->_sections['teller2']['loop'];
$this->_sections['teller2']['step'] = 1;
$this->_sections['teller2']['start'] = $this->_sections['teller2']['step'] > 0 ? 0 : $this->_sections['teller2']['loop']-1;
if ($this->_sections['teller2']['show']) {
    $this->_sections['teller2']['total'] = $this->_sections['teller2']['loop'];
    if ($this->_sections['teller2']['total'] == 0)
        $this->_sections['teller2']['show'] = false;
} else
    $this->_sections['teller2']['total'] = 0;
if ($this->_sections['teller2']['show']):

            for ($this->_sections['teller2']['index'] = $this->_sections['teller2']['start'], $this->_sections['teller2']['iteration'] = 1;
                 $this->_sections['teller2']['iteration'] <= $this->_sections['teller2']['total'];
                 $this->_sections['teller2']['index'] += $this->_sections['teller2']['step'], $this->_sections['teller2']['iteration']++):
$this->_sections['teller2']['rownum'] = $this->_sections['teller2']['iteration'];
$this->_sections['teller2']['index_prev'] = $this->_sections['teller2']['index'] - $this->_sections['teller2']['step'];
$this->_sections['teller2']['index_next'] = $this->_sections['teller2']['index'] + $this->_sections['teller2']['step'];
$this->_sections['teller2']['first']      = ($this->_sections['teller2']['iteration'] == 1);
$this->_sections['teller2']['last']       = ($this->_sections['teller2']['iteration'] == $this->_sections['teller2']['total']);
?>           
                        <table cellpadding="0" cellspacing="0">        
                                <tr>
                                        <th colspan="3"><?php echo $this->_tpl_vars['swapnaam'][$this->_sections['teller2']['index']]; ?>
</th>
                                </tr>
                
                                <tr>
                                        <td>Startlap</td>
                                        <td>Ending lap</td>
                                        <td>Driver</td>
                                </tr>
                
                                <?php unset($this->_sections['teller3']);
$this->_sections['teller3']['name'] = 'teller3';
$this->_sections['teller3']['loop'] = is_array($_loop=$this->_tpl_vars['swapdetaildriver'][$this->_sections['teller2']['index']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller3']['show'] = true;
$this->_sections['teller3']['max'] = $this->_sections['teller3']['loop'];
$this->_sections['teller3']['step'] = 1;
$this->_sections['teller3']['start'] = $this->_sections['teller3']['step'] > 0 ? 0 : $this->_sections['teller3']['loop']-1;
if ($this->_sections['teller3']['show']) {
    $this->_sections['teller3']['total'] = $this->_sections['teller3']['loop'];
    if ($this->_sections['teller3']['total'] == 0)
        $this->_sections['teller3']['show'] = false;
} else
    $this->_sections['teller3']['total'] = 0;
if ($this->_sections['teller3']['show']):

            for ($this->_sections['teller3']['index'] = $this->_sections['teller3']['start'], $this->_sections['teller3']['iteration'] = 1;
                 $this->_sections['teller3']['iteration'] <= $this->_sections['teller3']['total'];
                 $this->_sections['teller3']['index'] += $this->_sections['teller3']['step'], $this->_sections['teller3']['iteration']++):
$this->_sections['teller3']['rownum'] = $this->_sections['teller3']['iteration'];
$this->_sections['teller3']['index_prev'] = $this->_sections['teller3']['index'] - $this->_sections['teller3']['step'];
$this->_sections['teller3']['index_next'] = $this->_sections['teller3']['index'] + $this->_sections['teller3']['step'];
$this->_sections['teller3']['first']      = ($this->_sections['teller3']['iteration'] == 1);
$this->_sections['teller3']['last']       = ($this->_sections['teller3']['iteration'] == $this->_sections['teller3']['total']);
?>
                                <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                                        <td><?php echo $this->_tpl_vars['swapdetailstartlap'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                        <td><?php echo $this->_tpl_vars['swapdetailendlap'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                        <td><?php echo $this->_tpl_vars['swapdetaildriver'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                </tr>
                                <?php endfor; endif; ?>
                                
                        </table> 
                        <?php endfor; endif; ?>
        
                        <p>
                                <strong>Note:</strong>
                                The driver who drove the last stint will be used as the &#39;main driver&#39;.<br />
                                You will only find the name of the 'main driver' in the rest of this report.<br />
                                However, when driverswaps occured all information is car specific and not driver specific. For example you will 
                                see the name of the main driver in the fastest laps overview, but it could just as well be another driver of 
                                that car that drove the fastest lap.
                        </p>

                        <?php endif; ?>

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

                                <?php unset($this->_sections['teller']);
$this->_sections['teller']['name'] = 'teller';
$this->_sections['teller']['loop'] = is_array($_loop=$this->_tpl_vars['rpos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller']['show'] = true;
$this->_sections['teller']['max'] = $this->_sections['teller']['loop'];
$this->_sections['teller']['step'] = 1;
$this->_sections['teller']['start'] = $this->_sections['teller']['step'] > 0 ? 0 : $this->_sections['teller']['loop']-1;
if ($this->_sections['teller']['show']) {
    $this->_sections['teller']['total'] = $this->_sections['teller']['loop'];
    if ($this->_sections['teller']['total'] == 0)
        $this->_sections['teller']['show'] = false;
} else
    $this->_sections['teller']['total'] = 0;
if ($this->_sections['teller']['show']):

            for ($this->_sections['teller']['index'] = $this->_sections['teller']['start'], $this->_sections['teller']['iteration'] = 1;
                 $this->_sections['teller']['iteration'] <= $this->_sections['teller']['total'];
                 $this->_sections['teller']['index'] += $this->_sections['teller']['step'], $this->_sections['teller']['iteration']++):
$this->_sections['teller']['rownum'] = $this->_sections['teller']['iteration'];
$this->_sections['teller']['index_prev'] = $this->_sections['teller']['index'] - $this->_sections['teller']['step'];
$this->_sections['teller']['index_next'] = $this->_sections['teller']['index'] + $this->_sections['teller']['step'];
$this->_sections['teller']['first']      = ($this->_sections['teller']['iteration'] == 1);
$this->_sections['teller']['last']       = ($this->_sections['teller']['iteration'] == $this->_sections['teller']['total']);
?>
                 <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                        <td class="position"><?php echo $this->_tpl_vars['rpos'][$this->_sections['teller']['index']]; ?>
</td>
                                        <td class="driver"><?php echo $this->_tpl_vars['rnaam'][$this->_sections['teller']['index']]; ?>
</td>
                        <td class="time"><?php echo $this->_tpl_vars['rlaptime'][$this->_sections['teller']['index']]; ?>
</td>
                        <td class="gap"><?php echo $this->_tpl_vars['rgap'][$this->_sections['teller']['index']]; ?>
</td>
                        
                        <td class="team"><?php echo $this->_tpl_vars['rcar'][$this->_sections['teller']['index']]; ?>
</td>
                        
                        <td><?php echo $this->_tpl_vars['rlaps'][$this->_sections['teller']['index']]; ?>
</td>
                        <td><?php echo $this->_tpl_vars['rpit'][$this->_sections['teller']['index']]; ?>
</td>
                </tr>
                                <?php endfor; endif; ?>

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

                                <?php unset($this->_sections['teller2']);
$this->_sections['teller2']['name'] = 'teller2';
$this->_sections['teller2']['loop'] = is_array($_loop=$this->_tpl_vars['rdetailnaam']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller2']['show'] = true;
$this->_sections['teller2']['max'] = $this->_sections['teller2']['loop'];
$this->_sections['teller2']['step'] = 1;
$this->_sections['teller2']['start'] = $this->_sections['teller2']['step'] > 0 ? 0 : $this->_sections['teller2']['loop']-1;
if ($this->_sections['teller2']['show']) {
    $this->_sections['teller2']['total'] = $this->_sections['teller2']['loop'];
    if ($this->_sections['teller2']['total'] == 0)
        $this->_sections['teller2']['show'] = false;
} else
    $this->_sections['teller2']['total'] = 0;
if ($this->_sections['teller2']['show']):

            for ($this->_sections['teller2']['index'] = $this->_sections['teller2']['start'], $this->_sections['teller2']['iteration'] = 1;
                 $this->_sections['teller2']['iteration'] <= $this->_sections['teller2']['total'];
                 $this->_sections['teller2']['index'] += $this->_sections['teller2']['step'], $this->_sections['teller2']['iteration']++):
$this->_sections['teller2']['rownum'] = $this->_sections['teller2']['iteration'];
$this->_sections['teller2']['index_prev'] = $this->_sections['teller2']['index'] - $this->_sections['teller2']['step'];
$this->_sections['teller2']['index_next'] = $this->_sections['teller2']['index'] + $this->_sections['teller2']['step'];
$this->_sections['teller2']['first']      = ($this->_sections['teller2']['iteration'] == 1);
$this->_sections['teller2']['last']       = ($this->_sections['teller2']['iteration'] == $this->_sections['teller2']['total']);
?>

                                <table cellpadding="0" cellspacing="0">
                                
                                        <tr>
                                                <th colspan="6"><?php echo $this->_tpl_vars['rdetailnaam'][$this->_sections['teller2']['index']]; ?>
</th>
                                        </tr>
                                        
                                        <tr>
                                                <th>Ratas</th>
                                                <th>Degalų kiekis</th>
                                                <th>Sektorius 1</th>
                                                <th>Sektorius 2</th>
                                                <th>Sektorius 3</th>
                                                <th>Rato laikas</th>
                                        </tr>

                                        <?php unset($this->_sections['teller3']);
$this->_sections['teller3']['name'] = 'teller3';
$this->_sections['teller3']['loop'] = is_array($_loop=$this->_tpl_vars['rdetaillap'][$this->_sections['teller2']['index']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller3']['show'] = true;
$this->_sections['teller3']['max'] = $this->_sections['teller3']['loop'];
$this->_sections['teller3']['step'] = 1;
$this->_sections['teller3']['start'] = $this->_sections['teller3']['step'] > 0 ? 0 : $this->_sections['teller3']['loop']-1;
if ($this->_sections['teller3']['show']) {
    $this->_sections['teller3']['total'] = $this->_sections['teller3']['loop'];
    if ($this->_sections['teller3']['total'] == 0)
        $this->_sections['teller3']['show'] = false;
} else
    $this->_sections['teller3']['total'] = 0;
if ($this->_sections['teller3']['show']):

            for ($this->_sections['teller3']['index'] = $this->_sections['teller3']['start'], $this->_sections['teller3']['iteration'] = 1;
                 $this->_sections['teller3']['iteration'] <= $this->_sections['teller3']['total'];
                 $this->_sections['teller3']['index'] += $this->_sections['teller3']['step'], $this->_sections['teller3']['iteration']++):
$this->_sections['teller3']['rownum'] = $this->_sections['teller3']['iteration'];
$this->_sections['teller3']['index_prev'] = $this->_sections['teller3']['index'] - $this->_sections['teller3']['step'];
$this->_sections['teller3']['index_next'] = $this->_sections['teller3']['index'] + $this->_sections['teller3']['step'];
$this->_sections['teller3']['first']      = ($this->_sections['teller3']['iteration'] == 1);
$this->_sections['teller3']['last']       = ($this->_sections['teller3']['iteration'] == $this->_sections['teller3']['total']);
?>

                                        <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                                                <td><?php echo $this->_tpl_vars['rlapnumber'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                                <td><?php echo $this->_tpl_vars['rfuellevel'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                                <td><?php echo $this->_tpl_vars['rdetails1'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                                <td><?php echo $this->_tpl_vars['rdetails2'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                                <td><?php echo $this->_tpl_vars['rdetails3'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                                <td><?php echo $this->_tpl_vars['rdetaillap'][$this->_sections['teller2']['index']][$this->_sections['teller3']['index']]; ?>
</td>
                                        </tr>

                                        <?php endfor; endif; ?>

                                </table>

                                <?php endfor; endif; ?>

                        </div><!--lap detail-->

                </div><!--Race Results-->


                <div id="raceIncidents" class="section">
        
                        <h2>Lenktynių incidentai - <?php echo $this->_tpl_vars['track']; ?>
 - <?php echo $this->_tpl_vars['serverName']; ?>
</h2>
        
                        <h3>Incidentų/kontaktų skaičius</h3>
        
                        <!-- <div class="subSection"> -->
        
                                <table cellpadding="0" cellspacing="0">
        
                                <tr>
                                        <th class="numIncidents">Incidentų skaičius</th>
                                        <th>Pilotas</th>
                                </tr>
        
                                <?php unset($this->_sections['tteller']);
$this->_sections['tteller']['name'] = 'tteller';
$this->_sections['tteller']['loop'] = is_array($_loop=$this->_tpl_vars['incidentnames']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tteller']['show'] = true;
$this->_sections['tteller']['max'] = $this->_sections['tteller']['loop'];
$this->_sections['tteller']['step'] = 1;
$this->_sections['tteller']['start'] = $this->_sections['tteller']['step'] > 0 ? 0 : $this->_sections['tteller']['loop']-1;
if ($this->_sections['tteller']['show']) {
    $this->_sections['tteller']['total'] = $this->_sections['tteller']['loop'];
    if ($this->_sections['tteller']['total'] == 0)
        $this->_sections['tteller']['show'] = false;
} else
    $this->_sections['tteller']['total'] = 0;
if ($this->_sections['tteller']['show']):

            for ($this->_sections['tteller']['index'] = $this->_sections['tteller']['start'], $this->_sections['tteller']['iteration'] = 1;
                 $this->_sections['tteller']['iteration'] <= $this->_sections['tteller']['total'];
                 $this->_sections['tteller']['index'] += $this->_sections['tteller']['step'], $this->_sections['tteller']['iteration']++):
$this->_sections['tteller']['rownum'] = $this->_sections['tteller']['iteration'];
$this->_sections['tteller']['index_prev'] = $this->_sections['tteller']['index'] - $this->_sections['tteller']['step'];
$this->_sections['tteller']['index_next'] = $this->_sections['tteller']['index'] + $this->_sections['tteller']['step'];
$this->_sections['tteller']['first']      = ($this->_sections['tteller']['iteration'] == 1);
$this->_sections['tteller']['last']       = ($this->_sections['tteller']['iteration'] == $this->_sections['tteller']['total']);
?>

                                <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                                        <td class="numIncidents"><?php echo $this->_tpl_vars['incidentcounter'][$this->_sections['tteller']['index']]; ?>
</td>
                                        <td class="driver"><?php echo $this->_tpl_vars['incidentnames'][$this->_sections['tteller']['index']]; ?>
</td>
                                </tr>

                                <?php endfor; endif; ?>
        
                                </table>
        
                        <!-- </div> --> <!-- subSection Number of contacts/driver-->
                
                        <h4 id="incidents">Incidentų apžvalga išsamiau</h4>
        
                        <div class="subSection">
        
                                <table cellpadding="0" cellspacing="0">
        
                                <tr>
                                        <th>Incidento laikas</th>
                                        <th>Incidentas</th>
                                </tr>
        
                                <?php unset($this->_sections['incidentteller']);
$this->_sections['incidentteller']['name'] = 'incidentteller';
$this->_sections['incidentteller']['loop'] = is_array($_loop=$this->_tpl_vars['itime']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['incidentteller']['show'] = true;
$this->_sections['incidentteller']['max'] = $this->_sections['incidentteller']['loop'];
$this->_sections['incidentteller']['step'] = 1;
$this->_sections['incidentteller']['start'] = $this->_sections['incidentteller']['step'] > 0 ? 0 : $this->_sections['incidentteller']['loop']-1;
if ($this->_sections['incidentteller']['show']) {
    $this->_sections['incidentteller']['total'] = $this->_sections['incidentteller']['loop'];
    if ($this->_sections['incidentteller']['total'] == 0)
        $this->_sections['incidentteller']['show'] = false;
} else
    $this->_sections['incidentteller']['total'] = 0;
if ($this->_sections['incidentteller']['show']):

            for ($this->_sections['incidentteller']['index'] = $this->_sections['incidentteller']['start'], $this->_sections['incidentteller']['iteration'] = 1;
                 $this->_sections['incidentteller']['iteration'] <= $this->_sections['incidentteller']['total'];
                 $this->_sections['incidentteller']['index'] += $this->_sections['incidentteller']['step'], $this->_sections['incidentteller']['iteration']++):
$this->_sections['incidentteller']['rownum'] = $this->_sections['incidentteller']['iteration'];
$this->_sections['incidentteller']['index_prev'] = $this->_sections['incidentteller']['index'] - $this->_sections['incidentteller']['step'];
$this->_sections['incidentteller']['index_next'] = $this->_sections['incidentteller']['index'] + $this->_sections['incidentteller']['step'];
$this->_sections['incidentteller']['first']      = ($this->_sections['incidentteller']['iteration'] == 1);
$this->_sections['incidentteller']['last']       = ($this->_sections['incidentteller']['iteration'] == $this->_sections['incidentteller']['total']);
?>

                  <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                 <td class="timeOfIncident"><?php echo $this->_tpl_vars['itime'][$this->_sections['incidentteller']['index']]; ?>
</td>
                     <td class="driverIncident"><?php echo $this->_tpl_vars['iincident'][$this->_sections['incidentteller']['index']]; ?>
</td>
                  </tr>

                                <?php endfor; endif; ?>
        
                                </table>
        
                        </div><!--Overview-->
            <h2>Pokalbiai - <?php echo $this->_tpl_vars['track']; ?>
 - <?php echo $this->_tpl_vars['serverName']; ?>
</h2>
            <table cellpadding="0" cellspacing="0">
                                <tr>
                  <th>Laikas</th>
                                        <th>Pilotas</th>
                                        <th>Žinutė</th>
                                </tr>
                                <?php unset($this->_sections['chatcounter']);
$this->_sections['chatcounter']['name'] = 'chatcounter';
$this->_sections['chatcounter']['loop'] = is_array($_loop=$this->_tpl_vars['ichatDriver']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['chatcounter']['show'] = true;
$this->_sections['chatcounter']['max'] = $this->_sections['chatcounter']['loop'];
$this->_sections['chatcounter']['step'] = 1;
$this->_sections['chatcounter']['start'] = $this->_sections['chatcounter']['step'] > 0 ? 0 : $this->_sections['chatcounter']['loop']-1;
if ($this->_sections['chatcounter']['show']) {
    $this->_sections['chatcounter']['total'] = $this->_sections['chatcounter']['loop'];
    if ($this->_sections['chatcounter']['total'] == 0)
        $this->_sections['chatcounter']['show'] = false;
} else
    $this->_sections['chatcounter']['total'] = 0;
if ($this->_sections['chatcounter']['show']):

            for ($this->_sections['chatcounter']['index'] = $this->_sections['chatcounter']['start'], $this->_sections['chatcounter']['iteration'] = 1;
                 $this->_sections['chatcounter']['iteration'] <= $this->_sections['chatcounter']['total'];
                 $this->_sections['chatcounter']['index'] += $this->_sections['chatcounter']['step'], $this->_sections['chatcounter']['iteration']++):
$this->_sections['chatcounter']['rownum'] = $this->_sections['chatcounter']['iteration'];
$this->_sections['chatcounter']['index_prev'] = $this->_sections['chatcounter']['index'] - $this->_sections['chatcounter']['step'];
$this->_sections['chatcounter']['index_next'] = $this->_sections['chatcounter']['index'] + $this->_sections['chatcounter']['step'];
$this->_sections['chatcounter']['first']      = ($this->_sections['chatcounter']['iteration'] == 1);
$this->_sections['chatcounter']['last']       = ($this->_sections['chatcounter']['iteration'] == $this->_sections['chatcounter']['total']);
?>
                  <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                  <td><?php echo $this->_tpl_vars['ichattime'][$this->_sections['chatcounter']['index']]; ?>
</td>
                 <td><?php echo $this->_tpl_vars['ichatDriver'][$this->_sections['chatcounter']['index']]; ?>
</td>
                  <td class="driverIncident"><?php echo $this->_tpl_vars['ichatMessage'][$this->_sections['chatcounter']['index']]; ?>
</td>
               </tr>
                                <?php endfor; endif; ?>
            </table>
                </div><!--race incidents-->

                <div id="raceLeaders" class="section">
        
                        <h2>Lenktynių lyderiai - <?php echo $this->_tpl_vars['track']; ?>
 - <?php echo $this->_tpl_vars['serverName']; ?>
</h2>
        
                        <table cellpadding="0" cellspacing="0">
        
                                <tr>
                                        <th>Pilotas</th>
                                        <th>Ratai</th>
                                        
                                        <th>Komanda</th>
                                </tr>
        
                                <?php unset($this->_sections['leaderteller']);
$this->_sections['leaderteller']['name'] = 'leaderteller';
$this->_sections['leaderteller']['loop'] = is_array($_loop=$this->_tpl_vars['raceleaderrondes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['leaderteller']['show'] = true;
$this->_sections['leaderteller']['max'] = $this->_sections['leaderteller']['loop'];
$this->_sections['leaderteller']['step'] = 1;
$this->_sections['leaderteller']['start'] = $this->_sections['leaderteller']['step'] > 0 ? 0 : $this->_sections['leaderteller']['loop']-1;
if ($this->_sections['leaderteller']['show']) {
    $this->_sections['leaderteller']['total'] = $this->_sections['leaderteller']['loop'];
    if ($this->_sections['leaderteller']['total'] == 0)
        $this->_sections['leaderteller']['show'] = false;
} else
    $this->_sections['leaderteller']['total'] = 0;
if ($this->_sections['leaderteller']['show']):

            for ($this->_sections['leaderteller']['index'] = $this->_sections['leaderteller']['start'], $this->_sections['leaderteller']['iteration'] = 1;
                 $this->_sections['leaderteller']['iteration'] <= $this->_sections['leaderteller']['total'];
                 $this->_sections['leaderteller']['index'] += $this->_sections['leaderteller']['step'], $this->_sections['leaderteller']['iteration']++):
$this->_sections['leaderteller']['rownum'] = $this->_sections['leaderteller']['iteration'];
$this->_sections['leaderteller']['index_prev'] = $this->_sections['leaderteller']['index'] - $this->_sections['leaderteller']['step'];
$this->_sections['leaderteller']['index_next'] = $this->_sections['leaderteller']['index'] + $this->_sections['leaderteller']['step'];
$this->_sections['leaderteller']['first']      = ($this->_sections['leaderteller']['iteration'] == 1);
$this->_sections['leaderteller']['last']       = ($this->_sections['leaderteller']['iteration'] == $this->_sections['leaderteller']['total']);
?>

                                <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                                        <td class="driver"><?php echo $this->_tpl_vars['raceleadernamen'][$this->_sections['leaderteller']['index']]; ?>
</td>
                                        <td><?php echo $this->_tpl_vars['raceleaderrondes'][$this->_sections['leaderteller']['index']]; ?>
</td>
                                        
                                        <td class="team"><?php echo $this->_tpl_vars['raceleadercar'][$this->_sections['leaderteller']['index']]; ?>
</td>
                                </tr>

                                <?php endfor; endif; ?>
        
                        </table>
        
                </div><!--Race Leaders -->


                <div id="fastestLaps" class="section">

                        <h2>Greičiausieji ratai - <?php echo $this->_tpl_vars['track']; ?>
 - <?php echo $this->_tpl_vars['serverName']; ?>
</h2>
                
                        

<!--                    <div class="subSection">-->

                                <table cellpadding="0" cellspacing="0">

                                <tr>
                                        <th>Pos</th>
                                        <th>Pilotas</th>
                                        <th>Rato laikas</th>
                                        <th>Skirtumas</th>
                                        
                                        <th>Komanda</th>
                                </tr>

                                <?php unset($this->_sections['teller5']);
$this->_sections['teller5']['name'] = 'teller5';
$this->_sections['teller5']['loop'] = is_array($_loop=$this->_tpl_vars['fastestname']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller5']['show'] = true;
$this->_sections['teller5']['max'] = $this->_sections['teller5']['loop'];
$this->_sections['teller5']['step'] = 1;
$this->_sections['teller5']['start'] = $this->_sections['teller5']['step'] > 0 ? 0 : $this->_sections['teller5']['loop']-1;
if ($this->_sections['teller5']['show']) {
    $this->_sections['teller5']['total'] = $this->_sections['teller5']['loop'];
    if ($this->_sections['teller5']['total'] == 0)
        $this->_sections['teller5']['show'] = false;
} else
    $this->_sections['teller5']['total'] = 0;
if ($this->_sections['teller5']['show']):

            for ($this->_sections['teller5']['index'] = $this->_sections['teller5']['start'], $this->_sections['teller5']['iteration'] = 1;
                 $this->_sections['teller5']['iteration'] <= $this->_sections['teller5']['total'];
                 $this->_sections['teller5']['index'] += $this->_sections['teller5']['step'], $this->_sections['teller5']['iteration']++):
$this->_sections['teller5']['rownum'] = $this->_sections['teller5']['iteration'];
$this->_sections['teller5']['index_prev'] = $this->_sections['teller5']['index'] - $this->_sections['teller5']['step'];
$this->_sections['teller5']['index_next'] = $this->_sections['teller5']['index'] + $this->_sections['teller5']['step'];
$this->_sections['teller5']['first']      = ($this->_sections['teller5']['iteration'] == 1);
$this->_sections['teller5']['last']       = ($this->_sections['teller5']['iteration'] == $this->_sections['teller5']['total']);
?>

                                <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                                        <td class="position"><?php echo $this->_tpl_vars['fastestposition'][$this->_sections['teller5']['index']]; ?>
</td>
                                        <td class="driver"><?php echo $this->_tpl_vars['fastestname'][$this->_sections['teller5']['index']]; ?>
</td>
                                        <td class="time"><?php echo $this->_tpl_vars['fastesttime'][$this->_sections['teller5']['index']]; ?>
</td>
                                        <td class="gap"><?php echo $this->_tpl_vars['fastestgap'][$this->_sections['teller5']['index']]; ?>
</td>
                                        
                                        <td class="team"><?php echo $this->_tpl_vars['fastestcar'][$this->_sections['teller5']['index']]; ?>
</td>
                                </tr>

                                <?php endfor; endif; ?>

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

                                        <?php unset($this->_sections['teller20']);
$this->_sections['teller20']['name'] = 'teller20';
$this->_sections['teller20']['loop'] = is_array($_loop=$this->_tpl_vars['ppos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller20']['show'] = true;
$this->_sections['teller20']['max'] = $this->_sections['teller20']['loop'];
$this->_sections['teller20']['step'] = 1;
$this->_sections['teller20']['start'] = $this->_sections['teller20']['step'] > 0 ? 0 : $this->_sections['teller20']['loop']-1;
if ($this->_sections['teller20']['show']) {
    $this->_sections['teller20']['total'] = $this->_sections['teller20']['loop'];
    if ($this->_sections['teller20']['total'] == 0)
        $this->_sections['teller20']['show'] = false;
} else
    $this->_sections['teller20']['total'] = 0;
if ($this->_sections['teller20']['show']):

            for ($this->_sections['teller20']['index'] = $this->_sections['teller20']['start'], $this->_sections['teller20']['iteration'] = 1;
                 $this->_sections['teller20']['iteration'] <= $this->_sections['teller20']['total'];
                 $this->_sections['teller20']['index'] += $this->_sections['teller20']['step'], $this->_sections['teller20']['iteration']++):
$this->_sections['teller20']['rownum'] = $this->_sections['teller20']['iteration'];
$this->_sections['teller20']['index_prev'] = $this->_sections['teller20']['index'] - $this->_sections['teller20']['step'];
$this->_sections['teller20']['index_next'] = $this->_sections['teller20']['index'] + $this->_sections['teller20']['step'];
$this->_sections['teller20']['first']      = ($this->_sections['teller20']['iteration'] == 1);
$this->_sections['teller20']['last']       = ($this->_sections['teller20']['iteration'] == $this->_sections['teller20']['total']);
?>

                                        <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                                                <td class="position"><?php echo $this->_tpl_vars['ppos'][$this->_sections['teller20']['index']]; ?>
</td>
                                                <td class="driver"><?php echo $this->_tpl_vars['pdriver'][$this->_sections['teller20']['index']]; ?>
</td>
                                                <td class="time"><?php echo $this->_tpl_vars['ptime'][$this->_sections['teller20']['index']]; ?>
</td>
                                                <td class="gap"><?php echo $this->_tpl_vars['pgap'][$this->_sections['teller20']['index']]; ?>
</td>
                                                
                                                <td class="team"><?php echo $this->_tpl_vars['pcar'][$this->_sections['teller20']['index']]; ?>
</td>
                                        </tr>

                                        <?php endfor; endif; ?>

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

                                        <?php unset($this->_sections['teller6']);
$this->_sections['teller6']['name'] = 'teller6';
$this->_sections['teller6']['loop'] = is_array($_loop=$this->_tpl_vars['s1name']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller6']['show'] = true;
$this->_sections['teller6']['max'] = $this->_sections['teller6']['loop'];
$this->_sections['teller6']['step'] = 1;
$this->_sections['teller6']['start'] = $this->_sections['teller6']['step'] > 0 ? 0 : $this->_sections['teller6']['loop']-1;
if ($this->_sections['teller6']['show']) {
    $this->_sections['teller6']['total'] = $this->_sections['teller6']['loop'];
    if ($this->_sections['teller6']['total'] == 0)
        $this->_sections['teller6']['show'] = false;
} else
    $this->_sections['teller6']['total'] = 0;
if ($this->_sections['teller6']['show']):

            for ($this->_sections['teller6']['index'] = $this->_sections['teller6']['start'], $this->_sections['teller6']['iteration'] = 1;
                 $this->_sections['teller6']['iteration'] <= $this->_sections['teller6']['total'];
                 $this->_sections['teller6']['index'] += $this->_sections['teller6']['step'], $this->_sections['teller6']['iteration']++):
$this->_sections['teller6']['rownum'] = $this->_sections['teller6']['iteration'];
$this->_sections['teller6']['index_prev'] = $this->_sections['teller6']['index'] - $this->_sections['teller6']['step'];
$this->_sections['teller6']['index_next'] = $this->_sections['teller6']['index'] + $this->_sections['teller6']['step'];
$this->_sections['teller6']['first']      = ($this->_sections['teller6']['iteration'] == 1);
$this->_sections['teller6']['last']       = ($this->_sections['teller6']['iteration'] == $this->_sections['teller6']['total']);
?>

                                        <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                                                <td class="position"><?php echo $this->_tpl_vars['s1position'][$this->_sections['teller6']['index']]; ?>
</td>
                                                <td class="driver"><?php echo $this->_tpl_vars['s1name'][$this->_sections['teller6']['index']]; ?>
</td>
                                                <td class="time"><?php echo $this->_tpl_vars['s1time'][$this->_sections['teller6']['index']]; ?>
</td>
                                                <td class="gap"><?php echo $this->_tpl_vars['s1gap'][$this->_sections['teller6']['index']]; ?>
</td>
                                                
                                                <td class="team"><?php echo $this->_tpl_vars['s1car'][$this->_sections['teller6']['index']]; ?>
</td>
                                        </tr>

                                        <?php endfor; endif; ?>

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

                                        <?php unset($this->_sections['teller7']);
$this->_sections['teller7']['name'] = 'teller7';
$this->_sections['teller7']['loop'] = is_array($_loop=$this->_tpl_vars['s2name']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller7']['show'] = true;
$this->_sections['teller7']['max'] = $this->_sections['teller7']['loop'];
$this->_sections['teller7']['step'] = 1;
$this->_sections['teller7']['start'] = $this->_sections['teller7']['step'] > 0 ? 0 : $this->_sections['teller7']['loop']-1;
if ($this->_sections['teller7']['show']) {
    $this->_sections['teller7']['total'] = $this->_sections['teller7']['loop'];
    if ($this->_sections['teller7']['total'] == 0)
        $this->_sections['teller7']['show'] = false;
} else
    $this->_sections['teller7']['total'] = 0;
if ($this->_sections['teller7']['show']):

            for ($this->_sections['teller7']['index'] = $this->_sections['teller7']['start'], $this->_sections['teller7']['iteration'] = 1;
                 $this->_sections['teller7']['iteration'] <= $this->_sections['teller7']['total'];
                 $this->_sections['teller7']['index'] += $this->_sections['teller7']['step'], $this->_sections['teller7']['iteration']++):
$this->_sections['teller7']['rownum'] = $this->_sections['teller7']['iteration'];
$this->_sections['teller7']['index_prev'] = $this->_sections['teller7']['index'] - $this->_sections['teller7']['step'];
$this->_sections['teller7']['index_next'] = $this->_sections['teller7']['index'] + $this->_sections['teller7']['step'];
$this->_sections['teller7']['first']      = ($this->_sections['teller7']['iteration'] == 1);
$this->_sections['teller7']['last']       = ($this->_sections['teller7']['iteration'] == $this->_sections['teller7']['total']);
?>

                                        <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                                                <td class="position"><?php echo $this->_tpl_vars['s2position'][$this->_sections['teller7']['index']]; ?>
</td>
                                                <td class="driver"><?php echo $this->_tpl_vars['s2name'][$this->_sections['teller7']['index']]; ?>
</td>
                                                <td class="time"><?php echo $this->_tpl_vars['s2time'][$this->_sections['teller7']['index']]; ?>
</td>
                                                <td class="gap"><?php echo $this->_tpl_vars['s2gap'][$this->_sections['teller7']['index']]; ?>
</td>
                                                
                                                <td class="team"><?php echo $this->_tpl_vars['s2car'][$this->_sections['teller7']['index']]; ?>
</td>
                                        </tr>

                                <?php endfor; endif; ?>

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

                                        <?php unset($this->_sections['teller8']);
$this->_sections['teller8']['name'] = 'teller8';
$this->_sections['teller8']['loop'] = is_array($_loop=$this->_tpl_vars['s3name']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller8']['show'] = true;
$this->_sections['teller8']['max'] = $this->_sections['teller8']['loop'];
$this->_sections['teller8']['step'] = 1;
$this->_sections['teller8']['start'] = $this->_sections['teller8']['step'] > 0 ? 0 : $this->_sections['teller8']['loop']-1;
if ($this->_sections['teller8']['show']) {
    $this->_sections['teller8']['total'] = $this->_sections['teller8']['loop'];
    if ($this->_sections['teller8']['total'] == 0)
        $this->_sections['teller8']['show'] = false;
} else
    $this->_sections['teller8']['total'] = 0;
if ($this->_sections['teller8']['show']):

            for ($this->_sections['teller8']['index'] = $this->_sections['teller8']['start'], $this->_sections['teller8']['iteration'] = 1;
                 $this->_sections['teller8']['iteration'] <= $this->_sections['teller8']['total'];
                 $this->_sections['teller8']['index'] += $this->_sections['teller8']['step'], $this->_sections['teller8']['iteration']++):
$this->_sections['teller8']['rownum'] = $this->_sections['teller8']['iteration'];
$this->_sections['teller8']['index_prev'] = $this->_sections['teller8']['index'] - $this->_sections['teller8']['step'];
$this->_sections['teller8']['index_next'] = $this->_sections['teller8']['index'] + $this->_sections['teller8']['step'];
$this->_sections['teller8']['first']      = ($this->_sections['teller8']['iteration'] == 1);
$this->_sections['teller8']['last']       = ($this->_sections['teller8']['iteration'] == $this->_sections['teller8']['total']);
?>

                                        <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                                                <td class="position"><?php echo $this->_tpl_vars['s3position'][$this->_sections['teller8']['index']]; ?>
</td>
                                                <td class="driver"><?php echo $this->_tpl_vars['s3name'][$this->_sections['teller8']['index']]; ?>
</td>
                                                <td class="time"><?php echo $this->_tpl_vars['s3time'][$this->_sections['teller8']['index']]; ?>
</td>
                                                <td class="gap"><?php echo $this->_tpl_vars['s3gap'][$this->_sections['teller8']['index']]; ?>
</td>
                                                
                                                <td class="team"><?php echo $this->_tpl_vars['s3car'][$this->_sections['teller8']['index']]; ?>
</td>
                                        </tr>

                                        <?php endfor; endif; ?>

                                </table>

                        </div><!--sector 3-->

                </div><!--Fastest laps-->


                <div id="highestClimbers" class="section">

                        <h2>Daugiausiai iškovoję pozicijų: - <?php echo $this->_tpl_vars['track']; ?>
 - <?php echo $this->_tpl_vars['serverName']; ?>
</h2>

                        <table cellpadding="0" cellspacing="0">

                                <tr>
                                        <th>+/-</th>
                                        <th>Pilotas</th>
                                        <th>Starto pozicija</th>
                                        <th>Finišo pozicija</th>
                                        
                                        <th>Komanda</th>
                                </tr>

                                <?php unset($this->_sections['teller9']);
$this->_sections['teller9']['name'] = 'teller9';
$this->_sections['teller9']['loop'] = is_array($_loop=$this->_tpl_vars['hcpositions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller9']['show'] = true;
$this->_sections['teller9']['max'] = $this->_sections['teller9']['loop'];
$this->_sections['teller9']['step'] = 1;
$this->_sections['teller9']['start'] = $this->_sections['teller9']['step'] > 0 ? 0 : $this->_sections['teller9']['loop']-1;
if ($this->_sections['teller9']['show']) {
    $this->_sections['teller9']['total'] = $this->_sections['teller9']['loop'];
    if ($this->_sections['teller9']['total'] == 0)
        $this->_sections['teller9']['show'] = false;
} else
    $this->_sections['teller9']['total'] = 0;
if ($this->_sections['teller9']['show']):

            for ($this->_sections['teller9']['index'] = $this->_sections['teller9']['start'], $this->_sections['teller9']['iteration'] = 1;
                 $this->_sections['teller9']['iteration'] <= $this->_sections['teller9']['total'];
                 $this->_sections['teller9']['index'] += $this->_sections['teller9']['step'], $this->_sections['teller9']['iteration']++):
$this->_sections['teller9']['rownum'] = $this->_sections['teller9']['iteration'];
$this->_sections['teller9']['index_prev'] = $this->_sections['teller9']['index'] - $this->_sections['teller9']['step'];
$this->_sections['teller9']['index_next'] = $this->_sections['teller9']['index'] + $this->_sections['teller9']['step'];
$this->_sections['teller9']['first']      = ($this->_sections['teller9']['iteration'] == 1);
$this->_sections['teller9']['last']       = ($this->_sections['teller9']['iteration'] == $this->_sections['teller9']['total']);
?>

                                <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                                        <td class="position"><?php echo $this->_tpl_vars['hcpositions'][$this->_sections['teller9']['index']]; ?>
</td>
                                        <td class="driver"><?php echo $this->_tpl_vars['hcdriver'][$this->_sections['teller9']['index']]; ?>
</td>
                                        <td><?php echo $this->_tpl_vars['hcstartposition'][$this->_sections['teller9']['index']]; ?>
</td>
                                        <td><?php echo $this->_tpl_vars['hcfinishposition'][$this->_sections['teller9']['index']]; ?>
</td>
                                        
                                        <td class="team"><?php echo $this->_tpl_vars['hccar'][$this->_sections['teller9']['index']]; ?>
</td>
                                </tr>

                                <?php endfor; endif; ?>

                        </table>
                </div><!--highest climbers-->

                
                <div id="laptimeConsistency" class="section">

                        <h2>Lenktynių ratų įveikimo nuoseklumas - <?php echo $this->_tpl_vars['track']; ?>
 - <?php echo $this->_tpl_vars['serverName']; ?>
</h2>
                
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

                                        <?php unset($this->_sections['teller10']);
$this->_sections['teller10']['name'] = 'teller10';
$this->_sections['teller10']['loop'] = is_array($_loop=$this->_tpl_vars['stddevpos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller10']['show'] = true;
$this->_sections['teller10']['max'] = $this->_sections['teller10']['loop'];
$this->_sections['teller10']['step'] = 1;
$this->_sections['teller10']['start'] = $this->_sections['teller10']['step'] > 0 ? 0 : $this->_sections['teller10']['loop']-1;
if ($this->_sections['teller10']['show']) {
    $this->_sections['teller10']['total'] = $this->_sections['teller10']['loop'];
    if ($this->_sections['teller10']['total'] == 0)
        $this->_sections['teller10']['show'] = false;
} else
    $this->_sections['teller10']['total'] = 0;
if ($this->_sections['teller10']['show']):

            for ($this->_sections['teller10']['index'] = $this->_sections['teller10']['start'], $this->_sections['teller10']['iteration'] = 1;
                 $this->_sections['teller10']['iteration'] <= $this->_sections['teller10']['total'];
                 $this->_sections['teller10']['index'] += $this->_sections['teller10']['step'], $this->_sections['teller10']['iteration']++):
$this->_sections['teller10']['rownum'] = $this->_sections['teller10']['iteration'];
$this->_sections['teller10']['index_prev'] = $this->_sections['teller10']['index'] - $this->_sections['teller10']['step'];
$this->_sections['teller10']['index_next'] = $this->_sections['teller10']['index'] + $this->_sections['teller10']['step'];
$this->_sections['teller10']['first']      = ($this->_sections['teller10']['iteration'] == 1);
$this->_sections['teller10']['last']       = ($this->_sections['teller10']['iteration'] == $this->_sections['teller10']['total']);
?>

                                        <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                                                <td class="position"><?php echo $this->_tpl_vars['stddevpos'][$this->_sections['teller10']['index']]; ?>
</td>
                                                <td class="driver"><?php echo $this->_tpl_vars['stddevdriver'][$this->_sections['teller10']['index']]; ?>
</td>
                                                <td class="time"><?php echo $this->_tpl_vars['stddevtime'][$this->_sections['teller10']['index']]; ?>
</td>
                                                <td class="gap"><?php echo $this->_tpl_vars['stddevgap'][$this->_sections['teller10']['index']]; ?>
</td>
                                                
                                                <td class="team"><?php echo $this->_tpl_vars['stddevcar'][$this->_sections['teller10']['index']]; ?>
</td>
                                        </tr>

                                <?php endfor; endif; ?>

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

                                        <?php unset($this->_sections['teller11']);
$this->_sections['teller11']['name'] = 'teller11';
$this->_sections['teller11']['loop'] = is_array($_loop=$this->_tpl_vars['avgdevpos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['teller11']['show'] = true;
$this->_sections['teller11']['max'] = $this->_sections['teller11']['loop'];
$this->_sections['teller11']['step'] = 1;
$this->_sections['teller11']['start'] = $this->_sections['teller11']['step'] > 0 ? 0 : $this->_sections['teller11']['loop']-1;
if ($this->_sections['teller11']['show']) {
    $this->_sections['teller11']['total'] = $this->_sections['teller11']['loop'];
    if ($this->_sections['teller11']['total'] == 0)
        $this->_sections['teller11']['show'] = false;
} else
    $this->_sections['teller11']['total'] = 0;
if ($this->_sections['teller11']['show']):

            for ($this->_sections['teller11']['index'] = $this->_sections['teller11']['start'], $this->_sections['teller11']['iteration'] = 1;
                 $this->_sections['teller11']['iteration'] <= $this->_sections['teller11']['total'];
                 $this->_sections['teller11']['index'] += $this->_sections['teller11']['step'], $this->_sections['teller11']['iteration']++):
$this->_sections['teller11']['rownum'] = $this->_sections['teller11']['iteration'];
$this->_sections['teller11']['index_prev'] = $this->_sections['teller11']['index'] - $this->_sections['teller11']['step'];
$this->_sections['teller11']['index_next'] = $this->_sections['teller11']['index'] + $this->_sections['teller11']['step'];
$this->_sections['teller11']['first']      = ($this->_sections['teller11']['iteration'] == 1);
$this->_sections['teller11']['last']       = ($this->_sections['teller11']['iteration'] == $this->_sections['teller11']['total']);
?>

                                        <tr class="<?php echo smarty_function_cycle(array('values' => "row, altrow"), $this);?>
">
                                                <td class="position"><?php echo $this->_tpl_vars['avgdevpos'][$this->_sections['teller11']['index']]; ?>
</td>
                                                <td class="driver"><?php echo $this->_tpl_vars['avgdevdriver'][$this->_sections['teller11']['index']]; ?>
</td>
                                                <td class="time"><?php echo $this->_tpl_vars['avgdevtime'][$this->_sections['teller11']['index']]; ?>
</td>
                                                <td class="gap"><?php echo $this->_tpl_vars['avgdevgap'][$this->_sections['teller11']['index']]; ?>
</td>
                                                
                                                <td class="team"><?php echo $this->_tpl_vars['avgdevcar'][$this->_sections['teller11']['index']]; ?>
</td>
                                        </tr>

                                        <?php endfor; endif; ?>

                                </table>

                        <!-- </div> --> <!--Avg Deviation-->
                
                </div><!--Race laptime consistency-->


                <div id="raceHistoryGraph" class="section">

                        <h2>Lenktynių grafikas - <?php echo $this->_tpl_vars['track']; ?>
 - <?php echo $this->_tpl_vars['serverName']; ?>
</h2>

                        <h3>(Vardai legendoje išdėstyti pagal finišo pozicijas)</h3>

                        <form action="racehistory.php">
                        <div><br><p>
                        

                <input type="hidden" class="hidden" name="file" value="<?php echo $this->_tpl_vars['racefile']; ?>
" />

                                <input class="graphButton" type="submit" name="submit" value="Padidinti grafiką naujame lange" />

                        </div>
         </form>

                        <img src="<?php echo $this->_tpl_vars['racehistorygraph']; ?>
" alt="" />

                </div><!--Race history graph-->


                <div id="lapByLapGraph" class="section">

                        <h2>Ratas po rato grafikas - <?php echo $this->_tpl_vars['track']; ?>
 - <?php echo $this->_tpl_vars['serverName']; ?>
</h2>

                        <h3>(Vardai legendoje išdėstyti pagal finišo pozicijas)</h3>
                        
         <form action="lapbylap.php">
                        <div><br><p>

                 <input type="hidden" class="hidden" name="file" value="<?php echo $this->_tpl_vars['racefile']; ?>
" />
        
                 <input class="graphButton" type="submit" name="submit" value="Padidinti grafiką naujame lange" />

                        </div>
         </form>

                        <img src="<?php echo $this->_tpl_vars['lapbylapgraph']; ?>
" alt="" />

                </div><!--lap by lap-->


</body>
</html>