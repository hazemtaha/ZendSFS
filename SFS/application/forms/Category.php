<?php

class Application_Form_Category extends Zend_Form {

	public function init() {
		/* Form Elements & Other Definitions Here ... */
		$this->setMethod('post');

		$cat_name = new Zend_Form_Element_Text("cat_name");
		$cat_name->setAttrib("class", "form-control");
		$cat_name->setAttrib("placeholder", "Enter Category name ...");
		$cat_name->setName("name");

		$save = new Zend_Form_Element_Submit('save');
		$save->setAttrib("class","save btn btn-success");

		$this->addElements(array($cat_name, $save));
	}

}
