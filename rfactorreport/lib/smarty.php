<?php
   // put full path to Smarty.class.php
   require('../smarty/Smarty.class.php');

   $smarty = new Smarty();

   $smarty->template_dir = 'smarty_templates';
   $smarty->compile_dir = 'smarty_templates_c';
   $smarty->cache_dir = 'smarty_cache';
   $smarty->config_dir = 'smarty_config';

# iterate through an array of nodes
# looking for a text node
# return its content
function get_content($parent)
{
    $nodes = $parent->children();
    while($node = array_shift($nodes))
        if ($node->type == XML_TEXT_NODE)
            return $node->content;
    return "";
}

# get the content of a particular node
function find_content($parent,$name)
{
    $nodes = $parent->children();
    while($node = array_shift($nodes))
        if ($node->name == $name)
            return get_content($node);
    return "";
}

# get an attribute from a particular node
function find_attr($parent,$name,$attr)
{
    $nodes = $parent->children();
    while($node = array_shift($nodes))
        if ($node->name == $name)
            return $node->getattr($attr);
    return "";
}

# load xml doc
$doc = xmldocfile("http://www.vrl-simracing.be/rfactor-report/abc.xml") or die("What employees?");

# get root Node (employees)
$root = $doc->root();

# get an array of employees' children
# that is each employee node
$employees = $root->children();

# shift through the array
# and print out some employee data
while($employee = array_shift($employees))
{
    if ($employee->type == XML_TEXT_NODE)
        continue;

    $name = find_content($employee,"name");
    $pos = find_content($employee,"position");
    $type = find_attr($employee,"position","type");

    echo "$name the $pos, $type employee<br>";
}

?>

   //$smarty->assign('track', $track);
   //$smarty->display('index.tpl');
?>