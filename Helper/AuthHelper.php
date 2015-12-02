<?php 
namespace Homepage\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Authentication\AuthenticationService;

class AuthHelper extends AbstractHelper
{
    
    public function __invoke($type, $datas = null)
    {
        $authService = new AuthenticationService;
        
        $authIdentity = $authService->hasIdentity();
        $authStorage = $authService->getStorage()->read();
        
        switch ($type) {
            case 'hasIdentity':
                return $authIdentity;
                break;
            
            case 'getStorage':
                return $authStorage;
                break;
        }
    }
}