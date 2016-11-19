<?php date_default_timezone_set("Europe/Sofia"); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Apache</title>
</head>
<body>
<?php
	$var = "hellO";
	$world = "worldo";
	echo $var." ".$world;
	if($var === "hello"){
		echo "<br />Var is TRUE";
	}
	else if($world == "world"){
		echo "<br />world is true";
	}
	else{
		echo "<br />NOT TRUE";
	}
?>
</body>
</html>