<?php
include_once 'lekar.php';

class Smena
{
	public $id;
	public $dan;
	public $datum;
	public $lista;

	public function __construct($id,$dan,$datum)
	{
		$this->id=$id;
		$this->dan=$dan;
		$this->datum=$datum;
		$this->lista=array();
	}

	public function addLekara(Lekar $lekar)
	{
		$this->lista[]=$lekar;
	}
}