<?php

class Application_Form_Category extends Zend_Form {

	public function init() {
		/* Form Elements & Other Definitions Here ... */
		$this->setMethod('post');

		$name = new Zend_Form_Element_Text("name");
		$name->setAttrib("class", "form-control");
		$name->setAttrib("placeholder", "Enter Category name ...");
		$name->setName("name");

		$save = new Zend_Form_Element_Submit('save');
		$save->setAttrib("class","save btn btn-success");

		$this->addElements(array($name, $save));
	}

}