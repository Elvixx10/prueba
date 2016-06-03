<?php

require_once (APPLICATION_PATH.'/modules/Agenda/forms/Agregar.php');
require_once (APPLICATION_PATH.'/modules/Agenda/forms/Editar.php');
require_once (APPLICATION_PATH.'/modules/Agenda/models/DbTable/Sp.php');

class Agenda_IndexController extends Zend_Controller_Action 
{
	public function init() 
	{
		$this->_helper->layout->setLayout('layout');
	}

	public function indexAction() 
	{
		$contacto = new Agenda_Model_DbTable_Sp();
		$this->view->contacto = $contacto->getContacto();
		$form = new Agregar_Form_Agenda();
		$this->view->form = $form;
	}
	
	public function detalleAction() 
	{
		$id = $this->_getParam('id', 0);
		if(!empty($id)){
			$contacto = new Agenda_Model_DbTable_Sp();
			$this->view->telefono = $contacto->getTelefono($id);
			$this->view->contacto = $contacto->getRowContacto($id);
		}
	}
	
	public function agregarAction() 
	{
		$this->_helper->layout()->disableLayout();
		if($this->getRequest()->isXmlHttpRequest()) {
			$form = new Agregar_Form_Agenda();
			if ($form->isValid($_POST)) {
				
	        	$values = $form->getValues();
				$contanto = new Agenda_Model_DbTable_Sp();
				$id = $contanto->insertContacto(array(
					$values['nombre'],
					$values['apellidoP'],
					$values['apellidoM'],
					$values['correo'],
					$values['direccion'],
				));
				
				for ($i=0; $i<=count($values['telefono']) ; $i++) {
					if(!empty($values['telefono'][$i])) {
						$contanto->insertTelefono(array(
							$values['telefono'][$i],
							$id['id']
						));							
					}
				}
				
				$this->_helper->json(array('msg' => true));
			} else {
				$error = array();
				foreach ($form->getMessages() as $key => $value) {
					foreach ($value as $item) {
						$error['error'][] = array (
							'clave' => $key,
							'valor' => $item
						);						
					}
				}
            	$this->_helper->json($error);
			}
		}
		$this->_helper->viewRenderer->setNoRender(true);
	}
	
	public function editarAction() 
	{
		$id = $this->_getParam('id', 0);
		if(!empty($id)) {
			if($this->getRequest()->isXmlHttpRequest()) {
				$this->_helper->layout()->disableLayout();
        		$values = $_POST;
				$cuentaTel = count($values['formEditar']) - 6;
				$cuentaTel = $cuentaTel / 2;
				$contacto = new Agenda_Model_DbTable_Sp();
				
				$contacto->updateContacto(array(
					$values['formEditar']['id'],
					$values['formEditar']['nombre'],
					$values['formEditar']['apellidoP'],
					$values['formEditar']['apellidoM'],
					$values['formEditar']['correo'],
					$values['formEditar']['direccion'],						
				));
				for ($i=1; $i <= $cuentaTel; $i++) {
					$contacto->updateTelefono(array(
						$values['formEditar']['idTelefono'.$i],
						$values['formEditar']['numero'.$i]
					));
				}
				$this->_helper->json(array('msg' => true));
				$this->_helper->viewRenderer->setNoRender(true);
			} else {
				$contacto = new Agenda_Model_DbTable_Sp();
				$telefono = $contacto->getTelefono($id);
				$contacto = $contacto->getRowContacto($id);
				$form = new Editar_Form_Agenda();
				
				$i=1;
				foreach ($telefono as $value) {
					$f = new Zend_Form();
					$form->addElement('Text', 'numero'.$i, array(
					 	'label' => 'Teléfono número ' .$i,
						'value' => $value['numero'],
						'class' => 'form-control',
						'placeholder' => '5588547589',
						'required'   => true,
						'filters'    => array('StringTrim', 'StripTags'),
					))->setIsArray(true);
		
					$form->addElement('Hidden', 'idTelefono'.$i, array(
						'value' => $value['id'],
					))->setIsArray(true);
					
					$f->addSubForm($form, 'formEditar');
					$i++;			
				}
				
				$explode = explode(' ', $contacto['nombre']);
				$form->id->setValue($id);
				$form->nombre->setValue($explode[0]);
				$form->apellidoP->setValue($explode[1]);
				$form->apellidoM->setValue($explode[2]);
				$form->correo->setValue($contacto['correo']);
				$form->direccion->setValue($contacto['direccion']);
				$agregar = new Zend_Form_Element_Submit('Editar');
			    $agregar->setIgnore(true)->setAttrib('class', 'btn btn-warning');
				$form->addElement($agregar);
				$this->view->form = $form;
			}
		}
	}

}
