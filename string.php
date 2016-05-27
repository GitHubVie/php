<?php
if (isset($_POST['string'])) {
$s = $_POST['string'];
echo $s.'<br>';
$a = json_decode($s, true);
echo json_encode($a);
} else echo 'no string';
?>