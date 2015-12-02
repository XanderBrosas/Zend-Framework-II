<?php 
namespace Homepage\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Rets\PhRets;

class RetsHelper extends AbstractHelper
{

    public function connect($rets) {
        $login 	= 'http://rets.torontomls.net:6103/rets-treb3pv/server/login';
		$user 	= 'username';
		$pass 	= 'password';
		
		$connect = $rets->connect($login, $user, $pass);

		if($connect) {
			return $connect;
		} else {
			return $rets->Error();
		}
    }
	
	
	public function querySearch($class, $query, $select='', $limit = 20, $offset = 1, $count = 1) {
		$rets = new PhRets;
		$connect = $this->connect($rets);
		if($connect) {
			/* Search RETS server */
			$search = $rets->SearchQuery(
				'Property',		// Resource
				$class,			// Class
				$query,			// DMQL, with SystemNames
				array(
					'Format'	=> 'COMPACT-DECODED',
					'Select'	=> $select,
					'Count'		=> $count,
					'Limit'		=> $limit,
					'Offset'	=> $offset
				)
			);
			
			/* If search returned results */
			if($rets->TotalRecordsFound() > 0) {
				$result = array();
				while($data = $rets->FetchRow($search)) {
					$result[] = $data;
				}
			} else {
				$result = 0;
			}

			$rets->FreeResult($search);
			$rets->Disconnect();

			return $result;
		} else {
			$error = $rets->Error();
			print_r($error);
		}

	}
	
	public function getImage($mls_id){
		$rets = new PhRets;
		$connect = $this->connect($rets);
		if($connect && $mls_id != '') {
			$photos 		= $rets->GetObject('Property', 'Photo', $mls_id);
			$destination 	= getcwd() . "/public/uploads/{$mls_id}";
			
			if (!file_exists($destination)) {
				mkdir($destination, 0777, true);
				chmod($destination, 0777);
			}
			
			foreach ($photos as $photo) {
				$listing 	= $photo['Content-ID'];
				$number 	= $photo['Object-ID'];
				
				if ($photo['Success'] == true) {
					$name = "image-{$listing}-{$number}.jpg";
					file_put_contents($destination.'/'.$name, $photo['Data']);
				}
			}
			
			$image_name = "image-{$mls_id}-1.jpg";
			
			return $image_name;
		}
	}
}