<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    	var_dump($this->getRequest()->getActionName());
    }

    public function indexAction()
    {
        // action body
    }


}




