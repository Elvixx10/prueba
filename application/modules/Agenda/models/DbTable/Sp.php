<?php

class Agenda_Model_DbTable_Sp extends Zend_Db_Table_Abstract {
	
	public function getContacto()
	{
		$db = Zend_Db_Table::getDefaultAdapter(); 
		$stmt = $db->query("CALL getContactos()");
		$data = $stmt->fetchAll();
		$stmt->closeCursor();  
		return $data;
	}
	
	public function getRowContacto($id) 
	{
		$db = Zend_Db_Table::getDefaultAdapter(); 
		$stmt = $db->query("CALL getRowContacto(?)", $id);
		$data = $stmt->fetch();
		$stmt->closeCursor();  
		return $data;
	}
	
	public function getTelefono($idContacto)
	{
		$db = Zend_Db_Table::getDefaultAdapter(); 
		$stmt = $db->query("CALL getTelefonos(?)", $idContacto);
		$data = $stmt->fetchAll();
		$stmt->closeCursor();  
		return $data;
	}
	
	public function insertContacto(array $contacto)
	{
		$db = Zend_Db_Table::getDefaultAdapter();  
		$stmt = $db->query("CALL InsertContanto (?, ?, ?, ?, ?);", $contacto);  
		$row = $stmt->fetch();   
		$stmt->closeCursor();
		return $row;  
	}
	
	public function insertTelefono(array $telefono)
	{
		$db = Zend_Db_Table::getDefaultAdapter();  
		$stmt = $db->query("CALL InserTelefono (?, ?);", $telefono);  
		$stmt->closeCursor();
	}
	
	public function updateContacto(array $contacto)
	{
		$db = Zend_Db_Table::getDefaultAdapter();  
		$stmt = $db->query("CALL updateContacto (?, ?, ?, ?, ?, ?);", $contacto);  
		$stmt->closeCursor();
	}
	
	public function updateTelefono(array $telefono)
	{
		$db = Zend_Db_Table::getDefaultAdapter();  
		$stmt = $db->query("CALL updateTelefono (?, ?);", $telefono);  
		$stmt->closeCursor();
	}
}

?>