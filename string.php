<?php
if (isset($_POST['string'])) {
$s = $_POST['string'];
echo $s.'<br>';
$a = json_decode($s, true);

foreach($a as $key => $value) {
	if (strcmp($key, 'msg') === 0 ) {
		$m = json_decode($value, true);
		echo "<br>msg:<br>";
		print_r($m);
		echo "<br>";
	} else echo "<br>".$key." : ".$value."<br>";
}

echo json_encode($a);
} else echo 'no string';
?>