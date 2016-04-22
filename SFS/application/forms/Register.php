<?php

class Application_Form_Register extends Zend_Form {
	public function init() {
		$username = new Zend_Form_Element_Text('username');
		$username->setRequired();
		$username->addValidator(new Zend_Validate_Db_NoRecordExists(array(
					'table' => 'users',
					'field' => 'username',
				)));
		$username->setlabel('Username');
		$username->setAttrib('placeholder', 'Username');
		$username->setAttrib('class', 'form-control');

		$email = new Zend_Form_Element_Text('email');
		$email->setRequired();
		$email->addValidator(new Zend_Validate_EmailAddress());
		$email->addValidator(new Zend_Validate_Db_NoRecordExists(array(
					'table' => 'users',
					'field' => 'email',
				)));
		$email->setlabel('Email');
		$email->setAttrib('placeholder', 'Email');
		$email->setAttrib('class', 'form-control');

		$password = new Zend_Form_Element_Password('password');
		$password->setRequired();
		$password->setlabel('Password:');
		$password->addValidator(new Zend_Validate_StringLength(array('min' => 6, 'max' => 16)));
		$password->setAttrib('class', 'form-control');

		$gender = new Zend_Form_Element_Radio('gender');
		$gender->setLabel('Gender:');
		$gender->addMultiOptions(array(
				'0' => ' Male',
				'1' => ' Female',
			));
		$country = new Zend_Form_Element_Select('country', array(
				'label'    => 'Country',
				'required' => true,
			));
		$country->addMultiOptions(array(
				'Egypt'        => 'Egypt',
				'Saudi Arabia' => 'Saudi Arabia',
			));
		$country->setAttrib('class', 'form-control');

        $image = new Zend_Form_Element_File('picture');
        $image->setLabel('Upload an image:');
      	$image->setDestination(APPLICATION_PATH.'/../public/user-uploads/');
      	$image->setRequired(true);
      	$image->setMaxFileSize(2097152); // limits the filesize on the client side
      	// $image->setDescription('Click Browse and click on the image file you would like to upload');
        $image->addValidator('Count', false, 1);                // ensure only 1 file
		$image->addValidator('Size', false, 2097152);            // limit to 10 meg
		$image->addValidator('Extension', false, 'jpg,jpeg,png,gif');// only JPEG, PNG, and GIFs
		$image->setValueDisabled(true);
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('class', 'btn btn-primary');

		$this->setAttrib('enctype', 'multipart/form-data');
		$this->addElements(array($username, $email, $password, $gender, $country, $image, $submit));
	}
}
