<?php

function nexts($string){
	if(substr_count($string,'z')==strlen($string)){
		return a.str_repeat('a',strlen($string));
	}
	$arr=str_split($string);
	$pos=count($arr);
	$zcount=0;
	while ($arr[--$pos]=='z'){$arr[$pos]='a';}
	$arr[$pos]++;
	return implode('',$arr);	
}

include_once 'shared.php';

$url=$_POST['url'];
$url = filter_var($url, FILTER_SANITIZE_URL);


if (filter_var($url, FILTER_VALIDATE_URL)) {
    $name   = mysqli_fetch_all(mysqli_query($mysqli, "SELECT value FROM config WHERE name = 'next'"))[0][0];
    $suffix = mysqli_fetch_all(mysqli_query($mysqli, "SELECT value FROM config WHERE name = 'suffix'"))[0][0];
    $prefix = mysqli_fetch_all(mysqli_query($mysqli, "SELECT value FROM config WHERE name = 'prefix'"))[0][0];
    mysqli_query($mysqli,"INSERT INTO sites VALUES ('$name', '$url', 0)");
    $saddr=$prefix.$_SERVER['SERVER_NAME'].$name;
    echo "<a href='$saddr'>$saddr</a>";
    $name=nexts($name);
    mysqli_query($mysqli,"UPDATE config SET value='$name' where name='next'");
	} 
	else {
		echo("$url is not a valid URL");
	}
?>
