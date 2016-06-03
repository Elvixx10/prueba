<?php

class Agregar_Form_Agenda extends Zend_Form
{
 
    public function init()
    {
        $this->setName('formContacto')
        	 ->setMethod('post')
			 ->setAction('index/agregar');
      
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
        
	  $telefono = new Zend_Form_Element_Text('telefono');
	  $telefono->setLabel('Teléfono de contacto');
	  $telefono->setIsArray(true)
	  		   ->setRequired(true)
			   ->setAttrib('required', true)
		       ->setAttrib('placeholder','5566247859')
		       ->setAttrib('class', 'form-control')
			   ->addFilters(array('StringTrim', 'StripTags'))
			   ->addValidator('Digits');
	
      $agregar = new Zend_Form_Element_Submit('Guardar');
      $agregar->setIgnore(true)
          	  ->setAttrib('class', 'btn btn-warning');

     $this->addElements(array(
            $nombre,
            $apellidoP,
            $apellidoM,
            $correo,
            $direccion,
            $telefono,
            $agregar
        ));
    }
}