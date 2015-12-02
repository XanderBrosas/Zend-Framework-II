<?php
namespace Application\Model;

use Zend\Debug\Debug;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\Sql\Predicate;
    
class modelTable extends AbstractTableGateway implements ServiceLocatorAwareInterface {

	protected $table = 'table_name';
	protected $prefix;
	protected $serviceLocator;
	
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
		$this->prefix = $serviceLocator->get('config')['db']['prefix'];
	}

	public function getServiceLocator() {
		return $this->serviceLocator;
	}
	
	public function __construct(Adapter $adapter) {
		$this->adapter = $adapter;
		$this->initialize();
	}
	
	public function sampleData() {
		
		// Sample Predicate Like
		$select->where(array(
			new Predicate\PredicateSet(
				array(
					new Predicate\Like('column', '%'.$formDatas['key'].'%')
				),
				Predicate\PredicateSet::COMBINED_BY_OR
			),
		));
		
		// Sample Predicate Between
		$select->where(array(
			new Predicate\PredicateSet(
				array(
					new Predicate\Between('column', $formDatas['key1'], $formDatas['key2']),
				),
				Predicate\PredicateSet::COMBINED_BY_OR
			),
		));
		
		//Greaterthan or LessThan
		$select->where->greaterThanOrEqualTo('column', $formDatas['key']);
		$select->where->lessThanOrEqualTo('column', $formDatas['key']);
		
		//Random Data
		$rand = new \Zend\Db\Sql\Expression('RAND()');
		$select->order($rand);
		
	}
	
}