<?php

namespace Ajax\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\File\Transfer\Adapter\Http;

class ValidationHelper extends AbstractHelper {
    
	/**
	 * @todo
	 */
	public function sampleValidation($formDatas = array())
	{
        
		$errors = array();
		
		if(empty($formDatas['name'])){
            $errors['name'] = 'All field is required.';
        }
		
		//Email Validation
		$validator = new \Zend\Validator\EmailAddress();
		if(!$validator->isValid($formDatas['email'])){
			$errors['email'] = 'Email address is invalid format.';
		}
		
		//Check record exist
		$validator = new \Zend\Validator\Db\RecordExists(
			array(
				'table' 	=> 'table_name',
				'field' 	=> 'field_name',
				'adapter' 	=> \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::getStaticAdapter(),
			)
		);
		
		//Check Stringlenght
		$validator = new \Zend\Validator\StringLength(array('min'=>'6'));
		if(!$validator->isValid($formDatas['string'])){
			$formDatas['errors']['string'] = 'string must contain 6-20 alphanumeric characters';
		}
		
		//Check pattern string
		$pattern = '((?=.*\d)(?=.*[a-zA-Z]))';
		$validator = new \Zend\Validator\Regex($pattern);
		if(!$validator->isValid($formDatas['string'])){
			$formDatas['errors']['string'] = 'string must contain alphanumeric characters';
		}
		
        
        return $errors;
    }
	
}