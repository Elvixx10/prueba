<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initView()  
    {  
        $view = new Zend_View();
        $view->doctype('HTML5');
        $view->setEncoding('UTF-8');
        $view->headTitle()->setSeparator(' | ')
                          ->append('Examen'); 
        
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=utf-8')
                         ->setName('viewport', 'width=device-width, 
                            height=device-height, 
                            initial-scale=1.0, 
                            minimum-scale=1.0,  
                            user-scalable=yes, 
                            target-densitydpi=device-dpi')
                         ->setName('author', 'Elvis Cueto Tello')
                         ->setName('description', 'Interesse')
                         ->setName('keywords', 'Agenda, Usuarios, Prueba');
                         
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
           'ViewRenderer'
        );
        $viewRenderer->setView($view);
        return $view;
    }
    
    public function _initViewHelperPath()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->addHelperPath(
            APPLICATION_PATH . '/views/helpers',
            'Zend_View_Helper'
        );
    }
    
    public function _initViewScriptPath()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->addScriptPath(
            APPLICATION_PATH . '/views/scripts'
        );
    }
    
   
    
    
}