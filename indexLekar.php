<?php
include_once 'lib.php';
include_once 'lekar.php';
include_once 'smena.php';
include_once 'ISmenaService.php';

$baza=new SmenaService();

if(isset($_GET["id"]))
{
	$lekar=$baza->vratiLekara($_GET["id"]);
	echo json_encode($lekar);
}