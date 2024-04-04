<?php
include_once 'shared.php';

function count_update($mysqli,$surl){
	$count=mysqli_fetch_all(mysqli_query($mysqli, "SELECT usage_count FROM sites WHERE id = '$surl'"))[0][0];
	$count++;
	mysqli_query($mysqli,"UPDATE sites SET usage_count='$count' where id='$surl'");
}

$surl=$_GET['s'];
$url=mysqli_query($mysqli, "SELECT url_long FROM sites WHERE id = '$surl'");
if(mysqli_num_rows($url) != 0){
	$url=mysqli_fetch_all($url)[0][0];
	$cf=mysqli_fetch_all(mysqli_query($mysqli, "SELECT value FROM config WHERE name = 'count_fail'"))[0][0];
	
	$handle = curl_init($url);
	curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($handle);
	$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
	if($httpCode != 200) {
		echo "Page you're looking is unavaliable with the error code $httpCode <br>";
		$error_in_table = mysqli_query($mysqli,"SELECT * FROM errors WHERE code = $httpCode ");
		if(mysqli_num_rows($error_in_table) != 0){
			echo mysqli_fetch_all(mysqli_query($mysqli,"SELECT message FROM errors WHERE code = $httpCode "))[0][0];
		}
		echo "<br> But if you know how to bypass this you can still try to open it with <a href='$url'>this</a> link";
		if ($cf=="1"){
			count_update($mysqli,$surl);
		}
	}
	else{
		count_update($mysqli,$surl);
		echo "<script type='text/JavaScript'>window.location.replace('$url');</script>";
	}
	curl_close($handle);
}
else{
	echo "This short link is not found";
}
?>
