<?php

class Application_Form_Category extends Zend_Form {

	public function init() {
		/* Form Elements & Other Definitions Here ... */
		$this->setMethod('post');

		$name = new Zend_Form_Element_Text("name");
		$name->setAttrib("class", "form-control");
		$name->setAttrib("placeholder", "Enter Category name ...");
		$name->setName("title");

		$this->addElements(array($name));
	}

}
