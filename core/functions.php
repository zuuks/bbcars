<?php

function redirect($url) {
	if ($url == '') return;
	header("location: {$url}");
	exit;	
}

?>