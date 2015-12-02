<?php

namespace Homepage\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Debug\Debug;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class ImageHelper extends AbstractHelper {


    public function countImage($id) {

		$i = 0; 
		$dir = 'public/uploads/' . $id;
		if(is_dir($dir)) {
			
			if ($handle = opendir($dir)) {
				while (($file = readdir($handle)) !== false){
					if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
						$i++;
				}
			}
		
		}else{
			$i = 0;
		}
		
		return $i;
    }

	
	public function getAllImageNames($id) {
	
		$count = $this->countImage($id);
		
		if(is_dir('public/uploads/' . $id)) {
			if($count >= 1){
				$files = glob('public/uploads/' . $id. "/*.*");
				
				return $files;
			}else{
				return false;
			}
		}		
    }
    
}
