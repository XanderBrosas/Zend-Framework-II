<?php 
namespace Homepage\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Debug\Debug;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail as SendmailTransport;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

class EmailHelper extends AbstractHelper
{
    
    protected $siteEmail;

    
    public function __invoke($type, $formData) {
        
        $siteEmail = 'sample@yahoo.com';
        
        switch ($type) {
            case 'verify':
                return $this->verify($formData, $siteEmail);
                break;
            
        }
        
    }
    
    public function verify($formData, $siteEmail){
$htmlBody = <<<EOH
HTML HEADER
EOH;

$textBody = <<<EOH
BODY CONTENT
EOH;

		// make a header as html  
		$htmlPart  		= new MimePart($htmlBody);  
		$htmlPart->type = "text/html";  
		
		$textPart 		= new MimePart($textBody);
		$textPart->type = "text/plain";
	
		$body = new MimeMessage();  
		$body->setParts(array($textPart, $htmlPart));  
		
		// instance mail   
		$mail = new Message();
		
		$mail->setFrom($siteEmail, ' - Title')
			 ->setTo($formData['email'])
			 ->setSubject('Subject')
			 ->setEncoding("UTF-8")
			 ->setBody($body)
			 ->getHeaders()->get('content-type')->setType('multipart/alternative');	
		
		$transport = new SendmailTransport();
		$transport->send($mail);

    }
    
    
}