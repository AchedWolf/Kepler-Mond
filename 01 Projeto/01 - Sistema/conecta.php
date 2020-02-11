 <?php
	try{
		$db = new PDO("pgsql:host=kepler.ipmet.unesp.br dbname=telescopio user=kepler password=73aKepler!@cti");
	}
	catch(PDOException $e){
		print $e->getMessage();
	}
 ?>
