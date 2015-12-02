<?php
namespace Homepage\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zend\Debug\Debug,
    Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class DateHelper extends AbstractHelper {	

	public function countDom($dom, $dateModified, $dateAdded){				

		$dateNow = new \DateTime(date('Y-m-d'));		
		$added = new \DateTime($dateAdded);	
		$modified = new \DateTime($dateModified);	
		
		if($modified > $added){
			$dateModified = new \DateTime(date('Y-m-d', strtotime($dateModified)));			
			$interval = $dateModified->diff($dateNow);			

			return $interval->format('%a')+$dom;	
			
		}else{
			
			$dateAdded = new \DateTime(date('Y-m-d', strtotime($dateAdded)));			
			$interval = $dateAdded->diff($dateNow);			
			return $interval->format('%a')+$dom;		
			
		}	
		
	}
	
	
	public function countDom2($data){				

		$dateNow = new \DateTime(date('Y-m-d'));
		$dateAdded = new \DateTime($data['date_added']);	
		$dateModified = new \DateTime($data['date_modified']);	
		
		if($dateModified > $dateAdded){
			$dateModified = new \DateTime(date('Y-m-d', strtotime($data['date_modified'])));			
			$interval = $dateModified->diff($dateNow);			

			return $interval->format('%a')+$data['dom'];
			
		}else{
			
			$dateAdded = new \DateTime(date('Y-m-d', strtotime($data['date_added'])));			
			$interval = $dateAdded->diff($dateNow);			
			return $interval->format('%a')+$data['dom'];	
			
		}			
	}

}
