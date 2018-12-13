<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>TP 2 web 2.0</title>
<style>
table {
	font-family: Arial;	 
	padding: 2px;
}

.td1 {
	background-color: rgb(200, 250, 200);
}
</style>
</head>
<body>
	<?php
$localisation="localhost";
$db_user="root";
$db_password="root";
$db_name="db_aj";
$link=""; 
$connect=mysql_connect($localisation,$db_user,$db_password);

if ($connect){
    echo "conected...";
}

mysql_select_db( $db_name);
 
 
 
 $sql ="SELECT `id_auteur`, `nom_auteur`  FROM `auteur`";
$result = mysql_query($sql); 
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>name</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id_auteur'] . "</td>";
                echo "<td>" . $row['nom_auteur'] . "</td>";
   echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>
</body>
</html>