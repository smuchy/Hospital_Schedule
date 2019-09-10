<?php
include_once 'lekar.php';
include_once 'smena.php';

interface ISmenaService
{
	function vratiSmenu();
	function vratiLekara($idLekara);
	function azurirajLekara(Lekar $lekar);
}