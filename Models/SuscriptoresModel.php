<?php 

class SuscriptoresModel extends Mysql{

	public function selectSuscriptores()
	{
		$sql = "SELECT idsuscripcion, nombre, email, DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha
				FROM suscripciones ORDER BY idsuscripcion DESC";
		$request = $this->select_all($sql);
		return $request;
	}

}
 ?>