<?php
include_once 'shared.php';
echo "<table border='1'>";
echo "<tr><td>The Shortened Name</td><td>The Usage Count</td><td>The Long Link</td></tr>";
$data = mysqli_fetch_all(mysqli_query($mysqli, "SELECT id, usage_count, url_long FROM sites"));
foreach($data as $line){
	echo"<tr>";
	foreach ($line as $value){
		echo "<td>$value</td>";
	}
	echo"</tr>";
} 
echo "</table>";
?>
