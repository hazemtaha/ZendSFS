<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        $username = new Zend_Form_Element_Text("username");
		$username->setRequired();
		$username->setlabel("Username");
		$username->setAttrib("placeholder","Username");
		$username->setAttrib("class","form-control");

		$password = new Zend_Form_Element_Password("password");
		$password->setRequired();
		$password->setlabel("Password:");
		$password->setAttrib("placeholder","Password");
		$password->setAttrib("class","form-control");

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib("class","btn btn-primary");

		$this->addElements(array($username,$password,$submit));
    }


}

