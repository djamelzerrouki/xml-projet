<html>
<head>
<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {   if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }else if(window.ActiveXObject){//Internet Explorer 
            try {          
                      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");    
                              } 
            catch (e) {         

                          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");   
                     } 
         else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>

<form>
<select name="users" onchange="showUser(this.value)">
  <option value="">select id autuer</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
   </select>
</form>
<br>
<div id="txtHint"><b>Person info will be listed here...</b></div>

<h1>LA LISTE DES AUTEURS</h1>

<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "root", "db_aj");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
  
 
// Attempt select query execution
$sql ="SELECT *  FROM `auteur` ;";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>nom</th>";
               
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
$id= $row[0] ;
                echo "<td>" . $row[0] . "</td>";
                echo "<td onclick='showUser($id);'>" . $row[1] . "</td>";

           //      echo "<td onclick='showUser($id);'> open</td>";

 
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not jdjd able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>


</body>
</html>