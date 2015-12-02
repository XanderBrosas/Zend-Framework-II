<?php

namespace Homepage\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Debug\Debug;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class NotificationHelper extends AbstractHelper {


    public function flashmessanger($type, $message) {
        
        $flash = new FlashMessenger();
        
        $flash->setNamespace('application');
        
        if($type == 'success'){
            
            $html = '<div class="alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>SUCCESS!</strong>
                    <ul>' . $message . '</ul>
                </div>';
                
        
            return $html;
        
            
        }elseif($type == 'warning'){
            
            $html = '<div class="alert alert-warning fade in">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>WARNING!</strong>
                    <ul>' . $message . '</ul>
                </div>';
                
        
            return $html;
        
            
        }else{
            
            $messageArray = '<ul>';
            foreach ($message as $error) {
                $messageArray.= '<li>' . $error . '</li>';
            }
            
            $html = '<div class="alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>ERROR!</strong>' .  $messageArray . '</div>';
            
            return $flash->addErrorMessage($html);
            
        }
    }
    
}
