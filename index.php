<!DOCTYPE html>
<html>
<style>
table,th,td {
  border : 1px solid black;
  border-collapse: collapse;
}
th,td {
  padding: 5px;
}
</style>
<body>

<h1>utiliser ajax pour avoir les titre de livre</h1>

<form action=""> 
<select name="auteur" onchange="showtitre(this.value)">
<option value="">Select auteur:</option>
<option value="ali ali">ali ali</option>
<option value="amine amine">amine amine</option>
<option value="mohamed mohamed">mohamed mohamed</option>
</select>
</form>


<script>
function getXhr(){
var xhr = null;
if(window.XMLHttpRequest) // Firefox et autres
xhr = new XMLHttpRequest();
else if(window.ActiveXObject){ // Internet Explorer
try {
xhr = new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e) {xhr = new ActiveXObject("Microsoft.XMLHTTP"); }}
else {
// XMLHttpRequest non supporté par le navigateur
alert("Le navigateur ne supporte pas les objets XMLHTTPRequest...");
xhr = false;
}
return xhr;
}

function showtitre(str) {
  var xhttp;    
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = getXhr();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getlivrebyauter.php?q="+str, true);
  xhttp.send();
}
</script>
 <?php
$mysqli = new mysqli("localhost", "root", "", "db_aj");
if($mysqli->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT nom_auteur from auteur";

$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($nomeauteur);
    /* Récupération des valeurs */
echo "<table>";
echo "<tr>";
echo "<th>titre</th>";
echo "</tr>";
    while ($stmt->fetch()) {
echo "<tr>";
      echo "<td onclick='showtitre(&quot;".$nomeauteur."&quot;);'>" . $nomeauteur . "</td>";
echo "</tr>";
    }

echo "</table>";
$stmt->fetch();
$stmt->close();
?> 

<br>
<div id="txtHint"></div>
<br>
<h1>retourner un fichier XML</h1>

  nom d'auteur:<br>
<input type="text" id="auteurname" name="auteur" value="">
<button type="button" onclick="creatxmlfile()">fichier
XML qui contient tous les livres de cet auteur</button>
<br><br>
<table id="demo"></table>
<br>
<div id="txtaray"></div>
<br>
<script>
function creatxmlfile(){
var str = document.getElementById("auteurname").value;
  var xhttp;    
  if (str == "") {
   document.getElementById("demo").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      this.responseText;
    }
  };
  xhttp.open("GET", "createxmlfile.php?auteur="+str, true);
  xhttp.send();
//alert("ok");
loadDoc();
}
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myFunction(this);
    }
  };
  xhttp.open("GET", "titrelivre.xml", true);
  xhttp.send();
}
function myFunction(xml) {
  var i;
  var xmlDoc = xml.responseXML;
  var textarea ="<textarea rows=?quot4?quot cols=?quot50?quot>"
  var table="<tr><th>titre livre</th></tr>";
  var x = xmlDoc.getElementsByTagName("livre");
  for (i = 0; i <x.length; i++) { 
    table += "<tr><td>" +
    x[i].getElementsByTagName("titre")[0].childNodes[0].nodeValue +
    "</td></tr>";
    textarea += x[i].getElementsByTagName("titre")[0].childNodes[0].nodeValue +
    "&#13;" 
  }
   textarea +="</textarea>";
  document.getElementById("demo").innerHTML = table;
  document.getElementById("txtaray").innerHTML = textarea;
}
</script>
</body>
</html>



