<?php 


$q = intval($_GET['q']);
 

if(!$dbconnect = mysql_connect('localhost', 'root', 'root')) {
   echo "Connection failed to the host 'localhost'.";
   exit;
} // if
if (!mysql_select_db('db_aj')) {
   echo "Cannot connect to database 'test'";
   exit;
} // if

$table_id = 'livre';
 
$query = "SELECT *  FROM `livre`  WHERE idauteur = '".$q."'";
$dbresult = mysql_query($query, $dbconnect);
// create a new XML document

$doc = new DomDocument('1.0');

// create root node
$root = $doc->createElement('root');
$root = $doc->appendChild($root);

// process one row at a time
while($row = mysql_fetch_assoc($dbresult)) {

  // add node for each row
  $occ = $doc->createElement($table_id);
  $occ = $root->appendChild($occ);

  // add a child node for each field
  foreach ($row as $fieldname => $fieldvalue) {
 
    $child = $doc->createElement( $fieldname);
    $child = $occ->appendChild($child);

    $value = $doc->createTextNode($fieldvalue);
    $value = $child->appendChild($value);
  } // foreach
} // while
// get completed xml document
$xml_string = $doc->saveXML();
Header('Content-type: text/xml');
 
echo  $xml_string ;
 
$myfile = fopen("newfile.xml", "w") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $xml_string);
 
fclose($myfile);
 
?> 