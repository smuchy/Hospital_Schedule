<?php
include_once 'smena.php';

class Lekar
{
	public $id;
	public $ime;
	public $prezime;
	public $pol;
	public $radno_vreme;
	public $smena_id;

	public function __construct($id,$ime,$prezime,$pol,$radno_vreme)
	{
		$this->id=$id;
		$this->ime=$ime;
		$this->prezime=$prezime;
		$this->pol=$pol;
		$this->radno_vreme=$radno_vreme;
	}

}