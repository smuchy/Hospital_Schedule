<?php
include_once 'lib.php';
include_once 'lekar.php';
include_once 'smena.php';
include_once 'ISmenaService.php';

$baza=new SmenaService();

if(isset($_POST["ime"]))
{
	$lekar=new Lekar($_POST["id"],$_POST["ime"],$_POST["prezime"],$_POST["pol"],$_POST["radno_vreme"]);
	$baza->azurirajLekara($lekar);
}

$smena=$baza->vratiSmenu();
echo json_encode($smena);

