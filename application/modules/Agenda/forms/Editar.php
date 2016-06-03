<?php

class Editar_Form_Agenda extends Zend_Form
{
    public function init()
    {
        $this->setName('formEditar')
        	 ->setMethod('post')
			 ->setAction('index/editar/');
      	
		$id = new Zend_Form_Element_Hidden('id');
		
        $nombre = new Zend_Form_Element_Text('nombre');
        $nombre->setLabel('Nombre');
        $nombre->setRequired(true)
			   ->setAttrib('required', true)
               ->setAttrib('placeholder','Mario')
               ->setAttrib('class', 'form-control')
			   ->addFilters(array('StringTrim', 'StripTags'));
		
		$apellidoP = new Zend_Form_Element_Text('apellidoP');
        $apellidoP->setLabel('Apellido paterno');
        $apellidoP->setRequired(true)
		       ->setAttrib('required', true)
               ->setAttrib('placeholder','Alto')
               ->setAttrib('class', 'form-control')
			   ->addFilters(array('StringTrim', 'StripTags')); 
		
		$apellidoM = new Zend_Form_Element_Text('apellidoM');
        $apellidoM->setLabel('Apellido materno');
        $apellidoM->setRequired(true)
			   ->setAttrib('required', true)
               ->setAttrib('placeholder','Cruz')
               ->setAttrib('class', 'form-control')
			   ->addFilters(array('StringTrim', 'StripTags')); 
        
        $correo = new Zend_Form_Element_Text('correo');
        $correo->setLabel('Correo electrónico');
        $correo->setRequired(true)
			   ->setAttrib('required', true)
		       ->setAttrib('placeholder','mario@local.com')
		       ->setAttrib('class', 'form-control')
			   ->addFilters(array('StringTrim', 'StripTags'))
    		   ->addValidator('EmailAddress',  TRUE  );
		
		$direccion = new Zend_Form_Element_Text('direccion');
        $direccion->setLabel('Dirección');
        $direccion->setRequired(true)
			   ->setAttrib('required', true)
		       ->setAttrib('placeholder','Calle #2')
		       ->setAttrib('class', 'form-control')
			   ->addFilters(array('StringTrim', 'StripTags'));
        
     $this->addElements(array(
     		$id,
            $nombre,
            $apellidoP,
            $apellidoM,
            $correo,
            $direccion
        ));
    }
}