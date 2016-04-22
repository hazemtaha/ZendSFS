<?php

class Application_Form_Thread extends Zend_Form
{

    public function init()
    {
        $title = new Zend_Form_Element_Text('title');
        $title->setRequired();
        $title->addValidator(new Zend_Validate_Db_NoRecordExists(array(
          'table' => 'thread',
          'field' => 'title',
        )));
        $title->setlabel('Title');
        $title->setAttrib('placeholder', 'Thread Title');
        $title->setAttrib('class', 'form-control');

        $body = new Zend_Form_Element_Textarea('body');
        $body->setRequired();
        $body->setlabel('Body');
        $body->setAttrib('placeholder', 'Thread Body . . . . ');
        $body->setAttrib('class', 'form-control');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-primary');
        
        $this->addElements(array($title, $body, $submit));
    }


}

