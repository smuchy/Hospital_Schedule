<?php
include_once 'lekar.php';
include_once 'smena.php';
include_once 'ISmenaService.php';

class SmenaService implements ISmenaService
{
	const db_host='localhost';
	const db_user='root';
	const db_pass='';
	const db_name='januar';

	public function azurirajLekara(Lekar $lekar)
	{
		$con = new mysqli(self::db_host, self::db_user, self::db_pass, self::db_name);
        $con->set_charset('utf8');
        if ($con->connect_errno) {
            print ("Connection error (" . $con->connect_errno . "): $con->connect_error");
        }
        else {
            $res = $con->query("UPDATE lekar SET ime='$lekar->ime', prezime='$lekar->prezime', pol='$lekar->pol', radno_vreme='$lekar->radno_vreme' WHERE id='$lekar->id'");
            if ($res) {

            }
            else
            {
                print ("Query failed");
            }
        }
	}

	public function vratiLekara($idLekara)
	{
		$con = new mysqli(self::db_host, self::db_user, self::db_pass, self::db_name);
        $con->set_charset('utf8');
        if ($con->connect_errno) {
            print ("Connection error (" . $con->connect_errno . "): $con->connect_error");
        }
        else {
            $res = $con->query("SELECT * FROM lekar WHERE id='$idLekara'");
            if ($res) {
            	$lekar=null;
            	if($row=$res->fetch_assoc())
            	{
            		$lekar=new Lekar($row["id"],$row["ime"],$row["prezime"],$row["pol"],$row["radno_vreme"]);
            	}
            	$res->close();
            	return $lekar;
            }
            else
            {
                print ("Query failed");
            }
        }
	}

	public function vratiSmenu()
	{
		$con = new mysqli(self::db_host, self::db_user, self::db_pass, self::db_name);
        $con->set_charset('utf8');
        if ($con->connect_errno) {
            print ("Connection error (" . $con->connect_errno . "): $con->connect_error");
        }
        else {
            $res = $con->query("SELECT * FROM smena");
            if ($res) {
            	$smena=null;
            	if($row=$res->fetch_assoc())
            	{
            		$smena=new Smena($row["id"],$row["dan"],$row["datum"]);
            	}
            	
            	$res->close();
            	$res = $con->query("SELECT * FROM lekar WHERE smena_id='$smena->id'");
            	if($res)
            	{
	            	$lekar=null;
	            	while($row=$res->fetch_assoc())
	            	{
	            		$lekar=new Lekar($row["id"],$row["ime"],$row["prezime"],$row["pol"],$row["radno_vreme"]);
	            		$smena->addLekara($lekar);
	            	}
	            	$res->close();
	            }
	            return $smena;

            }
            else
            {
                print ("Query failed");
            }
        }
	}


}