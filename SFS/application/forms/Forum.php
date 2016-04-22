<?php

class Application_Form_Forum extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('post');

    		$name = new Zend_Form_Element_Text("name");
    		$name->setAttrib("class", "form-control");
    		$name->setAttrib("placeholder", "Enter Forum name ...");
    		$name->setName("name");
        $name->setLabel('Forum Name :');


        $cat_id = new Zend_Form_Element_Select('cat_id');
        $cat_id->setLabel('Category Name :');
        $cat_id->addMultiOption(0,'please select a category....');

        $categories = new Application_Model_DbTable_Category();

        foreach ($categories->fetchAll() as $cat) {
          # code...
          $cat_id->addMultiOption($cat['cat_id'],$cat['name']);
        }

        $cat_id->setAttrib('class','form-control');



        $is_locked = new Zend_Form_Element_Checkbox("is_locked");
        $is_locked->setName("is_locked");
        $is_locked->setLabel("Check This Box if you want to lock this forum :");


        $save = new Zend_Form_Element_Submit('save');
        $save->setAttrib("class","save btn btn-success");

        $this->addElements(array($name, $is_locked, $save,$cat_id));
    }


}
