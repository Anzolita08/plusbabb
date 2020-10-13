<?php
$mysqli = new mysqli('localhost', 'root','','plusbabb');

function fechaNormal($fecha){
	$nfecha = date ('d/m/Y',strtotime($fecha));
	return $nfecha;
}
?>